<?php

namespace TT\platformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TT\platformBundle\Entity\Bureau;
use TT\platformBundle\Form\BureauType;

/**
 * Bureau controller.
 *
 */
class BureauController extends Controller
{
    /**
     * Lists all Bureau entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bureaus = $em->getRepository('TTplatformBundle:Bureau')->findAll();

        return $this->render('bureau/index.html.twig', array(
            'bureaus' => $bureaus,
        ));
    }

    /**
     * Creates a new Bureau entity.
     *
     */
    public function newAction(Request $request)
    {
        $bureau = new Bureau();
        $form = $this->createForm('TT\platformBundle\Form\BureauType', $bureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bureau);
            $em->flush();

            return $this->redirectToRoute('adminBureau_show', array('id' => $bureau->getId()));
        }

        return $this->render('bureau/new.html.twig', array(
            'bureau' => $bureau,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Bureau entity.
     *
     */
    public function showAction(Bureau $bureau)
    {
        $deleteForm = $this->createDeleteForm($bureau);

        return $this->render('bureau/show.html.twig', array(
            'bureau' => $bureau,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Bureau entity.
     *
     */
    public function editAction(Request $request, Bureau $bureau)
    {
        $deleteForm = $this->createDeleteForm($bureau);
        $editForm = $this->createForm('TT\platformBundle\Form\BureauType', $bureau);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bureau);
            $em->flush();

            return $this->redirectToRoute('adminBureau_edit', array('id' => $bureau->getId()));
        }

        return $this->render('bureau/edit.html.twig', array(
            'bureau' => $bureau,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Bureau entity.
     *
     */
    public function deleteAction(Request $request, Bureau $bureau)
    {
        $form = $this->createDeleteForm($bureau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bureau);
            $em->flush();
        }

        return $this->redirectToRoute('adminBureau_index');
    }

    /**
     * Creates a form to delete a Bureau entity.
     *
     * @param Bureau $bureau The Bureau entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Bureau $bureau)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminBureau_delete', array('id' => $bureau->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
