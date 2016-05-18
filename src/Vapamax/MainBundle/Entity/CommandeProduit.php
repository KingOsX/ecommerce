<?php

namespace Vapamax\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandeProduit
 *
 * @ORM\Table(name="commande_produit")
 * @ORM\Entity(repositoryClass="Vapamax\MainBundle\Repository\CommandeProduitRepository")
 */
class CommandeProduit
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
     * @var Vapamax\MainBundle\Entity\Commande
     *
     * @ORM\ManyToOne(targetEntity="Vapamax\MainBundle\Entity\Commande")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @var Vapamax\MainBundle\Entity\Produit
     *
     * @ORM\ManyToOne(targetEntity="Vapamax\MainBundle\Entity\Produit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var int
     *
     * @ORM\Column(name="reference", type="string")
     */
    private $reference;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_valid", type="boolean", options={"default":0})
     */
    private $isValid;




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
     * Set quantite
     *
     * @param integer $quantite
     * @return CommandeProduit
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return CommandeProduit
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set commande
     *
     * @param \Vapamax\MainBundle\Entity\Commande $commande
     * @return CommandeProduit
     */
    public function setCommande(\Vapamax\MainBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;


        return $this;
    }

    /**
     * Get commande
     *
     * @return \Vapamax\MainBundle\Entity\Commande 
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set produit
     *
     * @param \Vapamax\MainBundle\Entity\Produit $produit
     * @return CommandeProduit
     */
    public function setProduit(\Vapamax\MainBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;


        return $this;
    }

    /**
     * Get produit
     *
     * @return \Vapamax\MainBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set isValid
     *
     * @param boolean $isValid
     * @return CommandeProduit
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * Get isValid
     *
     * @return boolean 
     */
    public function getIsValid()
    {
        return $this->isValid;
    }
}
