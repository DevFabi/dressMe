<?php

namespace DressmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prestation
 *
 * @ORM\Table(name="prestation")
 * @ORM\Entity(repositoryClass="DressmeBundle\Repository\PrestationRepository")
 */
class Prestation
{

    /**
     * @ORM\ManyToOne(targetEntity="DressmeBundle\Entity\Categorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;
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
     * @ORM\Column(name="Libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="Prix", type="integer")
     */
    private $prix;

public function __toString() {
    return $this->libelle;
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Prestation
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Prestation
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set categorie
     *
     * @param \DressmeBundle\Entity\Categorie $categorie
     *
     * @return Prestation
     */
    public function setCategorie(\DressmeBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \DressmeBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
