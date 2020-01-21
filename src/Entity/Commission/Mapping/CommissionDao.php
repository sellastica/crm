<?php
namespace Sellastica\Crm\Entity\Commission\Mapping;

/**
 * @see \Sellastica\Crm\Entity\Commission\Entity\Commission
 * @property CommissionDibiMapper $mapper
 */
class CommissionDao extends \Sellastica\Entity\Mapping\Dao
{
	/**
	 * @inheritDoc
	 */
	protected function getBuilder(
		$data,
		$first = null,
		$second = null
	): \Sellastica\Entity\IBuilder
	{
		return \Sellastica\Crm\Entity\Commission\Entity\CommissionBuilder::create(
			$data->invoiceId,
			$data->projectId,
			$data->b2bProjectId,
			$data->percentCommission,
			$data->commission,
			$data->exchangeRate
		)->hydrate($data);
	}

	/**
	 * @return \Sellastica\Crm\Entity\Commission\Entity\CommissionCollection
	 */
	public function getEmptyCollection(): \Sellastica\Entity\Entity\EntityCollection
	{
		return new \Sellastica\Crm\Entity\Commission\Entity\CommissionCollection;
	}
}