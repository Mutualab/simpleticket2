<?php

namespace SP\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
// service templating
use Symfony\Component\HttpFoundation\Request;

class MemberController extends Controller
{
    public function indexAction()
    {
        return $this->render('SPMemberBundle:Member:index.html.twig', array( 'listMembers' => array()));
    }

    public function viewAction($id)
    {
        // Ici, on récupérera la fiche correspondante à l'id $id

         return $this->render('SPMemberBundle:Member:view.html.twig',array('id'=> $id));
    }

    public function addAction(Request $request)
    {
     // Si la requête est en POST, c'est que le visiteur a soumis le formulaire

    if ($request->isMethod('POST')) {

      // Ici, on s'occupera de la création et de la gestion du formulaire

      $request->getSession()->getFlashBag()->add('notice','Fiche bien enregistrée.');

      // Puis on redirige vers la page de visualisation de cette fiche

      return $this->redirect($this->generateUrl('sp_member_view', array('id' => 5)));

    }


    // Si on n'est pas en POST, alors on affiche le formulaire

    return $this->render('SPMemberBundle:Member:add.html.twig');
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
