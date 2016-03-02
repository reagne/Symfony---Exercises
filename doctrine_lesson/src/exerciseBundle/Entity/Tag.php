<?php

namespace exerciseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass = "exerciseBundle\Entity\TagRepository")
 */
class Tag
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tagText", type="string", length=50)
     */
    private $tagText;

    /**
     * @ORM\ManyToMany(targetEntity = "Post", mappedBy = "tags")
     */
    private $posts;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tagText
     *
     * @param string $tagText
     * @return Tag
     */
    public function setTagText($tagText)
    {
        $this->tagText = $tagText;

        return $this;
    }

    /**
     * Get tagText
     *
     * @return string
     */
    public function getTagText()
    {
        return $this->tagText;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add posts
     *
     * @param \exerciseBundle\Entity\Post $posts
     * @return Tag
     */
    public function addPost(\exerciseBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \exerciseBundle\Entity\Post $posts
     */
    public function removePost(\exerciseBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
