<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response; // retour ajax
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cookbook\CoreBundle\Entity\CategoryRecipe;
use Cookbook\CoreBundle\Entity\People;
use Symfony\Component\HttpFoundation\Request;

class CategoryRecipeController extends Controller
{
    
    
    /**
     * @Route("/categoryrecipe/new")
     * @Template()
     */
    public function newAction(Request $request) {

        // create a task and give it some dummy data for this example
        $categoryRecipe = new CategoryRecipe();

        $form = $this->createFormBuilder($categoryRecipe)
                ->add('name','text', array(
                'attr' => array('placeholder' => 'Nouvelle catégorie'),
                ))
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $people = $this->get('security.context')->getToken()->getUser();
        
                $categoryRecipe->setPeople($people);
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($categoryRecipe);
                $em->flush();
                if(!$request->isXmlHttpRequest())
                {
                    return $this->redirect($this->generateUrl('cookbook'));
                } else {
                    $return = json_encode(array('id' => $categoryRecipe->getId(), 'name' =>$categoryRecipe->getName()));
                    return new Response($return,200,array('Content-Type'=>'application/json'));
                }
            }
        }

        return $this->render('CookbookCoreBundle:CategoryRecipe:new.html.twig', array(
                    'form' => $form->createView(),
                ));
    }
    
    
    /**
     * @Route("/categoryrecipe/show/{id}")
     * @Template()
     */
    public function showAction($id) {

        $categoryRecipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:CategoryRecipe')
                ->find($id);
        return $this->render('CookbookCoreBundle:CategoryRecipe:show.html.twig', array('categoryrecipe' => $categoryRecipe));
    }
    
    
}
