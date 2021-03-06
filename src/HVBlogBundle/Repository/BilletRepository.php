<?php

namespace HVBlogBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * BilletRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BilletRepository extends EntityRepository
{
  public function getBillets($page,$nbPerPage)
  {
    $query=$this->createQueryBuilder('billets')
      ->orderBy('billets.id','DESC')
      ->setFirstResult((($page-1)*$nbPerPage))
      ->setMaxResults($nbPerPage)
      ->getQuery()
      ;
    return new Paginator($query,true);
  }
}
