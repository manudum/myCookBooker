<?php

namespace Cookbook\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Cookbook\CoreBundle\Entity\People;
use Cookbook\CoreBundle\Entity\Friend;
use Symfony\Component\HttpFoundation\Request;

class FriendController extends Controller
{
    
    
    /**
     * @Route("/friend/new")
     * @Template()
     */
    public function newAction(Request $request) {

        // create a task and give it some dummy data for this example
        $usr= $this->get('security.context')->getToken()->getUser();
        
        $friend = new Friend();

        $form = $this->createFormBuilder($friend)
                ->add('name','text', array(
                'attr' => array('placeholder' => 'Nouvel invité'),
            ))
                ->getForm();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $people = $this->get('security.context')->getToken()->getUser();
        
                $friend->setPeople($people);
                // perform some action, such as saving the task to the database
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($friend);
                $em->flush();

                $response = $this->forward('CookbookCoreBundle:Friend:show', array(
                'id'  => $id
            ));
            return $response;
            }
        }

        return $this->render('CookbookCoreBundle:Friend:new.html.twig', array(
                    'form' => $form->createView(),
                    'user' => $usr
                ));
    }
    
    
    /**
     * @Route("/friend/show/{id}")
     * @Template()
     */
    public function showAction($id) {
        
        $usr= $this->get('security.context')->getToken()->getUser();
        
        $repository = $this->getDoctrine()->getRepository('CookbookCoreBundle:Friend');

        $friend = $repository
                ->find($id);
        
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('Select cf, e from CookbookCoreBundle:Friend cf JOIN cf.events e  JOIN e.friends f where f.id = :user_id and cf.id != f.id');
        $query->setParameters(array('user_id' => $id));
        $mutualfriends = $query->getResult();
        
        $query2 = $em->createQuery('Select kr, e from CookbookCoreBundle:Recipe kr JOIN kr.events e  JOIN e.friends f where f.id = :user_id');
        $query2->setParameters(array('user_id' => $id));
        $knownRecipies= $query2->getResult();
        return $this->render('CookbookCoreBundle:Friend:show.html.twig', array('friend' => $friend, 'user' => $usr, 'mutualFriends' => $mutualfriends, 'knownRecipies' => $knownRecipies));
    }
    
    /**
     * @Route("/friend/list")
     * @Template()
     */
    public function listAction() {

        $usr= $this->get('security.context')->getToken()->getUser();
        return $this->render('CookbookCoreBundle:Friend:list.html.twig', 
                    array(
                    'user' => $usr));
    }
    
}
