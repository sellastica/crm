<?php
namespace Sellastica\Crm\Entity\TariffHistory\Entity;

use Sellastica\Entity\Entity\EntityFactory;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;

/**
 * @method TariffHistory build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see TariffHistory
 */
class TariffHistoryFactory extends EntityFactory
{
	/**
	 * @param IEntity|TariffHistory $entity
	 */
	public function doInitialize(IEntity $entity)
	{
		$entity->setRelationService(new TariffHistoryRelations($entity, $this->em));
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return TariffHistory::class;
	}
}