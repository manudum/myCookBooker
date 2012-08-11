<?php

namespace Cookbook\CoreBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Cookbook\CoreBundle\Entity\Recipe;
use Cookbook\CoreBundle\Entity\People;

class RecipeHandler
{
    protected $form;
    protected $request;
    protected $em;

    public function __construct(Form $form, Request $request, EntityManager $em)
    {
        $this->form    = $form;
        $this->request = $request;
        $this->em      = $em;
    }

    public function process()
    {
        if( $this->request->getMethod() == 'POST' )
        {
            $this->form->bindRequest($this->request);

            if( $this->form->isValid() )
            {
                $this->onSuccess($this->form->getData());

                return true;
            }
        }

        return false;
    }

    public function onSuccess(Recipe $recipe)
    {
       
        $people = $this->em->find('CookbookCoreBundle:People', 1);
        $recipe->setPeople($people);
        $this->em->persist($recipe);
        $this->em->flush();
    }
}