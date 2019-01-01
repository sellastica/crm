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
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection|\Sellastica\Crm\Entity\Invoice\Entity\Invoice[]
	 */
	public function findUnpaidInvoices(
		int $projectId,
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection
	{
		return $this->initialize(
			$this->dao->findUnpaidInvoices($projectId, $configuration)
		);
	}
}