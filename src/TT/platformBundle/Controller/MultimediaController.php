<?php

namespace TT\platformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TT\platformBundle\Entity\Multimedia;
use TT\platformBundle\Form\MultimediaType;

/**
 * Multimedia controller.
 *
 */
class MultimediaController extends Controller
{
    /**
     * Lists all Multimedia entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $multimedia = $em->getRepository('TTplatformBundle:Multimedia')->findAll();

        return $this->render('multimedia/index.html.twig', array(
            'multimedia' => $multimedia,
        ));
    }

    /**
     * Creates a new Multimedia entity.
     *
     */
    public function newAction(Request $request)
    {
        $multimedia = new Multimedia();
        $form = $this->createForm('TT\platformBundle\Form\MultimediaType', $multimedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($multimedia);
            $em->flush();

            return $this->redirectToRoute('adminMultimedia_show', array('id' => $multimedia->getId()));
        }

        return $this->render('multimedia/new.html.twig', array(
            'multimedia' => $multimedia,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Multimedia entity.
     *
     */
    public function showAction(Multimedia $multimedia)
    {
        $deleteForm = $this->createDeleteForm($multimedia);

        return $this->render('multimedia/show.html.twig', array(
            'multimedia' => $multimedia,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Multimedia entity.
     *
     */
    public function editAction(Request $request, Multimedia $multimedia)
    {
        $deleteForm = $this->createDeleteForm($multimedia);
        $editForm = $this->createForm('TT\platformBundle\Form\MultimediaType', $multimedia);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($multimedia);
            $em->flush();

            return $this->redirectToRoute('adminMultimedia_edit', array('id' => $multimedia->getId()));
        }

        return $this->render('multimedia/edit.html.twig', array(
            'multimedia' => $multimedia,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Multimedia entity.
     *
     */
    public function deleteAction(Request $request, Multimedia $multimedia)
    {
        $form = $this->createDeleteForm($multimedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($multimedia);
            $em->flush();
        }

        return $this->redirectToRoute('adminMultimedia_index');
    }

    /**
     * Creates a form to delete a Multimedia entity.
     *
     * @param Multimedia $multimedia The Multimedia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Multimedia $multimedia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminMultimedia_delete', array('id' => $multimedia->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
