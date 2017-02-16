<?php

namespace TT\platformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * anneCompet
 *
 * @ORM\Table(name="anne_compet")
 * @ORM\Entity(repositoryClass="TT\platformBundle\Repository\anneCompetRepository")
 */
class anneCompet
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
     * @var int
     *
     * @ORM\Column(name="anneeDepart", type="string", length=255)
     */
    private $anneeDepart;

    /**
     * @var int
     *
     * @ORM\Column(name="phase", type="integer")
     */
    private $phase;
    
    /**
     * @var int
     *
     * @ORM\Column(name="numberEquipe", type="integer")
     */
    private $numberEquipe;
    
    /**
     * @var int
     *
     * @ORM\Column(name="visibilite", type="integer")
     */
    private $visibilite;


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
     * Set anneeDepart
     *
     * @param integer $anneeDepart
     *
     * @return anneCompet
     */
    public function setAnneeDepart($anneeDepart)
    {
        $this->anneeDepart = $anneeDepart;

        return $this;
    }

    /**
     * Get anneeDepart
     *
     * @return int
     */
    public function getAnneeDepart()
    {
        return $this->anneeDepart;
    }

    /**
     * Set phase
     *
     * @param integer $phase
     *
     * @return anneCompet
     */
    public function setPhase($phase)
    {
        $this->phase = $phase;

        return $this;
    }

    /**
     * Get phase
     *
     * @return int
     */
    public function getPhase()
    {
        return $this->phase;
    }
    
    public function __toString(){
        // to show the name of the Category in the select
        //return $this->name;
        // to show the id of the Category in the select
         return (string) $this->id;
    }


    /**
     * Set numberEquipe
     *
     * @param integer $numberEquipe
     *
     * @return anneCompet
     */
    public function setNumberEquipe($numberEquipe)
    {
        $this->numberEquipe = $numberEquipe;

        return $this;
    }

    /**
     * Get numberEquipe
     *
     * @return integer
     */
    public function getNumberEquipe()
    {
        return $this->numberEquipe;
    }

    /**
     * Set visibilite
     *
     * @param integer $visibilite
     *
     * @return anneCompet
     */
    public function setVisibilite($visibilite)
    {
        $this->visibilite = $visibilite;

        return $this;
    }

    /**
     * Get visibilite
     *
     * @return integer
     */
    public function getVisibilite()
    {
        return $this->visibilite;
    }
}
