<?php

// POPRAW NAZWE BUNDLA NA SWOJA
//namespace <your_bundle_name>\Entity;
namespace CodersLabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class Article
{
    private $id;
    private $title;
    private $articleText;

    public static function GetArticlebyId($id){
        if($id < 20){
            return new Article($id, "Title for article $id", "Text for article $id. Lorem ipsum...");
        }
        return null;
    }

    public static function GetAllArticles(){
        $ret = [];
        for($i=0; $i< 20; $i++){
            $ret[] = self::GetArticlebyId($i);
        }
        return $ret;
    }

    /**
     * Article constructor.
     * @param $id
     * @param $title
     * @param $articleText
     */
    public function __construct($id, $title, $articleText)
    {
        $this->id = $id;
        $this->title = $title;
        $this->articleText = $articleText;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getArticleText()
    {
        return $this->articleText;
    }

    /**
     * @param mixed $articleText
     */
    public function setArticleText($articleText)
    {
        $this->articleText = $articleText;
    }


}