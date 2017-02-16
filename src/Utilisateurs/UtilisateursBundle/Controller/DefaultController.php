<?php

namespace Utilisateurs\UtilisateursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //return $this->render('UtilisateursBundle:Default:index.html.twig');
        return $this->render('TTplatformBundle:Default:index.html.twig');
    }
}
