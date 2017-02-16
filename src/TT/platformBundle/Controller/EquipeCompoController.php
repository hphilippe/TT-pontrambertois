<?php

namespace TT\platformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TT\platformBundle\Entity\EquipeCompo;
use TT\platformBundle\Form\EquipeCompoType;

/**
 * EquipeCompo controller.
 *
 */
class EquipeCompoController extends Controller
{
    /**
     * Lists all EquipeCompo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipeCompos = $em->getRepository('TTplatformBundle:EquipeCompo')->findAll();

        return $this->render('equipecompo/index.html.twig', array(
            'equipeCompos' => $equipeCompos,
        ));
    }

    /**
     * Creates a new EquipeCompo entity.
     *
     */
    public function newAction(Request $request)
    {
        $equipeCompo = new EquipeCompo();
        $form = $this->createForm('TT\platformBundle\Form\EquipeCompoType', $equipeCompo);
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        $anneCompets = $em->getRepository('TTplatformBundle:anneCompet')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipeCompo);
            $em->flush();

            return $this->redirectToRoute('equipecompo_show', array('id' => $equipeCompo->getId()));
        }

        return $this->render('equipecompo/new.html.twig', array(
            'equipeCompo' => $equipeCompo,
            'form' => $form->createView(),
            'anneCompets' => $anneCompets,
        ));
    }

    /**
     * Finds and displays a EquipeCompo entity.
     *
     */
    public function showAction(EquipeCompo $equipeCompo)
    {
        $deleteForm = $this->createDeleteForm($equipeCompo);

        return $this->render('equipecompo/show.html.twig', array(
            'equipeCompo' => $equipeCompo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing EquipeCompo entity.
     *
     */
    public function editAction(Request $request, EquipeCompo $equipeCompo)
    {
        $deleteForm = $this->createDeleteForm($equipeCompo);
        $editForm = $this->createForm('TT\platformBundle\Form\EquipeCompoType', $equipeCompo);
        $editForm->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        $anneCompets = $em->getRepository('TTplatformBundle:anneCompet')->findAll();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipeCompo);
            $em->flush();

            return $this->redirectToRoute('equipecompo_show', array('id' => $equipeCompo->getId()));
        }

        return $this->render('equipecompo/edit.html.twig', array(
            'equipeCompo' => $equipeCompo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'anneCompets' => $anneCompets,
        ));
    }

    /**
     * Deletes a EquipeCompo entity.
     *
     */
    public function deleteAction(Request $request, EquipeCompo $equipeCompo)
    {
        $form = $this->createDeleteForm($equipeCompo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipeCompo);
            $em->flush();
        }

        return $this->redirectToRoute('equipecompo_index');
    }

    /**
     * Creates a form to delete a EquipeCompo entity.
     *
     * @param EquipeCompo $equipeCompo The EquipeCompo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EquipeCompo $equipeCompo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('equipecompo_delete', array('id' => $equipeCompo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
