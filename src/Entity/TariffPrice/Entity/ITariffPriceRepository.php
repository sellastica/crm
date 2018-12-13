<?php
namespace Sellastica\Crm\Entity\TariffPrice\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method TariffPrice find(int $id)
 * @method TariffPrice findOneBy(array $filterValues)
 * @method TariffPrice findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method TariffPrice[]|TariffPriceCollection findAll(Configuration $configuration = null)
 * @method TariffPrice[]|TariffPriceCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method TariffPrice[]|TariffPriceCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method TariffPrice[]|TariffPriceCollection findPublishable(int $id)
 * @method TariffPrice[]|TariffPriceCollection findAllPublishable(Configuration $configuration = null)
 * @method TariffPrice[]|TariffPriceCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see TariffPrice
 */
interface ITariffPriceRepository extends IRepository
{
}