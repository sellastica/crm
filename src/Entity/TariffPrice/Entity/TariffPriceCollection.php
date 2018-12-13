<?php
namespace Sellastica\Crm\Entity\TariffPrice\Entity;

use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Localization\Model\Currency;

/**
 * @property \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice $items
 * @method TariffPriceCollection add($entity)
 * @method TariffPriceCollection remove($key)
 * @method \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice|mixed getEntity(int $entityId, $default = null)
 * @method \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice|mixed getBy(string $property, $value, $default = null)
 */
class TariffPriceCollection extends EntityCollection
{
	/**
	 * @param Currency $currency
	 * @return \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice|null
	 */
	public function getPrice(Currency $currency): ?\Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice
	{
		return $this->get(function(\Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice $price) use ($currency) {
			return $price->getCurrency()->equals($currency);
		});
	}
}