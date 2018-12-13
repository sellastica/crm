<?php
namespace Sellastica\Crm\Entity\TariffHistory\Entity;

use Sellastica\Crm\Model\AccountingPeriod;

/**
 * @generate-builder
 * @see TariffHistoryBuilder
 */
class TariffHistory extends \Sellastica\Entity\Entity\AbstractEntity
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/** @var int @required */
	private $projectId;
	/** @var int @required */
	private $applicationId;
	/** @var int @required */
	private $tariffId;
	/** @var \DateTime @required */
	private $validFrom;
	/** @var \DateTime|null @optional */
	private $validTill;
	/** @var AccountingPeriod|null @optional */
	private $accountingPeriod;
	/** @var bool @optional */
	private $trial;


	/**
	 * @param TariffHistoryBuilder $builder
	 */
	public function __construct(TariffHistoryBuilder $builder)
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
	public function getValidTill(): ?\DateTime
	{
		return $this->validTill;
	}

	/**
	 * @param \DateTime|null $validTill
	 */
	public function setValidTill(?\DateTime $validTill): void
	{
		$this->validTill = $validTill;
	}

	public function end()
	{
		$validTill = new \DateTime('today');
		if ($validTill >= $this->validFrom) {
			$this->validTill = $validTill;
		} else {
			$this->validTill = $this->validFrom; //if validFrom is today
		}
	}

	/**
	 * @return AccountingPeriod|null
	 */
	public function getAccountingPeriod(): ?AccountingPeriod
	{
		return $this->accountingPeriod;
	}

	/**
	 * @param AccountingPeriod|null $accountingPeriod
	 */
	public function setAccountingPeriod(?AccountingPeriod $accountingPeriod): void
	{
		$this->accountingPeriod = $accountingPeriod;
	}

	/**
	 * @return bool
	 */
	public function isFreeOfCharge(): bool
	{
		return !isset($this->accountingPeriod);
	}

	/**
	 * @return bool
	 */
	public function isTrial(): bool
	{
		return $this->trial;
	}

	public function setTrial(): void
	{
		$this->trial = true;
	}

	/**
	 * @return bool
	 */
	public function isProduction(): bool
	{
		return !$this->isTrial();
	}

	public function setProduction(): void
	{
		$this->trial = false;
	}

	/**
	 * @return bool
	 */
	public function isTrialExpired(): bool
	{
		return $this->isTrial()
			&& isset($this->validTill)
			&& $this->validTill < new \DateTime('today');
	}

	/**
	 * @return int
	 */
	public function getTrialDaysLeft(): int
	{
		if ($this->isTrial()) {
			return $this->validTill->diff($this->validFrom)->format('%a');
		}

		return 0;
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return array_merge(
			$this->parentToArray(),
			[
				'projectId' => $this->projectId,
				'applicationId' => $this->applicationId,
				'tariffId' => $this->tariffId,
				'validFrom' => $this->validFrom,
				'validTill' => $this->validTill,
				'accountingPeriod' => $this->accountingPeriod ? $this->accountingPeriod->getPeriod() : null,
				'trial' => $this->trial,
			]
		);
	}
}