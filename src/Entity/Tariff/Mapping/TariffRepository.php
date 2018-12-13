<?php
namespace Sellastica\Crm\Entity\Tariff\Mapping;

use Sellastica\Crm\Entity\Tariff\Entity\ITariffRepository;
use Sellastica\Crm\Entity\Tariff\Entity\Tariff;
use Sellastica\Entity\Mapping\Repository;

/**
 * @property \Sellastica\Crm\Entity\Tariff\Mapping\TariffDao $dao
 * @see \Sellastica\Crm\Entity\Tariff\Entity\Tariff
 */
class TariffRepository extends Repository implements ITariffRepository
{
	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @return Tariff|null
	 */
	public function getCurrentTariff(int $projectId, int $applicationId): ?Tariff
	{
		return $this->initialize($this->dao->getCurrentTariff($projectId, $applicationId));
	}
}