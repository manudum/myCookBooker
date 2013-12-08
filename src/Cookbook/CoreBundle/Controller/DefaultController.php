<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    
    
    /**
     * @Route("/")
     * @Template()
     */
    public function showAction()
    {
        $usr = $this->get('security.context')->getToken()->getUser();
        //var_dump($people);
       
        $categoryRecipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:CategoryRecipe')
                ->findByPeople($usr->getId());
        
        $typeRecipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:TypeRecipe')
                ->findByPeople($usr->getId());
        
        $formatRecipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:FormatRecipe')
                ->findByPeople($usr->getId());
    
        
        return $this->render('CookbookCoreBundle:Default:index.html.twig', 
                array('user' => $usr,
                    'categories'    => $categoryRecipe,
                    'types'          => $typeRecipe,
                    'formats'        => $formatRecipe,));
            
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
                $people = $this->get('security.context')->getToken()->getUser();
        
                $peopleFriend->setPeople($people);
                $em = $this->getDoctrine()->getManager();
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
