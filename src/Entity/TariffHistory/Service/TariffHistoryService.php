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
	 * @param array $filter
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistoryCollection|TariffHistory[]
	 */
	public function findBy(
		array $filter,
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistoryCollection
	{
		return $this->em->getRepository(TariffHistory::class)
			->findBy($filter, $configuration);
	}

	/**
	 * @param \Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff
	 * @param \Sellastica\Project\Entity\Project $project
	 * @param string $title
	 * @param \DateTime|null $validFrom
	 * @param \DateTime|null $validTill
	 * @param \Sellastica\Crm\Model\AccountingPeriod $period
	 * @return TariffHistory
	 */
	public function createNewHistory(
		\Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff,
		\Sellastica\Project\Entity\Project $project,
		string $title,
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
			$title,
			$validFrom
		)->accountingPeriod($period)
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
	 * @return TariffHistory|IEntity|null
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
	 * @param \DateTime $from
	 * @param \DateTime $till
	 * @return TariffHistory|null
	 */
	public function findHistoryFromTill(
		\Sellastica\App\Entity\App $app,
		\Sellastica\Project\Entity\Project $project,
		\DateTime $from,
		\DateTime $till
	): ?TariffHistory
	{
		return $this->em->getRepository(TariffHistory::class)->findOneBy([
			'projectId' => $project->getId(),
			'applicationId' => $app->getId(),
			'validFrom <= "' . $from->format('Y-m-d') . '"',
			"(validTill >= '{$till->format('Y-m-d')}' OR validTill IS NULL)"
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