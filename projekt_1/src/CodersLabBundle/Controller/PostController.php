<?php

namespace CodersLabBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/*
 * @Route("/post/{id}")
 */

class PostController extends Controller
{

    /**
     * @Route("/helloWorld/{name}", defaults={"name" = "You"})
     */
    public function helloWorldAction(Request $req, $name){
        $sessStart = $req->getSession()->set('sesja_test','start');
        $test = $req->query->get('test', 'Nie podales paramtru GET'); // drugi parametr jest wartością domyślną
                                                                      // gdybyśmy chcieli przesłać POSTem, zamiast query trzeba by napisać request
        return new Response ("Hello World and ".$name.' '.$test.$sessStart);

    }
    /**
     * @Route("/get")
     */
    public function getSessionAction(Request $req){
        $sess = $req->getSession()->get('sesja_test', 'nie ma takiej sesji');  // jeśli nie będzie sesji to wyświetli "nie ma takiej sesji". Jeśli sesja będzie wyświetli value z set'a czy "start"
        return new Response ("Sesja: ".$sess);
    }
    /**
     * @Route("/unset")
     */
    public function unsetSessionAction(Request $req){
        $sess = $req->getSession()->remove('sesja_test');  // usunięcie sesji
        return new Response ($sess);
    }
    /**
     * @Route("/setcookie")
     */
    public function setCookieAction()
    {
        $cookie = new Cookie('test_cookie', 'cookie_set');
        //$response = new Response('Ciastko dodane');
        $response = $this->redirectToRoute('getcookie'); // $this odnosi się do klasy Controller gdzie jest metoda redirectToRoute()
        $response->headers->setCookie($cookie);

        return $response;
    }
    /**
     * @Route("/setcookie2")
     */
    public function setCookie2Action()
    {
        $response = new Response('<a href='.$this->generateUrl('getcookie').'>Zobacz</a>');
        $cookie = new Cookie('test_cookie2', 'cookie2_set');
        $response->headers->setCookie($cookie);
        return $response;
    }
    /**
     * @Route("/getcookie", name="getcookie")
     */
    public function getCookieAction(Request $req){
        $cookies = $req->cookies->all();
        //$ourCookie = $cookies['test_cookie'];
        return new Response(dump($cookies));
    }
    /**
     * @Route("/removecookie")
     */
    public function removeCookieAction()  // usunięcie ciastka jest na response a nie request ciastka są po stronie serwera a nie klienta jak sesja
    {
        $resp = new Response('ciastko usunięte');
        $resp->headers->clearCookie('test_cookie');
        return $resp;
    }
    /**
     * @Route("/setcookie/{val}", name="setcookieVal")
     */
    public function setCookieValAction($val)
    {
        $cookie = new Cookie('val_cookie', $val);
        //$response = new Response('Ciastko dodane');
        $response = $this->redirectToRoute('getcookie'); // $this odnosi się do klasy Controller gdzie jest metoda redirectToRoute()
        $response->headers->setCookie($cookie);

        return $response;
    }
    /**
     * @Route("/test")
     */
    public function setCookieTestAction()
    {
        return $this->redirectToRoute('setcookieVal', array("val" => 'test'));
    }
    /**
     * @Route("/google.pl/{search}")
     */
    public function googleRedirectAction($search)
    {
        return $this->redirect('http://google.pl/search?q='.$search);
    }

    /*
     * @Route("/")
     */
    /*
    public function showPost($id){
        return new Response('Wyswietla post '.$id);
    }
    */
    /*
     * @Route("/delete")
     */
    /*
    public function deletePost($id){
        return new Response('Usuwa post '.$id);
    }
    */
}
