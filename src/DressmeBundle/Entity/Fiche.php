<?php

namespace DressmeBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fiche
 *
 * @ORM\Table(name="fiche")
 * @ORM\Entity(repositoryClass="DressmeBundle\Repository\FicheRepository")
 */
class Fiche
{

    public function __construct()
  {
        $this->date = new \Datetime();
        $this->client = new ArrayCollection();
  }
  public function __toString() {
    return $this->date;
    return $this->text;
}
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
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Fiche
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
     * Set text
     *
     * @param string $text
     *
     * @return Fiche
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Add client
     *
     * @param \DressmeBundle\Entity\Client $client
     *
     * @return Fiche
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
}
