<?php
namespace Sellastica\Crm\Entity\Commission\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Sellastica\Crm\Entity\Commission\Entity\ICommissionRepository;
use Sellastica\Crm\Entity\Commission\Entity\Commission;

/**
 * @method CommissionRepository getRepository()
 * @see Commission
 */
class CommissionRepositoryProxy extends RepositoryProxy implements ICommissionRepository
{
}