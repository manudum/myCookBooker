<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $formatRecipe->setName('Put a name');

        $form = $this->createFormBuilder($formatRecipe)
                ->add('name', 'text')
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $people = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:People')
                ->find(1);
                $formatRecipe->setPeople($people);
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($formatRecipe);
                $em->flush();

                return $this->redirect($this->generateUrl('cookbook'));
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
