<?php
namespace Sellastica\Crm\Entity\TariffPrice\Entity;

use Sellastica\Crm\Model\AccountingPeriod;

/**
 * @generate-builder
 * @see TariffPriceBuilder
 */
class TariffPrice extends \Sellastica\Entity\Entity\AbstractEntity
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/** @var \Sellastica\Price\Price @required */
	private $monthly;
	/** @var \Sellastica\Price\Price @required */
	private $annual;
	/** @var \Sellastica\Localization\Model\Currency @required */
	private $currency;


	/**
	 * @param TariffPriceBuilder $builder
	 */
	public function __construct(TariffPriceBuilder $builder)
	{
		$this->hydrate($builder);
	}

	/**
	 * @return \Sellastica\Price\Price
	 */
	public function getMonthly(): \Sellastica\Price\Price
	{
		return $this->monthly;
	}

	/**
	 * @return \Sellastica\Price\Price
	 */
	public function getAnnual(): \Sellastica\Price\Price
	{
		return $this->annual;
	}

	/**
	 * @param AccountingPeriod $accountingPeriod
	 * @return \Sellastica\Price\Price
	 */
	public function getPrice(AccountingPeriod $accountingPeriod): \Sellastica\Price\Price
	{
		if ($accountingPeriod->isMonthly()) {
			return $this->monthly;
		} else {
			return $this->annual;
		}
	}

	/**
	 * @param AccountingPeriod $accountingPeriod
	 * @return \Sellastica\Price\Price
	 */
	public function getMonthlyPrice(AccountingPeriod $accountingPeriod): \Sellastica\Price\Price
	{
		$price = $this->getPrice($accountingPeriod);
		return $accountingPeriod->isMonthly()
			? $price
			: $price->divide(12);
	}

	/**
	 * @return \Sellastica\Localization\Model\Currency
	 */
	public function getCurrency(): \Sellastica\Localization\Model\Currency
	{
		return $this->currency;
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return array_merge(
			$this->parentToArray(),
			[
				'monthly' => $this->monthly->getDefaultPrice(),
				'annual' => $this->annual->getDefaultPrice(),
				'currency' => $this->currency->getCode(),
			]
		);
	}
}