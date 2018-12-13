<?php
namespace Sellastica\Crm\Entity\Tariff\Entity;

use Sellastica\Entity\Entity\EntityFactory;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;

/**
 * @method \Sellastica\Crm\Entity\Tariff\Entity\Tariff build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see Tariff
 */
class TariffFactory extends EntityFactory
{
	/**
	 * @param IEntity|\Sellastica\Crm\Entity\Tariff\Entity\Tariff $entity
	 */
	public function doInitialize(IEntity $entity)
	{
		$entity->setRelationService(new TariffRelations($entity, $this->em));
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return \Sellastica\Crm\Entity\Tariff\Entity\Tariff::class;
	}
}