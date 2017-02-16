<?php

namespace TT\platformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use TT\platformBundle\Entity\BlogComment;
use TT\platformBundle\Form\BlogCommentType;

use TT\platformBundle\Entity\ResumPost;
use TT\platformBundle\Form\ResumPostType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $blogPosts = $em->getRepository('TTplatformBundle:BlogPost')->byCategorieLimit();
        //$blogPosts = $em->getRepository('TTplatformBundle:BlogPost')->findAll();
        $anneCompets = $em->getRepository('TTplatformBundle:anneCompet')->findBy(array('visibilite' => 1));
        $matchCompets = $em->getRepository('TTplatformBundle:matchCompet')->findAll();
        $resumPosts = $em->getRepository('TTplatformBundle:ResumPost')->findAll();
        $equipeCompos = $em->getRepository('TTplatformBundle:EquipeCompo')->findAll();
        $DistinctEquipes = $em->getRepository('TTplatformBundle:matchCompet')->byDistinctEquipe();
        
        $championnats = $em->getRepository('TTplatformBundle:Championnat')->findAll();
        
        return $this->render('TTplatformBundle:Default:index.html.twig', array(
            'blogPosts' => $blogPosts,
            'anneCompets' => $anneCompets,
            'matchCompets' => $matchCompets,
            'resumPosts' => $resumPosts,
            'DistinctEquipes' => $DistinctEquipes,
            'equipeCompos' => $equipeCompos,
            'championnats' => $championnats,
        ));
    }
    
    public function inscriptionAction()
    {
        $em = $this->getDoctrine()->getManager();

        $inscriptions = $em->getRepository('TTplatformBundle:Inscription')->findAll();
        
        return $this->render('TTplatformBundle:Inscription:inscription.html.twig', array(
            'inscriptions' => $inscriptions,
        ));
    }
    
    public function bureauAction()
    {
        $em = $this->getDoctrine()->getManager();
        $bureaus = $em->getRepository('TTplatformBundle:Bureau')->findAll();
        
        return $this->render('TTplatformBundle:Club:bureau.html.twig', array(
            'bureaus' => $bureaus,
        ));
    }
    
    public function historiqueAction()
    {
        return $this->render('TTplatformBundle:Club:historique.html.twig');
    }
    
    public function reglementClubAction()
    {
        return $this->render('TTplatformBundle:Club:reglementClub.html.twig');
    }
    
    public function multimediaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $multimedias = $em->getRepository('TTplatformBundle:Multimedia')->findAll();
        
        return $this->render('TTplatformBundle:Club:multimedia.html.twig', array(
            'multimedias' => $multimedias,
        ));
    }
    
    public function entrainementAction()
    {
        return $this->render('TTplatformBundle:Entrainement:entrainement.html.twig');
    }
    
    public function championnatAction()
    {
        $em = $this->getDoctrine()->getManager();
        $anneCompets = $em->getRepository('TTplatformBundle:anneCompet')->findBy(array('visibilite' => 1));
        $matchCompets = $em->getRepository('TTplatformBundle:matchCompet')->findAll();
        $resumPosts = $em->getRepository('TTplatformBundle:ResumPost')->findAll();
        $equipeCompos = $em->getRepository('TTplatformBundle:EquipeCompo')->findAll();
        $DistinctEquipes = $em->getRepository('TTplatformBundle:matchCompet')->byDistinctEquipe();
        
        $championnats = $em->getRepository('TTplatformBundle:Championnat')->findAll();
        
        return $this->render('TTplatformBundle:Competition:championnat.html.twig', array(
            'anneCompets' => $anneCompets,
            'matchCompets' => $matchCompets,
            'resumPosts' => $resumPosts,
            'DistinctEquipes' => $DistinctEquipes,
            'equipeCompos' => $equipeCompos,
            'championnats' => $championnats,
        ));

    }
    
    public function tournoisAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBlogPosts = $em->getRepository('TTplatformBundle:BlogPost')->byCategorie('tournois');
        $blogComments = $em->getRepository('TTplatformBundle:BlogComment')->findAll();
       
        $paginator = $this->get('knp_paginator');
        $blogPosts = $paginator->paginate(
                $queryBlogPosts, /* query NOT result */ 
                $request->query->getInt('page', 1)/* page number */, 
                1/* limit per page */
        );
        
        // comment
        $blogComment = new BlogComment();
        $form = $this->createForm('TT\platformBundle\Form\BlogCommentType', $blogComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blogComment);
            $em->flush();
            
            return $this->redirectToRoute('tournois');
        }
        // fin comment
        
        return $this->render('TTplatformBundle:Competition:tournois.html.twig', array(
            'blogPosts' => $blogPosts,
            'blogComments' => $blogComments,
            'blogComment' => $blogComment,
            'form' => $form->createView(),
        ));
    }
    
    public function stagesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBlogPosts = $em->getRepository('TTplatformBundle:BlogPost')->byCategorie('stages');
        $blogComments = $em->getRepository('TTplatformBundle:BlogComment')->findAll();
       
        $paginator = $this->get('knp_paginator');
        $blogPosts = $paginator->paginate(
                $queryBlogPosts, /* query NOT result */ 
                $request->query->getInt('page', 1)/* page number */, 
                1/* limit per page */
        );
        
        // comment
        $blogComment = new BlogComment();
        $form = $this->createForm('TT\platformBundle\Form\BlogCommentType', $blogComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blogComment);
            $em->flush();
            
            return $this->redirectToRoute('stages');
        }
        // fin comment
        
        return $this->render('TTplatformBundle:Competition:stages.html.twig', array(
            'blogPosts' => $blogPosts,
            'blogComments' => $blogComments,
            'blogComment' => $blogComment,
            'form' => $form->createView(),
        ));
        
    }
    
    public function reglementArbitreAction()
    {
        return $this->render('TTplatformBundle:Competition:reglementArbitre.html.twig');
    }
    
    public function classementAction()
    {
        return $this->render('TTplatformBundle:Competition:classement.html.twig');
    }
    
    public function sponsorsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sponsors = $em->getRepository('TTplatformBundle:Sponsor')->findAll();
        
        return $this->render('TTplatformBundle:Sponsors:sponsors.html.twig', array(
            'sponsors' => $sponsors,
        ));
    }
    
    public function adminMultimediaAction()
    {
        return $this->render('TTplatformBundle:Club:adminMultimedia.html.twig');
    }
    
    public function contactAction()
    {
        return $this->render('TTplatformBundle:Contact:contact.html.twig');
    }
    
    public function actualiteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBlogPosts = $em->getRepository('TTplatformBundle:BlogPost')->byCategorie('actualites');
        $blogComments = $em->getRepository('TTplatformBundle:BlogComment')->findAll();
       
        $paginator = $this->get('knp_paginator');
        $blogPosts = $paginator->paginate(
                $queryBlogPosts, /* query NOT result */ 
                $request->query->getInt('page', 1)/* page number */, 
                1/* limit per page */
        );
        
        // comment
        $blogComment = new BlogComment();
        $form = $this->createForm('TT\platformBundle\Form\BlogCommentType', $blogComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blogComment);
            $em->flush();
            
            return $this->redirectToRoute('actualite');
        }
        // fin comment
        
        return $this->render('TTplatformBundle:Club:actualite.html.twig', array(
            'blogPosts' => $blogPosts,
            'blogComments' => $blogComments,
            'blogComment' => $blogComment,
            'form' => $form->createView(),
        ));
    }
    
    public function administrationAction()
    {
        return $this->render('TTplatformBundle:Club:administration.html.twig');
    }
    
    public function listeUserAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        
        return $this->render('TTplatformBundle:Club:listeUser.html.twig', array(
            'users' =>   $users,
        ));
    }
    
    public function promoteUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository("UtilisateursBundle:User")->find($id);
        $user->addRole("ROLE_ADMIN");

        $em->persist($user);
        $em->flush();
        
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        
        return $this->render('TTplatformBundle:Club:listeUser.html.twig', array(
            'users' =>   $users,
        ));
    }
    
    public function demoteUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository("UtilisateursBundle:User")->find($id);
        $user->removeRole("ROLE_ADMIN");

        $em->persist($user);
        $em->flush();
        
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        
        return $this->render('TTplatformBundle:Club:listeUser.html.twig', array(
            'users' =>   $users,
        ));
    }
    
    public function deleteUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository("UtilisateursBundle:User")->find($id);

        $em->remove($user);
        $em->flush();
        
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        
        return $this->render('TTplatformBundle:Club:listeUser.html.twig', array(
            'users' =>   $users,
        ));
    }
    
    public function adminResumMatchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $anneCompets = $em->getRepository('TTplatformBundle:anneCompet')->findAll();
        $matchCompets = $em->getRepository('TTplatformBundle:matchCompet')->findAll();
        $resumPosts = $em->getRepository('TTplatformBundle:ResumPost')->findAll();
        $equipeCompos = $em->getRepository('TTplatformBundle:EquipeCompo')->findAll();
        $DistinctEquipes = $em->getRepository('TTplatformBundle:matchCompet')->byDistinctEquipe();
        
        //form
        $resumPost = new ResumPost();
        $form = $this->createForm('TT\platformBundle\Form\ResumPostType', $resumPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($resumPost);
            $em->flush();

            return $this->redirectToRoute('resumpost_show', array('id' => $resumPost->getId()));
        }
        //form
        
        return $this->render('TTplatformBundle:Club:adminResumMatch.html.twig', array(
            'anneCompets' => $anneCompets,
            'matchCompets' => $matchCompets,
            'resumPosts' => $resumPosts,
            'resumPost' => $resumPost,
            'DistinctEquipes' => $DistinctEquipes,
            'form' => $form->createView(),
            'equipeCompos' => $equipeCompos,
        ));
    }
}
