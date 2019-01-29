<?php
namespace Sellastica\Crm\Entity\Invoice\Mapping;

/**
 * @see \Sellastica\Crm\Entity\Invoice\Entity\Invoice
 * @property InvoiceDibiMapper $mapper
 */
class InvoiceDao extends \Sellastica\Entity\Mapping\Dao
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesDao;

	/**
	 * @param int $projectId
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection|\Sellastica\Crm\Entity\Invoice\Entity\Invoice[]
	 */
	public function findUnpaidInvoices(
		int $projectId,
		\Sellastica\Entity\Configuration $configuration = null
	): \Sellastica\Crm\Entity\Invoice\Entity\InvoiceCollection
	{
		return $this->getEntitiesFromCacheOrStorage(
			$this->mapper->findUnpaidInvoices($projectId, $configuration)
		);
	}

	/**
	 * @param int $projectId
	 * @return \Sellastica\Crm\Entity\Invoice\Entity\Invoice|null
	 */
	public function findLongestUnpaidInvoice(int $projectId): ?\Sellastica\Crm\Entity\Invoice\Entity\Invoice
	{
		return $this->find(
			$this->mapper->findLongestUnpaidInvoice($projectId)
		);
	}

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