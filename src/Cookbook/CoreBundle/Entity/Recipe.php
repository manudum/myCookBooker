<?php

namespace Cookbook\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM; 
use Symfony\Component\Validator\Constraints as Assert;   

/**
 * Cookbook\CoreBundle\Entity\Recipe
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
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
     * @var string $image
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;
    
    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;
    
    /**
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    protected $comment;

    /**
     * @ORM\ManyToOne(targetEntity="People", inversedBy="recipes")
     * @ORM\JoinColumn(name="people_id", referencedColumnName="id")
     */
    protected $people;
    
    /**
     * @ORM\ManyToOne(targetEntity="CategoryRecipe", inversedBy="recipes")
     * @ORM\JoinColumn(name="categoryrecipe_id", referencedColumnName="id")
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
    
    /**
     * @ORM\OneToMany(targetEntity="Ingredient", mappedBy="recipe")
     */
    protected $ingredients;
    
    /**
     * @ORM\ManyToMany(targetEntity="Wine", mappedBy="recipes")
     */
    protected $wines;
    
    /**
     *
     * @ORM\Column(name="preparetime", type="integer", nullable=true)
     */
    protected $preparetime;
    
    /**
     *
     * @ORM\Column(name="cooktime", type="integer", nullable=true)
     */
    protected $cooktime;
    
    /**
     *
     * @ORM\Column(name="servings", type="integer", nullable=true)
     */
    protected $servings;
    
    /**
     *
     * @ORM\Column(name="difficulty", type="integer", nullable=true)
     */
    protected $difficulty;

    public function __construct() {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ingredients = new \Doctrine\Common\Collections\ArrayCollection();
        $this->wines = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->name;
    }
    
    public function __toArray()
    {
       return array('id'=>$this->getId(),'name' => $this->getName());
    }
    
    public function serialize()
    {
       return serialize(array('id'=>$this->getId(),'name' => $this->getName()));
    }
 
    public function unserialize($data)
    {
         list(
           $this->id,
           $this->name,
       ) = unserialize($data);
    }
    
    
    public function getFullImagePath() {
        return null === $this->image ? null : $this->getUploadRootDir(). $this->image;
    }
 
    protected function getUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return $this->getTmpUploadRootDir().$this->getId()."/picture/";
    }
 
    protected function getTmpUploadRootDir() {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/uploads/recipies/';
    }
 
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function uploadImage() {
        // the file property can be empty if the field is not required
        if (null === $this->image || $this->image == "" || (!is_object($this->image))) {
            return;
        }
        if(!$this->id){
            $this->image->move($this->getTmpUploadRootDir(), $this->image->getClientOriginalName());
        }else{
            $this->image->move($this->getUploadRootDir(), $this->image->getClientOriginalName());
        }
        $this->setImage($this->image->getClientOriginalName());
    }
     
    /**
     * @ORM\PostPersist()
     */
    public function moveImage()
    {
        if (null === $this->image) {
            return;
        }
        if(!is_dir($this->getUploadRootDir())){
            mkdir($this->getUploadRootDir());
        }
        copy($this->getTmpUploadRootDir().$this->image, $this->getFullImagePath());
        unlink($this->getTmpUploadRootDir().$this->image);
    }
 
    /**
     * @ORM\PreRemove()
     */
    public function removeImage()
    {
        unlink($this->getFullImagePath());
        rmdir($this->getUploadRootDir());
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
     * Set id
     *
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id     ;
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
     * Set image
     *
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
 
    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
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

    /**
     * Set comment
     *
     * @param text $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return text 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Add ingredients
     *
     * @param Cookbook\CoreBundle\Entity\Ingredient $ingredients
     */
    public function addIngredient(\Cookbook\CoreBundle\Entity\Ingredient $ingredients)
    {
        $this->ingredients[] = $ingredients;
    }

    /**
     * Get ingredients
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Add wines
     *
     * @param Cookbook\CoreBundle\Entity\Wine $wines
     */
    public function addWine(\Cookbook\CoreBundle\Entity\Wine $wines)
    {
        $this->wines[] = $wines;
    }

    /**
     * Get wines
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getWines()
    {
        return $this->wines;
    }

    /**
     * Set preparetime
     *
     * @param integer $preparetime
     */
    public function setPreparetime($preparetime)
    {
        $this->preparetime = $preparetime;
    }

    /**
     * Get preparetime
     *
     * @return integer 
     */
    public function getPreparetime()
    {
        return $this->preparetime;
    }

    /**
     * Set cooktime
     *
     * @param integer $cooktime
     */
    public function setCooktime($cooktime)
    {
        $this->cooktime = $cooktime;
    }

    /**
     * Get cooktime
     *
     * @return integer 
     */
    public function getCooktime()
    {
        return $this->cooktime;
    }

    /**
     * Set servings
     *
     * @param integer $servings
     */
    public function setServings($servings)
    {
        $this->servings = $servings;
    }

    /**
     * Get servings
     *
     * @return integer 
     */
    public function getServings()
    {
        return $this->servings;
    }

    /**
     * Set difficulty
     *
     * @param integer $difficulty
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * Get difficulty
     *
     * @return integer 
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }
}