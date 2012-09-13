<?php

namespace Cookbook\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Cookbook\CoreBundle\Entity\PostItRecipe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Cookbook\CoreBundle\Entity\PostItRecipeRepository")
 */
class PostItRecipe
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;
    
    /**
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    protected $comment;

    /**
     * @ORM\ManyToOne(targetEntity="Recipe", inversedBy="postits")
     * @ORM\JoinColumn(name="postit_id", referencedColumnName="id")
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
}