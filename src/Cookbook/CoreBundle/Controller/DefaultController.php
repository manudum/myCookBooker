<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cookbook\CoreBundle\Entity\People;
use Cookbook\CoreBundle\Entity\Recipe;

use Cookbook\CoreBundle\Entity\CategoryRecipe;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    
    
    /**
     * @Route("/cookbook/")
     * @Template()
     */
    public function showAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        //var_dump($people);
       /*
        $category = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:CategoryRecipe')
                ->createQueryBuilder('c')->select('c.name, COUNT(c.name) as catCount')
                ->leftJoin('c.recipes', 'r')
                ->where('c.people = '.$user->getId())
                ->groupBy('c.name')->getQuery()->getScalarResult();
        
        var_dump($category);*/
    
        
        return $this->render('CookbookCoreBundle:Default:index.html.twig', array('user' => $user));
            
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
