<?php

namespace Acme\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Acme\TestBundle\Entity\CategoryRepository")
 */
class Category
{
    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="title", type="string")
     * @ORM\OneToMany(targetEntity="Post", mappedBy="category")
     *
     */
    protected $title;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="child_categories")
     * @ORM\JoinColumn(name="parent_category_id", referencedColumnName="id")
     */
    protected $parent_category;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent_category")
     */
    protected $child_categories;

    public function __construct()
    {
        $this->child_categories = new \Doctrine\Common\Collections\ArrayCollection;
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
     * @return Category
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
     * Set parent_category
     *
     * @param \Acme\TestBundle\Entity\Category $parentCategory
     * @return Category
     */
    public function setParentCategory(\Acme\TestBundle\Entity\Category $parentCategory = null)
    {
        $this->parent_category = $parentCategory;

        return $this;
    }

    /**
     * Get parent_category
     *
     * @return \Acme\TestBundle\Entity\Category 
     */
    public function getParentCategory()
    {
        return $this->parent_category;
    }

    /**
     * Add child_categories
     *
     * @param \Acme\TestBundle\Entity\Category $childCategories
     * @return Category
     */
    public function addChildCategory(\Acme\TestBundle\Entity\Category $childCategories)
    {
        $this->child_categories[] = $childCategories;

        return $this;
    }

    /**
     * Remove child_categories
     *
     * @param \Acme\TestBundle\Entity\Category $childCategories
     */
    public function removeChildCategory(\Acme\TestBundle\Entity\Category $childCategories)
    {
        $this->child_categories->removeElement($childCategories);
    }

    /**
     * Get child_categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildCategories()
    {
        return $this->child_categories;
    }

    /**
     * Get idCategory
     *
     * @return integer 
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set idCategory
     *
     * @param integer $idCategory
     * @return Category
     */
    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;

        return $this;
    }
}
