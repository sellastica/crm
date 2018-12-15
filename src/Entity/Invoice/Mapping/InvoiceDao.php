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
		return \Sellastica\Crm\Entity\Invoice\Entity\InvoiceBuilder::create(
			$data->projectId,
			$data->code,
			$data->varSymbol,
			new \DateTime($data->dueDate),
			\Sellastica\Price\Price::sumPrice(
				$data->price,
				0,
				\Sellastica\Localization\Model\Currency::from($data->currency)
			),
			$data->externalId,
			new \Sellastica\Identity\Model\Email('info@example.com')
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