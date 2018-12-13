<?php
namespace Sellastica\Crm\Entity\Tariff\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method Tariff find(int $id)
 * @method Tariff findOneBy(array $filterValues)
 * @method Tariff findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method Tariff[]|TariffCollection findAll(Configuration $configuration = null)
 * @method Tariff[]|TariffCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method Tariff[]|TariffCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method Tariff[]|TariffCollection findPublishable(int $id)
 * @method Tariff[]|TariffCollection findAllPublishable(Configuration $configuration = null)
 * @method Tariff[]|TariffCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see Tariff
 */
interface ITariffRepository extends IRepository
{
	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @return Tariff|null
	 */
	function getCurrentTariff(int $projectId, int $applicationId): ?Tariff;
}