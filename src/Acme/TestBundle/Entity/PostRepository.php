<?php

namespace Acme\TestBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends EntityRepository
{
    public function getLastPost($limit = 3)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->addOrderBy('b.timePost', 'DESC');

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
            ->getResult();
    }

    public function getPostTag($tag)
    {
        $filter = array();
        $queryBuilder = $this->createQueryBuilder('a');
        $tags = $this->getEntityManager()->getRepository('AcmeTestBundle:Tags')->findOneBy(array('textTag' => $tag));
        $queryBuilder->innerJoin('a.tag', 't', Join::WITH, 't.id = :tag_id')
            ->setParameter(':tag_id', $tags->getId());
        $tagResult = $queryBuilder->getQuery()->getResult();

        return $tagResult;
    }

    public function getMostViewed($limit = 5)
    {
        $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->addOrderBy('b.viewed', 'DESC');

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
            ->getResult();
    }
}
