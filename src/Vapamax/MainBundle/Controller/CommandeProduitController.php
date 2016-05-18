<?php

namespace Vapamax\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Vapamax\MainBundle\Entity\Commande;
use Vapamax\MainBundle\Entity\CommandeProduit;
use Vapamax\MainBundle\Form\CommandeProduitType;

/**
 * CommandeProduit controller.
 *
 */
class CommandeProduitController extends Controller
{
    /**
     * Lists all CommandeProduit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $commandeProduits = $em->getRepository('VapamaxMainBundle:CommandeProduit')->findAll();
//        $commandeProduits = $em->getRepository('VapamaxMainBundle:Commande')->find($id);

        return $this->render('commandeproduit/index.html.twig', array(
            'commandeProduits' => $commandeProduits,
        ));
    }

    /**
     * Creates a new CommandeProduit entity.
     *
     */
    public function newAction(Request $request)
    {
        $commandeProduit = new CommandeProduit();
        $form = $this->createForm('Vapamax\MainBundle\Form\CommandeProduitType', $commandeProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commandeProduit);
            $em->flush();

            return $this->redirectToRoute('admin_show', array('id' => $commandeProduit->getId()));
        }

        return $this->render('commandeproduit/new.html.twig', array(
            'commandeProduit' => $commandeProduit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CommandeProduit entity.
     *
     */
    public function showAction(CommandeProduit $commandeProduit)
    {
        $deleteForm = $this->createDeleteForm($commandeProduit);

        return $this->render('commandeproduit/show.html.twig', array(
            'commandeProduit' => $commandeProduit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CommandeProduit entity.
     *
     */
    public function editAction(Request $request, CommandeProduit $commandeProduit)
    {
        $deleteForm = $this->createDeleteForm($commandeProduit);
        $editForm = $this->createForm('Vapamax\MainBundle\Form\CommandeProduitType', $commandeProduit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($commandeProduit);
            $em->flush();

            return $this->redirectToRoute('admin_edit', array('id' => $commandeProduit->getId()));
        }

        return $this->render('commandeproduit/edit.html.twig', array(
            'commandeProduit' => $commandeProduit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CommandeProduit entity.
     *
     */
    public function deleteAction(Request $request, CommandeProduit $commandeProduit)
    {
        $form = $this->createDeleteForm($commandeProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($commandeProduit);
            $em->flush();
        }

        return $this->redirectToRoute('admin_index');
    }

    /**
     * Creates a form to delete a CommandeProduit entity.
     *
     * @param CommandeProduit $commandeProduit The CommandeProduit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CommandeProduit $commandeProduit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_delete', array('id' => $commandeProduit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
