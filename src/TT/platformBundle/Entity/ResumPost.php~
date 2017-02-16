<?php

namespace TT\platformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResumPost
 *
 * @ORM\Table(name="resum_post")
 * @ORM\Entity(repositoryClass="TT\platformBundle\Repository\ResumPostRepository")
 */
class ResumPost
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="TT\platformBundle\Entity\matchCompet")
     * @ORM\JoinColumn(name="Match_id", referencedColumnName="id", nullable=false)
     */
    private $Match;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ResumPost
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
     * Set content
     *
     * @param string $content
     *
     * @return ResumPost
     */
    public function setContent($content)
    {
        $this->content = $content;
        $this->date = new \DateTime('now');

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return ResumPost
     */
    public function setDate($date)
    {
        $this->date = new \DateTime('now');

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return ResumPost
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }
    
    public function __toString(){
        // to show the name of the Category in the select
        //return $this->name;
        // to show the id of the Category in the select
         return (string) $this->id;
    }

    /**
     * Set match
     *
     * @param \TT\platformBundle\Entity\matchCompet $match
     *
     * @return ResumPost
     */
    public function setMatch(\TT\platformBundle\Entity\matchCompet $match)
    {
        $this->Match = $match;

        return $this;
    }

    /**
     * Get match
     *
     * @return \TT\platformBundle\Entity\matchCompet
     */
    public function getMatch()
    {
        return $this->Match;
    }
}
