<?php

namespace SP\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
// service templating
use Symfony\Component\HttpFoundation\Request;

use SP\MemberBundle\Form\Type\MemberType;
use SP\MemberBundle\Entity\Member;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MemberController extends Controller
{
    public function indexAction()
    {
       $listmembers = $this->getDoctrine()
        ->getRepository('SPMemberBundle:Member')
        ->findAll();


         return $this->render('SPMemberBundle:Member:index.html.twig',array('listmembers'=> $listmembers));
    }

    public function viewAction($id)
    {
        // Ici, on récupérera la fiche correspondante à l'id $id
        $member = $this->getDoctrine()
        ->getRepository('SPMemberBundle:Member')
        ->find($id);


         return $this->render('SPMemberBundle:Member:view.html.twig',array('member'=> $member));
    }

    public function addAction(Request $request)
    {
      // Ici, on s'occupe de la création et de la gestion du formulaire
        $member = new Member();

        $form = $this->createFormBuilder($member)
            ->add('usrFirstname', 'text',array('required'=>true, 'max_length'=>64))
            ->add('usrLastname', 'text',array('required'=>true, 'max_length'=>64))
            ->add('usrMail', 'email',array('required'=>true, 'max_length'=>128))
            ->add('save', 'submit')
            ->getForm();

         $form->handleRequest($request);

    if ($form->isValid()) {
        // sauvegarde le membre dans la bdd
        $em = $this->getDoctrine()->getManager();
        $em->persist($member);
        $em->flush();

        return $this->redirect($this->generateUrl('sp_member_view'));
    }
        return $this->render('SPMemberBundle:Member:add.html.twig', array(          'form'=>$form->createView(),
        ));

    }

    public function editAction($id, Request $request)
    {
         // Ici, on récupérera la fiche correspondante à $id


    // Même mécanisme que pour l'ajout

    if ($request->isMethod('POST')) {$request->getSession()->getFlashBag()->add('notice','Fiche bien modifiée.');

      return $this->redirect($this->generateUrl('sp_member_view', array('id'=>5)));

    }


    return $this->render('SPMemberBundle:Member:edit.html.twig');
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera la fiche correspondant à $id

    // Ici, on gérera la suppression de la fiche en question


    return $this->render('SPMemberBundle:Member:delete.html.twig');
    }

}
