<?php

namespace TT\platformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TT\platformBundle\Entity\matchCompet;
use TT\platformBundle\Form\matchCompetType;

/**
 * matchCompet controller.
 *
 */
class matchCompetController extends Controller
{
    /**
     * Lists all matchCompet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $matchCompets = $em->getRepository('TTplatformBundle:matchCompet')->findAll();

        return $this->render('matchcompet/index.html.twig', array(
            'matchCompets' => $matchCompets,
        ));
    }

    /**
     * Creates a new matchCompet entity.
     *
     */
    public function newAction(Request $request)
    {
        $matchCompet = new matchCompet();
        $form = $this->createForm('TT\platformBundle\Form\matchCompetType', $matchCompet);
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        $anneCompets = $em->getRepository('TTplatformBundle:anneCompet')->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($matchCompet);
            $em->flush();

            return $this->redirectToRoute('matchcompet_show', array('id' => $matchCompet->getId()));
        }

        return $this->render('matchcompet/new.html.twig', array(
            'matchCompet' => $matchCompet,
            'form' => $form->createView(),
            'anneCompets' => $anneCompets,
        ));
    }

    /**
     * Finds and displays a matchCompet entity.
     *
     */
    public function showAction(matchCompet $matchCompet)
    {
        $deleteForm = $this->createDeleteForm($matchCompet);

        return $this->render('matchcompet/show.html.twig', array(
            'matchCompet' => $matchCompet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing matchCompet entity.
     *
     */
    public function editAction(Request $request, matchCompet $matchCompet)
    {
        $deleteForm = $this->createDeleteForm($matchCompet);
        $editForm = $this->createForm('TT\platformBundle\Form\matchCompetType', $matchCompet);
        $editForm->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        $anneCompets = $em->getRepository('TTplatformBundle:anneCompet')->findAll();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($matchCompet);
            $em->flush();

            return $this->redirectToRoute('matchcompet_show', array('id' => $matchCompet->getId()));
        }

        return $this->render('matchcompet/edit.html.twig', array(
            'matchCompet' => $matchCompet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'anneCompets' => $anneCompets,
        ));
    }

    /**
     * Deletes a matchCompet entity.
     *
     */
    public function deleteAction(Request $request, matchCompet $matchCompet)
    {
        $form = $this->createDeleteForm($matchCompet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($matchCompet);
            $em->flush();
        }

        return $this->redirectToRoute('matchcompet_index');
    }

    /**
     * Creates a form to delete a matchCompet entity.
     *
     * @param matchCompet $matchCompet The matchCompet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(matchCompet $matchCompet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('matchcompet_delete', array('id' => $matchCompet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
