<?php
namespace Sellastica\Crm\Entity\TariffHistory\Entity;

use Sellastica\Crm\Model\AccountingPeriod;
use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

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
	/** @var \DateTime */
	private $validFrom;
	/** @var \DateTime|null */
	private $validTill;
	/** @var AccountingPeriod|null */
	private $accountingPeriod;
	/** @var bool */
	private $trial;

	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @param int $tariffId
	 * @param \DateTime $validFrom
	 */
	public function __construct(
		int $projectId,
		int $applicationId,
		int $tariffId,
		\DateTime $validFrom
	)
	{
		$this->projectId = $projectId;
		$this->applicationId = $applicationId;
		$this->tariffId = $tariffId;
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
	 * @param \Sellastica\Crm\Model\AccountingPeriod|null $accountingPeriod
	 * @return $this
	 */
	public function accountingPeriod(AccountingPeriod $accountingPeriod = null)
	{
		$this->accountingPeriod = $accountingPeriod;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getTrial(): bool
	{
		return $this->trial;
	}

	/**
	 * @param bool $trial
	 * @return $this
	 */
	public function trial(bool $trial)
	{
		$this->trial = $trial;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function generateId(): bool
	{
		return !\Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory::isIdGeneratedByStorage();
	}

	/**
	 * @return \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory
	 */
	public function build(): \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory
	{
		return new \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory($this);
	}

	/**
	 * @param int $projectId
	 * @param int $applicationId
	 * @param int $tariffId
	 * @param \DateTime $validFrom
	 * @return self
	 */
	public static function create(
		int $projectId,
		int $applicationId,
		int $tariffId,
		\DateTime $validFrom
	): self
	{
		return new self($projectId, $applicationId, $tariffId, $validFrom);
	}
}