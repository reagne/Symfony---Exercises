<?php

namespace CodersLabBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/first")
 */

class firstController extends Controller
{
    /**
     * @Route("/helloWorld")
     */
    public function sayHelloAction(){
        $response = new Response('Witaj!');
        return $response;
    }
    /**
     * @Route("/goodbye/{username}")
     */
    public function sayGoodbyeAction($username){
        return new Response('Bye bye '.$username);
    }
    /**
     * @Route("/welcome/{name}/{surname}", defaults={"name" = "Regina", "surname" = "Anam"})
     */
    public function sayWelcomeAction($name, $surname){
        return new Response('Welcome '.$name.' '.$surname);
    }
    /**
     * @Route("/showPost/{id}", defaults={"id" = "1"}, requirements={"id" = "\d+"})
     */
    public function showPostAction($id){
        return new Response('Post o id: '.$id);
    }
    /**
     * @Route("/form")
     * @Method("GET")
     */
    public function formGetAction(){

        return new Response('<html><head></head><body>
                             <form action="/form" method="POST">
                             <input type ="text" name="tekst">
                             <input type="submit" value="Wyślij">
                             </body></html>');
    }
    /**
     * @Route("/form")
     * @Method("POST")
     */
    public function formPostAction(Request $req){
        $form = $req->request->get('tekst');
        return new Response('Formularz przyjęty. Dziękujemy za twoją wiadomość: '.$form);
    }
    /**
     * @Route("/setSession/{value}", defaults={"value" = "sesja_testowa"})
     */
    public function setSessionAction(Request $req, $value){
        $session = $req->getSession()->set('session_start', array('usertext' => $value));
        return new Response('Sesja utworzona');
    }
    /**
     * @Route("/getSession")
     */
    public function getSessionAction(Request $req){
        $session = $req->getSession()->get('session_start', 'Brak sesji');
        return new Response($session['usertext']);
    }
    /**
     * @Route("/setCookie/{value}")
     */
    public function setCookieAction($value){
        $cookie = new Cookie('myCookie', $value);
        $response = new Response ('Ciasteczko stworzone');
        $response->headers->setCookie($cookie);
        return $response;
    }
    /**
     * @Route("/getCookie")
     */
    public function getCookieAction(Request $req){
        $cookies = $req->cookies->all();
        if(isset($cookies['myCookie'])){
            $ourCookie = $cookies['myCookie'];
            return new Response($ourCookie);
        } else {
            return new Response("Nie ma ciasteczka");
        }
    }
    /**
     * @Route("/deleteCookie")
     */
    public function deletCookieAction(){
        $response = new Response('Ciasteczko usunięte');
        $response->headers->clearCookie('myCookie');
        return $response;
    }

}
