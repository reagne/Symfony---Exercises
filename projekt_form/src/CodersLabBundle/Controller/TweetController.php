<?php

namespace CodersLabBundle\Controller;

use CodersLabBundle\Entity\Tweet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TweetController extends Controller
{
    private function tweetForm($tweet){
        $form = $this->createFormBuilder($tweet);
        $form->add('name', 'text', ['label' => 'Nazwa tweeta: ']);
        $form->add('text', 'textarea', ['label' => 'Tweet: ']);
        $form->add('save', 'submit', ['label' => 'Dodaj tweeta']);
        $form->setAction($this->generateUrl('create'));
        $tweetForm = $form->getForm();

        return $tweetForm;
    }
    /**
     * @Route("/create", name="create")
     */
    public function createTweetAction(Request $req){
        $tweet = new Tweet();
        $tweetForm = $this->tweetForm($tweet);
        $tweetForm->handleRequest($req);

        if($tweetForm->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($tweet);
            $em->flush();
        }

        return new Response('Utworzono nowy tweet');

    }
    /**
     * @Route("/new")
     * @Template("CodersLabBundle:Tweet:newTweet.html.twig")
     */
    public function newTweetAction(){
        $tweet = new Tweet();
        $tweetForm = $this->tweetForm($tweet);

        return ['form' => $tweetForm->createView()];
    }
    /**
     * @Route("/showAll")
     * @Template("CodersLabBundle:Tweet:getAll.html.twig")
     */
    public function showAllTweetsAction(){
        $repo = $this->getDoctrine()->getRepository('CodersLabBundle:Tweet');
        $allTweets = $repo->findAll();

        return ['allTweets' => $allTweets ];
    }
    /**
     * @Route("/update/{id}")
     * @Method["GET")
     * @Template("CodersLabBundle:Tweet:")
     */
    public function updateTweetAction($id){
        $repo = $this->getDoctrine()->getRepository('CodersLabBundle:Tweet');
        $tweet = $repo->find($id);

        return ['allTweets' => $tweet ];
    }

}
