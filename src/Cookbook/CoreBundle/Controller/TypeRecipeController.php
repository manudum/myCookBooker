<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cookbook\CoreBundle\Entity\TypeRecipe;
use Cookbook\CoreBundle\Entity\People;
use Symfony\Component\HttpFoundation\Request;

class TypeRecipeController extends Controller
{
    
    
    /**
     * @Route("/typerecipe/new")
     * @Template()
     */
    public function newAction(Request $request) {

        // create a task and give it some dummy data for this example
        $typeRecipe = new TypeRecipe();
        $typeRecipe->setName('Put a name');

        $form = $this->createFormBuilder($typeRecipe)
                ->add('name', 'text')
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $people = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:People')
                ->find(1);
                $typeRecipe->setPeople($people);
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($typeRecipe);
                $em->flush();

                return $this->redirect($this->generateUrl('cookbook'));
            }
        }

        return $this->render('CookbookCoreBundle:TypeRecipe:new.html.twig', array(
                    'form' => $form->createView(),
                ));
    }
    
    
    /**
     * @Route("/typerecipe/show/{id}")
     * @Template()
     */
    public function showAction($id) {

        $typeRecipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:TypeRecipe')
                ->find($id);
        return $this->render('CookbookCoreBundle:TypeRecipe:show.html.twig', array('typerecipe' => $typeRecipe));
    }
    
    
}
