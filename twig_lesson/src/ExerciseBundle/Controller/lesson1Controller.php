<?php

namespace ExerciseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class lesson1Controller extends Controller
{
    /*
     * @Route("/view" name = "view")
     * @Template("ExerciseBundle:Default:index.html.twig")
     */
    /*
    public function showAction(){
        return [];  // lub array(). Zwracamy pustą tablicę, a new  Response jest tworzony w use ...\Template
    }
    */
    /**
     * @Route("/test2", name="test")
     * @Template()
     */
    public function test2Action()
    {
        return array(); // Tempalte jest pusty gdyż znajduje odpowiedni twig po nazwie funkcji oraz odpowiedniej nazwie folderu, w którym znajduje się plik twig oraz po nazwie samego twigu
    }
    /**
     * @Route("/hello/{name}", name ="hello", defaults = {"name" = "World"})
     * @Template("ExerciseBundle:Default:index.html.twig")
     */
    public function helloAction($name){
        return ["name" => $name,
                "good" => ['Ala', 'Maja', 'Tomek', 'Jacek']];
    }
    /**
     * @Route("/hello2/{name}", name = "hello2", defaults = {"name" = "World"})
     * @Template("ExerciseBundle:Default:heirdomView.html.twig")
     */
    public function hello2Action($name){
        return ["name" => $name,
                "good" => ['Ala', 'Maja', 'Tomek', 'Jacek']];
    }
    /**
     * @Route("/showLinks")
     */
    public function showAllLinksAction(){
        $response = new Response('<a href='.$this->generateUrl('test').'>Zobacz test</a><br>
                                  <a href='.$this->generateUrl('hello').'>Zobacz hello</a><br>
                                  <a href='.$this->generateUrl('hello2').'>Zobacz hello2</a><br>');
        return $response;
    }
    /**
     * @Route("/showLinks2", name="show")
     * @Template("ExerciseBundle:Default:linkowanie.html.twig")
     */
    public function showAllLinks2Action(){
        return [ "akcje" => ['test', 'hello', 'hello2']];
    }
}
