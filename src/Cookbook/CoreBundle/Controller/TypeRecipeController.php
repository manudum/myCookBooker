<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response; // retour ajax
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

        $form = $this->createFormBuilder($typeRecipe)
                ->add('name','text', array(
                'attr' => array('placeholder' => 'Nouveau type'),
                ))
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $people = $this->get('security.context')->getToken()->getUser();
        
                $typeRecipe->setPeople($people);
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($typeRecipe);
                $em->flush();

                if(!$request->isXmlHttpRequest())
                {
                    return $this->redirect($this->generateUrl('cookbook'));
                } else {
                    $return = json_encode(array('id' => $typeRecipe->getId(), 'name' => $typeRecipe->getName()));
                    return new Response($return,200,array('Content-Type'=>'application/json'));
                }
            }
        }

        return $this->render('CookbookCoreBundle:TypeRecipe:new.html.twig', array(
                    'form' => $form->createView(),
                    'action' => 'typerecipe_new',
                ));
    }
    
    /**
     * @Route("/typerecipe/edit/{id}")
     * @Template()
     */
    public function editAction($id, Request $request) {

        // create a task and give it some dummy data for this example
        $usr= $this->get('security.context')->getToken()->getUser();
        // create a task and give it some dummy data for this example
        $typeRecipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:TypeRecipe')
                ->find($id);

        $form = $this->createFormBuilder($typeRecipe)
                ->add('name','text', array(
                'attr' => array('placeholder' => 'Nouveau type'),
                ))
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $people = $this->get('security.context')->getToken()->getUser();
        
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($typeRecipe);
                $em->flush();

                if(!$request->isXmlHttpRequest())
                {
                    return $this->redirect($this->generateUrl('cookbook'));
                } else {
                    $return = json_encode(array('id' => $typeRecipe->getId(), 'name' => $typeRecipe->getName()));
                    return new Response($return,200,array('Content-Type'=>'application/json'));
                }
            }
        }

        return $this->render('CookbookCoreBundle:TypeRecipe:new.html.twig', array(
                    'form' => $form->createView(),
                    'action' => 'typerecipe_edit',
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
    
    /**
     * @Route("/typerecipe/list")
     * @Template()
     */
    public function listAction() {

        $usr= $this->get('security.context')->getToken()->getUser();
        $types = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:TypeRecipe')
                ->findBy(array('people' => $usr->getId()),array('showorder'=> 'ASC'));
        
        $request = $this->getRequest();
        if ( false !== strpos($request->headers->get('Accept'), 'text/html')) {
            return $this->render('CookbookCoreBundle:TypeRecipe:list.html.twig', 
                    array('types' => $types,
                    'user' => $usr));
        }
        
        if (false !== strpos($request->headers->get('Accept'), 'application/json')) {
            $jsons = array();
            foreach ($types as $type) {
                $json = $type->__toArray();
                $jsons[]=$json;
            }

            $response = new Response(json_encode($jsons));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }
    
    /**
     * @Route("/typerecipe/reorder")
     * @Template()
     */
    public function reorderAction(Request $request) {

        $usr= $this->get('security.context')->getToken()->getUser();
        $filter = $request->request->get('order');
        //$filter= array_filter($filter);
        $types = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:TypeRecipe')
                ->findBy(array('people' => $usr->getId()));
        $em = $this->getDoctrine()->getEntityManager();
            
        foreach ($types as $type){
            $type->setShoworder(array_search($type->getId(),$filter));
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($type);
            $em->flush();
        }
        return new Response('ok',200,array('Content-Type'=>'application/json'));

    }
    
    /**
     * @Route("/typerecipe/delete/{id}")
     * @Template()
     */
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('CookbookCoreBundle:TypeRecipe');

        if ($repository->deleteTypeRecipe($id)) {
            return new Response(1,200,array('Content-Type'=>'application/json'));
        }
        else
        {
            return new Response(0,500,array('Content-Type'=>'application/json'));
        }
        
    }
}
