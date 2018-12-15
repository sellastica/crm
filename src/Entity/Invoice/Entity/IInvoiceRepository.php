<?php
namespace Sellastica\Crm\Entity\Invoice\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method Invoice find(int $id)
 * @method Invoice findOneBy(array $filterValues)
 * @method Invoice findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method Invoice[]|InvoiceCollection findAll(Configuration $configuration = null)
 * @method Invoice[]|InvoiceCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method Invoice[]|InvoiceCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method Invoice[]|InvoiceCollection findPublishable(int $id)
 * @method Invoice[]|InvoiceCollection findAllPublishable(Configuration $configuration = null)
 * @method Invoice[]|InvoiceCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see Invoice
 */
interface IInvoiceRepository extends IRepository
{
}