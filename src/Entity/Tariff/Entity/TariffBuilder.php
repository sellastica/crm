<?php
namespace Sellastica\Crm\Entity\Tariff\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

/**
 * @see Tariff
 */
class TariffBuilder implements IBuilder
{
	use TBuilder;

	/** @var int */
	private $applicationId;
	/** @var string */
	private $title;
	/** @var int */
	private $stockQuantityPeriod;
	/** @var int */
	private $priority;
	/** @var string|null */
	private $description;
	/** @var int|null */
	private $products;
	/** @var int|null */
	private $customers;

	/**
	 * @param int $applicationId
	 * @param string $title
	 * @param int $stockQuantityPeriod
	 * @param int $priority
	 */
	public function __construct(
		int $applicationId,
		string $title,
		int $stockQuantityPeriod,
		int $priority
	)
	{
		$this->applicationId = $applicationId;
		$this->title = $title;
		$this->stockQuantityPeriod = $stockQuantityPeriod;
		$this->priority = $priority;
	}

	/**
	 * @return int
	 */
	public function getApplicationId(): int
	{
		return $this->applicationId;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return int
	 */
	public function getStockQuantityPeriod(): int
	{
		return $this->stockQuantityPeriod;
	}

	/**
	 * @return int
	 */
	public function getPriority(): int
	{
		return $this->priority;
	}

	/**
	 * @return string|null
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param string|null $description
	 * @return $this
	 */
	public function description(string $description = null)
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getProducts()
	{
		return $this->products;
	}

	/**
	 * @param int|null $products
	 * @return $this
	 */
	public function products(int $products = null)
	{
		$this->products = $products;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getCustomers()
	{
		return $this->customers;
	}

	/**
	 * @param int|null $customers
	 * @return $this
	 */
	public function customers(int $customers = null)
	{
		$this->customers = $customers;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function generateId(): bool
	{
		return !\Sellastica\Crm\Entity\Tariff\Entity\Tariff::isIdGeneratedByStorage();
	}

	/**
	 * @return \Sellastica\Crm\Entity\Tariff\Entity\Tariff
	 */
	public function build(): \Sellastica\Crm\Entity\Tariff\Entity\Tariff
	{
		return new \Sellastica\Crm\Entity\Tariff\Entity\Tariff($this);
	}

	/**
	 * @param int $applicationId
	 * @param string $title
	 * @param int $stockQuantityPeriod
	 * @param int $priority
	 * @return self
	 */
	public static function create(
		int $applicationId,
		string $title,
		int $stockQuantityPeriod,
		int $priority
	): self
	{
		return new self($applicationId, $title, $stockQuantityPeriod, $priority);
	}
}