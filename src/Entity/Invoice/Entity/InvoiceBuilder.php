<?php
namespace Sellastica\Crm\Entity\Invoice\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

/**
 * @see Invoice
 */
class InvoiceBuilder implements IBuilder
{
	use TBuilder;

	/** @var int */
	private $projectId;
	/** @var string */
	private $code;
	/** @var string */
	private $varSymbol;
	/** @var \DateTime */
	private $dueDate;
	/** @var \Sellastica\Price\Price */
	private $price;
	/** @var int */
	private $externalId;
	/** @var \DateTime|null */
	private $paymentDate;
	/** @var string|null */
	private $externalUrl;
	/** @var bool */
	private $proforma = true;
	/** @var bool */
	private $display = true;
	/** @var bool */
	private $cancelled = false;
	/** @var float */
	private $paidAmount = 0;
	/** @var float */
	private $priceToPay = 0;
	/** @var \DateTime|null */
	private $sent;
	/** @var \DateTime|null */
	private $reminded;
	/** @var bool */
	private $mustPay = false;

	/**
	 * @param int $projectId
	 * @param string $code
	 * @param string $varSymbol
	 * @param \DateTime $dueDate
	 * @param \Sellastica\Price\Price $price
	 * @param int $externalId
	 */
	public function __construct(
		int $projectId,
		string $code,
		string $varSymbol,
		\DateTime $dueDate,
		\Sellastica\Price\Price $price,
		int $externalId
	)
	{
		$this->projectId = $projectId;
		$this->code = $code;
		$this->varSymbol = $varSymbol;
		$this->dueDate = $dueDate;
		$this->price = $price;
		$this->externalId = $externalId;
	}

	/**
	 * @return int
	 */
	public function getProjectId(): int
	{
		return $this->projectId;
	}

	/**
	 * @return string
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * @return string
	 */
	public function getVarSymbol(): string
	{
		return $this->varSymbol;
	}

	/**
	 * @return \DateTime
	 */
	public function getDueDate(): \DateTime
	{
		return $this->dueDate;
	}

	/**
	 * @return \Sellastica\Price\Price
	 */
	public function getPrice(): \Sellastica\Price\Price
	{
		return $this->price;
	}

	/**
	 * @return int
	 */
	public function getExternalId(): int
	{
		return $this->externalId;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getPaymentDate()
	{
		return $this->paymentDate;
	}

	/**
	 * @param \DateTime|null $paymentDate
	 * @return $this
	 */
	public function paymentDate(\DateTime $paymentDate = null)
	{
		$this->paymentDate = $paymentDate;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getExternalUrl()
	{
		return $this->externalUrl;
	}

	/**
	 * @param string|null $externalUrl
	 * @return $this
	 */
	public function externalUrl(string $externalUrl = null)
	{
		$this->externalUrl = $externalUrl;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getProforma(): bool
	{
		return $this->proforma;
	}

	/**
	 * @param bool $proforma
	 * @return $this
	 */
	public function proforma(bool $proforma = true)
	{
		$this->proforma = $proforma;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getDisplay(): bool
	{
		return $this->display;
	}

	/**
	 * @param bool $display
	 * @return $this
	 */
	public function display(bool $display = true)
	{
		$this->display = $display;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getCancelled(): bool
	{
		return $this->cancelled;
	}

	/**
	 * @param bool $cancelled
	 * @return $this
	 */
	public function cancelled(bool $cancelled)
	{
		$this->cancelled = $cancelled;
		return $this;
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
	 * @return $this
	 */
	public function paidAmount(float $paidAmount)
	{
		$this->paidAmount = $paidAmount;
		return $this;
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
	 * @return $this
	 */
	public function priceToPay(float $priceToPay)
	{
		$this->priceToPay = $priceToPay;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getSent()
	{
		return $this->sent;
	}

	/**
	 * @param \DateTime|null $sent
	 * @return $this
	 */
	public function sent(\DateTime $sent = null)
	{
		$this->sent = $sent;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getReminded()
	{
		return $this->reminded;
	}

	/**
	 * @param \DateTime|null $reminded
	 * @return $this
	 */
	public function reminded(\DateTime $reminded = null)
	{
		$this->reminded = $reminded;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function getMustPay(): bool
	{
		return $this->mustPay;
	}

	/**
	 * @param bool $mustPay
	 * @return $this
	 */
	public function mustPay(bool $mustPay)
	{
		$this->mustPay = $mustPay;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function generateId(): bool
	{
		return !Invoice::isIdGeneratedByStorage();
	}

	/**
	 * @return Invoice
	 */
	public function build(): Invoice
	{
		return new Invoice($this);
	}

	/**
	 * @param int $projectId
	 * @param string $code
	 * @param string $varSymbol
	 * @param \DateTime $dueDate
	 * @param \Sellastica\Price\Price $price
	 * @param int $externalId
	 * @return self
	 */
	public static function create(
		int $projectId,
		string $code,
		string $varSymbol,
		\DateTime $dueDate,
		\Sellastica\Price\Price $price,
		int $externalId
	): self
	{
		return new self($projectId, $code, $varSymbol, $dueDate, $price, $externalId);
	}
}