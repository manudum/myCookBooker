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
    protected $user;

    public function __construct(Form $form, Request $request, EntityManager $em, People $usr)
    {
        $this->form    = $form;
        $this->request = $request;
        $this->em      = $em;
        $this->user    = $usr;
    }

    public function process()
    {
        if( $this->request->getMethod() == 'POST' )
        {
            $this->form->bind($this->request);

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
        $event->setPeople($this->user);
        $this->em->persist($event);
        $this->em->flush();
    }
}