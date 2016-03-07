<?php

// src/AppBundle/Controller/AdminController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Currently;
use AppBundle\Entity\Escape;
use AppBundle\Entity\Isolation;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;

class AdminController extends EasyAdminController
{
    /**
     * @Route("/admin/", name="admin")
     */
    public function indexAction(Request $request)
    {
        return parent::indexAction($request);
    }

}
