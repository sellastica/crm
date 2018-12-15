<?php
namespace Sellastica\Crm\Entity\Tariff\Service;

use Sellastica\Crm\Entity\TariffHistory\Service\TariffHistoryService;
use Sellastica\Entity\Entity\IEntity;

class TariffService
{
	/** @var \Sellastica\Entity\EntityManager */
	private $em;
	/** @var TariffHistoryService */
	private $historyService;


	/**
	 * TariffService constructor.
	 * @param \Sellastica\Entity\EntityManager $em
	 * @param TariffHistoryService $historyService
	 */
	public function __construct(
		\Sellastica\Entity\EntityManager $em,
		TariffHistoryService $historyService
	)
	{
		$this->em = $em;
		$this->historyService = $historyService;
	}

	/**
	 * @param int $id
	 * @return null|\Sellastica\Crm\Entity\Tariff\Entity\Tariff
	 */
	public function find(int $id): ?\Sellastica\Crm\Entity\Tariff\Entity\Tariff
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Tariff\Entity\Tariff::class)->find($id);
	}

	/**
	 * @param array $filter
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return \Sellastica\Crm\Entity\Tariff\Entity\TariffCollection|\Sellastica\Crm\Entity\Tariff\Entity\Tariff[]
	 */
	public function findBy(
		array $filter,
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Crm\Entity\Tariff\Entity\TariffCollection
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Tariff\Entity\Tariff::class)
			->findBy($filter, $configuration);
	}

	/**
	 * @param \Sellastica\App\Entity\App $app
	 * @return \Sellastica\Crm\Entity\Tariff\Entity\Tariff|IEntity|null
	 */
	public function getDefaultTariff(
		\Sellastica\App\Entity\App $app
	): ?\Sellastica\Crm\Entity\Tariff\Entity\Tariff
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Tariff\Entity\Tariff::class)->findOneBy([
			'applicationId' => $app->getId(),
		], \Sellastica\Entity\Configuration::sortBy('priority'));
	}

	/**
	 * @param \Sellastica\App\Entity\App $app
	 * @param \Sellastica\Project\Entity\Project $project
	 * @return \Sellastica\Crm\Entity\Tariff\Entity\Tariff|null
	 */
	public function getCurrentTariff(
		\Sellastica\App\Entity\App $app,
		\Sellastica\Project\Entity\Project $project
	): ?\Sellastica\Crm\Entity\Tariff\Entity\Tariff
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Tariff\Entity\Tariff::class)->getCurrentTariff(
			$project->getId(), $app->getId()
		);
	}

	/**
	 * @param \Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff
	 * @param \Sellastica\Project\Entity\Project $project
	 * @return bool
	 */
	public function isCurrent(
		\Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff,
		\Sellastica\Project\Entity\Project $project
	): bool
	{
		return $tariff == $this->getCurrentTariff($tariff->getApplication(), $project); //==
	}

	/**
	 * @param \Sellastica\App\Entity\App $app
	 * @return \Sellastica\Crm\Entity\Tariff\Entity\TariffCollection
	 */
	public function getAllTariffs(\Sellastica\App\Entity\App $app): \Sellastica\Crm\Entity\Tariff\Entity\TariffCollection
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Tariff\Entity\Tariff::class)
			->findBy(['applicationId' => $app->getId()], \Sellastica\Entity\Configuration::sortBy('priority'));
	}

	/**
	 * @param \Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff
	 * @param \Sellastica\Crm\Model\AccountingPeriod $period
	 * @param \DateTime|null $validFrom
	 * @param \Sellastica\Project\Entity\Project $project
	 */
	public function setTariff(
		\Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff,
		\Sellastica\Project\Entity\Project $project,
		\Sellastica\Crm\Model\AccountingPeriod $period,
		\DateTime $validFrom = null
	)
	{
		$tariffHistory = $this->historyService->createNewHistory(
			$tariff,
			$project,
			$validFrom ?? new \DateTime('today'),
			null,
			$period
		);
		$tariffHistory->setProduction();
	}
}