<?php

namespace Acme\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tags
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\TestBundle\Entity\TagsRepository")
 */
class Tags
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tag")
     */
    private $tags;

    /**
     * @var string
     * @ORM\Column(name="text_tag", type="string")
     */
    private $textTag;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set textTag
     *
     * @param string $textTag
     * @return Tags
     */
    public function setTextTag($textTag)
    {
        $this->textTag = $textTag;

        return $this;
    }

    /**
     * Get textTag
     *
     * @return string 
     */
    public function getTextTag()
    {
        return $this->textTag;
    }

    /**
     * Add tags
     *
     * @param \Acme\TestBundle\Entity\Post $tags
     * @return Tags
     */
    public function addTag(\Acme\TestBundle\Entity\Post $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Acme\TestBundle\Entity\Post $tags
     */
    public function removeTag(\Acme\TestBundle\Entity\Post $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
}
