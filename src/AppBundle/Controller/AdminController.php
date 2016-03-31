<?php

// src/AppBundle/Controller/AdminController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Currently;
use AppBundle\Entity\Escape;
use AppBundle\Entity\Isolation;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;
use AppBundle\Entity\Pdf;

class AdminController extends EasyAdminController
{
    /**
     * @Route("/admin/", name="admin")
     */
    public function indexAction(Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * @param object $entity
     * @param array $entityProperties
     * @return \Symfony\Component\Form\Form
     */
    public function createEditForm($entity, array $entityProperties)
    {
        $editForm = parent::createEditForm($entity, $entityProperties);

        if ($entity instanceof Pdf) {
            // the trick is to remove the default field and then
            // add the customized field
            $editForm->remove('color');
            $editForm->add('color', 'choice', array('choices' => array(
                'Rouge',
                'Bleu',
                'Gris'
            )));
        }

        return $editForm;
    }

}
