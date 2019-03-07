<?php
namespace Sellastica\Crm\Entity\Tariff\Mapping;

use Sellastica\Crm\Entity\Tariff\Entity\Tariff;
use Sellastica\Crm\Entity\Tariff\Entity\TariffBuilder;
use Sellastica\Crm\Entity\Tariff\Entity\TariffCollection;
use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;

/**
 * @see Tariff
 * @property TariffDibiMapper $mapper
 */
class TariffDao extends Dao
{
	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @return \Sellastica\Crm\Entity\Tariff\Entity\Tariff|IEntity|null
	 */
	public function getCurrentTariff(int $projectId, int $applicationId): ?Tariff
	{
		return $this->find($this->mapper->getCurrentTariff($projectId, $applicationId));
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
		return TariffBuilder::create(
			$data->applicationId,
			$data->level,
			$data->title,
			$data->stockQuantityPeriod,
			$data->priority
		)->hydrate($data);
	}

	/**
	 * @return EntityCollection|TariffCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new TariffCollection;
	}
}