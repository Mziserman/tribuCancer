<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Pdf;
use Cocur\Slugify\Slugify;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceRepository")
 * @Vich\Uploadable
 */
class Service
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
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;

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
    private $image;

    /**
     * @Vich\UploadableField(mapping="images_service", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=255)
     */
    private $icon;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @Vich\UploadableField(mapping="images_icon", fileNameProperty="icon")
     * @var File
     */
    private $iconFile;

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
     * @ORM\OneToMany(targetEntity="Pdf", mappedBy="service", cascade={"persist", "remove"})
     */
    private $pdf;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __construct() {
        $this->pdf = new ArrayCollection();
        $slugify = new Slugify();

        $this->slug = $slugify->slugify($this->name);
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
     * @return Service
     */
    public function setName($name)
    {
        $this->name = $name;
        $slugify = new Slugify();

        $this->slug = $slugify->slugify($this->name);

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
     * Set link
     *
     * @param string $link
     * @return Service
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set shortDesc
     *
     * @param string $shortDesc
     * @return Service
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
     * @return Service
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

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

     public function setIconFile(File $icon = null)
    {
        $this->iconFile = $icon;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($icon) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getIconFile()
    {
        return $this->iconFile;
    }

    /**
     * Set icon
     *
     * @param string $icon
     * @return Service
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string 
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Service
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
        $pdf->setService($this);
        return $this;
    }

    public function removePdf(Pdf $pdf)
    {
        $this->pdf->removeElement($pdf);
        return $this;
    } 

    public function getClass()
    {
        return 'service';
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Service
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

    /**
     * Set slug
     *
     * @param string $slug
     * @return Service
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
