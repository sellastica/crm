<?php
namespace Sellastica\Crm\Entity\TariffHistory\Mapping;

use Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory;
use Sellastica\Entity\Mapping\DibiMapper;

/**
 * @see \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory
 */
class TariffHistoryDibiMapper extends DibiMapper
{
	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @return int|false
	 */
	public function getCurrentHistory(int $projectId, int $applicationId)
	{
		return $this->getResourceWithIds()
			->where('projectId = %i', $projectId)
			->where('applicationId = %i', $applicationId)
			->where('validFrom <= NOW()')
			->where('(validTill IS NULL OR validTill >= NOW())')
			->fetchSingle();
	}

	/**
	 * @return bool
	 */
	protected function isInCrmDatabase(): bool
	{
		return true;
	}
}