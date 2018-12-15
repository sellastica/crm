<?php
namespace Sellastica\Crm\Entity\Invoice\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\Entity\EntityFactory;

/**
 * @method Invoice build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see Invoice
 */
class InvoiceFactory extends EntityFactory
{
	/**
	 * @param IEntity|Invoice $entity
	 */
	public function doInitialize(IEntity $entity)
	{
		$entity->setRelationService(new InvoiceRelations($entity, $this->em));
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return Invoice::class;
	}
}