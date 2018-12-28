<?php
namespace Sellastica\Crm\Entity\Invoice\Mapping;

/**
 * @see \Sellastica\Crm\Entity\Invoice\Entity\Invoice
 * @property InvoiceDibiMapper $mapper
 */
class InvoiceDao extends \Sellastica\Entity\Mapping\Dao
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
		$data->price = \Sellastica\Price\Price::sumPrice(
			$data->price + $data->vat,
			$data->vat,
			\Sellastica\Localization\Model\Currency::from($data->currency)
		);
		return \Sellastica\Crm\Entity\Invoice\Entity\InvoiceBuilder::create(
			$data->projectId,
			$data->code,
			$data->varSymbol,
			$data->dueDate,
			$data->price,
			$data->externalId
		)->hydrate($data);
	}

	/**
	 * @return \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection
	 */
	public function getEmptyCollection(): \Sellastica\Entity\Entity\EntityCollection
	{
		return new \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection;
	}
}