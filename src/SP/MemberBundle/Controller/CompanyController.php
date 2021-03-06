<?php

namespace SP\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
// service templating
use Symfony\Component\HttpFoundation\Request;

use SP\MemberBundle\Entity\Company;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyController extends Controller
{
    public function indexAction()
    {
       $listcompanies = $this->getDoctrine()
        ->getRepository('SPMemberBundle:Company')
        ->findAll();


         return $this->render('SPMemberBundle:Company:index.html.twig',array('listcompanies'=> $listcompanies));
    }

    public function viewAction($id)
    {
        // Ici, on récupérera la fiche correspondante à l'id $id
        $company = $this->getDoctrine()
        ->getRepository('SPMemberBundle:Company')
        ->find($id);


         return $this->render('SPMemberBundle:Company:view.html.twig',array('company'=> $company));
    }

    public function addAction(Request $request)
    {
      // Ici, on s'occupe de la création et de la gestion du formulaire
        $company = new Company();

        $form = $this->createFormBuilder($company)
            ->add('cpyName', 'text',array('required'=>true, 'max_length'=>64))
            ->add('cpyLegalForm', 'text',array('required'=>true, 'max_length'=>24))
            ->add('cpySiren', 'integer',array('required'=>true, 'max_length'=>9))
            ->add('cpySiret', 'integer',array('required'=>true, 'max_length'=>14))
            ->add('cpyTvaNumber', 'text',array('required'=>true, 'max_length'=>13))
            ->add('cpyWebsite', 'text',array('required'=>true, 'max_length'=>128))
            ->add('members','entity',array(
                'class'=>'SPMemberBundle:Member',
                'choice_label'=>'usr_firstname',
                'multiple'=>true
            ))
            ->add('save', 'submit')
            ->getForm();

         $form->handleRequest($request);

    if ($form->isValid()) {
        // sauvegarde la compagnie dans la bdd
        $em = $this->getDoctrine()->getManager();
        $em->persist($company);
        $em->flush();

        return $this->redirect($this->generateUrl('sp_company_view',array('id'=>$company->getId())));
    }
        return $this->render('SPMemberBundle:Company:add.html.twig', array(          'form'=>$form->createView(),
        ));

    }

    public function editAction($id, Request $request)
    {
         // Ici, on récupérera la fiche correspondante à $id
        $company = $this->getDoctrine()
        ->getRepository('SPMemberBundle:Company')
        ->find($id);

         $form = $this->createFormBuilder($company)
            ->add('cpyName', 'text',array('required'=>true, 'max_length'=>64))
            ->add('cpyLegalForm', 'text',array('required'=>true, 'max_length'=>24))
            ->add('cpySiren', 'integer',array('required'=>true, 'max_length'=>9))
            ->add('cpySiret', 'integer',array('required'=>true, 'max_length'=>14))
            ->add('cpyTvaNumber', 'text',array('required'=>true, 'max_length'=>13))
            ->add('cpyWebsite', 'text',array('required'=>true, 'max_length'=>128))
            ->add('save', 'submit')
            ->getForm();

             $form->handleRequest($request);

            $company->setCpyDupd(new \Datetime());


        if ($form->isValid()) {
        // sauvegarde la compagnie dans la bdd
        $em = $this->getDoctrine()->getManager();
        $em->persist($company);
        $em->flush();


    }
    // Même mécanisme que pour l'ajout

    if ($request->isMethod('POST')) {
        $request->getSession()->getFlashBag()->add('notice','Fiche bien modifiée.');

        return $this->redirect($this->generateUrl('sp_company_view',array('id'=>$company->getId())));

    }

   return $this->render('SPMemberBundle:Company:edit.html.twig', array(          'form'=>$form->createView(),'company'=> $company
        ));
    }

    public function deleteAction($id)
    {
    // Ici, on récupérera la fiche correspondant à $id
        $company = $this->getDoctrine()
            ->getRepository('SPMemberBundle:Company')
            ->find($id);

    // Ici, on gérera la suppression de la fiche en question
        $em = $this->getDoctrine()->getManager();
        $em->remove($company);
        $em->flush();


    // Une fois la suppression effectuee, on renvoie sur la liste des entites
        return $this->redirect($this->generateUrl('sp_company_homepage'));
    }

}
