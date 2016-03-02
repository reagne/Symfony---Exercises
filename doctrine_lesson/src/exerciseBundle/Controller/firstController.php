<?php

namespace exerciseBundle\Controller;

use exerciseBundle\Entity\Post;
use exerciseBundle\Entity\User;
use exerciseBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class firstController extends Controller
{
    private function getTag($tagText){
        $tagRepository = $this->getDoctrine()->getRepository('exerciseBundle:Tag');
        $tag = $tagRepository->findOneByTagText($tagText);
        if($tag !== null){
            return $tag;
        } else {
            $tag = new Tag();
            $tag->setTagText($tagText);
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            return $tag;
        }
    }
    private function mapPostTag ($post, $tagText){
        $tag = $this->getTag($tagText);

        $post->addTag($tag);    // to nam zapisuje w akcji createPost, gdzie mamy flush().
        $tag->addPost($post);   // Wchodzi nam to z autmatu do tabeli łączącej product_tag
    }
    private function generatePostForm($post){
        $form = $this->createFormBuilder($post);
        $form->add('title', 'text', ['label' => 'Podaj tytuł: ']);
        $form->add('rating', 'number');
        $form->add('postText', 'textarea');
        $form->add('user', 'entity', ['class' => 'exerciseBundle\Entity\User', 'choice_label' => 'username']);
        $form->add('tags', 'entity', ['class' => 'exerciseBundle\Entity\Tag', 'choice_label' => 'tagText', 'expanded' => 'true', 'multiple' =>'true']);
        $form->add('save', 'submit', ['label' => 'Dodaj post']);
        $form->setAction($this->generateUrl('createPost'));
        $postForm = $form->getForm();

        return $postForm;
    }
    /**
     * @Route("/newPost")
     * @Template("exerciseBundle:Post:newPost.html.twig")
     */
    public function newPostAction(){
        $post = new Post();
        $postForm = $this->generatePostForm($post);

        return['form' => $postForm->createView()];
    }
    /**
     * @Route("/create", name="createPost")
     */
    public function createPostAction(Request $req){
        $post = new Post();

        $postForm = $this->generatePostForm($post);
        $postForm->handleRequest($req);

        if($postForm->isSubmitted()){
            //To nam pobierze Entity Managera:
            $em = $this->getDoctrine()->getManager();
            //To nam zapamięta obiekt
            $em->persist($post);
            //Informujemy Entity Managera, aby zapamiętał nam obiekt w bazie
            $em->flush();
        }
        /*
        $post->setTitle('Pierwszy post');
        $post->setPostText('Opis pierwszego posta');
        $post->setRating(10.00);
        //To nam pobierze Entity Managera:
        $em = $this->getDoctrine()->getManager();

        $userRepository = $this->getDoctrine()->getRepository('exerciseBundle:User');
        $user = $userRepository->find(1);
        $post->setUser($user);
        $user->addPost($post);

        //Dodawanie tagów do postu
        $tags = explode(',', $tagsStr);
        foreach($tags as $tag){
            $this->mapPostTag($post, $tag);
        }

        //To nam zapamięta obiekt
        $em->persist($post);
        //Informujemy Entity Managera, aby zapamiętał nam obiekt w bazie
        $em->flush();
        */
        //Pobieramy id nowo utworzonego obiektu
        $newId = $post->getId();

        return $this->redirectToRoute('getPost', ['id' => $newId]);
    }

    /**
     * @Route("/getPost/{id}", name="getPost")
     * @Template("exerciseBundle:Post:getPost.html.twig")
     */
    public function getPostAction($id){
        $repo = $this->getDoctrine()->getRepository('exerciseBundle:Post');
        $post = $repo->find($id);
        return ['post' => $post];
    }
    /**
     * @Route("/allPost", name="getAllPost")
     * @Template("exerciseBundle:Post:allPost.html.twig")
     */
    public function allPostAction(){
        $repo = $this->getDoctrine()->getRepository('exerciseBundle:Post');
        $post = $repo->findAll();  // tutaj do $post wrzuca nam tablicę
        return ['posts' => $post];
    }
    /**
     * @Route("/update/{id}/{newTitle}")
     */
    public function updatePostTitleAction($id, $newTitle){
        $repo = $this->getDoctrine()->getRepository('exerciseBundle:Post');
        $post = $repo->find($id);
        $post->setTitle($newTitle);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute('getPost', ['id' => $id]);
    }
    /**
     * @Route("/remove/{id}")
     */
    public function removePostAction($id){
        $repo = $this->getDoctrine()->getRepository('exerciseBundle:Post');
        $post = $repo->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('getAllPost');
    }
}
