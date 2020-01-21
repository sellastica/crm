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
	private $b2bProjectId;
	/** @var int */
	private $percentCommission;
	/** @var \Sellastica\Price\Price */
	private $commission;
	/** @var \DateTime */
	private $commissionPaid;

	/**
	 * @param int $invoiceId
	 * @param int $b2bProjectId
	 * @param int $percentCommission
	 * @param \Sellastica\Price\Price $commission
	 */
	public function __construct(
		int $invoiceId,
		int $b2bProjectId,
		int $percentCommission,
		\Sellastica\Price\Price $commission
	)
	{
		$this->invoiceId = $invoiceId;
		$this->b2bProjectId = $b2bProjectId;
		$this->percentCommission = $percentCommission;
		$this->commission = $commission;
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
	 * @param int $b2bProjectId
	 * @param int $percentCommission
	 * @param \Sellastica\Price\Price $commission
	 * @return self
	 */
	public static function create(
		int $invoiceId,
		int $b2bProjectId,
		int $percentCommission,
		\Sellastica\Price\Price $commission
	): self
	{
		return new self($invoiceId, $b2bProjectId, $percentCommission, $commission);
	}
}