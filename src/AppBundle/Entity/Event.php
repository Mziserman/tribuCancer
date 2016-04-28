<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Pdf;
/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 * @Vich\Uploadable
 */
class Event
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="short_desc", type="string", length=255)
     */
    private $shortDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $thumbnail;

    /**
     *
     * @Vich\UploadableField(mapping="images_event", fileNameProperty="thumbnail")
     * @var File
     */
    private $thumbnailFile;

    /**
     * @var int
     * @Assert\Range(
     *      min = 1,
     *      minMessage = "Vous ne pouvez pas placer en place 0 ou moins",
     * )
     *
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255)
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="inscription", type="boolean")
     */
    private $inscription;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image1;

    /**
     * @Vich\UploadableField(mapping="images_event", fileNameProperty="image1")
     * @var File
     */
    private $imageFile1;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image2;

    /**
     * @Vich\UploadableField(mapping="images_event", fileNameProperty="image2")
     * @var File
     */
    private $imageFile2;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image3;

    /**
     * @Vich\UploadableField(mapping="images_event", fileNameProperty="image3")
     * @var File
     */
    private $imageFile3;

    /**
     * @var string
     *
     * @ORM\Column(name="flickr", type="string", length=255, nullable=true)
     */
    private $flickr;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube", type="string", length=255, nullable=true)
     */
    private $youtube;

    /**
     * @ORM\OneToMany(targetEntity="Pdf", mappedBy="event", cascade={"persist", "remove"})
     */
    private $pdf;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __construct() {
        $this->pdf = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set shortDesc
     *
     * @param string $shortDesc
     * @return Event
     */
    public function setShortDesc($shortDesc)
    {
        $this->shortDesc = $shortDesc;

        return $this;
    }

    /**
     * Get shortDesc
     *
     * @return string 
     */
    public function getShortDesc()
    {
        return $this->shortDesc;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Event
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    public function setThumbnailFile(File $image = null)
    {
        $this->thumbnailFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getThumbnailFile()
    {
        return $this->thumbnailFile;
    }

    public function setThumbnail($image)
    {
        $this->thumbnail = $image;
    }

    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set date
     *
     * @param string $date
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set inscription
     *
     * @param boolean $inscription
     * @return Event
     */
    public function setInscription($inscription)
    {
        $this->inscription = $inscription;

        return $this;
    }

    /**
     * Get inscription
     *
     * @return boolean 
     */
    public function getInscription()
    {
        return $this->inscription;
    }


    public function setImageFile1(File $image = null)
    {
        $this->imageFile1 = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile1()
    {
        return $this->imageFile1;
    }

    public function setImage1($image)
    {
        $this->image1 = $image;
    }

    public function getImage1()
    {
        return $this->image1;
    }

    public function setImageFile2(File $image = null)
    {
        $this->imageFile2 = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile2()
    {
        return $this->imageFile2;
    }

    public function setImage2($image)
    {
        $this->image2 = $image;
    }

    public function getImage2()
    {
        return $this->image2;
    }

    public function setImageFile3(File $image = null)
    {
        $this->imageFile3 = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile3()
    {
        return $this->imageFile3;
    }

    public function setImage3($image)
    {
        $this->image3 = $image;
    }

    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * Set flickr
     *
     * @param string $flickr
     * @return Event
     */
    public function setFlickr($flickr)
    {
        $this->flickr = $flickr;

        return $this;
    }

    /**
     * Get flickr
     *
     * @return string 
     */
    public function getFlickr()
    {
        return $this->flickr;
    }

    /**
     * Set youtube
     *
     * @param string $youtube
     * @return Event
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;

        return $this;
    }

    /**
     * Get youtube
     *
     * @return string 
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Event
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    public function getPdf()
    {
        return $this->pdf->toArray();
    }

    public function addPdf(Pdf $pdf)
    {
        $this->pdf->add($pdf);
        $pdf->setEvent($this);
        return $this;
    }

    public function removePdf(Pdf $pdf)
    {
        $this->pdf->removeElement($pdf);
        return $this;
    } 

    public function getClass()
    {
        return 'event';
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Event
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
