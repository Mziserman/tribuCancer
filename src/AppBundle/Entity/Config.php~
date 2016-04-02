<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="config")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConfigRepository")
 */
class Config
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
     * @var int
     *
     * @ORM\Column(name="Isolation", type="integer")
     */
    private $isolation;

    /**
     * @var int
     *
     * @ORM\Column(name="Escape", type="integer")
     */
    private $escape;

    /**
     * @var string
     *
     * @ORM\Column(name="Currently", type="integer")
     */
    private $currently;


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
     * Set isolation
     *
     * @param integer $isolation
     * @return Config
     */
    public function setIsolation($isolation)
    {
        $this->isolation = $isolation;

        return $this;
    }

    /**
     * Get isolation
     *
     * @return integer 
     */
    public function getIsolation()
    {
        return $this->isolation;
    }

    /**
     * Set escape
     *
     * @param integer $escape
     * @return Config
     */
    public function setEscape($escape)
    {
        $this->escape = $escape;

        return $this;
    }

    /**
     * Get escape
     *
     * @return integer 
     */
    public function getEscape()
    {
        return $this->escape;
    }

    /**
     * Set currently
     *
     * @param string $currently
     * @return Config
     */
    public function setCurrently($currently)
    {
        $this->currently = $currently;

        return $this;
    }

    /**
     * Get currently
     *
     * @return string 
     */
    public function getCurrently()
    {
        return $this->currently;
    }
}
