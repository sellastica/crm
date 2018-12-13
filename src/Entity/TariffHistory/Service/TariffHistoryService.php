<?php
namespace Sellastica\Crm\Entity\TariffHistory\Service;

use Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory;
use Sellastica\Entity\Entity\IEntity;

class TariffHistoryService
{
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->em = $em;
	}

	/**
	 * @param \Sellastica\Project\Entity\Project $project
	 * @param \Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff
	 * @param \DateTime|null $validFrom
	 * @param \DateTime|null $validTill
	 * @param \Sellastica\Crm\Model\AccountingPeriod $period
	 * @return \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory
	 * @throws \InvalidArgumentException
	 */
	public function createNewHistory(
		\Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff,
		\Sellastica\Project\Entity\Project $project,
		\DateTime $validFrom,
		\DateTime $validTill = null,
		\Sellastica\Crm\Model\AccountingPeriod $period = null
	): TariffHistory
	{
		$this->endCurrentHistory($tariff->getApplication(), $project);
		$newHistory = \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistoryBuilder::create(
			$project->getId(),
			$tariff->getApplicationId(),
			$tariff->getId(),
			$validFrom
		)
			->accountingPeriod($period)
			->validTill($validTill)
			->build();
		$this->em->persist($newHistory);

		return $newHistory;
	}

	/**
	 * @param \Sellastica\App\Entity\App $app
	 * @param \Sellastica\Project\Entity\Project $project
	 */
	public function endCurrentHistory(
		\Sellastica\App\Entity\App $app,
		\Sellastica\Project\Entity\Project $project
	)
	{
		if ($currentHistory = $this->getCurrentHistory($app, $project)) {
			$currentHistory->end();
		}
	}

	/**
	 * @param \Sellastica\App\Entity\App $app
	 * @param \Sellastica\Project\Entity\Project $project
	 * @return \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory|IEntity|null
	 */
	public function getCurrentHistory(
		\Sellastica\App\Entity\App $app,
		\Sellastica\Project\Entity\Project $project
	): ?TariffHistory
	{
		return $this->em->getRepository(TariffHistory::class)->getCurrentHistory($project->getId(), $app->getId());
	}

	/**
	 * @param \Sellastica\App\Entity\App $app
	 * @param \Sellastica\Project\Entity\Project $project
	 * @return bool
	 */
	public function isNextMonthHistory(
		\Sellastica\App\Entity\App $app,
		\Sellastica\Project\Entity\Project $project
	): bool
	{
		$nextMonth = new \DateTime();
		$nextMonth->setDate($nextMonth->format('Y'), $nextMonth->format('m'), 1);
		$nextMonth->setTime(0, 0, 0);
		$nextMonth = $nextMonth->add(new \DateInterval('P1M'))->format('Y-m-d');

		return $this->em->getRepository(TariffHistory::class)->existsBy([
			'projectId' => $project->getId(),
			'applicationId' => $app->getId(),
			'validFrom <= "' . $nextMonth . '"',
		]);
	}

	/**
	 * @param \Sellastica\App\Entity\App $app
	 * @param \Sellastica\Project\Entity\Project $project
	 * @return TariffHistory|IEntity|null
	 */
	public function getLastHistory(
		\Sellastica\App\Entity\App $app,
		\Sellastica\Project\Entity\Project $project
	): ?TariffHistory
	{
		return $this->em->getRepository(TariffHistory::class)->findOneBy([
			'applicationId' => $app->getId(),
			'projectId' => $project->getId(),
		], \Sellastica\Entity\Configuration::sortBy('COALESCE(validTill, NOW())', false));
	}
}