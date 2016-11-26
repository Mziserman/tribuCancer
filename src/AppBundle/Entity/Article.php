<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Pdf;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 * @Vich\Uploadable
 */
class Article
{

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="images_article", fileNameProperty="image")
     * @var File
     */
    private $imageFile;
    
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

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
     * @ORM\OneToMany(targetEntity="Pdf", mappedBy="article", cascade={"persist", "remove"})
     */
    private $pdf;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;    

    public function __construct() {
        $this->pdf = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Article
     */
    public function setContent($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->body;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Article
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

    /**
     * Set body
     *
     * @param string $body
     * @return Article
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


    public function getPdf()
    {
        return $this->pdf->toArray();
    }

    public function addPdf(Pdf $pdf)
    {
        $this->pdf->add($pdf);
        $pdf->setArticle($this);
        return $this;
    }

    public function removePdf(Pdf $pdf)
    {
        $this->pdf->removeElement($pdf);
        return $this;
    }

    public function getClass()
    {
        return 'article';
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Article
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

    

// PICTURES IN PAGE

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image1;

    /**
     * @Vich\UploadableField(mapping="images_article", fileNameProperty="image1")
     * @var File
     */
    private $imageFile1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image2;

    /**
     * @Vich\UploadableField(mapping="images_article", fileNameProperty="image2")
     * @var File
     */
    private $imageFile2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image3;

    /**
     * @Vich\UploadableField(mapping="images_article", fileNameProperty="image3")
     * @var File
     */
    private $imageFile3;



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

    
}

