<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cookbook\CoreBundle\Entity\People;
use Cookbook\CoreBundle\Entity\Friend;
use Symfony\Component\HttpFoundation\Request;

class FriendController extends Controller
{
    
    
    /**
     * @Route("/friend/new")
     * @Template()
     */
    public function newAction(Request $request) {

        // create a task and give it some dummy data for this example
        $usr= $this->get('security.context')->getToken()->getUser();
        
        $friend = new Friend();

        $form = $this->createFormBuilder($friend)
                ->add('name','text', array(
                'attr' => array('placeholder' => 'Nouvel invité'),
            ))
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $people = $this->get('security.context')->getToken()->getUser();
        
                $friend->setPeople($people);
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($friend);
                $em->flush();

                return $this->redirect($this->generateUrl('cookbook'));
            }
        }

        return $this->render('CookbookCoreBundle:Friend:new.html.twig', array(
                    'form' => $form->createView(),
                    'user' => $usr
                ));
    }
    
    
    /**
     * @Route("/friend/show/{id}")
     * @Template()
     */
    public function showAction($id) {
        
        $usr= $this->get('security.context')->getToken()->getUser();
        
        $friend = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Friend')
                ->find($id);
        return $this->render('CookbookCoreBundle:Friend:show.html.twig', array('friend' => $friend, 'user' => $usr));
    }
    
    
}
