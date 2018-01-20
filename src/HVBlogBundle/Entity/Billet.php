<?php

namespace HVBlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Billet
 *
 * @ORM\Table(name="hv_billets")
 * @ORM\Entity(repositoryClass="HVBlogBundle\Repository\BilletRepository")
 * @UniqueEntity(fields="titre",message="Un billet du meme titre existe deja. Changez votre titre.")
 */
class Billet
{
   /**
    *
    * @ORM\OneToOne(targetEntity="HVBlogBundle\Entity\Image",cascade={"persist","remove"})
    *
    */
    private $image;

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
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Ne peut etre vide. Renseignez le champ")
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     * @Assert\DateTime()
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", nullable=false)
     * @Assert\NotBlank(message="Ne peut etre vide. Renseignez le champ")
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @Assert\NotBlank(message="Ne peut etre vide. Renseignez le champ")
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="string", length=255)
     * @Assert\NotBlank(message="Ne peut etre vide. Renseignez le champ")
     */
    private $abstract;

    public function __construct()
    {
      $this->date=new \Datetime();
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Billet
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Billet
     */
    public function setDate($date)
    {
        $this->date = $date;

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
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Billet
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Billet
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     *
     * @return Billet
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set image
     *
     * @param \HVBlogBundle\Entity\Image $image
     *
     * @return Billet
     */
    public function setImage(\HVBlogBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \HVBlogBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
