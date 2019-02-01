<?php
namespace Sellastica\Crm\Entity\TariffHistory\Entity;

use Sellastica\Crm\Model\AccountingPeriod;

/**
 * @generate-builder
 * @see TariffHistoryBuilder
 *
 * @property TariffHistoryRelations $relationService
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
	/** @var string @required */
	private $title;
	/** @var \DateTime @required */
	private $validFrom;
	/** @var \DateTime|null @optional */
	private $validTill;
	/** @var AccountingPeriod|null @optional */
	private $accountingPeriod;
	/** @var int|null @optional */
	private $invoiceId;
	/** @var bool @optional */
	private $active = true;

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
	 * @param int $projectId
	 */
	public function setProjectId(int $projectId): void
	{
		$this->projectId = $projectId;
	}

	/**
	 * @return \Sellastica\Project\Entity\Project
	 */
	public function getProject(): \Sellastica\Project\Entity\Project
	{
		return $this->relationService->getProject();
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
	 * @param int $tariffId
	 */
	public function setTariffId(int $tariffId): void
	{
		$this->tariffId = $tariffId;
	}

	/**
	 * @return \Sellastica\Crm\Entity\Tariff\Entity\Tariff
	 */
	public function getTariff(): \Sellastica\Crm\Entity\Tariff\Entity\Tariff
	{
		return $this->relationService->getTariff();
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle(string $title): void
	{
		$this->title = $title;
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

	public function setFreeOfCharge(): void
	{
		$this->accountingPeriod = null;
	}

	/**
	 * @return int|null
	 */
	public function getInvoiceId(): ?int
	{
		return $this->invoiceId;
	}

	/**
	 * @param int|null $invoiceId
	 */
	public function setInvoiceId(?int $invoiceId): void
	{
		$this->invoiceId = $invoiceId;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->active;
	}

	/**
	 * @param bool $active
	 */
	public function setActive(bool $active): void
	{
		$this->active = $active;
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
				'title' => $this->title,
				'validFrom' => $this->validFrom,
				'validTill' => $this->validTill,
				'accountingPeriod' => $this->accountingPeriod ? $this->accountingPeriod->getPeriod() : null,
				'invoiceId' => $this->invoiceId,
				'active' => $this->active,
			]
		);
	}
}