<?php

namespace Cookbook\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Cookbook\CoreBundle\Entity\CategoryRecipe
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CategoryRecipe
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     *
     * @ORM\Column(name="showorder", type="integer", nullable=true)
     */
    protected $showorder;

    /**
     * @ORM\OneToMany(targetEntity="Recipe", mappedBy="category")
     */
    protected $recipes;
    
    /**
     * @ORM\ManyToOne(targetEntity="People", inversedBy="categoryrecipes")
     * @ORM\JoinColumn(name="people_id", referencedColumnName="id")
     */
    protected $people;
    
    
    public function __construct()
    {
        $this->recipes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->name;
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
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Add recipes
     *
     * @param Cookbook\CoreBundle\Entity\Recipe $recipes
     */
    public function addRecipe(\Cookbook\CoreBundle\Entity\Recipe $recipes)
    {
        $this->recipes[] = $recipes;
    }

    /**
     * Get recipes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getRecipes()
    {
        return $this->recipes;
    }

    /**
     * Set people
     *
     * @param Cookbook\CoreBundle\Entity\People $people
     */
    public function setPeople(\Cookbook\CoreBundle\Entity\People $people)
    {
        $this->people = $people;
    }

    /**
     * Get people
     *
     * @return Cookbook\CoreBundle\Entity\People 
     */
    public function getPeople()
    {
        return $this->people;
    }

    /**
     * Set order
     *
     * @param integer $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * Get order
     *
     * @return integer 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set showorder
     *
     * @param integer $showorder
     */
    public function setShoworder($showorder)
    {
        $this->showorder = $showorder;
    }

    /**
     * Get showorder
     *
     * @return integer 
     */
    public function getShoworder()
    {
        return $this->showorder;
    }
}