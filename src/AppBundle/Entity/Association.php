<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Pdf;

/**
 * Association
 *
 * @ORM\Table(name="association")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AssociationRepository")
 * @Vich\Uploadable
 */
class Association
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\OneToMany(targetEntity="Pdf", mappedBy="association", cascade={"persist", "remove"})
     */
    private $pdf;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __construct() {
        $this->pdf = new ArrayCollection();
    }

    public function getPdf()
    {
        return $this->pdf->toArray();
    }

    public function addPdf(Pdf $pdf)
    {
        $this->pdf->add($pdf);
        $pdf->setAssociation($this);
        return $this;
    }

    public function removePdf(Pdf $pdf)
    {
        $this->pdf->removeElement($pdf);
        return $this;
    } 

    public function getClass()
    {
        return 'association';
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Association
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
