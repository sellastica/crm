<?php
namespace Sellastica\Crm\Entity\TariffPrice\Entity;

use Sellastica\Entity\Entity\EntityFactory;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;

/**
 * @method \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see TariffPrice
 */
class TariffPriceFactory extends EntityFactory
{
	/**
	 * @param IEntity|\Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice $entity
	 */
	public function doInitialize(IEntity $entity)
	{
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice::class;
	}
}