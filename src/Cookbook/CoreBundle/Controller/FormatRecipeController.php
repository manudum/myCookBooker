<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response; // retour ajax
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cookbook\CoreBundle\Entity\FormatRecipe;
use Cookbook\CoreBundle\Entity\People;
use Symfony\Component\HttpFoundation\Request;

class FormatRecipeController extends Controller
{
    
    
    /**
     * @Route("/formatrecipe/new")
     * @Template()
     */
    public function newAction(Request $request) {

        // create a task and give it some dummy data for this example
        $formatRecipe = new FormatRecipe();

        $form = $this->createFormBuilder($formatRecipe)
                ->add('name','text', array(
                'attr' => array('placeholder' => 'Nouveau format'),
                ))
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $people = $this->get('security.context')->getToken()->getUser();
        
                $formatRecipe->setPeople($people);
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($formatRecipe);
                $em->flush();

                if(!$request->isXmlHttpRequest())
                {
                    return $this->redirect($this->generateUrl('cookbook'));
                } else {
                    $return = json_encode(array('id' => $formatRecipe->getId(), 'name' =>$formatRecipe->getName()));
                    return new Response($return,200,array('Content-Type'=>'application/json'));
                }
            }
        }

        return $this->render('CookbookCoreBundle:FormatRecipe:new.html.twig', array(
                    'form' => $form->createView(),
                ));
    }
    
    
    /**
     * @Route("/formatrecipe/show/{id}")
     * @Template()
     */
    public function showAction($id) {

        $formatRecipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:FormatRecipe')
                ->find($id);
        return $this->render('CookbookCoreBundle:FormatRecipe:show.html.twig', array('formatrecipe' => $formatRecipe));
    }
    
    
}
