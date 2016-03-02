<?php

namespace exerciseBundle\Controller;

use exerciseBundle\Entity\Post;
use exerciseBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TagController extends Controller
{
    /**
     * @Route("/showTags")
     * @Template("exerciseBundle:Tag:allTag.html.twig")
     */
    public function showAllTagsAction(){
        $repo = $this->getDoctrine()->getRepository('exerciseBundle:Tag');
        $allTags = $repo->findAllOrderedByTagText();

        return ['allTags' => $allTags];
    }
    /**
     * @Route("/searchTag/{searchText}")
     *  @Template("exerciseBundle:Tag:allTag.html.twig")
     */
    public function searchTagAction($searchText){
        $repo = $this->getDoctrine()->getRepository('exerciseBundle:Tag');
        $allTags = $repo->searchByTagText($searchText);

        return ['allTags' => $allTags];
    }
}
