<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Article;
use AppBundle\Entity\Archive;
use AppBundle\Entity\Event;
use AppBundle\Entity\Service;
use AppBundle\Entity\Association;

/**
 * Pdf
 *
 * @ORM\Table(name="pdf")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PdfRepository")
 * @Vich\Uploadable
 */
class Pdf
{

    /**
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="pdf", cascade={"persist"})
     * @ORM\JoinColumn ( name="article_id", referencedColumnName="id")
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="Archive", inversedBy="pdf", cascade={"persist"})
     * @ORM\JoinColumn ( name="archive_id", referencedColumnName="id")
     */
    private $archive;

    /**
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="pdf", cascade={"persist"})
     * @ORM\JoinColumn ( name="service_id", referencedColumnName="id")
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="pdf", cascade={"persist"})
     * @ORM\JoinColumn ( name="event_id", referencedColumnName="id")
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="Association", inversedBy="pdf", cascade={"persist"})
     * @ORM\JoinColumn ( name="association_id", referencedColumnName="id")
     */
    private $association;

    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $file;

    /**
     * @Vich\UploadableField(mapping="pdf_files", fileNameProperty="file")
     * @var File
     */
    private $pdfFile;

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
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;

    /**
     * @var string
     * @Assert\Range(
     *      min = 1,
     *      minMessage = "Vous ne pouvez pas placer en place 0 ou moins",
     * )
     *
     *
     * @ORM\Column(name="position", type="string", length=255)
     */
    private $position;


    public function setPdfFile(File $file = null)
    {
        $this->pdfFile = $file;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($file) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getPdfFile()
    {
        return $this->pdfFile;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
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
     * @return file
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
     * Set color
     *
     * @param string $color
     * @return file
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return File
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    public function setArticle(Article $article)
    {
        
        $this->article = $article;

        return $this;
    }

    public function getArticle(Article $article)
    {
        return $this->article;
    }

    public function setArchive(Archive $archive)
    {
        
        $this->archive = $archive;

        return $this;
    }

    public function getArchive(Archive $archive)
    {
        return $this->archive;
    }

    public function setService(Service $service)
    {
        
        $this->service = $service;

        return $this;
    }

    public function getService(Service $service)
    {
        return $this->service;
    }

    public function setEvent(Event $event)
    {
        
        $this->event = $event;

        return $this;
    }

    public function getEvent(Event $event)
    {
        return $this->event;
    }

    public function setAssociation(Association $association)
    {
        
        $this->association = $association;

        return $this;
    }

    public function getAssociation(Association $association)
    {
        return $this->association;
    }

    public function getClass()
    {
        return 'pdfFile';
    }
}
