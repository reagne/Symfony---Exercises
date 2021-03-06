<?php

namespace CoderslabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Book
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CoderslabBundle\Entity\BookRepository")
 */
class Book
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
     * @ORM\Column(name="title", type="string", length=100)
     * @Assert\NotBlank(message = "Podaj tytuł")
     * @Assert\Length(min = 5, minMessage = "Tytuł musi mieć conajmniej 5 znaków")
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="rating", type="float")
     * @Assert\NotBlank(message = "Podaj rating")
     * @Assert\Range(min = 0.00, max = 10.00, minMessage = "Rating musi być większy niż {{ limit }}", minMessage = "Rating musi być mniejszy niż {{ limit }}")
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank(message = "Podaj opis")
     * @Assert\Length(max = 600, maxMessage = "Opis może mieć maksymalnie 600 znaków")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="pages", type="integer")
     * @Assert\NotBlank(message = "Podaj liczbę stron")
     * @Assert\GreaterThan(value = 0, message = "Liczba strona musi być większa od 0")
     */
    private $pages;

    /**
     * @ORM\ManyToOne(targetEntity = "Author", inversedBy = "books")
     * @ORM\JoinColumn(name = "book_id", referencedColumnName = "id", onDelete="CASCADE")
     * @Assert\NotBlank(message = "Podaj autora")
     */
    private $author;


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
     * Set title
     *
     * @param string $title
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set rating
     *
     * @param float $rating
     * @return Book
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return float 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Book
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set pages
     *
     * @param integer $pages
     * @return Book
     */
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return integer 
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set author
     *
     * @param \CoderslabBundle\Entity\Author $author
     * @return Book
     */
    public function setAuthor(\CoderslabBundle\Entity\Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \CoderslabBundle\Entity\Author 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
