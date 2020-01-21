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
	 * @return bool
	 */
	public function existsBy(array $filter): bool
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)->existsBy($filter);
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
	 * @param int $projectId
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return \Sellastica\Crm\Entity\Commission\Entity\CommissionCollection|\Sellastica\Crm\Entity\Commission\Entity\Commission[]
	 */
	public function findCommissionsToDisplay(
		int $projectId,
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Crm\Entity\Commission\Entity\CommissionCollection
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)
			->findCommissionsToDisplay($projectId, $configuration);
	}

	/**
	 * @param int|null $projectId
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return \Sellastica\Crm\Entity\Commission\Entity\CommissionCollection|\Sellastica\Crm\Entity\Commission\Entity\Commission[]
	 */
	public function findUnpaidCommissions(
		int $projectId = null,
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Crm\Entity\Commission\Entity\CommissionCollection
	{
		$filter = [
			'cancelled' => 0,
			'mustPay' => 1,
			'CEIL(priceToPay) > CEIL(paidAmount)',
		];
		if ($projectId) {
			$filter['projectId'] = $projectId;
		}

		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)
			->findBy($filter, $configuration);
	}

	/**
	 * @param int $projectId
	 * @return \Sellastica\Crm\Entity\Commission\Entity\Commission|null
	 */
	public function findLongestUnpaidCommission(int $projectId): ?\Sellastica\Crm\Entity\Commission\Entity\Commission
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)
			->findLongestUnpaidCommission($projectId);
	}

	/**
	 * @param array $filter
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return null|\Sellastica\Crm\Entity\Commission\Entity\Commission
	 */
	public function findOneBy(
		array $filter,
		\Sellastica\Entity\Configuration $configuration = null
	): ?\Sellastica\Crm\Entity\Commission\Entity\Commission
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)
			->findOneBy($filter, $configuration);
	}

	/**
	 * @param int $externalId
	 * @return null|\Sellastica\Crm\Entity\Commission\Entity\Commission
	 */
	public function findOneByExternalId(int $externalId): ?\Sellastica\Crm\Entity\Commission\Entity\Commission
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)
			->findOneBy(['externalId' => $externalId]);
	}

	/**
	 * @param string $code
	 * @return null|\Sellastica\Crm\Entity\Commission\Entity\Commission
	 */
	public function findOneByCode(string $code): ?\Sellastica\Crm\Entity\Commission\Entity\Commission
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)
			->findOneBy(['code' => $code]);
	}

	/**
	 * @param int $invoiceId
	 * @param int $b2bProjectId
	 * @param int $percentCommission
	 * @param \Sellastica\Price\Price $commission
	 * @return \Sellastica\Crm\Entity\Commission\Entity\Commission
	 */
	public function create(
		int $invoiceId,
		int $b2bProjectId,
		int $percentCommission,
		\Sellastica\Price\Price $commission
	): \Sellastica\Crm\Entity\Commission\Entity\Commission
	{
		$commission = \Sellastica\Crm\Entity\Commission\Entity\CommissionBuilder::create(
			$invoiceId,
			$b2bProjectId,
			$percentCommission,
			$commission
		)->build();
		$this->em->persist($commission);

		return $commission;
	}

	/**
	 * @param int $projectId
	 * @param \DateTimeImmutable $from
	 * @param \DateTimeImmutable $till
	 * @return float
	 */
	public function getPaidAmountSummary(
		int $projectId,
		\DateTimeImmutable $from,
		\DateTimeImmutable $till
	): float
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Commission\Entity\Commission::class)
			->getPaidAmountSummary($projectId, $from, $till);
	}
}