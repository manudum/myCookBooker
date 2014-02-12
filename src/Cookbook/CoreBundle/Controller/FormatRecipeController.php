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
            $form->bind($request);

            if ($form->isValid()) {
                $people = $this->get('security.context')->getToken()->getUser();
        
                $formatRecipe->setPeople($people);
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getManager();
                $em->persist($formatRecipe);
                $em->flush();

                if(!$request->isXmlHttpRequest())
                {
                    return $this->redirect($this->generateUrl('formatrecipe_list'));
                } else {
                    $return = json_encode(array('id' => $formatRecipe->getId(), 'name' => $formatRecipe->getName()));
                    return new Response($return,200,array('Content-Type'=>'application/json'));
                }
            }
        }

        return $this->render('CookbookCoreBundle:FormatRecipe:new.html.twig', array(
                    'form' => $form->createView(),
                    'action' => 'formatrecipe_new',
                ));
    }
    
    /**
     * @Route("/formatrecipe/edit/{id}")
     * @Template()
     */
    public function editAction($id, Request $request) {

        // create a task and give it some dummy data for this example
        $usr= $this->get('security.context')->getToken()->getUser();
        // create a task and give it some dummy data for this example
        $formatRecipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:FormatRecipe')
                ->find($id);

        $form = $this->createFormBuilder($formatRecipe)
                ->add('name','text', array(
                'attr' => array('placeholder' => 'Nouveau format'),
                ))
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $people = $this->get('security.context')->getToken()->getUser();
        
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getManager();
                $em->persist($formatRecipe);
                $em->flush();

                if(!$request->isXmlHttpRequest())
                {
                    return $this->redirect($this->generateUrl('cookbook'));
                } else {
                    $return = json_encode(array('id' => $formatRecipe->getId(), 'name' => $formatRecipe->getName()));
                    return new Response($return,200,array('Content-Type'=>'application/json'));
                }
            }
        }

        return $this->render('CookbookCoreBundle:FormatRecipe:new.html.twig', array(
                    'form' => $form->createView(),
                    'action' => 'formatrecipe_edit',
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
    
    /**
     * @Route("/formatrecipe/list")
     * @Template()
     */
    public function listAction() {

        $usr= $this->get('security.context')->getToken()->getUser();
        $formats = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:FormatRecipe')
                ->findBy(array('people' => $usr->getId()),array('showorder'=> 'ASC'));
        
        $request = $this->getRequest();
        if ( false !== strpos($request->headers->get('Accept'), 'text/html')) {
            return $this->render('CookbookCoreBundle:FormatRecipe:list.html.twig', 
                    array('formats' => $formats,
                    'user' => $usr));
        }
        
        if (false !== strpos($request->headers->get('Accept'), 'application/json')) {
            $jsons = array();
            foreach ($formats as $format) {
                $json = $format->__toArray();
                $jsons[]=$json;
            }

            $response = new Response(json_encode($jsons));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }
    
    /**
     * @Route("/formatrecipe/reorder")
     * @Template()
     */
    public function reorderAction(Request $request) {

        $usr= $this->get('security.context')->getToken()->getUser();
        $filter = $request->request->get('order');
        //$filter= array_filter($filter);
        $formats = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:FormatRecipe')
                ->findBy(array('people' => $usr->getId()));
        $em = $this->getDoctrine()->getManager();
            
        foreach ($formats as $format){
            $format->setShoworder(array_search($format->getId(),$filter));
            $em = $this->getDoctrine()->getManager();
            $em->persist($format);
            $em->flush();
        }
        return new Response('ok',200,array('Content-Type'=>'application/json'));

    }
    
    /**
     * @Route("/formatrecipe/delete/{id}")
     * @Template()
     */
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CookbookCoreBundle:FormatRecipe');

        if ($repository->deleteFormatRecipe($id)) {
            return new Response(1,200,array('Content-Type'=>'application/json'));
        }
        else
        {
            return new Response(0,500,array('Content-Type'=>'application/json'));
        }
        
    }
}
