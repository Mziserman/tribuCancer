<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle'=>  'Mail de nuit'
        ));
    }

    /**
<<<<<<< HEAD
     * @Route("/lassociation", name="lassociation")
     */
    public function associationAction(Request $request)
    {
        return $this->render('association.html.twig', array(
           'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        'myTitle'=>  'L\'association'
        ));
    }

    /**
     * @Route("/nous-soutenir", name="nous-soutenir")
     */
    public function soutenirAction(Request $request)
    {
        return $this->render('soutenir.html.twig', array(
           'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle'=>  'Nous soutenir'
        ));
    }

    /**
<<<<<<< HEAD
     * @Route("/rompre-lisolement", name="rompre-lisolement")
     */
    public function rompreAction(Request $request)
    {
        return $this->render('rompre.html.twig', array(
           'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
           'myTitle'=>  'Rompre l\'isolement'
        ));
    }

    /**
     * @Route("/sevader", name="sevader")
     */
    public function sevaderAction(Request $request)
    {
        return $this->render('sevader.html.twig', array(
           'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
           'myTitle'=>  'S\'évader'
        ));
    }

    /**
     * @Route("/partenaires", name="partenaires")
     */
    public function partenairesAction(Request $request)
    {
        return $this->render('partenaires.html.twig', array(
           'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
           'myTitle'=>  'Partenaires'
        ));
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        return $this->render('contact.html.twig', array(
           'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
           'myTitle'=>  'Contact'
        ));
    }
}
