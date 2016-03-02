<?php
namespace exerciseBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository{

    public function findAllOrderedByTagText(){
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT tag FROM exerciseBundle:Tag tag
            ORDER BY tag.tagText ASC');
        return $query->getResult();
    }
    public function searchByTagText($searchTag){
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT tag FROM exerciseBundle:Tag tag
            WHERE tag.tagText LIKE :text
            ORDER BY tag.tagText ASC')
            ->setParameter( 'text', '%'.$searchTag.'%');

        return $query->getResult();
    }
}