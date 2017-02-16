<?php

namespace TT\platformBundle\Repository;

/**
 * BlogPostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BlogPostRepository extends \Doctrine\ORM\EntityRepository
{
    public function byCategorieLimit()
    {
        $qb = $this->createQueryBuilder('u')
                ->select('u')
                ->orderBy('u.id', 'DESC')
                ->setMaxResults(3);
        return $qb->getQuery()->getResult();      
    }
    
    public function byCategorie($categorie)
    {
        $qb = $this->createQueryBuilder('u')
                ->select('u')
                ->where('u.categorie = :categorie')
                ->orderBy('u.id', 'DESC')
                ->setMaxResults(10)
                ->setParameter('categorie', $categorie);
        return $qb->getQuery()->getResult();      
    }
}