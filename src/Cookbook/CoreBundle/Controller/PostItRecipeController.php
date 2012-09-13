<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response; // retour ajax
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cookbook\CoreBundle\Entity\PostItRecipe;
use Cookbook\CoreBundle\Entity\Recipe;

use Symfony\Component\HttpFoundation\Request;

class PostItRecipeController extends Controller
{
    
    
    /**
     * @Route("/postitrecipe/new")
     * @Template()
     */
    public function newAction(Request $request) {

        // create a task and give it some dummy data for this example
        $postitrecipe = new PostItRecipe();
       
        $recipe = $this->getDoctrine()
        ->getRepository('CookbookCoreBundle:Recipe')
        ->find($request->request->get('recipe_id'));
        $postitrecipe->setRecipe($recipe);
        $postitrecipe->setTitle(date("d/m/Y"));
        $postitrecipe->setComment("Remarque");
        // perform some action, such as saving the task to the database
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($postitrecipe);
        $em->flush();
        if(!$request->isXmlHttpRequest())
        {
            return $this->redirect($this->generateUrl('cookbook'));
        } else {
            $return = json_encode(array('id' => $postitrecipe->getId(), 'title' =>$postitrecipe->getTitle(), 'comment' =>$postitrecipe->getComment()));
            return new Response($return,200,array('Content-Type'=>'application/json'));
        }
          
    }
    
    
   
    
    /**
     * @Route("/postitrecipe/delete/{id}")
     * @Template()
     */
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('CookbookCoreBundle:PostItRecipe');

        if ($repository->deletePostIt($id)) {
            return new Response(1,200,array('Content-Type'=>'application/json'));
        }
        else
        {
            return new Response(0,500,array('Content-Type'=>'application/json'));
        }
        
    }
    
    
}
