<?php
namespace Sellastica\Crm\Entity\TariffHistory\Mapping;

use Sellastica\Crm\Entity\TariffHistory\Entity\ITariffHistoryRepository;
use Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory;
use Sellastica\Entity\Mapping\RepositoryProxy;

/**
 * @method \Sellastica\Crm\Entity\TariffHistory\Mapping\TariffHistoryRepository getRepository()
 * @see \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory
 */
class TariffHistoryRepositoryProxy extends RepositoryProxy implements ITariffHistoryRepository
{
	public function getCurrentHistory(int $projectId, int $applicationId): ?TariffHistory
	{
		return $this->getRepository()->getCurrentHistory($projectId, $applicationId);
	}
}