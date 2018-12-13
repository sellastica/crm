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
	 * @param int $projectId
	 * @param int $applicationId
	 * @return int|false
	 */
	public function isNextMonthHistory(int $projectId, int $applicationId): bool
	{
		$nextMonth = new \DateTime('Y-m-01');
		$nextMonth = $nextMonth->add(new \DateInterval('P1M'));
		g($nextMonth);
		return (bool)$this->getResourceWithIds()
			->where('projectId = %i', $projectId)
			->where('applicationId = %i', $applicationId)
			->where('validFrom <= %d', $nextMonth)
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