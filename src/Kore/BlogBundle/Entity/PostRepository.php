<?php

namespace Kore\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends EntityRepository
{
    private function getPosts()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                 FROM KoreBlogBundle:Post p
                 WHERE p.published = 1
                 ORDER BY p.sticky desc, p.created DESC'
            );
    }
    
    public function findRecent()
    {
        return $this->getPosts()
            ->setMaxResults(10)
            ->getResult();
    }
    
    public function findAll()
    {
        return $this->getPosts()
            ->getResult();
    }
}
