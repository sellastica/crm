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
}