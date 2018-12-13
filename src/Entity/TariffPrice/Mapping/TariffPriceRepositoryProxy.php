<?php
namespace Sellastica\Crm\Entity\TariffPrice\Mapping;

use Sellastica\Crm\Entity\TariffPrice\Entity\ITariffPriceRepository;
use Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice;
use Sellastica\Entity\Mapping\RepositoryProxy;

/**
 * @method \Sellastica\Crm\Entity\TariffPrice\Mapping\TariffPriceRepository getRepository()
 * @see TariffPrice
 */
class TariffPriceRepositoryProxy extends RepositoryProxy implements ITariffPriceRepository
{
}