<?php
namespace Sellastica\Crm\Entity\Commission\Service;

class CommissionService
{
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->em = $em;
	}

	/**
	 * @param int $id
	 * @return null|\Sellastica\Crm\Entity\Commission\Entity\Commission
	 */
	public function find(int $id): ?\Sellastica\Crm\Entity\Commission\Entity\Commission
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)->find($id);
	}

	/**
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return \Sellastica\Crm\Entity\Commission\Entity\CommissionCollection|\Sellastica\Crm\Entity\Commission\Entity\Commission[]
	 */
	public function findAll(
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Crm\Entity\Commission\Entity\CommissionCollection
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)
			->findAll($configuration);
	}

	/**
	 * @param array $filter
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return \Sellastica\Crm\Entity\Commission\Entity\CommissionCollection|\Sellastica\Crm\Entity\Commission\Entity\Commission[]
	 */
	public function findBy(
		array $filter,
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Crm\Entity\Commission\Entity\CommissionCollection
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)
			->findBy($filter, $configuration);
	}

	/**
	 * @param array $filter
	 * @return int
	 */
	public function findCountBy(array $filter): int
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)
			->findCountBy($filter);
	}

	/**
	 * @param array $filter
	 * @return bool
	 */
	public function existsBy(array $filter): bool
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)->existsBy($filter);
	}

	/**
	 * @param int $invoiceId
	 * @param int $projectId
	 * @param int $b2bProjectId
	 * @param int $percentCommission
	 * @param \Sellastica\Price\Price $commission
	 * @param float $exchangeRate
	 * @return \Sellastica\Crm\Entity\Commission\Entity\Commission
	 */
	public function create(
		int $invoiceId,
		int $projectId,
		int $b2bProjectId,
		int $percentCommission,
		\Sellastica\Price\Price $commission,
		float $exchangeRate
	): \Sellastica\Crm\Entity\Commission\Entity\Commission
	{
		$commission = \Sellastica\Crm\Entity\Commission\Entity\CommissionBuilder::create(
			$invoiceId,
			$projectId,
			$b2bProjectId,
			$percentCommission,
			$commission,
			$exchangeRate
		)->build();
		$this->em->persist($commission);

		return $commission;
	}
}