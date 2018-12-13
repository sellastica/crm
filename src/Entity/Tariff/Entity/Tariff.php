<?php
namespace Sellastica\Crm\Entity\Tariff\Entity;

use Sellastica\Localization\Model\Currency;

/**
 * @generate-builder
 * @see TariffBuilder
 *
 * @property TariffRelations $relationService
 */
class Tariff extends \Sellastica\Entity\Entity\AbstractEntity
{
	use \Sellastica\Entity\Entity\TAbstractEntity;

	/** @var int @required */
	private $applicationId;
	/** @var string @required */
	private $title;
	/** @var string|null @optional */
	private $description;
	/** @var int|null @optional */
	private $products;
	/** @var int|null @optional */
	private $customers;
	/** @var int @required */
	private $stockQuantityPeriod;
	/** @var int @required */
	private $priority;


	/**
	 * @param TariffBuilder $builder
	 */
	public function __construct(TariffBuilder $builder)
	{
		$this->hydrate($builder);
	}

	/**
	 * @return int
	 */
	public function getApplicationId(): int
	{
		return $this->applicationId;
	}

	/**
	 * @param int $applicationId
	 */
	public function setApplicationId(int $applicationId): void
	{
		$this->applicationId = $applicationId;
	}

	/**
	 * @return \Sellastica\App\Entity\App
	 */
	public function getApplication(): \Sellastica\App\Entity\App
	{
		return $this->relationService->getApplication();
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
	 * @return null|string
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @param string $language
	 * @return array
	 * @throws \Nette\Utils\JsonException
	 */
	public function parseDescription(string $language): array
	{
		$description = $this->description
			? \Nette\Utils\Json::decode($this->description, \Nette\Utils\Json::FORCE_ARRAY)
			: [];
		return $description[$language] ?? [];
	}

	/**
	 * @param null|string $description
	 */
	public function setDescription(?string $description): void
	{
		$this->description = $description;
	}

	/**
	 * @return int|null
	 */
	public function getProducts(): ?int
	{
		return $this->products;
	}

	/**
	 * @param int|null $products
	 */
	public function setProducts(?int $products): void
	{
		$this->products = $products;
	}

	/**
	 * @return int|null
	 */
	public function getCustomers(): ?int
	{
		return $this->customers;
	}

	/**
	 * @param int|null $customers
	 */
	public function setCustomers(?int $customers): void
	{
		$this->customers = $customers;
	}

	/**
	 * @return int
	 */
	public function getStockQuantityPeriod(): int
	{
		return $this->stockQuantityPeriod;
	}

	/**
	 * @param int $stockQuantityPeriod
	 */
	public function setStockQuantityPeriod(int $stockQuantityPeriod): void
	{
		$this->stockQuantityPeriod = $stockQuantityPeriod;
	}

	/**
	 * @return \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPriceCollection
	 */
	public function getTariffPrices(): \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPriceCollection
	{
		return $this->relationService->getPrices();
	}

	/**
	 * @param Currency $currency
	 * @return \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice
	 */
	public function getTariffPrice(Currency $currency): \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice
	{
		return $this->getTariffPrices()->getPrice($currency);
	}

	/**
	 * @return int
	 */
	public function getPriority(): int
	{
		return $this->priority;
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return array_merge(
			$this->parentToArray(),
			[
				'applicationId' => $this->applicationId,
				'title' => $this->title,
				'description' => $this->description,
				'products' => $this->products,
				'customers' => $this->customers,
				'stockQuantityPeriod' => $this->stockQuantityPeriod,
			]
		);
	}
}