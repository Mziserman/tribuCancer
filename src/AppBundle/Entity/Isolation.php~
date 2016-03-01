<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Isolation
 *
 * @ORM\Table(name="Isolation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IsolationRepository")
 */
class Isolation
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Article", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer", length=11)
     */
    private $ordre;

    /**
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     * @return Isolation
     */
    public function setArticle(\AppBundle\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set ordre
     *
     * @param integer $ordre
     * @return Isolation
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * Get ordre
     *
     * @return integer
     */
    public function getOrdre()
    {
        return $this->ordre;
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
}
