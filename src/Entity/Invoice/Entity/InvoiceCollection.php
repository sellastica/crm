<?php
namespace Sellastica\Crm\Entity\Invoice\Entity;

use Sellastica\Entity\Entity\EntityCollection;

/**
 * @property Invoice[] $items
 * @method InvoiceCollection add($entity)
 * @method InvoiceCollection remove($key)
 * @method Invoice|mixed getEntity(int $entityId, $default = null)
 * @method Invoice|mixed getBy(string $property, $value, $default = null)
 */
class InvoiceCollection extends EntityCollection
{
}