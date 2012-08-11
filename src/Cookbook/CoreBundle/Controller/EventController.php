<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cookbook\CoreBundle\Entity\Recipe;
use Cookbook\CoreBundle\Entity\People;
use Cookbook\CoreBundle\Entity\Event;
use Cookbook\CoreBundle\Form\EventType;
use Cookbook\CoreBundle\Form\EventHandler;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

class EventController extends Controller
{
    
    
    /**
     * @Route("/event/new")
     * @Template()
     */
    public function newAction(Request $request) {

        // create a task and give it some dummy data for this example
        $event = new Event();
        $event->setName('Put a name');
        $form = $this->createForm(new EventType, $event);

        $formHandler = new EventHandler($form, $this->get('request'), $this->getDoctrine()->getEntityManager());

        // On exécute le traitement du formulaire. S'il retourne true, alors le formulaire a bien été traité
        if( $formHandler->process() )
        {
            return $this->redirect($this->generateUrl('cookbook'));
        }
        
        return $this->render('CookbookCoreBundle:Event:new.html.twig', array(
                    'form' => $form->createView(),
                ));
    }
    
    /**
     * @Route("/event/edit/{id}")
     * @Template()
     */
    public function editAction($id) {

        // create a task and give it some dummy data for this example
        $event = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Event')
                ->find($id);
        $form = $this->createForm(new EventType, $event);

        $formHandler = new EventHandler($form, $this->get('request'), $this->getDoctrine()->getEntityManager());

        // On exécute le traitement du formulaire. S'il retourne true, alors le formulaire a bien été traité
        if( $formHandler->process() )
        {
            return $this->redirect($this->generateUrl('cookbook'));
        }
        return $this->render('CookbookCoreBundle:Event:edit.html.twig', array(
                    'form' => $form->createView(),
                ));
    }
    
    
    /**
     * @Route("/event/show/{id}")
     * @Template()
     */
    public function showAction($id) {

        $event = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Event')
                ->find($id);
        return $this->render('CookbookCoreBundle:Event:show.html.twig', array('event' => $event));
    }
    
    
}