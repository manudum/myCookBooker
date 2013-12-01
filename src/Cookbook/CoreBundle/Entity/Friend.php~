<?php

namespace Cookbook\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cookbook\CoreBundle\Entity\Event;

/**
 * Cookbook\CoreBundle\Entity\Friend
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Friend
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
     * @ORM\ManyToOne(targetEntity="People", inversedBy="friends")
     * @ORM\JoinColumn(name="people_id", referencedColumnName="id")
     */
    protected $people;
    
     /**
     * @ORM\ManyToMany(targetEntity="Event", mappedBy="friends")
     */
    private $events;

    public function __construct() {
        $this->events = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->name;
    }
    
    public function __toArray()
    {
       return array('id'=>$this->getId(),'name' => $this->getName());
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
     * Remove events
     *
     * @param Cookbook\CoreBundle\Entity\Event $events
     */
    public function removeEvent(\Cookbook\CoreBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }
}