<?php
namespace Sellastica\Crm\Entity\Invoice\Mapping;

/**
 * @see \Sellastica\Crm\Entity\Invoice\Entity\Invoice
 */
class InvoiceDibiMapper extends \Sellastica\Entity\Mapping\DibiMapper
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesDibiMapper;

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
	public function findInvoicesToDisplay(
		int $projectId,
		\Sellastica\Entity\Configuration $configuration = null
	): array
	{
		$resource = $this->getResourceWithIds($configuration)
			->where('projectId = %i', $projectId)
			->where('cancelled = 0')
			->where('(display = 1 OR (FLOOR(priceToPay - paidAmount) > 0 AND dueDate < %d))', new \DateTime(
				sprintf('-%s days', \Sellastica\Project\Service\ProjectService::SUSPEND_AFTER_DAYS))
			);

		if ($configuration) {
			$this->setSorter($resource, $configuration->getSorter());
		}

		return $resource->fetchPairs();
	}

	/**
	 * @param int $projectId
	 * @return int|false
	 */
	public function findLongestUnpaidInvoice(int $projectId)
	{
		$resource = $this->getResourceWithIds()
			->where('projectId = %i', $projectId)
			->where('CEIL(paidAmount) < CEIL(price + vat)')
			->where('cancelled = 0')
			->orderBy('dueDate');

		return $resource->fetchSingle();
	}
}