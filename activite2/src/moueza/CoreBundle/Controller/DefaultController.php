<?php

namespace moueza\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('mouezaCoreBundle:Default:index.html.twig');
    }
}
