<?php

namespace Cookbook\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cookbook\CoreBundle\Entity\Recipe
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Recipe
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
     * @ORM\ManyToOne(targetEntity="People", inversedBy="recipes")
     * @ORM\JoinColumn(name="people_id", referencedColumnName="id")
     */
    protected $people;
    
    /**
     * @ORM\ManyToOne(targetEntity="CategoryRecipe", inversedBy="recipes")
     * @ORM\JoinColumn(name="categoryrecipe_id", referencedColumnName="id", nullable=true)
     */
    protected $category; //entree plat dessert
    
    /**
     * @ORM\ManyToOne(targetEntity="TypeRecipe", inversedBy="recipes")
     * @ORM\JoinColumn(name="typerecipe_id", referencedColumnName="id", nullable=true)
     */
    protected $type; //convivial, rafiné
    
    /**
     * @ORM\ManyToOne(targetEntity="FormatRecipe", inversedBy="recipes")
     * @ORM\JoinColumn(name="formatrecipe_id", referencedColumnName="id", nullable=true)
     */
    protected $format; //individial, familial
    
    /**
     * @ORM\ManyToMany(targetEntity="Event", mappedBy="recipes")
     */
    private $events;

    public function __construct() {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->name;
    }
    
    
    protected $wines;
    
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
     * Set decription
     *
     * @param text $decription
     */
    public function setDecription($decription)
    {
        $this->decription = $decription;
    }

    /**
     * Get decription
     *
     * @return text 
     */
    public function getDecription()
    {
        return $this->decription;
    }

    /**
     * Set category
     *
     * @param Cookbook\CoreBundle\Entity\CategoryRecipe $category
     */
    public function setCategory($category)
    {
        if (is_null($category) )
        {
            $this->category = null;
        } elseif ($category instanceof \Cookbook\CoreBundle\Entity\CategoryRecipe) 
        {
            $this->category = $category;
        } else
        {
            $mess = "setMyRelatedEntity method expects instance of CategoryRecipe as argument 1 !";
            throw new \InvalidArgumentException($mess);
        }
    }

    /**
     * Get category
     *
     * @return Cookbook\CoreBundle\Entity\CategoryRecipe 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set type
     *
     * @param Cookbook\CoreBundle\Entity\TypeRecipe $type
     */
    public function setType($type)
    {
        if (is_null($type) )
        {
            $this->type = null;
        } elseif ($type instanceof \Cookbook\CoreBundle\Entity\TypeRecipe) 
        {
            $this->type = $type;
        } else
        {
            $mess = "setMyRelatedEntity method expects instance of typeRecipe as argument 1 !";
            throw new \InvalidArgumentException($mess);
        }
    }

    /**
     * Get type
     *
     * @return Cookbook\CoreBundle\Entity\TypeRecipe 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set format
     *
     * @param Cookbook\CoreBundle\Entity\FormatRecipe $format
     */
    public function setFormat($format)
    {
        if (is_null($format) )
        {
            $this->format = null;
        } elseif ($format instanceof \Cookbook\CoreBundle\Entity\FormatRecipe) 
        {
            $this->format = $format;
        } else
        {
            $mess = "setMyRelatedEntity method expects instance of typeRecipe as argument 1 !";
            throw new \InvalidArgumentException($mess);
        }
    }

    /**
     * Get format
     *
     * @return Cookbook\CoreBundle\Entity\FormatRecipe 
     */
    public function getFormat()
    {
        return $this->format;
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
     * Add events
     *
     * @param Cookbook\CoreBundle\Entity\Event $events
     */
    public function addEvent(\Cookbook\CoreBundle\Entity\Event $events)
    {
        $this->events[] = $events;
    }

    /**
     * Get events
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }
}