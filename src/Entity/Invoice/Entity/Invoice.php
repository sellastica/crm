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
	/** @var int @required */
	private $externalId;
	/** @var string|null @optional */
	private $externalUrl;
	/** @var bool @optional */
	private $proforma = true;
	/** @var bool @optional */
	private $display = true;

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
				'vat' => $this->price->getTax(),
				'currency' => $this->price->getCurrency()->getCode(),
				'externalId' => $this->externalId,
				'externalUrl' => $this->externalUrl,
				'proforma' => $this->proforma,
				'display' => $this->display,
			]
		);
	}
}