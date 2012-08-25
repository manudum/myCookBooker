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

use Symfony\Component\HttpFoundation\Response;

class RecipeController extends Controller
{
    
    
    /**
     * @Route("/recipe/new")
     * @Template()
     */
    public function newAction(Request $request) {


        $usr= $this->get('security.context')->getToken()->getUser();
        // create a task and give it some dummy data for this example
        $recipe = new Recipe();
        $form = $this->createForm(new RecipeType, $recipe, array('user_id' => $usr->getId()));

        $formHandler = new RecipeHandler($form, $this->get('request'), $this->getDoctrine()->getEntityManager(), $usr);

        // On exécute le traitement du formulaire. S'il retourne true, alors le formulaire a bien été traité
        if( $formHandler->process() )
        {
            $response = $this->forward('CookbookCoreBundle:Recipe:show', array(
                'id'  => $id
            ));
            return $response;
        }
        
        return $this->render('CookbookCoreBundle:Recipe:new.html.twig', array(
                    'form' => $form->createView(),
                    'action' => 'recipe_new',
                    'user' => $usr,
                ));
    }
    
    /**
     * @Route("/recipe/edit/{id}")
     * @Template()
     */
    public function editAction($id) {
        
        $usr= $this->get('security.context')->getToken()->getUser();
        // create a task and give it some dummy data for this example
        $recipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->find($id);
        $form = $this->createForm(new RecipeType, $recipe, array('user_id' => $usr->getId()));

        $formHandler = new RecipeHandler($form, $this->get('request'), $this->getDoctrine()->getEntityManager(), $usr);
        
        // On exécute le traitement du formulaire. S'il retourne true, alors le formulaire a bien été traité
        if( $formHandler->process() )
        {
            $response = $this->forward('CookbookCoreBundle:Recipe:show', array(
                'id'  => $id
            ));
            return $response;
        }
        return $this->render('CookbookCoreBundle:Recipe:new.html.twig', array(
                    'form' => $form->createView(),
                    'action' => 'recipe_edit',
                    'user' => $usr,
                ));
    }
    
    
    /**
     * @Route("/recipe/show/{id}")
     * @Template()
     */
    public function showAction($id) {

        $usr= $this->get('security.context')->getToken()->getUser();
        $recipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->find($id);
        return $this->render('CookbookCoreBundle:Recipe:show.html.twig', 
                    array('recipe' => $recipe,
                    'user' => $usr,));
    }
    
    /**
     * @Route("/recipe/list")
     * @Template()
     */
    public function listAction() {

        $usr= $this->get('security.context')->getToken()->getUser();
        $recipes = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->findBy(array('people' => $usr->getId()));
        $category = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:CategoryRecipe')
                ->findBy(array('people' => $usr->getId()));
        return $this->render('CookbookCoreBundle:Recipe:list.html.twig', 
                    array('recipes' => $recipes,
                    'user' => $usr,
            'categories' => $category));
    }
    
    /**
     * @Route("/recipe/get")
     * @Template()
     */
    public function getAction(Request $request) {

        $usr= $this->get('security.context')->getToken()->getUser();
       
        $filter = $request->request->all();
        $filter= array_filter($filter);
        $recipes = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->findBy(array_merge($filter, array('people' => $usr->getId())));
        
        $jsons = array();
        foreach ($recipes as $recipe) {
            $json = $recipe->__toArray();
            $jsons[]=$json;
        }
        
        
        
        $response = new Response(json_encode($jsons));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    
    
}