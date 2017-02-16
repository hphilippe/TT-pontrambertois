<?php

namespace TT\platformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * matchCompet
 *
 * @ORM\Table(name="match_compet")
 * @ORM\Entity(repositoryClass="TT\platformBundle\Repository\matchCompetRepository")
 */
class matchCompet
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
     * @ORM\ManyToOne(targetEntity="TT\platformBundle\Entity\anneCompet", cascade={"remove"})
     * @ORM\JoinColumn(name="anne_id", referencedColumnName="id", nullable=true)
     */
    private $anne;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroEquie", type="string", length=255)
     */
    private $numeroEquie;

    /**
     * @var string
     *
     * @ORM\Column(name="score", type="string", length=255)
     */
    private $score;
    
    /**
     * @var string
     *
     * @ORM\Column(name="journee", type="string", length=255)
     */
    private $journee;


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
     * Set numeroEquie
     *
     * @param integer $numeroEquie
     *
     * @return matchCompet
     */
    public function setNumeroEquie($numeroEquie)
    {
        $this->numeroEquie = $numeroEquie;

        return $this;
    }

    /**
     * Get numeroEquie
     *
     * @return int
     */
    public function getNumeroEquie()
    {
        return $this->numeroEquie;
    }

    /**
     * Set score
     *
     * @param integer $score
     *
     * @return matchCompet
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set journee
     *
     * @param integer $journee
     *
     * @return matchCompet
     */
    public function setJournee($journee)
    {
        $this->journee = $journee;

        return $this;
    }

    /**
     * Get journee
     *
     * @return integer
     */
    public function getJournee()
    {
        return $this->journee;
    }

    /**
     * Set anne
     *
     * @param \TT\platformBundle\Entity\anneCompet $anne
     *
     * @return matchCompet
     */
    public function setAnne(\TT\platformBundle\Entity\anneCompet $anne = null)
    {
        $this->anne = $anne;

        return $this;
    }

    /**
     * Get anne
     *
     * @return \TT\platformBundle\Entity\anneCompet
     */
    public function getAnne()
    {
        return $this->anne;
    }
    
    public function __toString(){
        // to show the name of the Category in the select
        //return $this->name;
        // to show the id of the Category in the select
         return (string) $this->id;
    }
    
}
