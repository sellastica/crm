<?php
namespace Sellastica\Crm\Entity\TariffHistory\Mapping;

use Sellastica\Crm\Entity\TariffHistory\Entity\ITariffHistoryRepository;
use Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory;
use Sellastica\Entity\Mapping\Repository;

/**
 * @property \Sellastica\Crm\Entity\TariffHistory\Mapping\TariffHistoryDao $dao
 * @see \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory
 */
class TariffHistoryRepository extends Repository implements ITariffHistoryRepository
{
	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @return \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory|null
	 */
	public function getCurrentHistory(int $projectId, int $applicationId): ?TariffHistory
	{
		return $this->initialize($this->dao->getCurrentHistory($projectId, $applicationId));
	}
}