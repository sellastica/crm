<?php
namespace Sellastica\Crm\Model;

class AccountingPeriod
{
	const MONTHLY = 'monthly',
		ANNUAL = 'annual';

	/** @var string */
	private $period;


	/**
	 * @param string $period
	 */
	private function __construct(string $period)
	{
		$this->period = $period;
	}

	/**
	 * @return string
	 */
	public function getPeriod(): string
	{
		return $this->period;
	}

	/**
	 * @return bool
	 */
	public function isMonthly(): bool
	{
		return $this->period === self::MONTHLY;
	}

	/**
	 * @return bool
	 */
	public function isAnnual(): bool
	{
		return $this->period === self::ANNUAL;
	}

	/**
	 * @param string $period
	 * @return AccountingPeriod
	 * @throws \InvalidArgumentException
	 */
	public static function from(string $period): AccountingPeriod
	{
		if (!in_array($period, [self::MONTHLY, self::ANNUAL])) {
			throw new \InvalidArgumentException("Unknown period $period");
		}

		return new self($period);
	}

	/**
	 * @return AccountingPeriod
	 */
	public static function monthly(): AccountingPeriod
	{
		return new self(self::MONTHLY);
	}

	/**
	 * @return AccountingPeriod
	 */
	public static function annual(): AccountingPeriod
	{
		return new self(self::ANNUAL);
	}
}