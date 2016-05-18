<?php

namespace Vapamax\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Vapamax\MainBundle\Entity\Adresse;
use Vapamax\MainBundle\Form\FormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vapamax\MainBundle\Entity\Produit;
use Vapamax\MainBundle\Entity\Eliquide;
use Vapamax\MainBundle\Form\AdresseType;
use Vapamax\UserBundle\Entity\User;
use Vapamax\UserBundle\Form\RegistrationType;


class MainController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $produits=$em->getRepository("VapamaxMainBundle:Produit")->FindBy(array('isNew'=>1));
        $datas= array('produits'=>$produits);


        return $this->render('VapamaxMainBundle:Main:index.html.twig',$datas);
    }
    public function CategorieAction($categorie){
        $em = $this->getDoctrine()->getManager();
        $findproduits = $em->getRepository("VapamaxMainBundle:Produit")->findByCat($categorie);
        $produits  = $this->get('knp_paginator')->paginate($findproduits,$this->get('request')->query->get('page', 1),8 );





        $datas = array('produits'=>$produits);
        return $this->render('VapamaxMainBundle:Main:ecigarette.html.twig',$datas);
    }


    function CategorieListAction($class){
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository("VapamaxMainBundle:Categorie")->findAll();


        return $this->render('VapamaxMainBundle:Main:categorie_list.html.twig', array(
            'categories' =>$categories,'class'=>$class
        ));
    }
    public function presentationAction($id){

        $em = $this->getDoctrine()->getManager();
        $produits=$em->getRepository("VapamaxMainBundle:Produit")->FindBy(array('id'=>$id));
        $eliquides = $em->getRepository('VapamaxMainBundle:Eliquide')->findAll();
        $datas= array('produits'=>$produits,'eliquides'=>$eliquides);
        if (!$produits) throw $this->createNotFoundException('La page n\'existe pas.');

        return $this->render('VapamaxMainBundle:Main:presentation.html.twig',$datas);
    }

    public function livraisonAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if ($user != "anon.") {
            $em = $this->getDoctrine()->getManager();
            $livraison = $em->getRepository("VapamaxMainBundle:Adresse")->findby(array('user'=>$user));
            $adresse = new Adresse();


            $adresse->setUser($user);
            $form = $this->createForm(AdresseType::class, $adresse);
            //2> prendre en charge la validation du formulaire
            //Recuperer doctrine

            $formHandler = new FormHandler($form, $request, $em);
            //si les données du formulaire sont validées et enregistrer dans db redicrection vers la validation
            if ($formHandler->process() == true) {
                return $this->redirect($this->generateUrl("vapamax_main_livraison"));

            }


            $datas = array('form' => $form->createView(), 'livraison' => $livraison,'user'=>$user);

        }
        else{
            return $this->redirect($this->generateUrl("vapamax_main_livraison"));
        }


        return $this->render('VapamaxMainBundle:Main:livraison.html.twig', $datas);
    }
    public function createAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($user != "anon.") {
            $profil = new User(true, $user);
            $form = $this->createForm(RegistrationType::class, $profil);
            //2> prendre en charge la validation du formulaire
            //Recuperer doctrine
            $em = $this->getDoctrine()->getManager();
            $formHandler = new FormHandler($form, $request, $em);
            //si les données du formulaire sont validées et enregistrer dans db redicrection vers accueil
            if ($formHandler->process() == true) {
                return $this->redirect($this->generateUrl("vapamax_main_homepage"));

            }


            $datas = array('form'=>$form->createView());
        }
        else{
            $datas = array();
        }
        //..

        return $this->render('@VapamaxMain/Main/profil.html.twig', $datas);
    }




}
