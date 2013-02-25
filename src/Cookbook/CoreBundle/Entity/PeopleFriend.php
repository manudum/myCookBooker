<?php

namespace Cookbook\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cookbook\CoreBundle\Entity\PeopleFriend
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PeopleFriend
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
     * @ORM\ManyToOne(targetEntity="People", inversedBy="peoplefriends")
     * @ORM\JoinColumn(name="people_id", referencedColumnName="id")
     */
    protected $people;
    
    /**
     * @ORM\ManyToOne(targetEntity="People", inversedBy="peoplefriends")
     * @ORM\JoinColumn(name="friend_id", referencedColumnName="id")
     */
    protected $friend;
    
    
    /**
     * @ORM\OneToMany(targetEntity="People", mappedBy="peoplefriend")
     */
    protected $friends;
    
    
    public function __construct()
    {
        
        //$this->$friends = new ArrayCollection();
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
     * Set friend
     *
     * @param Cookbook\CoreBundle\Entity\People $friend
     */
    public function setFriend(\Cookbook\CoreBundle\Entity\People $friend)
    {
        $this->friend = $friend;
    }

    /**
     * Get friend
     *
     * @return Cookbook\CoreBundle\Entity\People 
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * Add friends
     *
     * @param Cookbook\CoreBundle\Entity\People $friends
     */
    public function addPeople(\Cookbook\CoreBundle\Entity\People $friends)
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
     * @param Cookbook\CoreBundle\Entity\People $friends
     * @return PeopleFriend
     */
    public function addFriend(\Cookbook\CoreBundle\Entity\People $friends)
    {
        $this->friends[] = $friends;
    
        return $this;
    }

    /**
     * Remove friends
     *
     * @param Cookbook\CoreBundle\Entity\People $friends
     */
    public function removeFriend(\Cookbook\CoreBundle\Entity\People $friends)
    {
        $this->friends->removeElement($friends);
    }
}