<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $categoryRecipe->setName('Put a name');

        $form = $this->createFormBuilder($categoryRecipe)
                ->add('name', 'text')
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $people = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:People')
                ->find(1);
                $categoryRecipe->setPeople($people);
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($categoryRecipe);
                $em->flush();

                return $this->redirect($this->generateUrl('cookbook'));
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
