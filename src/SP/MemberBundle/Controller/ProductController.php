<?php

namespace SP\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
// service templating
use Symfony\Component\HttpFoundation\Request;

use SP\MemberBundle\Form\Type\MemberType;
use SP\MemberBundle\Entity\Product;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    public function indexAction()
    {
       $listproducts = $this->getDoctrine()
        ->getRepository('SPMemberBundle:Product')
        ->findAll();


         return $this->render('SPMemberBundle:Product:index.html.twig',array('listproducts'=> $listproducts));
    }

    public function viewAction($id)
    {
        // Ici, on récupérera la fiche correspondante à l'id $id
        $product = $this->getDoctrine()
        ->getRepository('SPMemberBundle:Product')
        ->find($id);


         return $this->render('SPMemberBundle:Product:view.html.twig',array('product'=> $product));
    }

    public function addAction(Request $request)
    {
      // Ici, on s'occupe de la création et de la gestion du formulaire
        $product = new Product();

        $form = $this->createFormBuilder($product)
            ->add('pdttype', 'text',array('required'=>true, 'max_length'=>24))
            ->add('pdtname', 'text',array('required'=>true, 'max_length'=>128))
            ->add('pdtdesc', 'text',array('required'=>true, 'max_length'=>255))
            ->add('pdtunitqty', 'integer')
            ->add('pdtprice', 'number')
            ->add('pdtcurrency', 'currency')
            ->add('save', 'submit')
            ->getForm();

         $form->handleRequest($request);

    if ($form->isValid()) {
        // sauvegarde le membre dans la bdd
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return $this->redirect($this->generateUrl('sp_product_view',array('id'=>$product->getId())));
    }
        return $this->render('SPMemberBundle:Product:add.html.twig', array(          'form'=>$form->createView(),
        ));

    }

    public function editAction($id, Request $request)
    {
          // Ici, on récupérera la fiche correspondante à $id
        $product = $this->getDoctrine()
        ->getRepository('SPMemberBundle:Product')
        ->find($id);

         $form = $this->createFormBuilder($product)
            ->add('pdttype', 'text',array('required'=>true, 'max_length'=>24))
            ->add('pdtname', 'text',array('required'=>true, 'max_length'=>128))
            ->add('pdtdesc', 'text',array('required'=>true, 'max_length'=>255))
            ->add('pdtunitqty', 'integer')
            ->add('pdtprice', 'number')
            ->add('pdtcurrency', 'currency')
            ->add('save', 'submit')
            ->getForm();

             $form->handleRequest($request);

        $product->setPdtDupd(new \Datetime());


        if ($form->isValid()) {
        // sauvegarde la compagnie dans la bdd
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();


    }
    // Même mécanisme que pour l'ajout

    if ($request->isMethod('POST')) {
        $request->getSession()->getFlashBag()->add('notice','Fiche bien modifiée.');

        return $this->redirect($this->generateUrl('sp_product_view',array('id'=>$product->getId())));

    }

   return $this->render('SPMemberBundle:Product:edit.html.twig', array(          'form'=>$form->createView(),'product'=> $product
        ));
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera la fiche correspondant à $id
         $product = $this->getDoctrine()
            ->getRepository('SPMemberBundle:Product')
            ->find($id);

    // Ici, on gérera la suppression de la fiche en question
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

    // Une fois la suppression effectuee, on renvoie sur la liste des produits
        return $this->redirect($this->generateUrl('sp_product_homepage'));    }
    }

}
