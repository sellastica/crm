<?php
namespace Sellastica\Crm\Entity\Invoice\Entity;

use Sellastica\Entity\EntityManager;
use Sellastica\Entity\Relation\IEntityRelations;

/**
 * @property \Sellastica\Crm\Entity\Invoice\Entity\Invoice $invoice
 */
class InvoiceRelations implements IEntityRelations
{
	/** @var \Sellastica\Crm\Entity\Invoice\Entity\Invoice */
	private $invoice;
	/** @var EntityManager */
	private $em;


	/**
	 * @param \Sellastica\Crm\Entity\Invoice\Entity\Invoice $invoice
	 * @param EntityManager $em
	 */
	public function __construct(
		\Sellastica\Crm\Entity\Invoice\Entity\Invoice $invoice,
		EntityManager $em
	)
	{
		$this->invoice = $invoice;
		$this->em = $em;
	}

	/**
	 * @return \Sellastica\Project\Entity\Project
	 */
	public function getProject(): \Sellastica\Project\Entity\Project
	{
		return $this->em->getRepository(\Sellastica\Project\Entity\Project::class)
			->find($this->invoice->getProjectId());
	}
}