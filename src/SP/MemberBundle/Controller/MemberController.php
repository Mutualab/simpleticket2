<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class MemberController
{
    public function indexAction()
    {
        return new Response("Hello World !");
    }
}
