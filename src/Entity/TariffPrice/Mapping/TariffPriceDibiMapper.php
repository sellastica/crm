<?php
namespace Sellastica\Crm\Entity\TariffPrice\Mapping;

use Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice;
use Sellastica\Entity\Mapping\DibiMapper;

/**
 * @see TariffPrice
 */
class TariffPriceDibiMapper extends DibiMapper
{
	/**
	 * @return bool
	 */
	protected function isInCrmDatabase(): bool
	{
		return true;
	}
}