<?php
namespace Sellastica\Crm\Entity\Tariff\Entity;

use Sellastica\App\Entity\App;
use Sellastica\Entity\EntityManager;
use Sellastica\Entity\Relation\IEntityRelations;

/**
 * @property Tariff $tariff
 */
class TariffRelations implements IEntityRelations
{
	/** @var Tariff */
	private $tariff;
	/** @var EntityManager */
	private $em;


	/**
	 * @param Tariff $tariff
	 * @param EntityManager $em
	 */
	public function __construct(
		Tariff $tariff,
		EntityManager $em
	)
	{
		$this->tariff = $tariff;
		$this->em = $em;
	}

	/**
	 * @return \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPriceCollection
	 */
	public function getPrices(): \Sellastica\Crm\Entity\TariffPrice\Entity\TariffPriceCollection
	{
		return $this->em->getRepository(\Sellastica\Crm\Entity\TariffPrice\Entity\TariffPrice::class)->findBy(['tariffId' => $this->tariff->getId()]);
	}

	/**
	 * @return App
	 */
	public function getApplication(): App
	{
		return $this->em->getRepository(App::class)->find($this->tariff->getApplicationId());
	}
}