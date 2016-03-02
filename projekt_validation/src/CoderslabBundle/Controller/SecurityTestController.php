<?php

namespace CoderslabBundle\Controller;

use CoderslabBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;


class SecurityTestController extends Controller
{
    /**
     * @Route("/admin")
     *
     */
    public function adminAction(){
        return new Response('Jesteś adminem! I zwycięzcą!');
    }
    /**
     * @Route("/test")
     *
     */
    public function denyAccessTestAction(){
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied!');

        return new Response('I\'m in!');
    }
    /**
     * @Route("/test2")
     * @Security("has_role('ROLE_ADMIN')")
     *
     */
    public function denyAccessTest2Action(){
        return new Response('I\'m in!');
    }
    /**
     * @Route("/getuser")
     */
    public function getuserAsction(){
        /**@var User @user */
        $user = $this->getUser();

        if(!$user){
            return new Response ("Nie jesteś zalogowany");
        } else {
            return new Response('Jesteś zalogowany');
        }
    }

    /**
     * @Route("/addadmin/{userId}")
     * @Security("has_role('ROLE_ADMIN')")
     *
     */
    public function addAdminAction($userId){
        $repo = $this->getDoctrine()->getRepository('CoderslabBundle:User');
        $user = $repo->find($userId);

        $user->addRole('ROLE_ADMIN');

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response('Utworzono nowego admina');
    }
}
