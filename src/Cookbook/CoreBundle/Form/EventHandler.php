<?php

namespace Cookbook\CoreBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Cookbook\CoreBundle\Entity\Event;
use Cookbook\CoreBundle\Entity\People;

class EventHandler
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

    public function onSuccess(Event $event)
    {
        $people = $this->em->find('CookbookCoreBundle:People', 1);
        $event->setPeople($people);
        $this->em->persist($event);
        $this->em->flush();
    }
}