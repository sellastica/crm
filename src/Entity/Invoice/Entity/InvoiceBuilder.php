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
	/** @var \Sellastica\Identity\Model\Email */
	private $email;

	/**
	 * @param int $projectId
	 * @param string $code
	 * @param string $varSymbol
	 * @param \DateTime $dueDate
	 * @param \Sellastica\Price\Price $price
	 * @param int $externalId
	 * @param \Sellastica\Identity\Model\Email $email
	 */
	public function __construct(
		int $projectId,
		string $code,
		string $varSymbol,
		\DateTime $dueDate,
		\Sellastica\Price\Price $price,
		int $externalId,
		\Sellastica\Identity\Model\Email $email
	)
	{
		$this->projectId = $projectId;
		$this->code = $code;
		$this->varSymbol = $varSymbol;
		$this->dueDate = $dueDate;
		$this->price = $price;
		$this->externalId = $externalId;
		$this->email = $email;
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
	 * @return \Sellastica\Identity\Model\Email
	 */
	public function getEmail(): \Sellastica\Identity\Model\Email
	{
		return $this->email;
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
	 * @param \Sellastica\Identity\Model\Email $email
	 * @return self
	 */
	public static function create(
		int $projectId,
		string $code,
		string $varSymbol,
		\DateTime $dueDate,
		\Sellastica\Price\Price $price,
		int $externalId,
		\Sellastica\Identity\Model\Email $email
	): self
	{
		return new self($projectId, $code, $varSymbol, $dueDate, $price, $externalId, $email);
	}
}