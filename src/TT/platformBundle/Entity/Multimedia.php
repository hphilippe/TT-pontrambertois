<?php

namespace TT\platformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Multimedia
 *
 * @ORM\Table(name="multimedia")
 * @ORM\Entity(repositoryClass="TT\platformBundle\Repository\MultimediaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Multimedia
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
     * @var \DateTime
     * 
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updateAt;
    
    /**
     * @ORM\PostLoad()
     */
    public function postLoad()
    {
        $this->updateAt = new \DateTime();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    public $path;
    
    public $file;
    
    public function getUploadRootDir()
    {
        return __dir__.'/../../../../web/uploads';
    }
    
    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }
    
    public function getAssetPath()
    {
        return'uploads/'.$this->path;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
        $this->oldFile = $this->getPath();
        $this->updateAt = new \DateTime();
        
        if(null !== $this->file)
        {
            $this->path = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
        }
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if(null !== $this->file)
        {
            $this->file->move($this->getUploadRootDir(),$this->path);
            unset($this->file);
            
            if($this->oldFile != null) unlink($this->tempFile);
        }
    }
    
    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFile = $this->getAbsolutePath();
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function RemoveUpload()
    {
        if(file_exists($this->tempFile)) unlink ($this->tempFile);
    }

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
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Multimedia
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    
    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}

