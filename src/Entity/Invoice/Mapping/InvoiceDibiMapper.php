<?php
namespace Sellastica\Crm\Entity\Invoice\Mapping;

/**
 * @see \Sellastica\Crm\Entity\Invoice\Entity\Invoice
 */
class InvoiceDibiMapper extends \Sellastica\Entity\Mapping\DibiMapper
{
	/**
	 * @return bool
	 */
	protected function isInCrmDatabase(): bool
	{
		return true;
	}

	/**
	 * @param bool $databaseName
	 * @return string
	 */
	protected function getTableName($databaseName = false): string
	{
		return ($databaseName ? $this->environment->getCrmDatabaseName() . '.' : '')
			. 'invoice';
	}

	/**
	 * @param int $projectId
	 * @param \Sellastica\Entity\Configuration|null $configuration
	 * @return array
	 */
	public function findUnpaidInvoices(
		int $projectId,
		\Sellastica\Entity\Configuration $configuration = null
	): array
	{
		$resource = $this->getResourceWithIds($configuration)
			->where('projectId = %i', $projectId)
			->where('CEIL(paidAmount) < CEIL(price + vat)');

		if ($configuration) {
			$this->setSorter($resource, $configuration->getSorter());
		}

		return $resource->fetchPairs();
	}
}