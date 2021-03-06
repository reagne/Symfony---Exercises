<?php

namespace CodersLabBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BookRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookRepository extends EntityRepository
{
    public function findBooksWithId($id){
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT b FROM CodersLabBundle:Book b
            WHERE b.id > :id')
            ->setParameter('id', $id);
        return $query->getResult();
    }
    public function findBooksWithRating($rating){
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT b FROM CodersLabBundle:Book b
            WHERE b.raiting > :rating')
            ->setParameter('rating', $rating);
        return $query->getResult();
    }
    public function findBooksWithTitle($title){
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT b FROM CodersLabBundle:Book b
            WHERE b.title LIKE :title')
            ->setParameter('title', $title.'%');
        return $query->getResult();
    }
}
