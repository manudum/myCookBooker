<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cookbook\CoreBundle\Entity\People;
use Cookbook\CoreBundle\Entity\Recipe;
use Cookbook\CoreBundle\Entity\PeopleFriend;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    
    
    /**
     * @Route("/cookbook/")
     * @Template()
     */
    public function showAction()
    {
        $id =1; // à lire en session
        $people = $this->getDoctrine()
        ->getRepository('CookbookCoreBundle:People')
        ->find($id);
        //var_dump($people);
       
        return $this->render('CookbookCoreBundle:Default:index.html.twig', array('people' => $people));
            
    }
    //plus utilisé
    public function addFriendAction(Request $request)
    {
        
         // create a task and give it some dummy data for this example
        $peopleFriend = new PeopleFriend();

        $form = $this->createFormBuilder($peopleFriend)
                ->add('friend')
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                // perform some action, such as saving the task to the database
                $people = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:People')
                ->find(1);
                $peopleFriend->setPeople($people);
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($peopleFriend);
                $em->flush();

                return $this->redirect($this->generateUrl('cookbook'));
            }
        }

        return $this->render('CookbookCoreBundle:Default:addFriend.html.twig', array(
                    'form' => $form->createView(),
                ));    
    }
    
    
}
