<?php

namespace Vapamax\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vapamax\MainBundle\VapamaxMainBundle;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="Vapamax\MainBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @var Vapamax\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Vapamax\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Vapamax\MainBundle\Entity\Adresse")
     * @ORM\JoinColumn (name="adresseLivraison_id",referencedColumnName="id",onDelete="CASCADE")
     */
    private $adresseLivraison;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commandeProduits = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Commande
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

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
     * Set user
     *
     * @param \Vapamax\UserBundle\Entity\User $user
     * @return Commande
     */
    public function setUser(\Vapamax\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Vapamax\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }



    /**
     * Set adresseLivraison
     *
     * @param \Vapamax\MainBundle\Entity\Adresse $adresseLivraison
     * @return Commande
     */
    public function setAdresseLivraison(\Vapamax\MainBundle\Entity\Adresse $adresseLivraison = null)
    {
        $this->adresseLivraison = $adresseLivraison;

        return $this;
    }

    /**
     * Get adresseLivraison
     *
     * @return \Vapamax\MainBundle\Entity\Adresse
     */
    public function getAdresseLivraison()
    {
        return $this->adresseLivraison;
    }
}
