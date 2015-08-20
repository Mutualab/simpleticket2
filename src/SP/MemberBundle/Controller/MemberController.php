<?php

namespace SP\MemberBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class MemberController
{
    public function indexAction()
    {
        return new Response("Hello Member !");
    }

    public function viewAction($id)
    {
        return new Response("consulter fiche Member: ".$id);
    }

    public function addAction()
    {
        return new Response("ajouter Member !");
    }

    public function updateAction($id)
    {
        return new Response("update Member".$id);
    }

    public function deleteAction($id)
    {
        return new Response("Attention!! Delete Member ".$id);
    }

}
