<?php
namespace Sellastica\Crm\Entity\Commission\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\Entity\EntityFactory;

/**
 * @method Commission build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see Commission
 */
class CommissionFactory extends EntityFactory
{
	/**
	 * @param IEntity|Commission $entity
	 */
	public function doInitialize(IEntity $entity)
	{
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return Commission::class;
	}
}