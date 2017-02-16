<?php

namespace TT\platformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use TT\platformBundle\Entity\BlogComment;
use TT\platformBundle\Form\BlogCommentType;

/**
 * BlogComment controller.
 *
 */
class BlogCommentController extends Controller
{
    /**
     * Lists all BlogComment entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $blogComments = $em->getRepository('TTplatformBundle:BlogComment')->findAll();

        return $this->render('blogcomment/index.html.twig', array(
            'blogComments' => $blogComments,
        ));
    }

    /**
     * Creates a new BlogComment entity.
     *
     */
    public function newAction(Request $request)
    {
        $blogComment = new BlogComment();
        $form = $this->createForm('TT\platformBundle\Form\BlogCommentType', $blogComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blogComment);
            $em->flush();

            return $this->redirectToRoute('blogcomment_show', array('id' => $blogComment->getId()));
        }

        return $this->render('blogcomment/new.html.twig', array(
            'blogComment' => $blogComment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BlogComment entity.
     *
     */
    public function showAction(BlogComment $blogComment)
    {
        $deleteForm = $this->createDeleteForm($blogComment);

        return $this->render('blogcomment/show.html.twig', array(
            'blogComment' => $blogComment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BlogComment entity.
     *
     */
    public function editAction(Request $request, BlogComment $blogComment)
    {
        $deleteForm = $this->createDeleteForm($blogComment);
        $editForm = $this->createForm('TT\platformBundle\Form\BlogCommentType', $blogComment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blogComment);
            $em->flush();

            return $this->redirectToRoute('blogcomment_show', array('id' => $blogComment->getId()));
        }

        return $this->render('blogcomment/edit.html.twig', array(
            'blogComment' => $blogComment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BlogComment entity.
     *
     */
    public function deleteAction(Request $request, BlogComment $blogComment)
    {
        $form = $this->createDeleteForm($blogComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($blogComment);
            $em->flush();
        }

        return $this->redirectToRoute('blogcomment_index');
    }

    /**
     * Creates a form to delete a BlogComment entity.
     *
     * @param BlogComment $blogComment The BlogComment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BlogComment $blogComment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blogcomment_delete', array('id' => $blogComment->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
