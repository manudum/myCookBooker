<?php

namespace Cookbook\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Cookbook\CoreBundle\Entity\People
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cookbook\CoreBundle\Entity\PeopleRepository")
 */
class People implements UserInterface, \Serializable
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string $username
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;
    
    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    
    /**
     * @var string $salt
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;
    
    
    private $roles;
    
   

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $gender
     *
     * @ORM\Column(name="gender", type="string", length=1)
     */
    private $gender;
    
    /**
     * @ORM\OneToMany(targetEntity="Recipe", mappedBy="people")
     * @ORM\OrderBy({"name" = "ASC"})
     */
    protected $recipes;

    /**
     * @ORM\OneToMany(targetEntity="Friend", mappedBy="people")
     * @ORM\OrderBy({"name" = "ASC"})
     */
    protected $friends;
    
    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="people")
     * @ORM\OrderBy({"date" = "DESC"})
     */
    protected $events;
   
    
    
    public function __construct()
    {
        $this->$recipes = new ArrayCollection();
        $this->$friends = new ArrayCollection();
        $this->$events = new ArrayCollection();
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
     * Set gender
     *
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
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
     * Add friends
     *
     * @param Cookbook\CoreBundle\Entity\PeopleFriend $friends
     */
    public function addPeopleFriend(\Cookbook\CoreBundle\Entity\PeopleFriend $friends)
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
     * Add friends
     *
     * @param Cookbook\CoreBundle\Entity\Friend $friends
     */
    public function addFriend(\Cookbook\CoreBundle\Entity\Friend $friends)
    {
        $this->friends[] = $friends;
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
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @inheritDoc
     */
    public function equals(UserInterface $user)
    {
        return $this->username === $user->getUsername();
    }

    /**
     * Set username
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }
    
     public function serialize()
    {
       return serialize(array($this->getId(),$this->getUsername(),$this->getName()));
    }
 
    public function unserialize($data)
    {
         list(
           $this->id,
           $this->username,
           $this->name,
       ) = unserialize($data);
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
     * Remove events
     *
     * @param Cookbook\CoreBundle\Entity\Event $events
     */
    public function removeEvent(\Cookbook\CoreBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }
}