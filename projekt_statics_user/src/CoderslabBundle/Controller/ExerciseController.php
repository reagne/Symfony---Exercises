<?php

namespace CoderslabBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;

class ExerciseController extends Controller
{
    /**
     * @Route("/all")
     *
     */
    public function allAction(){
        return new Response('Wszyscy widzą tę stronę');
    }
    /**
     * @Route("/restricted")
     * @Security("has_role('ROLE_USER')")
     */
    public function restrictedAction(){
        return new Response('Tę stron widzą wybrańcy');
    }
}
