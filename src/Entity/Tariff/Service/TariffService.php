<?php
namespace Sellastica\Crm\Entity\Tariff\Service;

use Sellastica\Crm\Entity\TariffHistory\Service\TariffHistoryService;
use Sellastica\Entity\Entity\IEntity;

class TariffService
{
	/** @var \Sellastica\Entity\EntityManager */
	private $em;
	/** @var TariffHistoryService */
	private $historyService;


	/**
	 * TariffService constructor.
	 * @param \Sellastica\Entity\EntityManager $em
	 * @param TariffHistoryService $historyService
	 */
	public function __construct(
		\Sellastica\Entity\EntityManager $em,
		TariffHistoryService $historyService
	)
	{
		$this->em = $em;
		$this->historyService = $historyService;
	}

	/**
	 * @param int $id
	 * @return null|\Sellastica\Crm\Entity\Tariff\Entity\Tariff
	 */
	public function find(int $id): ?\Sellastica\Crm\Entity\Tariff\Entity\Tariff
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Tariff\Entity\Tariff::class)->find($id);
	}

	/**
	 * @param \Sellastica\App\Entity\App $app
	 * @return \Sellastica\Crm\Entity\Tariff\Entity\Tariff|IEntity|null
	 */
	public function getDefaultTariff(
		\Sellastica\App\Entity\App $app
	): ?\Sellastica\Crm\Entity\Tariff\Entity\Tariff
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Tariff\Entity\Tariff::class)->findOneBy([
			'applicationId' => $app->getId(),
		], \Sellastica\Entity\Configuration::sortBy('priority'));
	}

	/**
	 * @param \Sellastica\App\Entity\App $app
	 * @param \Sellastica\Project\Entity\Project $project
	 * @return \Sellastica\Crm\Entity\Tariff\Entity\Tariff|null
	 */
	public function getCurrentTariff(
		\Sellastica\App\Entity\App $app,
		\Sellastica\Project\Entity\Project $project
	): ?\Sellastica\Crm\Entity\Tariff\Entity\Tariff
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Tariff\Entity\Tariff::class)->getCurrentTariff(
			$project->getId(), $app->getId()
		);
	}

	/**
	 * @param \Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff
	 * @param \Sellastica\Project\Entity\Project $project
	 * @return bool
	 */
	public function isCurrent(
		\Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff,
		\Sellastica\Project\Entity\Project $project
	): bool
	{
		return $tariff == $this->getCurrentTariff($tariff->getApplication(), $project); //==
	}

	/**
	 * @param \Sellastica\App\Entity\App $app
	 * @return \Sellastica\Crm\Entity\Tariff\Entity\TariffCollection
	 */
	public function getAllTariffs(\Sellastica\App\Entity\App $app): \Sellastica\Crm\Entity\Tariff\Entity\TariffCollection
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Tariff\Entity\Tariff::class)
			->findBy(['applicationId' => $app->getId()], \Sellastica\Entity\Configuration::sortBy('priority'));
	}

	/**
	 * @param \Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff
	 * @param string|null $productClass
	 * @return bool
	 */
	public function canBeSet(
		\Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff,
		string $productClass = null
	): bool
	{
		//products
		if ($productClass
			&& $tariff->getProducts() !== null) {
			$currentProductsCount = $this->em->getRepository($productClass)
				->findCount();
			$productsOk = $currentProductsCount <= $tariff->getProducts();
		} else {
			$productsOk = true;
		}

		//customers
		if ($tariff->getCustomers() !== null) {
			$currentCustomersCount = $this->em->getRepository(\Integroid\Entity\Product\Entity\AbstractProduct::class)
				->findCount();
			$customersOk = $currentCustomersCount <= $tariff->getCustomers();
		} else {
			$customersOk = true;
		}

		return $productsOk && $customersOk;
	}

	/**
	 * @param \Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff
	 * @param \Sellastica\Crm\Model\AccountingPeriod $period
	 * @param \DateTime|null $validFrom
	 * @param \Sellastica\Project\Entity\Project $project
	 * @throws \InvalidArgumentException
	 */
	public function setTariff(
		\Sellastica\Crm\Entity\Tariff\Entity\Tariff $tariff,
		\Sellastica\Project\Entity\Project $project,
		\Sellastica\Crm\Model\AccountingPeriod $period,
		\DateTime $validFrom = null
	)
	{
		if (!$this->canBeSet($tariff)) {
			throw new \InvalidArgumentException(sprintf('Tariff "%s" cannot be choosed', $tariff->getTitle()));
		}

		$tariffHistory = $this->historyService->createNewHistory(
			$tariff,
			$project,
			$validFrom ?? new \DateTime('today'),
			null,
			$period
		);
		$tariffHistory->setProduction();
	}
}