<?php
namespace Sellastica\Crm\Entity\Invoice\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Sellastica\Crm\Entity\Invoice\Entity\IInvoiceRepository;
use Sellastica\Crm\Entity\Invoice\Entity\Invoice;

/**
 * @method InvoiceRepository getRepository()
 * @see Invoice
 */
class InvoiceRepositoryProxy extends RepositoryProxy implements IInvoiceRepository
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesRepositoryProxy;


	public function findUnpaidInvoices(
		int $projectId,
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection
	{
		return $this->getRepository()->findUnpaidInvoices($projectId, $configuration);
	}

	public function findLongestUnpaidInvoice(int $projectId): ?\Sellastica\Crm\Entity\Invoice\Entity\Invoice
	{
		return $this->getRepository()->findLongestUnpaidInvoice($projectId);
	}
}