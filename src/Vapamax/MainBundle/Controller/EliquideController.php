<?php

namespace Vapamax\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Vapamax\MainBundle\Entity\Eliquide;
use Vapamax\MainBundle\Form\EliquideType;

/**
 * Eliquide controller.
 *
 */
class EliquideController extends Controller
{
    /**
     * Lists all Eliquide entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $eliquides = $em->getRepository('VapamaxMainBundle:Eliquide')->findAll();

        return $this->render('eliquide/index.html.twig', array(
            'eliquides' => $eliquides,
        ));
    }

    /**
     * Creates a new Eliquide entity.
     *
     */
    public function newAction(Request $request)
    {
        $eliquide = new Eliquide();
        $form = $this->createForm('Vapamax\MainBundle\Form\EliquideType', $eliquide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $eliquide->upload();
            $em->persist($eliquide);
            $em->flush();

            return $this->redirectToRoute('eliquide_show', array('id' => $eliquide->getId()));
        }

        return $this->render('eliquide/new.html.twig', array(
            'eliquide' => $eliquide,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Eliquide entity.
     *
     */
    public function showAction(Eliquide $eliquide)
    {
        $deleteForm = $this->createDeleteForm($eliquide);

        return $this->render('eliquide/show.html.twig', array(
            'eliquide' => $eliquide,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Eliquide entity.
     *
     */
    public function editAction(Request $request, Eliquide $eliquide)
    {
        $deleteForm = $this->createDeleteForm($eliquide);
        $editForm = $this->createForm('Vapamax\MainBundle\Form\EliquideType', $eliquide);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($eliquide);
            $em->flush();

            return $this->redirectToRoute('eliquide_edit', array('id' => $eliquide->getId()));
        }

        return $this->render('eliquide/edit.html.twig', array(
            'eliquide' => $eliquide,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Eliquide entity.
     *
     */
    public function deleteAction(Request $request, Eliquide $eliquide)
    {
        $form = $this->createDeleteForm($eliquide);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($eliquide);
            $em->flush();
        }

        return $this->redirectToRoute('eliquide_index');
    }

    /**
     * Creates a form to delete a Eliquide entity.
     *
     * @param Eliquide $eliquide The Eliquide entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Eliquide $eliquide)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('eliquide_delete', array('id' => $eliquide->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
