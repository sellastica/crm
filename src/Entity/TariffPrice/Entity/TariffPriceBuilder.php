<?php
namespace Sellastica\Crm\Entity\TariffPrice\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

/**
 * @see TariffPrice
 */
class TariffPriceBuilder implements IBuilder
{
	use TBuilder;

	/** @var \Sellastica\Price\Price */
	private $monthly;
	/** @var \Sellastica\Price\Price */
	private $annual;
	/** @var \Sellastica\Localization\Model\Currency */
	private $currency;

	/**
	 * @param \Sellastica\Price\Price $monthly
	 * @param \Sellastica\Price\Price $annual
	 * @param \Sellastica\Localization\Model\Currency $currency
	 */
	public function __construct(
		\Sellastica\Price\Price $monthly,
		\Sellastica\Price\Price $annual,
		\Sellastica\Localization\Model\Currency $currency
	)
	{
		$this->monthly = $monthly;
		$this->annual = $annual;
		$this->currency = $currency;
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
	 * @return \Sellastica\Localization\Model\Currency
	 */
	public function getCurrency(): \Sellastica\Localization\Model\Currency
	{
		return $this->currency;
	}

	/**
	 * @return bool
	 */
	public function generateId(): bool
	{
		return !\Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice::isIdGeneratedByStorage();
	}

	/**
	 * @return \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice
	 */
	public function build(): \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice
	{
		return new \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice($this);
	}

	/**
	 * @param \Sellastica\Price\Price $monthly
	 * @param \Sellastica\Price\Price $annual
	 * @param \Sellastica\Localization\Model\Currency $currency
	 * @return self
	 */
	public static function create(
		\Sellastica\Price\Price $monthly,
		\Sellastica\Price\Price $annual,
		\Sellastica\Localization\Model\Currency $currency
	): self
	{
		return new self($monthly, $annual, $currency);
	}
}