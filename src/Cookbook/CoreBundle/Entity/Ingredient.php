<?php

namespace Cookbook\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Cookbook\CoreBundle\Entity\Ingredient
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cookbook\CoreBundle\Entity\IngredientRepository")
 */
class Ingredient
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
     * @ORM\ManyToOne(targetEntity="Aliment")
     * @ORM\JoinColumn(name="aliment_id", referencedColumnName="id", nullable=true)
     */
    protected $aliment; 
    
    /**
     *
     * @ORM\Column(name="quantity", type="decimal", scale=3, nullable=true)
     */
    protected $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="Unit")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id", nullable=true)
     */
    protected $unit; 
    
    /**
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="ingredients")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     */
    protected $recipe;
    

    public function __construct() {
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
     * Set recipe
     *
     * @param Cookbook\CoreBundle\Entity\Recipe $recipe
     */
    public function setRecipe(\Cookbook\CoreBundle\Entity\Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    /**
     * Get recipe
     *
     * @return Cookbook\CoreBundle\Entity\Recipe 
     */
    public function getRecipe()
    {
        return $this->recipe;
    }

    /**
     * Set quantity
     *
     * @param float $quantity
     * @return Ingredient
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return float 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set aliment
     *
     * @param Cookbook\CoreBundle\Entity\Aliment $aliment
     * @return Ingredient
     */
    public function setAliment(\Cookbook\CoreBundle\Entity\Aliment $aliment = null)
    {
        $this->aliment = $aliment;
    
        return $this;
    }

    /**
     * Get aliment
     *
     * @return Cookbook\CoreBundle\Entity\Aliment 
     */
    public function getAliment()
    {
        return $this->aliment;
    }

    /**
     * Set unit
     *
     * @param Cookbook\CoreBundle\Entity\Unit $unit
     * @return Ingredient
     */
    public function setUnit(\Cookbook\CoreBundle\Entity\Unit $unit = null)
    {
        $this->unit = $unit;
    
        return $this;
    }

    /**
     * Get unit
     *
     * @return Cookbook\CoreBundle\Entity\Unit 
     */
    public function getUnit()
    {
        return $this->unit;
    }
}