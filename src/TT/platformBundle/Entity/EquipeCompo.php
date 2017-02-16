<?php

namespace TT\platformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EquipeCompo
 * @ORM\Table(name="equipe_compet")
 * @ORM\Entity(repositoryClass="TT\platformBundle\Repository\EquipeCompoRepository")
 */
class EquipeCompo
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
     * @var string
     * 
     * @ORM\Column(name="nomEquipe", type="string", length=255)
     */
    private $nomEquipe;
    
    /**
     * @ORM\ManyToOne(targetEntity="TT\platformBundle\Entity\anneCompet", cascade={"remove"})
     * @ORM\JoinColumn(name="anne_id", referencedColumnName="id", nullable=true)
     */
    private $anne;


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
     * Set nomEquipe
     *
     * @param string $nomEquipe
     *
     * @return EquipeCompo
     */
    public function setNomEquipe($nomEquipe)
    {
        $this->nomEquipe = $nomEquipe;

        return $this;
    }

    /**
     * Get nomEquipe
     *
     * @return string
     */
    public function getNomEquipe()
    {
        return $this->nomEquipe;
    }

    /**
     * Set anne
     *
     * @param \TT\platformBundle\Entity\anneCompet $anne
     *
     * @return EquipeCompo
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
}
