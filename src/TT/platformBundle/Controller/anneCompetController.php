<?php

namespace TT\platformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TT\platformBundle\Entity\anneCompet;
use TT\platformBundle\Form\anneCompetType;

/**
 * anneCompet controller.
 *
 */
class anneCompetController extends Controller
{
    /**
     * Lists all anneCompet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $anneCompets = $em->getRepository('TTplatformBundle:anneCompet')->findAll();

        return $this->render('annecompet/index.html.twig', array(
            'anneCompets' => $anneCompets,
        ));
    }

    /**
     * Creates a new anneCompet entity.
     *
     */
    public function newAction(Request $request)
    {
        $anneCompet = new anneCompet();
        $form = $this->createForm('TT\platformBundle\Form\anneCompetType', $anneCompet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($anneCompet);
            $em->flush();

            return $this->redirectToRoute('annecompet_show', array('id' => $anneCompet->getId()));
        }

        return $this->render('annecompet/new.html.twig', array(
            'anneCompet' => $anneCompet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a anneCompet entity.
     *
     */
    public function showAction(anneCompet $anneCompet)
    {
        $deleteForm = $this->createDeleteForm($anneCompet);

        return $this->render('annecompet/show.html.twig', array(
            'anneCompet' => $anneCompet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing anneCompet entity.
     *
     */
    public function editAction(Request $request, anneCompet $anneCompet)
    {
        $deleteForm = $this->createDeleteForm($anneCompet);
        $editForm = $this->createForm('TT\platformBundle\Form\anneCompetType', $anneCompet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($anneCompet);
            $em->flush();

            return $this->redirectToRoute('annecompet_show', array('id' => $anneCompet->getId()));
        }

        return $this->render('annecompet/edit.html.twig', array(
            'anneCompet' => $anneCompet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a anneCompet entity.
     *
     */
    public function deleteAction(Request $request, anneCompet $anneCompet)
    {
        $form = $this->createDeleteForm($anneCompet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($anneCompet);
            $em->flush();
        }

        return $this->redirectToRoute('annecompet_index');
    }

    /**
     * Creates a form to delete a anneCompet entity.
     *
     * @param anneCompet $anneCompet The anneCompet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(anneCompet $anneCompet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('annecompet_delete', array('id' => $anneCompet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
