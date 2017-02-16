<?php

namespace TT\platformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TT\platformBundle\Entity\ResumPost;
use TT\platformBundle\Form\ResumPostType;

/**
 * ResumPost controller.
 *
 */
class ResumPostController extends Controller
{
    /**
     * Lists all ResumPost entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $resumPosts = $em->getRepository('TTplatformBundle:ResumPost')->findAll();

        return $this->render('resumpost/index.html.twig', array(
            'resumPosts' => $resumPosts,
        ));
    }

    /**
     * Creates a new ResumPost entity.
     *
     */
    public function newAction(Request $request)
    {
        $resumPost = new ResumPost();
        $form = $this->createForm('TT\platformBundle\Form\ResumPostType', $resumPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resumPost);
            $em->flush();

            return $this->redirectToRoute('resumpost_show', array('id' => $resumPost->getId()));
        }

        return $this->render('resumpost/new.html.twig', array(
            'resumPost' => $resumPost,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ResumPost entity.
     *
     */
    public function showAction(ResumPost $resumPost)
    {
        $deleteForm = $this->createDeleteForm($resumPost);

        return $this->render('resumpost/show.html.twig', array(
            'resumPost' => $resumPost,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ResumPost entity.
     *
     */
    public function editAction(Request $request, ResumPost $resumPost)
    {
        $deleteForm = $this->createDeleteForm($resumPost);
        $editForm = $this->createForm('TT\platformBundle\Form\ResumPostType', $resumPost);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resumPost);
            $em->flush();

            return $this->redirectToRoute('resumpost_show', array('id' => $resumPost->getId()));
        }

        return $this->render('resumpost/edit.html.twig', array(
            'resumPost' => $resumPost,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ResumPost entity.
     *
     */
    public function deleteAction(Request $request, ResumPost $resumPost)
    {
        $form = $this->createDeleteForm($resumPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($resumPost);
            $em->flush();
        }

        return $this->redirectToRoute('resumpost_index');
    }

    /**
     * Creates a form to delete a ResumPost entity.
     *
     * @param ResumPost $resumPost The ResumPost entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ResumPost $resumPost)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('resumpost_delete', array('id' => $resumPost->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
