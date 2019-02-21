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
				sprintf('-%s days', \Sellastica\Project\Entity\Project::SUSPEND_AFTER_DAYS))
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
			->where('CEIL(paidAmount) < CEIL(priceToPay)')
			->where('cancelled = 0')
			->where('mustPay = 1')
			->orderBy('dueDate');

		return $resource->fetchSingle();
	}

	/**
	 * @param \Sellastica\Entity\Configuration $configuration
	 * @param \Sellastica\DataGrid\Model\FilterRuleCollection $rules
	 * @return \Dibi\Fluent
	 */
	protected function getAdminResource(
		\Sellastica\Entity\Configuration $configuration = null,
		\Sellastica\DataGrid\Model\FilterRuleCollection $rules = null
	): \Dibi\Fluent
	{
		$resource = $this->getResource($configuration);

		if (isset($rules)) {
			//after_due
			if ($rules['after_due']) {
				$resource->where('dueDate <= NOW()');
			}

			//paid
			if ($rules['paid']) {
				if ($rules['paid']->getValue()) {
					$resource->where('CEIL(priceToPay) <= CEIL(paidAmount)');
				} else {
					$resource->where('CEIL(priceToPay) > CEIL(paidAmount)');
				}
			}

			//cancelled
			if ($rules['cancelled']) {
				if ($rules['cancelled']->getValue()) {
					$resource->where('cancelled = 1');
				} else {
					$resource->where('cancelled = 0');
				}
			}
		}

		return $resource;
	}
}