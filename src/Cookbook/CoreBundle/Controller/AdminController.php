<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cookbook\CoreBundle\Entity\People;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller {

    /**
     * @Route("/people/{id}")
     * @Template()
     */
    public function indexAction() {

        $people = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:People')
                ->findAll();
        return $this->render('CookbookCoreBundle:People:index.html.twig', array('people' => $people));
    }

    /**
     * @Route("/people/edit/{id}")
     * @Template()
     */
    public function editAction($id) {

        $people = $this->getDoctrine()
                ->getRepository('CookbookCoreBundle:People')
                ->findById($id);
        var_dump($people);
        return $this->render('CookbookCoreBundle:People:edit.html.twig', array('people' => $people));
    }
    
    /**
     * @Route("/people/show/{id}")
     * @Template()
     */
    public function showAction($id) {

        $usr= $this->get('security.context')->getToken()->getUser();
        
        return $this->render('CookbookCoreBundle:People:show.html.twig', array('user' => $usr));
    }

    /**
     * @Route("/people/new")
     * @Template()
     */
    public function newAction(Request $request) {

        // create a task and give it some dummy data for this example
        $people = new People();
        $people->setName('Put a name');
        $people->setGender('M');

        $form = $this->createFormBuilder($people)
                ->add('name', 'text')
                ->add('gender', 'text')
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($people);
                $em->flush();

                return $this->redirect($this->generateUrl('people'));
            }
        }

        return $this->render('CookbookCoreBundle:People:new.html.twig', array(
                    'form' => $form->createView(),
                ));
    }

}
