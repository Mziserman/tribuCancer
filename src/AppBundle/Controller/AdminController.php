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
use AppBundle\Entity\Article;

class AdminController extends EasyAdminController
{
    /**
     * @Route("/", name="easyadmin")
     * @Route("/", name="admin")
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

    public function positionUpdateAuto($entity, $position, $repository)
    {
        $nextEntity = $this->getDoctrine()
        ->getRepository($repository)
        ->findByPosition($position);

        if ( !empty($nextEntity) ){
            $this->positionUpdateAuto($nextEntity, ( $position + 1 ), $repository);
        }

        if ( gettype($entity) != "array" ){
            $entity->setPosition($position);
        } else {
            $entity[0]->setPosition($position);
        }
        
    }

    public function prePersistArticleEntity($entity)
    {
        $repository = 'AppBundle:Article';
        $position = $entity->getPosition();
        $this->positionUpdateAuto($entity, $position, $repository);
    }

    public function preUpdateArticleEntity($entity)
    {
        $repository = 'AppBundle:Article';
        $position = $entity->getPosition();
        $this->positionUpdateAuto($entity, $position, $repository);
    }
}
