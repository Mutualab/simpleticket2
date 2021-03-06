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
            ->add('email', 'email',array('required'=>true, 'max_length'=>128))
            ->add('usrBirthdate', 'birthday', array('widget'=>'choice'))
            ->add('usrWebsite', 'text',array('max_length'=>128))
            ->add('usrMobile', 'text',array('max_length'=>16))
            ->add('usrJobType', 'text',array('max_length'=>64))
            ->add('usrJobTitle', 'text',array('max_length'=>64))
            ->add('companies','entity',array(
                'required'=>false,
                'class'=>'SPMemberBundle:Company',
                'choice_label'=>'cpyName',
                'multiple'=>true
            ))
            ->add('save', 'submit')
            ->getForm();

         $form->handleRequest($request);

    if ($form->isValid()) {
        // sauvegarde le membre dans la bdd
        $em = $this->getDoctrine()->getManager();
        $em->persist($member);
        $em->flush();

        return $this->redirect($this->generateUrl('sp_member_view',array('id'=>$member->getId())));
    }
        return $this->render('SPMemberBundle:Member:add.html.twig', array(          'form'=>$form->createView(),
        ));

    }

    public function editAction($id, Request $request)
    {
          // Ici, on récupérera la fiche correspondante à $id
        $member = $this->getDoctrine()
        ->getRepository('SPMemberBundle:Member')
        ->find($id);

         $form = $this->createFormBuilder($member)
            ->add('usrFirstname', 'text',array('required'=>true, 'max_length'=>64))
            ->add('usrLastname', 'text',array('required'=>true, 'max_length'=>64))
            ->add('email', 'email',array('required'=>true, 'max_length'=>128))
            ->add('usrBirthdate', 'birthday', array('widget'=>'choice'))
            ->add('usrWebsite', 'text',array('max_length'=>128))
            ->add('usrMobile', 'text',array('max_length'=>16))
            ->add('usrJobType', 'text',array('max_length'=>64))
            ->add('usrJobTitle', 'text',array('max_length'=>64))
            ->add('companies','entity',array(
                'class'=>'SPMemberBundle:Company',
                'choice_label'=>'cpyName',
                'multiple'=>true
            ))
            ->add('save', 'submit')
            ->getForm();

             $form->handleRequest($request);

        $member->setUsrDupd(new \Datetime());

        if ($form->isValid()) {
        // sauvegarde le membre dans la bdd
        $em = $this->getDoctrine()->getManager();
        $em->persist($member);
        $em->flush();

    }
    // Même mécanisme que pour l'ajout

    if ($request->isMethod('POST')) {
        $request->getSession()->getFlashBag()->add('notice','Fiche bien modifiée.');

        return $this->redirect($this->generateUrl('sp_member_view',array('id'=>$member->getId())));

    }

   return $this->render('SPMemberBundle:Member:edit.html.twig', array(          'form'=>$form->createView(),'member'=> $member
        ));
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera la fiche correspondant à $id

         $member = $this->getDoctrine()
            ->getRepository('SPMemberBundle:Member')
            ->find($id);


    // Ici, on gérera la suppression de la fiche en question
        $em = $this->getDoctrine()->getManager();
        $em->remove($member);
        $em->flush();


    // Une fois la suppression effcetuee, on renvoie sur la liste des membres

        return $this->redirect($this->generateUrl('sp_member_homepage'));    }

}
