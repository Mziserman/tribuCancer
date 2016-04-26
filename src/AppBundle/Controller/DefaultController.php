<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
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
      return $this->render('index.html.twig', array(
        'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        'myTitle'=>  'Mail de nuit'
      ));
    }

    /**
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
        $repository = $this->getDoctrine()->getRepository('AppBundle:Partner');

        $partners = $repository->findAll();
        $textPartner = [];
        $noTextPartner = [];

        for ($i = 0; $i < count($partners); $i++) {
            if ($partners[$i]->getBody()) {
                array_push($textPartner, $partners[$i]);
            } else {
                array_push($noTextPartner, $partners[$i]);
            }
        }

        return $this->render('partenaires.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle'=>  'Partenaires',
            'text' => $textPartner,
            'noText' => $noTextPartner
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

    /**
    * @Route("/actualite/{id}", name="actualite")
    */
    public function actualiteAction(Request $request, $id)
    {
        $article = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->find($id);

        $autreArticles = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->findAll(
                array("position" => "DESC")
            );
        /*for($i = 0; $i < 4; $i++) {
            if ($autreArticles[$i]->getId() == $id) {
                $temp = array_splice($autreArticles, $i);
                dump($temp);
                dump($autreArticles);
            }
        }*/
        array_splice($autreArticles, 3);
        return $this->render('actu_template.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle' =>  'Actualite',
            'article' =>  $article,
            'autreArticles' => $autreArticles,
        ));
    }
}
