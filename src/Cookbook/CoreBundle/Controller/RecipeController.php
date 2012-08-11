<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cookbook\CoreBundle\Entity\Recipe;
use Cookbook\CoreBundle\Entity\People;
use Cookbook\CoreBundle\Form\RecipeType;
use Cookbook\CoreBundle\Form\RecipeHandler;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

class RecipeController extends Controller
{
    
    
    /**
     * @Route("/recipe/new")
     * @Template()
     */
    public function newAction(Request $request) {

        // create a task and give it some dummy data for this example
        $recipe = new Recipe();
        $recipe->setName('Put a name');
        $form = $this->createForm(new RecipeType, $recipe);

        $formHandler = new RecipeHandler($form, $this->get('request'), $this->getDoctrine()->getEntityManager());

        // On exécute le traitement du formulaire. S'il retourne true, alors le formulaire a bien été traité
        if( $formHandler->process() )
        {
            return $this->redirect($this->generateUrl('cookbook'));
        }
        
        return $this->render('CookbookCoreBundle:Recipe:new.html.twig', array(
                    'form' => $form->createView(),
                ));
    }
    
    /**
     * @Route("/recipe/edit/{id}")
     * @Template()
     */
    public function editAction($id) {

        // create a task and give it some dummy data for this example
        $recipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->find($id);
        $form = $this->createForm(new RecipeType, $recipe);

        $formHandler = new RecipeHandler($form, $this->get('request'), $this->getDoctrine()->getEntityManager());

        // On exécute le traitement du formulaire. S'il retourne true, alors le formulaire a bien été traité
        if( $formHandler->process() )
        {
            return $this->redirect($this->generateUrl('cookbook'));
        }
        return $this->render('CookbookCoreBundle:Recipe:edit.html.twig', array(
                    'form' => $form->createView(),
                ));
    }
    
    
    /**
     * @Route("/recipe/show/{id}")
     * @Template()
     */
    public function showAction($id) {

        $recipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->find($id);
        return $this->render('CookbookCoreBundle:Recipe:show.html.twig', array('recipe' => $recipe));
    }
    
    
}