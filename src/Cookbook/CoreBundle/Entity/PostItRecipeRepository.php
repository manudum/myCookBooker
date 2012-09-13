<?php

namespace Cookbook\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PostItRecipeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostItRecipeRepository extends EntityRepository
{
    
    public function deletePostIt($id)
    {
        $q = $this->getEntityManager()
            ->createQueryBuilder()
            ->delete('Cookbook\CoreBundle\Entity\PostItRecipe', 'i')
            ->where('i.id = :postit_id')
            ->setParameter('postit_id', $id)
            ->getQuery()
        ;
        return 1 === $q->getScalarResult();
    }
}