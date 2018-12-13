<?php
namespace Sellastica\Crm\Entity\TariffHistory\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method TariffHistory find(int $id)
 * @method TariffHistory findOneBy(array $filterValues)
 * @method TariffHistory findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method TariffHistory[]|TariffHistoryCollection findAll(Configuration $configuration = null)
 * @method TariffHistory[]|TariffHistoryCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method TariffHistory[]|TariffHistoryCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method TariffHistory[]|TariffHistoryCollection findPublishable(int $id)
 * @method TariffHistory[]|TariffHistoryCollection findAllPublishable(Configuration $configuration = null)
 * @method TariffHistory[]|TariffHistoryCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see TariffHistory
 */
interface ITariffHistoryRepository extends IRepository
{
	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @return TariffHistory|null
	 */
	function getCurrentHistory(int $projectId, int $applicationId): ?TariffHistory;
}