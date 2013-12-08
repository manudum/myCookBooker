<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response; // retour ajax
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cookbook\CoreBundle\Entity\Ingredient;
use Cookbook\CoreBundle\Entity\Recipe;

use Symfony\Component\HttpFoundation\Request;

class IngredientController extends Controller
{
    
    
    /**
     * @Route("/ingredient/new")
     * @Template()
     */
    public function newAction(Request $request) {

        // create a task and give it some dummy data for this example
        $ingredient = new Ingredient();

        $form = $this->createFormBuilder($ingredient)
                ->add('name','text', array(
                'attr' => array('placeholder' => 'Ajouter un ingrédient'),
                ))
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $recipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->find($request->request->get('recipe_id'));
                $ingredient->setRecipe($recipe);
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getManager();
                $em->persist($ingredient);
                $em->flush();
                if(!$request->isXmlHttpRequest())
                {
                    return $this->redirect($this->generateUrl('cookbook'));
                } else {
                    $return = json_encode(array('id' => $ingredient->getId(), 'name' =>$ingredient->getName()));
                    return new Response($return,200,array('Content-Type'=>'application/json'));
                }
            }
        }

        return $this->render('CookbookCoreBundle:Ingredient:new.html.twig', array(
                    'form' => $form->createView(),
                ));
    }
    
    
   
    
    /**
     * @Route("/ingredient/delete/{id}")
     * @Template()
     */
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CookbookCoreBundle:Ingredient');

        if ($repository->deleteIngredient($id)) {
            return new Response(1,200,array('Content-Type'=>'application/json'));
        }
        else
        {
            return new Response(0,500,array('Content-Type'=>'application/json'));
        }
        
    }
    
    
}
