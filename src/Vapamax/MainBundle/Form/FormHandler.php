<?php

//Cette class va servir à prendre en charge et sauvegarder n'importe quel form
namespace Vapamax\MainBundle\Form;
//Formulaire à sauvegarder
use Symfony\Component\Form\Form;
//Le protocole HTTP > récuperation de/des superglobales
use Symfony\Component\HttpFoundation\Request;
//Le Doctrine Manager pour persister les données du form dans la DB
use Doctrine\ORM\EntityManager;
class FormHandler
{
    protected $form;
    protected $em;
    protected $request;

    public function __construct(Form $form,Request $request,EntityManager $em){
      $this->form = $form;
      $this->request =$request;
      $this->em = $em;
    }
    //Prise en charge de la validation du form, çad récuperation et vérif des données de la requete HTTP
  public function process(){
      if($this->request->getMethod() == "POST"){
          $this->form->handleRequest($this->request);
         if( $this->form->isValid() == true) {
             //Appel de la méthode pour sauvegarder le form
             $this->onSuccess($this->form->getData());
             return true;
         }//fin is valid

      }

          return false;

  }
    //sauvegarde dans la db de l'entity, si form valid
    private function onSuccess($entity){
        $this->em->persist($entity);
        $this->em->flush();
    }
}