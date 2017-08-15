<?php

namespace Home\PageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Box
 *
 * @ORM\Table(name="box")
 * @ORM\Entity(repositoryClass="Home\PageBundle\Repository\BoxRepository")
 */
class Box
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
     * @ORM\Column(name="height", type="string", length=255)
     */
    private $height;

    /**
     * @var string
     *
     * @ORM\Column(name="width", type="string", length=255)
     */
    private $width;

    /**
     * @var string
     *
     * @ORM\Column(name="lenght", type="string", length=255)
     */
    private $lenght;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set height
     *
     * @param string $height
     *
     * @return Box
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set width
     *
     * @param string $width
     *
     * @return Box
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set lenght
     *
     * @param string $lenght
     *
     * @return Box
     */
    public function setLenght($lenght)
    {
        $this->lenght = $lenght;

        return $this;
    }

    /**
     * Get lenght
     *
     * @return string
     */
    public function getLenght()
    {
        return $this->lenght;
    }
}
