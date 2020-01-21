<?php
namespace Sellastica\Crm\Entity\Commission\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method Commission find(int $id)
 * @method Commission findOneBy(array $filterValues)
 * @method Commission findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method Commission[]|CommissionCollection findAll(Configuration $configuration = null)
 * @method Commission[]|CommissionCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method Commission[]|CommissionCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method Commission[]|CommissionCollection findPublishable(int $id)
 * @method Commission[]|CommissionCollection findAllPublishable(Configuration $configuration = null)
 * @method Commission[]|CommissionCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see Commission
 */
interface ICommissionRepository extends IRepository
{
}