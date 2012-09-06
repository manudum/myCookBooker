<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response; // retour ajax
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

        $form = $this->createFormBuilder($categoryRecipe)
                ->add('name','text', array(
                'attr' => array('placeholder' => 'Nouvelle catégorie'),
                ))
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $people = $this->get('security.context')->getToken()->getUser();
        
                $categoryRecipe->setPeople($people);
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($categoryRecipe);
                $em->flush();
                if(!$request->isXmlHttpRequest())
                {
                    return $this->redirect($this->generateUrl('cookbook'));
                } else {
                    $return = json_encode(array('id' => $categoryRecipe->getId(), 'name' =>$categoryRecipe->getName()));
                    return new Response($return,200,array('Content-Type'=>'application/json'));
                }
            }
        }

        return $this->render('CookbookCoreBundle:CategoryRecipe:new.html.twig', array(
                    'form' => $form->createView(),
                    'action' => 'categoryrecipe_new',
                ));
    }
    
    /**
     * @Route("/categoryrecipe/edit/{id}")
     * @Template()
     */
    public function editAction($id, Request $request) {

        // create a task and give it some dummy data for this example
        $usr= $this->get('security.context')->getToken()->getUser();
        // create a task and give it some dummy data for this example
        $categoryRecipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:CategoryRecipe')
                ->find($id);

        $form = $this->createFormBuilder($categoryRecipe)
                ->add('name','text', array(
                'attr' => array('placeholder' => 'Nouvelle catégorie'),
                ))
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $people = $this->get('security.context')->getToken()->getUser();
        
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($categoryRecipe);
                $em->flush();

                if(!$request->isXmlHttpRequest())
                {
                    return $this->redirect($this->generateUrl('cookbook'));
                } else {
                    $return = json_encode(array('id' => $categoryRecipe->getId(), 'name' => $categoryRecipe->getName()));
                    return new Response($return,200,array('Content-Type'=>'application/json'));
                }
            }
        }

        return $this->render('CookbookCoreBundle:CategoryRecipe:new.html.twig', array(
                    'form' => $form->createView(),
                    'action' => 'categoryrecipe_edit',
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
    
    /**
     * @Route("/categoryrecipe/list")
     * @Template()
     */
    public function listAction() {

        $usr= $this->get('security.context')->getToken()->getUser();
        $categories = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:CategoryRecipe')
                ->findBy(array('people' => $usr->getId()),array('showorder'=> 'ASC'));
        return $this->render('CookbookCoreBundle:CategoryRecipe:list.html.twig', 
                    array('categories' => $categories,
                    'user' => $usr));
    }
    
    /**
     * @Route("/categoryrecipe/reorder")
     * @Template()
     */
    public function reorderAction(Request $request) {

        $usr= $this->get('security.context')->getToken()->getUser();
        $filter = $request->request->get('order');
        //$filter= array_filter($filter);
        $categories = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:CategoryRecipe')
                ->findBy(array('people' => $usr->getId()));
        $em = $this->getDoctrine()->getEntityManager();
            
        foreach ($categories as $category){
            $category->setShoworder(array_search($category->getId(),$filter));
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($category);
            $em->flush();
        }
        return new Response('ok',200,array('Content-Type'=>'application/json'));

    }
    
    /**
     * @Route("/categoryrecipe/delete/{id}")
     * @Template()
     */
    public function deleteAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('CookbookCoreBundle:CategoryRecipe');

        if ($repository->deleteCategoryRecipe($id)) {
            return new Response(1,200,array('Content-Type'=>'application/json'));
        }
        else
        {
            return new Response(0,500,array('Content-Type'=>'application/json'));
        }
        
    }
    
}
