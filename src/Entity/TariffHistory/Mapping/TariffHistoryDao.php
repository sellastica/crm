<?php
namespace Sellastica\Crm\Entity\TariffHistory\Mapping;

use Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory;
use Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistoryBuilder;
use Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistoryCollection;
use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;

/**
 * @see TariffHistory
 * @property TariffHistoryDibiMapper $mapper
 */
class TariffHistoryDao extends Dao
{
	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @return \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory|IEntity|null
	 */
	public function getCurrentHistory(int $projectId, int $applicationId): ?TariffHistory
	{
		return $this->find($this->mapper->getCurrentHistory($projectId, $applicationId));
	}

	/**
	 * @inheritDoc
	 */
	protected function getBuilder(
		$data,
		$first = null,
		$second = null
	): IBuilder
	{
		$data->accountingPeriod = $data->accountingPeriod
			? \Sellastica\Crm\Model\AccountingPeriod::from($data->accountingPeriod)
			: null;
		return TariffHistoryBuilder::create(
			$data->projectId,
			$data->applicationId,
			$data->tariffId,
			$data->title,
			$data->validFrom
		)->hydrate($data);
	}

	/**
	 * @return EntityCollection|TariffHistoryCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new TariffHistoryCollection;
	}
}