<?php

namespace Vapamax\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eliquide
 *
 * @ORM\Table(name="eliquide")
 * @ORM\Entity(repositoryClass="Vapamax\MainBundle\Repository\EliquideRepository")
 */
class Eliquide extends Produit
{
//    /**
//     * @var int
//     *
//     * @ORM\Column(name="id", type="integer")
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="AUTO")
//     */
//    private $id;

    /**
     * @var Nicotine
     *
     * @ORM\ManyToMany(targetEntity="Vapamax\MainBundle\Entity\Nicotine")
     */
    private $nicotine;


    /**
     * Get id
     *
     * @return integer 
     */
//    public function getId()
//    {
//        return $this->id;
//    }

    /**
     * Add nicotine
     *
     * @param \Vapamax\MainBundle\Entity\Nicotine $nicotine
     * @return Eliquide
     */
    public function addNicotine(\Vapamax\MainBundle\Entity\Nicotine $nicotine)
    {
        $this->nicotine[] = $nicotine;

        return $this;
    }

    /**
     * Remove nicotine
     *
     * @param \Vapamax\MainBundle\Entity\Nicotine $nicotine
     */
    public function removeNicotine(\Vapamax\MainBundle\Entity\Nicotine $nicotine)
    {
        $this->nicotine->removeElement($nicotine);
    }

    /**
     * Get nicotine
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNicotine()
    {
        return $this->nicotine;
    }
}
