<?php
namespace Sellastica\Crm\Entity\Commission\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

/**
 * @see Commission
 */
class CommissionBuilder implements IBuilder
{
	use TBuilder;

	/** @var int */
	private $invoiceId;
	/** @var int */
	private $projectId;
	/** @var int */
	private $b2bProjectId;
	/** @var int */
	private $percentCommission;
	/** @var \Sellastica\Price\Price */
	private $commission;
	/** @var float */
	private $exchangeRate;
	/** @var \DateTime */
	private $commissionPaid;

	/**
	 * @param int $invoiceId
	 * @param int $projectId
	 * @param int $b2bProjectId
	 * @param int $percentCommission
	 * @param \Sellastica\Price\Price $commission
	 * @param float $exchangeRate
	 */
	public function __construct(
		int $invoiceId,
		int $projectId,
		int $b2bProjectId,
		int $percentCommission,
		\Sellastica\Price\Price $commission,
		float $exchangeRate
	)
	{
		$this->invoiceId = $invoiceId;
		$this->projectId = $projectId;
		$this->b2bProjectId = $b2bProjectId;
		$this->percentCommission = $percentCommission;
		$this->commission = $commission;
		$this->exchangeRate = $exchangeRate;
	}

	/**
	 * @return int
	 */
	public function getInvoiceId(): int
	{
		return $this->invoiceId;
	}

	/**
	 * @return int
	 */
	public function getProjectId(): int
	{
		return $this->projectId;
	}

	/**
	 * @return int
	 */
	public function getB2bProjectId(): int
	{
		return $this->b2bProjectId;
	}

	/**
	 * @return int
	 */
	public function getPercentCommission(): int
	{
		return $this->percentCommission;
	}

	/**
	 * @return \Sellastica\Price\Price
	 */
	public function getCommission(): \Sellastica\Price\Price
	{
		return $this->commission;
	}

	/**
	 * @return float
	 */
	public function getExchangeRate(): float
	{
		return $this->exchangeRate;
	}

	/**
	 * @return \DateTime
	 */
	public function getCommissionPaid(): \DateTime
	{
		return $this->commissionPaid;
	}

	/**
	 * @param \DateTime $commissionPaid
	 * @return $this
	 */
	public function commissionPaid(\DateTime $commissionPaid)
	{
		$this->commissionPaid = $commissionPaid;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function generateId(): bool
	{
		return !Commission::isIdGeneratedByStorage();
	}

	/**
	 * @return Commission
	 */
	public function build(): Commission
	{
		return new Commission($this);
	}

	/**
	 * @param int $invoiceId
	 * @param int $projectId
	 * @param int $b2bProjectId
	 * @param int $percentCommission
	 * @param \Sellastica\Price\Price $commission
	 * @param float $exchangeRate
	 * @return self
	 */
	public static function create(
		int $invoiceId,
		int $projectId,
		int $b2bProjectId,
		int $percentCommission,
		\Sellastica\Price\Price $commission,
		float $exchangeRate
	): self
	{
		return new self($invoiceId, $projectId, $b2bProjectId, $percentCommission, $commission, $exchangeRate);
	}
}