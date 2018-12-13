<?php
namespace Sellastica\Crm\Entity\Tariff\Mapping;

use Sellastica\Crm\Entity\Tariff\Entity\ITariffRepository;
use Sellastica\Crm\Entity\Tariff\Entity\Tariff;
use Sellastica\Entity\Mapping\RepositoryProxy;

/**
 * @method \Sellastica\Crm\Entity\Tariff\Mapping\TariffRepository getRepository()
 * @see Tariff
 */
class TariffRepositoryProxy extends RepositoryProxy implements ITariffRepository
{
	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @return Tariff|null
	 */
	public function getCurrentTariff(int $projectId, int $applicationId): ?Tariff
	{
		return $this->getRepository()->getCurrentTariff($projectId, $applicationId);
	}
}