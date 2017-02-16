<?php

namespace TT\platformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BlogComment
 * 
 * @ORM\Table(name="blog_comment", indexes={@ORM\Index(name="blog_comment_post_id_idx", columns={"post_id"})})
 * @ORM\Entity(repositoryClass="TT\platformBundle\Repository\BlogCommentRepository")
 */
class BlogComment
{
    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=20, nullable=false)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \TT\platformBundle\Entity\BlogPost
     *
     * @ORM\ManyToOne(targetEntity="TT\platformBundle\Entity\BlogPost")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     * })
     */
    private $post;



    /**
     * Set author
     *
     * @param string $author
     *
     * @return BlogComment
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

    /**
     * Set content
     *
     * @param string $content
     *
     * @return BlogComment
     */
    public function setContent($content)
    {
        $this->content = $content;
        $this->createdAt = new \DateTime('now');

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return BlogComment
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new \DateTime('now');

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

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
     * Set post
     *
     * @param \TT\platformBundle\Entity\BlogPost $post
     *
     * @return BlogComment
     */
    public function setPost(\TT\platformBundle\Entity\BlogPost $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \TT\platformBundle\Entity\BlogPost
     */
    public function getPost()
    {
        return $this->post;
    }
}
