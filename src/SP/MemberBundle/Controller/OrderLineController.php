<?php

namespace SP\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
// service templating
use Symfony\Component\HttpFoundation\Request;

use SP\MemberBundle\Entity\OrderLine;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderLineController extends Controller
{
    public function indexAction()
    {
       $listorderlines = $this->getDoctrine()
        ->getRepository('SPMemberBundle:OrderLine')
    //on utilise un findBy() pour trier, garder seulement les dix dernieres commandes
        ->findAll();


         return $this->render('SPMemberBundle:OrderLine:index.html.twig',array('listorderlines'=> $listorderlines));
    }

    public function viewAction($id)
    {
        // Ici, on récupérera la fiche correspondante à l'id $id
        $orderline = $this->getDoctrine()
        ->getRepository('SPMemberBundle:OrderLine')
        ->find($id);


         return $this->render('SPMemberBundle:OrderLine:view.html.twig',array('orderline'=> $orderline));
    }

    public function addAction(Request $request)
    {
      // Ici, on s'occupe de la création et de la gestion du formulaire. On fait appel a la liste des membres, des entites et des produits.
        $orderline = new OrderLine();

        $form = $this->createFormBuilder($orderline)
            ->add('company','entity',array(
                'required'=>false,
                'class'=>'SPMemberBundle:Company',
                'choice_label'=>'cpyName',
                'multiple'=>false
            ))
             ->add('member','entity',array(
                'required'=>false,
                'class'=>'SPMemberBundle:Member',
                'choice_label'=>'usrFirstname',
                'multiple'=>false
            ))
            ->add('product','entity',array(
                'required'=>true,
                'class'=>'SPMemberBundle:Product',
                'choice_label'=>'pdtName',
                'multiple'=>false
            ))
            ->add('odlInitialQty', 'integer')
            ->add('save', 'submit')
            ->getForm();

         $form->handleRequest($request);

    if ($form->isValid()) {

       /* var_dump($orderline);
        exit();*/

    //On recupere la quantite de ticket du produit on le multiplie par le nombre de produit achete, on obtient la quantite restante
        $orderline->calculateOdlPendingQty();

    //On récupère un objet gestionnaire d'entités (entity manager) de Doctrine, qui est responsable de la gestion du processus de persistance et de récupération des objets vers et depuis la base de données.

        $em = $this->getDoctrine()->getManager();
    //La méthode persist() dit à Doctrine de « gérer » l'objet. Cela ne crée pas vraiment de requête dans la base de données (du moins pas encore).

        $em->persist($orderline);
    //Quand la méthode flush() est appelée, Doctrine regarde dans tous les objets qu'il gère pour savoir si ils ont besoin d'être persistés dans la base de données. Le gestionnaire d'entités exécute donc une requête INSERT et une ligne est créée dans la table.
        $em->flush();

        return $this->redirect($this->generateUrl('sp_orderline_view',array('id'=>$orderline->getId())));
    }
        return $this->render('SPMemberBundle:OrderLine:add.html.twig', array(          'form'=>$form->createView(),
        ));

    }

    public function editAction($id, Request $request)
    {
          // Ici, on récupérera la commande correspondante à $id
        $orderline = $this->getDoctrine()
        ->getRepository('SPMemberBundle:OrderLine')
        ->find($id);

        $form = $this->createFormBuilder($orderline)
            ->add('company','entity',array(
                'required'=>false,
                'class'=>'SPMemberBundle:Company',
                'choice_label'=>'cpyName',
                'multiple'=>false
            ))
             ->add('member','entity',array(
                'required'=>false,
                'class'=>'SPMemberBundle:Member',
                'choice_label'=>'usrFirstname',
                'multiple'=>false
            ))
            ->add('product','entity',array(
                'required'=>false,
                'class'=>'SPMemberBundle:Product',
                'choice_label'=>'pdtName',
                'multiple'=>false
            ))
            ->add('odlInitialQty', 'integer')
            ->add('save', 'submit')
            ->getForm();

             $form->handleRequest($request);

        $orderline->setOdlDupd(new \Datetime());

        if ($form->isValid()) {
        // sauvegarde le membre dans la bdd
        $em = $this->getDoctrine()->getManager();
        $em->persist($orderline);
        $em->flush();

    }
    // Même mécanisme que pour l'ajout

        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice','Fiche bien modifiée.');

            return $this->redirect($this->generateUrl('sp_orderline_view',array('id'=>$orderline->getId())));
        }

   return $this->render('SPMemberBundle:OrderLine:edit.html.twig',
        array(
            'form'=>$form->createView(),'orderline'=> $orderline
        ));
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera la commande correspondant à $id

         $orderline = $this->getDoctrine()
            ->getRepository('SPMemberBundle:OrderLine')
            ->find($id);


    // Ici, on gérera la suppression de la commande en question
        $em = $this->getDoctrine()->getManager();
        $em->remove($orderline);
        $em->flush();


    // Une fois la suppression effectuee, on renvoie sur la liste des commandes

        return $this->redirect($this->generateUrl('sp_orderline_homepage'));    }

    public function loggingAction($id,Request $request)
    {
      // Ici, on récupérera la commande correspondante à $id
        $orderline = $this->getDoctrine()
        ->getRepository('SPMemberBundle:OrderLine')
        ->find($id);

        // on definit les champs du formulaire
        $form = $this->createFormBuilder($orderline)
            ->add('odlPendingQty', 'number')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);


        if ($form->isValid()) {
         $orderline->setOdlDupd(new \Datetime());

        // sauvegarde le membre dans la bdd
        $em = $this->getDoctrine()->getManager();
        $em->persist($orderline);
        $em->flush();
        }

         // Même mécanisme que pour l'ajout

        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice','Fiche bien modifiée.');

            return $this->redirect($this->generateUrl('sp_orderline_view',array('id'=>$orderline->getId())));
        }

   return $this->render('SPMemberBundle:OrderLine:edit.html.twig',
        array(
            'form'=>$form->createView(),'orderline'=> $orderline
        ));
    }

}
