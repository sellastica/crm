<?php
namespace Sellastica\Crm\Entity\Commission\Entity;

/**
 * @generate-builder
 * @see CommissionBuilder
 */
class Commission extends \Sellastica\Entity\Entity\AbstractEntity
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/** @var int @required */
	private $invoiceId;
	/** @var int @required */
	private $b2bProjectId;
	/** @var int @required */
	private $percentCommission;
	/** @var \Sellastica\Price\Price @required */
	private $commission;
	/** @var \DateTime @optional */
	private $commissionPaid;


	/**
	 * @param CommissionBuilder $builder
	 */
	public function __construct(CommissionBuilder $builder)
	{
		$this->hydrate($builder);
	}

	/**
	 * @return bool
	 */
	public static function isIdGeneratedByStorage(): bool
	{
		return true;
	}

	/**
	 * @return int
	 */
	public function getInvoiceId(): int
	{
		return $this->invoiceId;
	}

	/**
	 * @param int $invoiceId
	 */
	public function setInvoiceId(int $invoiceId): void
	{
		$this->invoiceId = $invoiceId;
	}

	/**
	 * @return int
	 */
	public function getB2bProjectId(): int
	{
		return $this->b2bProjectId;
	}

	/**
	 * @param int $b2bProjectId
	 */
	public function setB2bProjectId(int $b2bProjectId): void
	{
		$this->b2bProjectId = $b2bProjectId;
	}

	/**
	 * @return int
	 */
	public function getPercentCommission(): int
	{
		return $this->percentCommission;
	}

	/**
	 * @param int $percentCommission
	 */
	public function setPercentCommission(int $percentCommission): void
	{
		$this->percentCommission = $percentCommission;
	}

	/**
	 * @return \Sellastica\Price\Price
	 */
	public function getCommission(): \Sellastica\Price\Price
	{
		return $this->commission;
	}

	/**
	 * @param \Sellastica\Price\Price $commission
	 */
	public function setCommission(\Sellastica\Price\Price $commission): void
	{
		$this->commission = $commission;
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
	 */
	public function setCommissionPaid(\DateTime $commissionPaid): void
	{
		$this->commissionPaid = $commissionPaid;
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return array_merge(
			$this->parentToArray(),
			[
				'invoiceId' => $this->invoiceId,
				'b2bProjectId' => $this->b2bProjectId,
				'percentCommission' => $this->percentCommission,
				'commission' => $this->commission->getWithoutTax(),
				'commissionPaid' => $this->commissionPaid,
			]
		);
	}
}