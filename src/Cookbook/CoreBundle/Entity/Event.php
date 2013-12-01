<?php

namespace Cookbook\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Cookbook\CoreBundle\Entity\Event
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Event
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
     * @var date $date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="People", inversedBy="events")
     * @ORM\JoinColumn(name="people_id", referencedColumnName="id")
     */
    protected $people;
    
    /**
     * @ORM\ManyToMany(targetEntity="Friend", inversedBy="events")
     * @ORM\JoinTable(name="event_friends")
     * @ORM\OrderBy({"name" = "ASC"})
     */
    
    private $friends;
    
    /**
     * @ORM\ManyToMany(targetEntity="Recipe", inversedBy="events")
     * @ORM\JoinTable(name="event_recipes")
     * @ORM\OrderBy({"name" = "ASC"})
     */
    
    private $recipes;

    public function __construct() {
        $this->friends = new \Doctrine\Common\Collections\ArrayCollection();
        $this->recipes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set date
     *
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return date 
     */
    public function getDate()
    {
        return $this->date;
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
     * Add friends
     *
     * @param Cookbook\CoreBundle\Entity\Friend $friends
     */
    public function addFriend(\Cookbook\CoreBundle\Entity\Friend $friends)
    {
        $this->friends[] = $friends;
    }

    /**
     * Get friends
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFriends()
    {
        return $this->friends;
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
     * Remove friends
     *
     * @param Cookbook\CoreBundle\Entity\Friend $friends
     */
    public function removeFriend(\Cookbook\CoreBundle\Entity\Friend $friends)
    {
        $this->friends->removeElement($friends);
    }

    /**
     * Remove recipes
     *
     * @param Cookbook\CoreBundle\Entity\Recipe $recipes
     */
    public function removeRecipe(\Cookbook\CoreBundle\Entity\Recipe $recipes)
    {
        $this->recipes->removeElement($recipes);
    }
}