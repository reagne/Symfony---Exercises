<?php

namespace exerciseBundle\Controller;

use exerciseBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private function generateUserForm($user){
        $form = $this->createFormBuilder($user);
        $form->add('username', 'text');
        $form->add('age', 'number');
        $form->add('email', 'email');
        $form->add('save', 'submit', ['label' => 'Utwórz nowego użytkownika']);
        $form->setAction($this->generateUrl('createUser'));
        $userForm = $form->getForm();

        return $userForm;
    }
    /**
     * @Route("/newUser")
     * @Template("exerciseBundle:User:newUser.html.twig")
     */
    public function newUserAction(){
        $user = new User();
        $userForm = $this->generateUserForm($user);

        return['form' => $userForm->createView()];
    }
    /**
     * @Route("/createUser", name="createUser")
     */
    public function createUserAction(Request $req){
        $user = new User();
        $userForm = $this->generateUserForm($user);
        $userForm->handleRequest($req);

        if($userForm->isSubmitted()){
            //To nam pobierze Entity Managera:
            $em = $this->getDoctrine()->getManager();
            //To nam zapamięta obiekt
            $em->persist($user);
            //Informujemy Entity Managera, aby zapamiętał nam obiekt w bazie
            $em->flush();
        }
        $newId = $user->getId();

        return $this->redirectToRoute('showUser', ['id' => $newId]);
    }
    /**
     * @Route("/showUser/{id}", name="showUser")
     * @Template("exerciseBundle:User:oneUser.html.twig")
     */
    public function showUserAction($id){
        $repository = $this->getDoctrine()->getRepository('exerciseBundle:User');
        $user = $repository->find($id);

        return ['user' => $user];
    }
    /**
     * @Route("/showAllUser", name="showAll")
     * @Template("exerciseBundle:User:allUser.html.twig")
     */
    public function showAllUser(){
        $repository = $this->getDoctrine()->getRepository('exerciseBundle:User');
        $user = $repository->findAll();

        return ['users' => $user];
    }
    /**
     * @Route("/updateUser/{id}/{username}")
     */
    public function updateUser($id, $username){
        $repository = $this->getDoctrine()->getRepository('exerciseBundle:User');
        $user = $repository->find($id);

        $em= $this->getDoctrine()->getManager();
        $user->setUsername($username);
        $em->flush();

        return $this->redirectToRoute('showUser', ['id' => $id]);
    }
    /**
     * @Route("/removeUser/{id}")
     */
    public function removeUser($id){
        $repository = $this->getDoctrine()->getRepository('exerciseBundle:User');
        $user = $repository->find($id);

        $em= $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('showAll');
    }

}
