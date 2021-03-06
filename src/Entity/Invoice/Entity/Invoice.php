<?php
namespace Sellastica\Crm\Entity\Invoice\Entity;

/**
 * @generate-builder
 * @see InvoiceBuilder
 *
 * @property InvoiceRelations $relationService
 */
class Invoice extends \Sellastica\Entity\Entity\AbstractEntity
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/** @var int @required */
	private $projectId;
	/** @var string @required */
	private $code;
	/** @var string @required */
	private $varSymbol;
	/** @var \DateTime @required */
	private $dueDate;
	/** @var \DateTime|null @optional */
	private $paymentDate;
	/** @var \Sellastica\Price\Price @required */
	private $price;
	/** @var float @optional */
	private $exchangeRate = 1;
	/** @var int @required */
	private $externalId;
	/** @var string|null @optional */
	private $externalUrl;
	/** @var bool @optional */
	private $proforma = true;
	/** @var bool @optional */
	private $display = true;
	/** @var bool @optional */
	private $cancelled = false;
	/** @var float @optional */
	private $paidAmount = 0;
	/** @var float @optional */
	private $priceToPay = 0;
	/** @var \DateTime|null @optional */
	private $sent;
	/** @var \DateTime|null @optional */
	private $reminded;
	/** @var \DateTime|null @optional */
	private $lastTimeReminded;
	/** @var bool @optional */
	private $mustPay = false;
	/** @var \DateTime|null @optional */
	private $accountingPeriod;


	/**
	 * @param InvoiceBuilder $builder
	 */
	public function __construct(InvoiceBuilder $builder)
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
	 * @return string
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * @param string $code
	 */
	public function setCode(string $code): void
	{
		$this->code = $code;
	}

	/**
	 * @return string
	 */
	public function getVarSymbol(): string
	{
		return $this->varSymbol;
	}

	/**
	 * @param string $varSymbol
	 */
	public function setVarSymbol(string $varSymbol): void
	{
		$this->varSymbol = $varSymbol;
	}

	/**
	 * @return \DateTime
	 */
	public function getDueDate(): \DateTime
	{
		return $this->dueDate;
	}

	/**
	 * @param \DateTime $dueDate
	 */
	public function setDueDate(\DateTime $dueDate): void
	{
		$this->dueDate = $dueDate;
	}

	/**
	 * @return int
	 */
	public function getDaysCountAfterDueDate(): int
	{
		$interval = $this->dueDate->diff(new \DateTime());
		return $interval->invert
			? -$interval->days
			: $interval->days;
	}

	/**
	 * @return bool
	 */
	public function isAfterDueDate(): bool
	{
		return $this->dueDate->format('Ymd') < (new \DateTime())->format('Ymd');
	}

	/**
	 * @return \Sellastica\Price\Price
	 */
	public function getPrice(): \Sellastica\Price\Price
	{
		return $this->price;
	}

	/**
	 * @param \Sellastica\Price\Price $price
	 */
	public function setPrice(\Sellastica\Price\Price $price): void
	{
		$this->price = $price;
	}

	/**
	 * @return int
	 */
	public function getExternalId(): int
	{
		return $this->externalId;
	}

	/**
	 * @param int $externalId
	 */
	public function setExternalId(int $externalId): void
	{
		$this->externalId = $externalId;
	}

	/**
	 * @return string|null
	 */
	public function getExternalUrl(): ?string
	{
		return $this->externalUrl;
	}

	/**
	 * @param string|null $externalUrl
	 */
	public function setExternalUrl(?string $externalUrl): void
	{
		$this->externalUrl = $externalUrl;
	}

	/**
	 * @return string
	 */
	public function getOnlinePaymentUrl(): string
	{
		return "https://klient.napojse.cz/pay/invoice/{$this->code}-{$this->varSymbol}";
	}

	/**
	 * @return \DateTime|null
	 */
	public function getPaymentDate(): ?\DateTime
	{
		return $this->paymentDate;
	}

	/**
	 * @param \DateTime|null $paymentDate
	 */
	public function setPaymentDate(?\DateTime $paymentDate): void
	{
		$this->paymentDate = $paymentDate;
	}

	/**
	 * @return float
	 */
	public function getPriceToPay(): float
	{
		return $this->priceToPay;
	}

	/**
	 * @param float $priceToPay
	 */
	public function setPriceToPay(float $priceToPay): void
	{
		$this->priceToPay = $priceToPay;
	}

	/**
	 * @return float
	 */
	public function getPriceToPayLeft(): float
	{
		return floor($this->priceToPay - $this->paidAmount);
	}

	/**
	 * @return bool
	 */
	public function isPaid(): bool
	{
		return !$this->getPriceToPayLeft();
	}

	/**
	 * @return bool
	 */
	public function isPartiallyPaid(): bool
	{
		return ceil($this->paidAmount) > 0
			&& ceil($this->paidAmount) < ceil($this->priceToPay);
	}

	/**
	 * @return bool
	 */
	public function isProforma(): bool
	{
		return $this->proforma;
	}

	/**
	 * @param bool $proforma
	 */
	public function setProforma(bool $proforma): void
	{
		$this->proforma = $proforma;
	}

	/**
	 * @return bool
	 */
	public function isDisplay(): bool
	{
		return $this->display;
	}

	/**
	 * @param bool $display
	 */
	public function setDisplay(bool $display): void
	{
		$this->display = $display;
	}

	/**
	 * @return bool
	 */
	public function canHide(): bool
	{
		return !$this->getPriceToPayLeft() || !$this->isAfterDueDate();
	}

	/**
	 * @return string
	 */
	public function getPaymentId(): string
	{
		return $this->code . '-' . $this->varSymbol;
	}

	/**
	 * @return bool
	 */
	public function isCancelled(): bool
	{
		return $this->cancelled;
	}

	/**
	 * @param bool $cancelled
	 */
	public function setCancelled(bool $cancelled): void
	{
		$this->cancelled = $cancelled;
	}

	/**
	 * @return float
	 */
	public function getPaidAmount(): float
	{
		return $this->paidAmount;
	}

	/**
	 * @param float $paidAmount
	 */
	public function setPaidAmount(float $paidAmount): void
	{
		$this->paidAmount = $paidAmount;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getSent(): ?\DateTime
	{
		return $this->sent;
	}

	/**
	 * @param \DateTime|null $sent
	 */
	public function setSent(?\DateTime $sent): void
	{
		$this->sent = $sent;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getReminded(): ?\DateTime
	{
		return $this->reminded;
	}

	/**
	 * @param \DateTime|null $reminded
	 */
	public function setReminded(?\DateTime $reminded): void
	{
		$this->reminded = $reminded;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getLastTimeReminded(): ?\DateTime
	{
		return $this->lastTimeReminded;
	}

	/**
	 * @param \DateTime|null $lastTimeReminded
	 */
	public function setLastTimeReminded(?\DateTime $lastTimeReminded): void
	{
		$this->lastTimeReminded = $lastTimeReminded;
	}

	/**
	 * @return bool
	 */
	public function mustPay(): bool
	{
		return $this->mustPay;
	}

	/**
	 * @param bool $mustPay
	 */
	public function setMustPay(bool $mustPay): void
	{
		$this->mustPay = $mustPay;
	}

	/**
	 * @return float
	 */
	public function getExchangeRate(): float
	{
		return $this->exchangeRate;
	}

	/**
	 * @param float $exchangeRate
	 */
	public function setExchangeRate(float $exchangeRate): void
	{
		$this->exchangeRate = $exchangeRate;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getAccountingPeriod(): ?\DateTime
	{
		return $this->accountingPeriod;
	}

	/**
	 * @param \DateTime|null $accountingPeriod
	 */
	public function setAccountingPeriod(?\DateTime $accountingPeriod): void
	{
		$this->accountingPeriod = $accountingPeriod;
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
				'code' => $this->code,
				'varSymbol' => $this->varSymbol,
				'dueDate' => $this->dueDate,
				'paymentDate' => $this->paymentDate,
				'price' => $this->price->getDefaultPrice(),
				'exchangeRate' => $this->exchangeRate,
				'vat' => $this->price->getTax(),
				'currency' => $this->price->getCurrency()->getCode(),
				'externalId' => $this->externalId,
				'externalUrl' => $this->externalUrl,
				'proforma' => $this->proforma,
				'display' => $this->display,
				'cancelled' => $this->cancelled,
				'paidAmount' => $this->paidAmount,
				'priceToPay' => $this->priceToPay,
				'sent' => $this->sent,
				'reminded' => $this->reminded,
				'lastTimeReminded' => $this->lastTimeReminded,
				'mustPay' => $this->mustPay,
				'accountingPeriod' => $this->accountingPeriod,
			]
		);
	}
}