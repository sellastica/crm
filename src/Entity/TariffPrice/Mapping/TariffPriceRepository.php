<?php
namespace Sellastica\Crm\Entity\TariffPrice\Mapping;

use Sellastica\Crm\Entity\TariffPrice\Entity\ITariffPriceRepository;
use Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice;
use Sellastica\Entity\Mapping\Repository;

/**
 * @property \Sellastica\Crm\Entity\TariffPrice\Mapping\TariffPriceDao $dao
 * @see \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice
 */
class TariffPriceRepository extends Repository implements ITariffPriceRepository
{
}