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
        return $this->render('SPMemberBundle:Member:index.html.twig');
    }

    public function viewAction($id)
    {
         return $this->render('SPMemberBundle:Member:view.html.twig',array('id'  => $id));
    }

    public function addAction()
    {
        return new Response("ajouter Member !");
    }

    public function editAction($id)
    {
        return new Response("update Member".$id);
    }

    public function deleteAction($id)
    {
        return new Response("Attention!! Delete Member ".$id);
    }

}
