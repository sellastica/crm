<?php
namespace Sellastica\Crm\Entity\TariffHistory\Entity;

use Sellastica\Entity\Entity\EntityFactory;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;

/**
 * @method \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see TariffHistory
 */
class TariffHistoryFactory extends EntityFactory
{
	/**
	 * @param IEntity|\Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory $entity
	 */
	public function doInitialize(IEntity $entity)
	{
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return \Sellastica\Crm\Entity\TariffHistory\Entity\TariffHistory::class;
	}
}