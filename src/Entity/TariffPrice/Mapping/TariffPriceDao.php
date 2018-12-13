<?php
namespace Sellastica\Crm\Entity\TariffPrice\Mapping;

use Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice;
use Sellastica\Crm\Entity\TariffPrice\Entity\TariffPriceBuilder;
use Sellastica\Crm\Entity\TariffPrice\Entity\TariffPriceCollection;
use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;

/**
 * @see TariffPrice
 * @property TariffPriceDibiMapper $mapper
 */
class TariffPriceDao extends Dao
{
	/**
	 * @inheritDoc
	 */
	protected function getBuilder(
		$data,
		$first = null,
		$second = null
	): IBuilder
	{
		$currency = \Sellastica\Localization\Model\Currency::from($data->currencyCode);
		return TariffPriceBuilder::create(
			new \Sellastica\Price\Price($data->monthly, false, 21, $currency),
			new \Sellastica\Price\Price($data->annual, false, 21, $currency),
			$currency
		)->hydrate($data);
	}

	/**
	 * @return EntityCollection|TariffPriceCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new TariffPriceCollection;
	}
}