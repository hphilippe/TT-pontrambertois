<?php

namespace TT\platformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TT\platformBundle\Entity\Sponsor;
use TT\platformBundle\Form\SponsorType;

/**
 * Sponsor controller.
 *
 */
class SponsorController extends Controller
{
    /**
     * Lists all Sponsor entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sponsors = $em->getRepository('TTplatformBundle:Sponsor')->findAll();

        return $this->render('sponsor/index.html.twig', array(
            'sponsors' => $sponsors,
        ));
    }

    /**
     * Creates a new Sponsor entity.
     *
     */
    public function newAction(Request $request)
    {
        $sponsor = new Sponsor();
        $form = $this->createForm('TT\platformBundle\Form\SponsorType', $sponsor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sponsor);
            $em->flush();

            return $this->redirectToRoute('sponsor_show', array('id' => $sponsor->getId()));
        }

        return $this->render('sponsor/new.html.twig', array(
            'sponsor' => $sponsor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Sponsor entity.
     *
     */
    public function showAction(Sponsor $sponsor)
    {
        $deleteForm = $this->createDeleteForm($sponsor);

        return $this->render('sponsor/show.html.twig', array(
            'sponsor' => $sponsor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Sponsor entity.
     *
     */
    public function editAction(Request $request, Sponsor $sponsor)
    {
        $deleteForm = $this->createDeleteForm($sponsor);
        $editForm = $this->createForm('TT\platformBundle\Form\SponsorType', $sponsor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sponsor);
            $em->flush();

            return $this->redirectToRoute('sponsor_edit', array('id' => $sponsor->getId()));
        }

        return $this->render('sponsor/edit.html.twig', array(
            'sponsor' => $sponsor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Sponsor entity.
     *
     */
    public function deleteAction(Request $request, Sponsor $sponsor)
    {
        $form = $this->createDeleteForm($sponsor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sponsor);
            $em->flush();
        }

        return $this->redirectToRoute('sponsor_index');
    }

    /**
     * Creates a form to delete a Sponsor entity.
     *
     * @param Sponsor $sponsor The Sponsor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sponsor $sponsor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sponsor_delete', array('id' => $sponsor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
