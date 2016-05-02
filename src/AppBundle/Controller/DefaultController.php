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
        $em = $this->getDoctrine()->getManager();

        $articles = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->findBy(array(), array('position' => 'ASC'), 3);
        $services = $this->getDoctrine()
            ->getRepository('AppBundle:Service')
            ->findBy(array(), array('position' => 'ASC'), 3);
        $services = $this->container->get('app.slug')->setSlugForEntities($services, $em);

        $events = $this->getDoctrine()
            ->getRepository('AppBundle:Event')
            ->findBy(array(), array('position' => 'ASC'), 4);
        $events = $this->container->get('app.slug')->setSlugForEntities($events, $em);

        $archives = $this->getDoctrine()
            ->getRepository('AppBundle:Archive')
            ->findBy(array(), array('position' => 'ASC'), 3);

        return $this->render('index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle'=>  'Mail de nuit',
            'articles' => $articles,
            'services' => $services,
            'events' => $events,
            'archives' => $archives
        ));
    }

    /**
     * @Route("/lassociation", name="lassociation")
     */
    public function associationAction(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Association');

        $pdf = $this->get('app.association')
            ->arrayFromRepository($repository);

        return $this->render('association.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle'=>  'L\'association',
            'pdf' => $pdf
        ));
    }

    /**
     * @Route("/nous-soutenir", name="nous-soutenir")
     */
    public function soutenirAction(Request $request)
    {
      return $this->render('soutenir.html.twig', array(
        'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        'myTitle'=> 'Nous soutenir'
      ));
    }

    /**
     * @Route("/rompre-lisolement", name="rompre-lisolement")
     */
    public function rompreAction(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository("AppBundle:Service");

        $services = $this->get("app.service")->arrayFromRepository($repository);

        $session = $request->getSession();
        $selected = $session->get("rompre-lisolement");
        $session->invalidate();

        return $this->render('rompre.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle'=>  'Rompre l\'isolement',
            'services'=> $services,
            'selected' => $selected
        ));
    }

    /**
     * @Route("/sevader", name="sevader")
     */
    public function sevaderAction(Request $request)
    {
        $repository = $this
            ->getDoctrine()
            ->getRepository("AppBundle:Event");

        $events = $this->get("app.event")->arrayFromRepository($repository);

        $session = $request->getSession();
        $selected = $session->get("sevader");
        $session->invalidate();

        return $this->render('sevader.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle'=>  'S\'évader',
            'events' => $events,
            'selected' => $selected
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
            ->findAll();

        // for($i = 0; $i < 5; $i++) {
        //     echo $autreArticles[$i]->getId();
        //     if ($autreArticles[$i]->getId() == $id) {

        //         $temp = array_splice($autreArticles, $i);

        //     }
        //     dump($temp);
        // }

        return $this->render('actu_template.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle' =>  'Actualite',
            'article' =>  $article,
            'autreArticles' => $autreArticles,
        ));
    }

    /**
     * @Route("redirect/{page}/{slug}", name="redirect")
     */
    public function redirectServiceAction(Request $request, $page, $slug)
    {
        $session = $request->getSession();
        $session->set($page, $slug);

        return $this->redirectToRoute($page);
    }
}
