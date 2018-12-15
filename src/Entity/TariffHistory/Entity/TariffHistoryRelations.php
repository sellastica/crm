<?php
namespace Sellastica\Crm\Entity\TariffHistory\Entity;

/**
 * @property TariffHistory $tariffHistory
 */
class TariffHistoryRelations implements \Sellastica\Entity\Relation\IEntityRelations
{
	/** @var TariffHistory */
	private $tariffHistory;
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param TariffHistory $tariffHistory
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		TariffHistory $tariffHistory,
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->tariffHistory = $tariffHistory;
		$this->em = $em;
	}

	/**
	 * @return \Sellastica\Crm\Entity\Tariff\Entity\Tariff
	 */
	public function getTariff(): \Sellastica\Crm\Entity\Tariff\Entity\Tariff
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Tariff\Entity\Tariff::class)
			->find($this->tariffHistory->getTariffId());
	}

	/**
	 * @return \Sellastica\Project\Entity\Project
	 */
	public function getProject(): \Sellastica\Project\Entity\Project
	{
		return $this->em->getRepository(\Sellastica\Project\Entity\Project::class)
			->find($this->tariffHistory->getProjectId());
	}
}