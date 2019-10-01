<?php
namespace Sellastica\Crm\Entity\Invoice\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Sellastica\Crm\Entity\Invoice\Entity\Invoice;
use Sellastica\Crm\Entity\Invoice\Entity\IInvoiceRepository;

/**
 * @property InvoiceDao $dao
 * @see Invoice
 */
class InvoiceRepository extends Repository implements IInvoiceRepository
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesRepository;

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
		return $this->dao->getPaidAmountSummary($projectId, $from, $till);
	}

	/**
	 * @param int $projectId
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection|\Sellastica\Crm\Entity\Invoice\Entity\Invoice[]
	 */
	public function findInvoicesToDisplay(
		int $projectId,
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection
	{
		return $this->initialize(
			$this->dao->findInvoicesToDisplay($projectId, $configuration)
		);
	}

	/**
	 * @param int $projectId
	 * @return Invoice|null
	 */
	public function findLongestUnpaidInvoice(int $projectId): ?\Sellastica\Crm\Entity\Invoice\Entity\Invoice
	{
		return $this->initialize(
			$this->dao->findLongestUnpaidInvoice($projectId)
		);
	}
}