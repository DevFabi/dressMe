<?php

namespace DressmeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Encaissement
 *
 * @ORM\Table(name="encaissement")
 * @ORM\Entity(repositoryClass="DressmeBundle\Repository\EncaissementRepository")
 */
class Encaissement
{   
    public function __construct()
  {

        $this->modepayement = new ArrayCollection();
        $this->client = new ArrayCollection();
        $this->prestation = new ArrayCollection();
        $this->date = new \Datetime();
  }

    /**
     * @ORM\ManyToMany(targetEntity="DressmeBundle\Entity\ModePayement", cascade={"persist"})
     */
    private $modePayement;
    /**
     * @ORM\ManyToMany(targetEntity="DressmeBundle\Entity\Prestation", cascade={"persist"})
     */
    private $prestation;

    /**
     * @ORM\ManyToMany(targetEntity="DressmeBundle\Entity\Client", cascade={"persist"})
     */
    private $client;

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
     * @ORM\Column(name="date", type="date")
     */
    private $date;


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
     * Add modePayement
     *
     * @param \DressmeBundle\Entity\ModePayement $modePayement
     *
     * @return Encaissement
     */
    public function addModePayement(\DressmeBundle\Entity\ModePayement $modePayement)
    {
        $this->modePayement[] = $modePayement;

        return $this;
    }

    /**
     * Remove modePayement
     *
     * @param \DressmeBundle\Entity\ModePayement $modePayement
     */
    public function removeModePayement(\DressmeBundle\Entity\ModePayement $modePayement)
    {
        $this->modePayement->removeElement($modePayement);
    }

    /**
     * Get modePayement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModePayement()
    {
        return $this->modePayement;
    }

    /**
     * Add prestation
     *
     * @param \DressmeBundle\Entity\Prestation $prestation
     *
     * @return Encaissement
     */
    public function addPrestation(\DressmeBundle\Entity\Prestation $prestation)
    {
        $this->prestation[] = $prestation;

        return $this;
    }

    /**
     * Remove prestation
     *
     * @param \DressmeBundle\Entity\Prestation $prestation
     */
    public function removePrestation(\DressmeBundle\Entity\Prestation $prestation)
    {
        $this->prestation->removeElement($prestation);
    }

    /**
     * Get prestation
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrestation()
    {
        return $this->prestation;
    }

    /**
     * Add client
     *
     * @param \DressmeBundle\Entity\Client $client
     *
     * @return Encaissement
     */
    public function addClient(\DressmeBundle\Entity\Client $client)
    {
        $this->client[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param \DressmeBundle\Entity\Client $client
     */
    public function removeClient(\DressmeBundle\Entity\Client $client)
    {
        $this->client->removeElement($client);
    }

    /**
     * Get client
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Encaissement
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
}
