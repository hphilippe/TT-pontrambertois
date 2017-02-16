<?php

namespace TT\platformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TT\platformBundle\Entity\Championnat;
use TT\platformBundle\Form\ChampionnatType;

/**
 * Championnat controller.
 *
 */
class ChampionnatController extends Controller
{
    /**
     * Lists all Championnat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $championnats = $em->getRepository('TTplatformBundle:Championnat')->findAll();

        return $this->render('championnat/index.html.twig', array(
            'championnats' => $championnats,
        ));
    }

    /**
     * Creates a new Championnat entity.
     *
     */
    public function newAction(Request $request)
    {
        $championnat = new Championnat();
        $form = $this->createForm('TT\platformBundle\Form\ChampionnatType', $championnat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($championnat);
            $em->flush();

            return $this->redirectToRoute('adminChampionnat_show', array('id' => $championnat->getId()));
        }

        return $this->render('championnat/new.html.twig', array(
            'championnat' => $championnat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Championnat entity.
     *
     */
    public function showAction(Championnat $championnat)
    {
        $deleteForm = $this->createDeleteForm($championnat);

        return $this->render('championnat/show.html.twig', array(
            'championnat' => $championnat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Championnat entity.
     *
     */
    public function editAction(Request $request, Championnat $championnat)
    {
        $deleteForm = $this->createDeleteForm($championnat);
        $editForm = $this->createForm('TT\platformBundle\Form\ChampionnatType', $championnat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($championnat);
            $em->flush();

            return $this->redirectToRoute('adminChampionnat_edit', array('id' => $championnat->getId()));
        }

        return $this->render('championnat/edit.html.twig', array(
            'championnat' => $championnat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Championnat entity.
     *
     */
    public function deleteAction(Request $request, Championnat $championnat)
    {
        $form = $this->createDeleteForm($championnat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($championnat);
            $em->flush();
        }

        return $this->redirectToRoute('adminChampionnat_index');
    }

    /**
     * Creates a form to delete a Championnat entity.
     *
     * @param Championnat $championnat The Championnat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Championnat $championnat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminChampionnat_delete', array('id' => $championnat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
