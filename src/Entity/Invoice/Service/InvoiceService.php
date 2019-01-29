<?php
namespace Sellastica\Crm\Entity\Invoice\Service;

class InvoiceService
{
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * InvoiceService constructor.
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
	 * @return null|\Sellastica\Crm\Entity\Invoice\Entity\Invoice
	 */
	public function find(int $id): ?\Sellastica\Crm\Entity\Invoice\Entity\Invoice
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Invoice\Entity\Invoice::class)->find($id);
	}

	/**
	 * @param array $filter
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection|\Sellastica\Crm\Entity\Invoice\Entity\Invoice[]
	 */
	public function findBy(
		array $filter,
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Invoice\Entity\Invoice::class)
			->findBy($filter, $configuration);
	}

	/**
	 * @param int $projectId
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection|\Sellastica\Crm\Entity\Invoice\Entity\Invoice[]
	 */
	public function findUnpaidInvoices(
		int $projectId,
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Invoice\Entity\Invoice::class)
			->findUnpaidInvoices($projectId, $configuration);
	}

	/**
	 * @param int $projectId
	 * @return \Sellastica\Crm\Entity\Invoice\Entity\Invoice|null
	 */
	public function findLongestUnpaidInvoice(int $projectId): ?\Sellastica\Crm\Entity\Invoice\Entity\Invoice
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Invoice\Entity\Invoice::class)
			->findLongestUnpaidInvoice($projectId);
	}

	/**
	 * @param array $filter
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return null|\Sellastica\Crm\Entity\Invoice\Entity\Invoice
	 */
	public function findOneBy(
		array $filter,
		\Sellastica\Entity\Configuration $configuration = null
	): ?\Sellastica\Crm\Entity\Invoice\Entity\Invoice
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\Invoice\Entity\Invoice::class)
			->findOneBy($filter, $configuration);
	}

	/**
	 * @param int $projectId
	 * @param string $code
	 * @param string $varSymbol
	 * @param \DateTime $dueDate
	 * @param \Sellastica\Price\Price $price
	 * @param int $externalId
	 * @return \Sellastica\Crm\Entity\Invoice\Entity\Invoice
	 */
	public function create(
		int $projectId,
		string $code,
		string $varSymbol,
		\DateTime $dueDate,
		\Sellastica\Price\Price $price,
		int $externalId
	): \Sellastica\Crm\Entity\Invoice\Entity\Invoice
	{
		$invoice = \Sellastica\Crm\Entity\Invoice\Entity\InvoiceBuilder::create(
			$projectId,
			$code,
			$varSymbol,
			$dueDate,
			$price,
			$externalId
		)->build();
		$this->em->persist($invoice);

		return $invoice;
	}
}