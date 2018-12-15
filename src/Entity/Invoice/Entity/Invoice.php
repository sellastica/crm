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
	/** @var \Sellastica\Price\Price @required */
	private $price;
	/** @var int @required */
	private $externalId;
	/** @var \Sellastica\Identity\Model\Email @required */
	private $email;


	/**
	 * @param InvoiceBuilder $builder
	 */
	public function __construct(InvoiceBuilder $builder)
	{
		$this->hydrate($builder);
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
	 * @param bool $object
	 * @return string
	 */
	public function getEmail(bool $object = false): string
	{
		return $object ? $this->email : (string)$this->email;
	}

	/**
	 * @param \Sellastica\Identity\Model\Email $email
	 */
	public function setEmail(\Sellastica\Identity\Model\Email $email): void
	{
		$this->email = $email;
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
				'price' => $this->price->getDefaultPrice(),
				//'vat' => $this->price->getTax(),
				//'email' => $this->getEmail(),
				'currency' => $this->price->getCurrency()->getCode(),
				'externalId' => $this->externalId,
			]
		);
	}
}