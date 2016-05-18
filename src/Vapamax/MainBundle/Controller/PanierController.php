<?php

namespace Vapamax\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Vapamax\MainBundle\Entity\AdresseLivraison;
use Vapamax\MainBundle\Entity\Commande;
use Vapamax\MainBundle\Entity\CommandeProduit;
use Vapamax\MainBundle\Entity\Nicotine;
use Vapamax\MainBundle\Entity\Produit;
use Vapamax\UserBundle\Entity\User;

class PanierController extends Controller
{
    public function voirAction(Request $request) {
        $session = $request->getSession();
        $request = $this->container->get('request');


        return $this->render('VapamaxMainBundle:Panier:voir.html.twig', array('panier' => $session->get('panier')));
    }

    public function ajoutAction(Request $request, Produit $produit, $qte ) {
        $session = $request->getSession();
        //$_SESSION['panier'] =~= $session->get('panier')
        if($produit->getCategorie()->getId()==2){

        $em = $this->getDoctrine()->getManager();
        $nicotine = $em->getRepository("VapamaxMainBundle:Nicotine")->find($request->get('nicotine'));
    }
        else
        {
        $nicotine=array();

    }
        $panier = $session->get('panier', array());
        $panier[$produit->getId()] = array('produit'=>$produit,'qte'=>$qte ,'nicotine'=>$nicotine);
        $session->set('panier', $panier);
        $session->set('nicotine', $nicotine);
        return $this->redirectToRoute('vapamax_main_panier');
    }
    public function supprimerAction(Request $request,Produit $produit) {
        $session = $request->getSession();
        //$_SESSION['panier'] =~= $session->get('panier')
        $panier = $session->get('panier', array());
        $article=count($panier);
        unset($panier[$produit->getId()]);

        $session->set('panier', $panier);
        $article2=count($panier);

            if($article!=$article2){
                $this->get('session')->getFlashBag()->add('success','Article supprimé avec succès');

            }
        return $this->redirectToRoute('vapamax_main_panier');
    }
    public function  validationAction(Request $request,User $id){
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $adresse = $em->getRepository("VapamaxMainBundle:Adresse")->find($request->get('addr'));
        $session->set('adresse', $adresse->getId());
        //$adresse  = $em->getRepository("VapamaxMainBundle:Adresse")->findBy(array('id'=>$id));
        return $this->render('VapamaxMainBundle:Panier:validation.html.twig',array('panier' => $session->get('panier'), 'adresse' => $adresse));
    }

    public function prepareCommandeAction(Request $request )
    {

        $session = $request->getSession();
        $panier = $session->get('panier', array());
        if(empty($panier)){
           return $this->redirectToRoute('vapamax_main_panier');
       }
        $em = $this->getDoctrine()->getManager();
        $produitRepository = $em->getRepository('VapamaxMainBundle:Produit');
        $adresseRepository = $em->getRepository('VapamaxMainBundle:Adresse');

        $commande = new Commande();


        $commande->setCreatedAt(new \DateTime());
        $commande->setUser($this->getUser());
        $commande->setAdresseLivraison($adresseRepository->find($session->get('adresse')));



        $em->persist($commande);



        $validation= new CommandeProduit();
        $validation->setCommande($commande);



       foreach($panier as $value){
           $validation= new CommandeProduit();
           $validation->setCommande($commande);
           $produit = $produitRepository->find($value['produit']->getId());
           $validation->setProduit($produit);

           $validation->setIsValid('0');
           $validation->setQuantite($value['qte']);

           $validation->setReference('azaza');
           $em->persist($validation);
       }
        $em->flush();
       // unset($panier);
        $this->get('session')->clear();

        return $this->redirectToRoute('vapamax_main_homepage');
    }



}
