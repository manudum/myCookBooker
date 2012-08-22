<?php

namespace Cookbook\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Cookbook\CoreBundle\Entity\Wine
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Wine
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
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;
    
    /**
     * @var string $year
     *
     * @ORM\Column(name="year", type="string", length=255)
     */
    private $year;

    /**
     * @ORM\ManyToMany(targetEntity="Recipe", inversedBy="ingredients")
     * @ORM\JoinTable(name="recipe_wines")
     * @ORM\OrderBy({"name" = "ASC"})
     */
    protected $recipes;
    

    public function __construct() {
        $this->$recipes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set year
     *
     * @param string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * Get year
     *
     * @return string 
     */
    public function getYear()
    {
        return $this->year;
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
}