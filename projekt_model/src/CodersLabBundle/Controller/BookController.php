<?php

namespace CodersLabBundle\Controller;

use CodersLabBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    /**
     * @Route("/newBook")
     * @Template("CodersLabBundle:Book:bookForm.html.twig")
     */
    public function newBookAction(){
        return[];
    }
    /**
     * @Route("/createBook", name="createBook")
     */
    public function createBookAction(Request $req){
        $title= trim($req->request->get('title'));
        $description = trim($req->request->get('description'));
        $rating = trim($req->request->get('rating'));

        if(strlen($title) > 0 && strlen($description) > 0 && strlen($rating) > 0){
            $book = new Book();
            $book->setTitle($title);
            $book->setDescription($description);
            $book->setRaiting($rating);

            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return new Response('Dodano nową książkę');

        } else {
            return new Response('Podano błędne dane');
        }
    }
    /**
     * @Route("/showBook/{id}", name="bookById")
     * @Template("CodersLabBundle:Book:getBook.html.twig")
     */
    public function showBookByIdAction($id){
        $repo = $this->getDoctrine()->getRepository('CodersLabBundle:Book');
        $book = $repo->find($id);

        return ['book' => $book];
    }
    /**
     * @Route("/showAllBooks")
     * @Template("CodersLabBundle:Book:getAllBooks.html.twig")
     */
    public function showAllBooksAction(){
        $repo = $this->getDoctrine()->getRepository('CodersLabBundle:Book');
        $book = $repo->findAll();

        return ['books' => $book];
    }
    /**
     * @Route("/deleteBook/{id}")
     */
    public function removeBookAction($id){
        $repo = $this->getDoctrine()->getRepository('CodersLabBundle:Book');
        $book = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();

        return new Response('Książka usunięta');
    }
    /**
     * @Route("/booksId/{id}")
     * @Template("CodersLabBundle:Book:getAllBooks.html.twig")
     */
    public function booksWithIdAction($id){
        $repo = $this->getDoctrine()->getRepository('CodersLabBundle:Book');
        $books = $repo->findBooksWithId($id);

        return ['books' => $books];
    }
    /**
     * @Route("/booksRating/{rating}")
     * @Template("CodersLabBundle:Book:getAllBooks.html.twig")
     */
    public function booksWithRatingAction($rating){
        $repo = $this->getDoctrine()->getRepository('CodersLabBundle:Book');
        $books = $repo->findBooksWithRating($rating);

        return ['books' => $books];
    }
    /**
     * @Route("/booksTitle/{title}")
     * @Template("CodersLabBundle:Book:getAllBooks.html.twig")
     */
    public function booksWithTitleAction($title){
        $repo = $this->getDoctrine()->getRepository('CodersLabBundle:Book');
        $books = $repo->findBooksWithTitle($title);

        return ['books' => $books];
    }

}
