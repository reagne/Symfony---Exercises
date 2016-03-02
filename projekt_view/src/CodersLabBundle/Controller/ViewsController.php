<?php

namespace CodersLabBundle\Controller;

use CodersLabBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ViewsController extends Controller
{
    /**
     * @Route("/render")
     * @Template("CodersLabBundle:Default:render.html.twig");
     */
    public function newAction(){
        return array();
    }
    /**
     * @Route("/render2/{username}")
     * @Template("CodersLabBundle:Default:render2.html.twig");
     */
    public function usernameAction($username){
        return array('username' => $username);
    }
    /**
     * @Route("/repeatSentence/{n}")
     * @Template("CodersLabBundle:Default:sentence.html.twig");
     */
    public function sentenceAction($n){
        return array('n' => $n);
    }
    /**
     * @Route("/repeatSentence2/{n}/{tekst}", defaults={"tekst" = ""})
     * @Template("CodersLabBundle:Default:sentence.html.twig");
     */
    public function sentence2Action($n, $tekst){
        return array('n' => $n, 'tekst' => $tekst);
    }
    /**
     * @Route("/createRandoms/{start}/{end}/{n}")
     * @Template("CodersLabBundle:Default:random.html.twig");
     */
    public function randomAction($start, $end, $n){
        $ret = [];
        for($i = $start; $i <= $end; $i++){
            $ret[] = $i;
        }
        return array('n' => $n, 'tab' => $ret, 'start' => $start, 'end' => $end);
    }
    /**
     * @Route("/showArticle/{id}")
     * @Template("CodersLabBundle:Default:articleOne.html.twig");
     */
    public function showArticleAction($id){
        $article = Article::GetArticlebyId($id);
        return ['article' => $article];
    }
    /**
     * @Route("/showAllArticle")
     * @Template("CodersLabBundle:Default:articleAll.html.twig");
     */
    public function showAllArticleAction(){
        $article = Article::GetAllArticles();
        return ['articles' => $article];
    }
    /**
     * @Route("/linksToArticle")
     * @Template("CodersLabBundle:Default:linksArticle.html.twig");
     */
    public function showArticleLinksAction(){
        $article = Article::GetAllArticles();
        return ['articles' => $article];

    }

}
