<?php
namespace Sellastica\Crm\Entity\Commission\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Sellastica\Crm\Entity\Commission\Entity\Commission;
use Sellastica\Crm\Entity\Commission\Entity\ICommissionRepository;

/**
 * @property CommissionDao $dao
 * @see Commission
 */
class CommissionRepository extends Repository implements ICommissionRepository
{
}