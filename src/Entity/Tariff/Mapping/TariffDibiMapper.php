<?php
namespace Sellastica\Crm\Entity\Tariff\Mapping;

use Sellastica\Crm\Entity\Tariff\Entity\Tariff;
use Sellastica\Entity\Mapping\DibiMapper;

/**
 * @see \Sellastica\Crm\Entity\Tariff\Entity\Tariff
 */
class TariffDibiMapper extends DibiMapper
{
	/**
	 * @return bool
	 */
	protected function isInCrmDatabase(): bool
	{
		return true;
	}

	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @return int|false
	 */
	public function getCurrentTariff(int $projectId, int $applicationId)
	{
		return $this->database->select('tariffId')
			->from('%n.tariff_history', $this->environment->getCrmDatabaseName())->as('th')
			->innerJoin('%n.tariff', $this->environment->getCrmDatabaseName())
			->on('th.tariffId = tariff.id')
			->where('th.projectId = %i', $projectId)
			->where('tariff.applicationId = %i', $applicationId)
			->where('(th.validTill IS NULL OR th.validTill > NOW())')
			->fetchSingle();
	}
}