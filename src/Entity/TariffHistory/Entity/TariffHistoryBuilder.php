<?php
namespace Sellastica\Crm\Entity\TariffHistory\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;
use Sellastica\Crm\Model\AccountingPeriod;

/**
 * @see TariffHistory
 */
class TariffHistoryBuilder implements IBuilder
{
	use TBuilder;

	/** @var int */
	private $projectId;
	/** @var int */
	private $applicationId;
	/** @var int */
	private $tariffId;
	/** @var string */
	private $title;
	/** @var \DateTime */
	private $validFrom;
	/** @var \DateTime|null */
	private $validTill;
	/** @var AccountingPeriod|null */
	private $accountingPeriod;
	/** @var int|null */
	private $invoiceId;
	/** @var bool */
	private $active = true;

	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @param int $tariffId
	 * @param string $title
	 * @param \DateTime $validFrom
	 */
	public function __construct(
		int $projectId,
		int $applicationId,
		int $tariffId,
		string $title,
		\DateTime $validFrom
	)
	{
		$this->projectId = $projectId;
		$this->applicationId = $applicationId;
		$this->tariffId = $tariffId;
		$this->title = $title;
		$this->validFrom = $validFrom;
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
	public function getApplicationId(): int
	{
		return $this->applicationId;
	}

	/**
	 * @return int
	 */
	public function getTariffId(): int
	{
		return $this->tariffId;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return \DateTime
	 */
	public function getValidFrom(): \DateTime
	{
		return $this->validFrom;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getValidTill()
	{
		return $this->validTill;
	}

	/**
	 * @param \DateTime|null $validTill
	 * @return $this
	 */
	public function validTill(\DateTime $validTill = null)
	{
		$this->validTill = $validTill;
		return $this;
	}

	/**
	 * @return AccountingPeriod|null
	 */
	public function getAccountingPeriod()
	{
		return $this->accountingPeriod;
	}

	/**
	 * @param AccountingPeriod|null $accountingPeriod
	 * @return $this
	 */
	public function accountingPeriod(AccountingPeriod $accountingPeriod = null)
	{
		$this->accountingPeriod = $accountingPeriod;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getInvoiceId()
	{
		return $this->invoiceId;
	}

	/**
	 * @param int|null $invoiceId
	 * @return $this
	 */
	public function invoiceId(int $invoiceId = null)
	{
		$this->invoiceId = $invoiceId;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getActive(): bool
	{
		return $this->active;
	}

	/**
	 * @param bool $active
	 * @return $this
	 */
	public function active(bool $active = true)
	{
		$this->active = $active;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function generateId(): bool
	{
		return !TariffHistory::isIdGeneratedByStorage();
	}

	/**
	 * @return TariffHistory
	 */
	public function build(): TariffHistory
	{
		return new TariffHistory($this);
	}

	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @param int $tariffId
	 * @param string $title
	 * @param \DateTime $validFrom
	 * @return self
	 */
	public static function create(
		int $projectId,
		int $applicationId,
		int $tariffId,
		string $title,
		\DateTime $validFrom
	): self
	{
		return new self($projectId, $applicationId, $tariffId, $title, $validFrom);
	}
}