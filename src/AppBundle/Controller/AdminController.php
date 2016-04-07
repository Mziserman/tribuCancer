<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Pdf;
use AppBundle\Form\PdfType;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use AppBundle\Entity\Archive;
use AppBundle\Form\ArchiveType;
use AppBundle\Entity\Partner;
use AppBundle\Form\PartnerType;
use AppBundle\Entity\Event;
use AppBundle\Form\EventType;
use AppBundle\Entity\Service;
use AppBundle\Form\ServiceType;
use AppBundle\Entity\Association;
use AppBundle\Form\AssociationType;



/**
* @Route("/admin")
*/
class AdminController extends Controller
{

    /**
     * @Route("/404", name="admin_404")
     */
    public function admin404(Request $request)
    {
      return $this->render('AppBundle:Admin:404.html.twig', array(
        'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        'myTitle'=>  'Page introuvable',
      ));
    }

    /**
     * @Route("/", name="admin_accueil")
     */
    public function indexAction(Request $request)
    {
      return $this->render('AppBundle:Admin:index.html.twig', array(
        'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        'myTitle'=>  'Administration'
      ));
    }

    /**
     * @Route("/{slug}", name="admin_list")
     */
    public function listAction(Request $request, $slug)
    {
      return $this->render('AppBundle:Admin:list.html.twig', array(
        'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        'myTitle'=>  'Liste de données'
      ));
    }

    /**
     * @Route("/{slug}/create", name="admin_create")
     */
    public function createAction(Request $request, $slug) 
	{
		// SECTION WHERE WE DETECT ENTITY

		switch ($slug) {
		    case 'association':
		    	$entity = new Association();
		    	$title = 'Nouveau Pdf sur l\'association';
		    	$repository = 'AppBundle:Association';
		        $form = $this->createForm(AssociationType::class, $entity);
		        break;
		    case 'service':
		    	$entity = new Service();
		    	$title = 'Nouveau service pour rompre l\'isolement';
		    	$repository = 'AppBundle:Service';
		        $form = $this->createForm(ServiceType::class, $entity);
		        break;
		    case 'event':
		    	$entity = new Event();
		    	$title = 'Nouvelle activité pour rompre l\'isolement';
		    	$repository = 'AppBundle:Event';
		        $form = $this->createForm(EventType::class, $entity);
		        break;
		    case 'partner':
		    	$entity = new Partner();
		    	$title = 'Nouveau partenaire';
		    	$repository = 'AppBundle:Partner';
		        $form = $this->createForm(PartnerType::class, $entity);
		        break;
		    case 'article':
		    	$entity = new Article();
		    	$title = 'Nouvel article';
		    	$repository = 'AppBundle:Article';
		        $form = $this->createForm(ArticleType::class, $entity);
		        break;
		    case 'archive':
		    	$entity = new Archive();
		    	$title = 'Nouvel archive';
		    	$repository = 'AppBundle:Archive';
		        $form = $this->createForm(ArchiveType::class, $entity);
		        break;
		    default:
		    	return $this->redirect($this->generateUrl('admin_404'));
		}

		$form->add('submit', SubmitType::class, array(
		            'label' => 'Create',
		            'attr'  => array('class' => 'btn btn-default pull-right')
		        ));

        //SECTION WHERE WE RECEIVE THE DATA FORM

        $form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {

	        $em = $this->getDoctrine()->getManager();

	        $this->prePersist($entity, $repository);

	        $em->persist($entity);
	        $em->flush();

	        // REDIRECTION TO THE LIST OF DATA
	        return $this->redirect($this->generateUrl(
	            'admin_list',
	            array('slug' => $entity->getClass() )
	        ));
	    }

	    // SECTION WHERE WE RENDER THE TEMPLATE CREATE

		return $this->render('AppBundle:Admin:create.html.twig', array(
			'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
			'myTitle'=>  $title,
			'slug' => $slug,
			'form' => $form->createView()
		));
    }

    /**
     * @Route("/{slug}/edit", name="admin_edit")
     */
    public function editAction(Request $request, $slug)
    {
      return $this->render('AppBundle:Admin:edit.html.twig', array(
        'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        'myTitle'=>  'Modification de données',
      ));
    }


    //FIN DES ROUTES

    //FONCTIONS DIVERSES

    public function prePersist($entity, $repository)
    {
    	if ( isset($entity->pdf) ){
    		$position = $entity->getPosition();
        	$this->positionUpdateAuto($entity, $position, $repository);
    	}   
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


    /**
     * @Route("/test/test/test", name="admin_test")
     */
    public function testAction(Request $request)
    {
    	$test = $this->getDoctrine()
        ->getRepository('AppBundle:Article')
        ->findAll();

        $superTest = $test[2]->getPdf();
        dump($superTest);
  		die;
    }
}
