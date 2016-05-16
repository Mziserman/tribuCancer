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
            ->findBy(array(), array('position' => 'ASC'), 6);
        $events = $this->container->get('app.slug')->setSlugForEntities($events, $em);

        $archives = $this->getDoctrine()
            ->getRepository('AppBundle:Archive')
            ->findBy(array(), array('position' => 'ASC'), 3);

        $partner = $this->getDoctrine()
                ->getRepository('AppBundle:Partner')
                ->findBy(array(), array('position' => 'ASC'));

        return $this->render('index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle'=>  'Mail de nuit',
            'articles' => $articles,
            'services' => $services,
            'events' => $events,
            'archives' => $archives,
            'partner' => $partner
        ));
    }

    /**
     * @Route("/lassociation", name="lassociation")
     */
    public function associationAction(Request $request)
    {
        $partner = $this->getDoctrine()
                ->getRepository('AppBundle:Partner')
                ->findBy(array(), array('position' => 'ASC'));

        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Association');

        $pdf = $this->get('app.association')
            ->arrayFromRepository($repository);

        return $this->render('association.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle'=>  'L\'association',
            'pdf' => $pdf,
            'partner' => $partner
        ));
    }

    /**
     * @Route("/nous-soutenir", name="nous-soutenir")
     */
    public function soutenirAction(Request $request)
    {
        $partner = $this->getDoctrine()
                ->getRepository('AppBundle:Partner')
                ->findBy(array(), array('position' => 'ASC'));

      return $this->render('soutenir.html.twig', array(
        'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        'myTitle'=> 'Nous soutenir',
        'partner' => $partner
      ));
    }

    /**
     * @Route("/mentions-legales", name="mentions-legales")
     */
    public function mentionsLegalesAction(Request $request)
    {

      return $this->render('mentions-legales.html.twig', array(
        'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        'myTitle'=> 'Mentions légales'
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

        $partner = $this->getDoctrine()
                ->getRepository('AppBundle:Partner')
                ->findBy(array(), array('position' => 'ASC'));


        return $this->render('rompre.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle'=>  'Rompre l\'isolement',
            'services'=> $services,
            'selected' => $selected,
            'partner' => $partner
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

        $partner = $this->getDoctrine()
                ->getRepository('AppBundle:Partner')
                ->findBy(array(), array('position' => 'ASC'));

        return $this->render('sevader.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle'=>  'S\'évader',
            'events' => $events,
            'selected' => $selected,
            'partner' => $partner
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
            'noText' => $noTextPartner,
            'partner' => $partners
        ));
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction(Request $request)
    {
        $partner = $this->getDoctrine()
                ->getRepository('AppBundle:Partner')
                ->findBy(array(), array('position' => 'ASC'));

        if ( !empty($request->query->get('last-name')) &&
        !empty($request->query->get('first-name')) &&
        !empty($request->query->get('email')) &&
        !empty($request->query->get('message')) ) {

            $message = \Swift_Message::newInstance()
                ->setSubject('Tribu Cancer : Demande de contact de la part de '.$request->query->get('last-name').$request->query->get('first-name'))
                ->setFrom($request->query->get('email'))
                ->setTo('boris.laporte@gmail.com')
                ->setBody($request->query->get('message'));
            $this->get('mailer')->send($message);
            

            return $this->redirect($this->generateUrl(
                'contact_confirm' )
            );
        }

      return $this->render('contact.html.twig', array(
       'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
       'myTitle'=>  'Contact',
       'partner' => $partner
      ));
    }

    /**
     * @Route("/contact_confirm", name="contact_confirm")
     */
    public function contactConfirmAction(Request $request)
    {
        $partner = $this->getDoctrine()
                ->getRepository('AppBundle:Partner')
                ->findBy(array(), array('position' => 'ASC'));

      return $this->render('contactConfirm.html.twig', array(
       'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
       'myTitle'=>  'ContactConfirm',
       'partner' => $partner
      ));
    }

    /**
    * @Route("/actualite/{id}", name="actualite")
    */
    public function actualiteAction(Request $request, $id)
    {
        $partner = $this->getDoctrine()
                ->getRepository('AppBundle:Partner')
                ->findBy(array(), array('position' => 'ASC'));

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
            'partner' => $partner
        ));
    }

    /**
    * @Route("/archive/{id}", name="archive")
    */
    public function archiveAction(Request $request, $id)
    {
        $partner = $this->getDoctrine()
                ->getRepository('AppBundle:Partner')
                ->findBy(array(), array('position' => 'ASC'));

        $archive = $this->getDoctrine()
            ->getRepository('AppBundle:Archive')
            ->find($id);

        $autreArchives = $this->getDoctrine()
            ->getRepository('AppBundle:Archive')
            ->findAll();

        return $this->render('archive_template.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle' =>  'Archive',
            'archive' =>  $archive,
            'autreArchives' => $autreArchives,
            'partner' => $partner
        ));
    }

    /**
    * @Route("/archives", name="archives")
    */
    public function archivesAction(Request $request)
    {
        $partner = $this->getDoctrine()
                ->getRepository('AppBundle:Partner')
                ->findBy(array(), array('position' => 'ASC'));

        $archives = $this->getDoctrine()
            ->getRepository('AppBundle:Archive')
            ->findAll();

        return $this->render('articles_list_template.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle' =>  'Archive',
            'archives' => $archives,
            'partner' => $partner
        ));
    }

    /**
    * @Route("/actualites", name="actualites")
    */
    public function articlesAction(Request $request)
    {
        $partner = $this->getDoctrine()
                ->getRepository('AppBundle:Partner')
                ->findBy(array(), array('position' => 'ASC'));

        $articles = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->findAll();

        return $this->render('articles_list_template.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'myTitle' =>  'Archive',
            'articles' => $articles,
            'partner' => $partner
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
