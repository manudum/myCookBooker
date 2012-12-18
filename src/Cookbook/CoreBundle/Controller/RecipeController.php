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
            if ( false !== strpos($request->headers->get('Accept'), 'text/html')) {
                $response = $this->redirect($this->generateUrl('recipe_show', 
                    array('id'  => $recipe->getId()
                )));
            }

            if (false !== strpos($request->headers->get('Accept'), 'application/json')) {
                $jsons = array();
                $jsons[]=$recipe->__toArray();
                $response = new Response(json_encode($jsons));
                $response->headers->set('Content-Type', 'application/json');
            }
            
            return $response;
        }
        
        if ($request->isXmlHttpRequest()) {
            return $this->render('CookbookCoreBundle:Recipe:new.html_ajax.twig', array(
                'form' => $form->createView(),
                'action' => 'recipe_new',
                'user' => $usr,
            ));
        } else {
            return $this->render('CookbookCoreBundle:Recipe:new.html.twig', array(
                'form' => $form->createView(),
                'action' => 'recipe_new',
                'user' => $usr,
            ));
        }
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
            $response = $this->redirect($this->generateUrl('recipe_show', array(
                'id'  => $id
            )));
            return $response;
        }
        return $this->render('CookbookCoreBundle:Recipe:new.html.twig', array(
                    'form' => $form->createView(),
                    'action' => 'recipe_edit',
                    'user' => $usr,
                ));
    }
    
     /**
     * @Route("/recipe/changeContent/{id}")
     * @Template()
     */
    public function changeContentAction($id) {
        
        // create a task and give it some dummy data for this example
        $recipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->find($id);
        $recipe->setDescription($this->getRequest()->request->get('content'));
        $em = $this->getDoctrine()->getEntityManager();
           $em->persist($recipe);
           $em->flush();
            $return = '';
           return new Response($return,200,array('Content-Type'=>'application/json'));
       
    }
    
    /**
     * @Route("/recipe/changeCategory/{id}")
     * @Template()
     */
    public function changeCategoryAction($id) {
        
        // create a task and give it some dummy data for this example
        $recipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->find($id);
        $recipe->setCategory($this->getDoctrine()
                ->getRepository('CookbookCoreBundle:CategoryRecipe')
                ->find( $this->getRequest()->request->get('new_categ')));
        $em = $this->getDoctrine()->getEntityManager();
           $em->persist($recipe);
           $em->flush();
            $return = '';
           return new Response($return,200,array('Content-Type'=>'application/json'));
       
    }
    
    /**
     * @Route("/recipe/changeType/{id}")
     * @Template()
     */
    public function changeTypeAction($id) {
        
        // create a task and give it some dummy data for this example
        $recipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->find($id);
        $recipe->setType($this->getDoctrine()
                ->getRepository('CookbookCoreBundle:TypeRecipe')
                ->find( $this->getRequest()->request->get('new_type')));
        $em = $this->getDoctrine()->getEntityManager();
           $em->persist($recipe);
           $em->flush();
            $return = '';
           return new Response($return,200,array('Content-Type'=>'application/json'));
       
    }
    
    /**
     * @Route("/recipe/changeFormat/{id}")
     * @Template()
     */
    public function changeFormatAction($id) {
        
        // create a task and give it some dummy data for this example
        $recipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->find($id);
        $recipe->setFormat($this->getDoctrine()
                ->getRepository('CookbookCoreBundle:FormatRecipe')
                ->find( $this->getRequest()->request->get('new_format')));
        $em = $this->getDoctrine()->getEntityManager();
           $em->persist($recipe);
           $em->flush();
            $return = '';
           return new Response($return,200,array('Content-Type'=>'application/json'));
       
    }
    
    /**
     * @Route("/recipe/changePrepareTime/{id}")
     * @Template()
     */
    public function changePrepareTimeAction($id) {
        
        // create a task and give it some dummy data for this example
        $recipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->find($id);
        $recipe->setPrepareTime($this->getRequest()->request->get('new_prepareTime'));
        $em = $this->getDoctrine()->getEntityManager();
           $em->persist($recipe);
           $em->flush();
            $return = '';
           return new Response($return,200,array('Content-Type'=>'application/json'));
       
    }
    
    /**
     * @Route("/recipe/changeCookTime/{id}")
     * @Template()
     */
    public function changeCookTimeAction($id) {
        
        // create a task and give it some dummy data for this example
        $recipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->find($id);
        $recipe->setCookTime($this->getRequest()->request->get('new_cookTime'));
        $em = $this->getDoctrine()->getEntityManager();
           $em->persist($recipe);
           $em->flush();
            $return = '';
           return new Response($return,200,array('Content-Type'=>'application/json'));
       
    }
    
    
    /**
     * @Route("/recipe/delete/{id}")
     * @Template()
     */
    public function deleteAction($id) {
        
        
        $repository = $this->getDoctrine()->getRepository('CookbookCoreBundle:Recipe');

        $recipe = $repository
                ->find($id);
        
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($recipe);
        $em->flush();
        return $this->redirect($this->generateUrl('recipe_list'));
    }
    
    
    /**
     * @Route("/recipe/upload/{id}")
     * @Template()
     */
    public function uploadAction($id) {
        
        // create a task and give it some dummy data for this example
        $recipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:Recipe')
                ->find($id);
        $form = $this->createFormBuilder($recipe)
            ->add('image','file',array('required' => true, 'data_class' => null))
            ->getForm()
        ;
        
        $view = $form->createView();

        if ($this->getRequest()->getMethod() === 'POST') {
            $form->bindRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();

                $em->persist($recipe);
                $em->flush();
                $request = $this->getRequest();
                $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
                $return = $baseurl.'/uploads/recipies/'.$recipe->getId().'/picture/'.$recipe->getImage();
          
                return new Response($return,200,array('Content-Type'=>'text/html'));
            }
        }
        
        return $this->render('CookbookCoreBundle:Recipe:upload.html.twig', array(
                    'form' => $view
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
        $categoryRecipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:CategoryRecipe')
                ->findByPeople($usr->getId());
        
        $typeRecipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:TypeRecipe')
                ->findByPeople($usr->getId());
        
        $formatRecipe = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:FormatRecipe')
                ->findByPeople($usr->getId());
        return $this->render('CookbookCoreBundle:Recipe:list.html.twig', 
                    array('recipes' => $recipes,
                    'types'          => $typeRecipe,
                    'formats'        => $formatRecipe,
                    'user' => $usr,
            'categories' => $categoryRecipe));
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
                ->findBy(array_merge($filter, array('people' => $usr->getId())), array('name'=>'ASC'));
        // only do something when the client accepts "text/html" as response format
        if ( false !== strpos($request->headers->get('Accept'), 'text/html')) {
            return $this->render('CookbookCoreBundle:Recipe:listHome.html.twig', 
                    array('recipes' => $recipes,));
        }
        
        if (false !== strpos($request->headers->get('Accept'), 'application/json')) {
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
    
    
}