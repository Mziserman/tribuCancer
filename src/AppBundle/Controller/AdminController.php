<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Article;
use AppBundle\Form\create\ArticleType as ArticleCreate;
use AppBundle\Form\edit\ArticleType as ArticleEdit;
use AppBundle\Entity\Archive;
use AppBundle\Form\create\ArchiveType as ArchiveCreate;
use AppBundle\Form\edit\ArchiveType as ArchiveEdit;
use AppBundle\Entity\Partner;
use AppBundle\Form\create\PartnerType as PartnerCreate;
use AppBundle\Form\edit\PartnerType as PartnerEdit;
use AppBundle\Entity\Event;
use AppBundle\Form\create\EventType as EventCreate;
use AppBundle\Form\edit\EventType as EventEdit;
use AppBundle\Entity\Service;
use AppBundle\Form\create\ServiceType as ServiceCreate;
use AppBundle\Form\edit\ServiceType as ServiceEdit;
use AppBundle\Entity\Association;
use AppBundle\Form\create\AssociationType as AssociationCreate;
use AppBundle\Form\edit\AssociationType as AssociationEdit;



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

        // SECTION WHERE WE DETECT ENTITY

        switch ($slug) {
            case 'association':
                $title = 'Liste des pdf de l\'association';
                $repository = 'AppBundle:Association';
                break;
            case 'service':
                $title = 'Liste des services pour rompre l\'isolement';
                $repository = 'AppBundle:Service';
                break;
            case 'event':
                $title = 'Liste des activités pour s\'évader ';
                $repository = 'AppBundle:Event';
                break;
            case 'partner':
                $title = 'Liste des partenaires';
                $repository = 'AppBundle:Partner';
                break;
            case 'article':
                $title = 'Liste des articles';
                $repository = 'AppBundle:Article';
                break;
            case 'archive':
                $title = 'Liste des archives';
                $repository = 'AppBundle:Archive';
                break;
            default:
                return $this->redirect($this->generateUrl('admin_404'));
        }

        $entities = $this->getDoctrine()
          ->getRepository($repository)
          ->findAll();

        // SECTION WHERE WE RENDER THE TEMPLATE CREATE

        return $this->render('AppBundle:Admin:list.html.twig', array(
          'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
          'myTitle'=>  $title,
          'slug' => $slug,
          'data' => $entities 
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
  		        $form = $this->createForm(AssociationCreate::class, $entity);
  		        break;
  		    case 'service':
  		    	$entity = new Service();
  		    	$title = 'Nouveau service pour rompre l\'isolement';
  		    	$repository = 'AppBundle:Service';
  		        $form = $this->createForm(ServiceCreate::class, $entity);
  		        break;
  		    case 'event':
  		    	$entity = new Event();
  		    	$title = 'Nouvelle activité pour s\'évader ';
  		    	$repository = 'AppBundle:Event';
  		        $form = $this->createForm(EventCreate::class, $entity);
  		        break;
  		    case 'partner':
  		    	$entity = new Partner();
  		    	$title = 'Nouveau partenaire';
  		    	$repository = 'AppBundle:Partner';
  		        $form = $this->createForm(PartnerCreate::class, $entity);
  		        break;
  		    case 'article':
  		    	$entity = new Article();
  		    	$title = 'Nouvel article';
  		    	$repository = 'AppBundle:Article';
  		        $form = $this->createForm(ArticleCreate::class, $entity);
  		        break;
  		    case 'archive':
  		    	$entity = new Archive();
  		    	$title = 'Nouvel archive';
  		    	$repository = 'AppBundle:Archive';
  		        $form = $this->createForm(ArchiveCreate::class, $entity);
  		        break;
  		    default:
  		    	return $this->redirect($this->generateUrl('admin_404'));
  		}

		  $form->add('submit', SubmitType::class, array(
            'label' => 'Créer !',
            'attr'  => array('class' => 'btn-create')
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
     * @Route("/{slug}/edit/{id}", name="admin_edit")
     */
    public function editAction(Request $request, $slug, $id)
    {

        switch ($slug) {
            case 'association':
                $title = 'Edit Pdf sur l\'association';
                $repository = 'AppBundle:Association';
                $entity = $this->getDoctrine()
                    ->getRepository($repository)
                    ->find($id);
                $form = $this->createForm(AssociationEdit::class, $entity);
                break;
            case 'service':
                $title = 'Edit service pour rompre l\'isolement';
                $repository = 'AppBundle:Service';
                $entity = $this->getDoctrine()
                    ->getRepository($repository)
                    ->find($id);
                $form = $this->createForm(ServiceEdit::class, $entity);
                break;
            case 'event':
                $title = 'Edit activité pour s\'évader ';
                $repository = 'AppBundle:Event';
                $entity = $this->getDoctrine()
                    ->getRepository($repository)
                    ->find($id);
                $form = $this->createForm(EventEdit::class, $entity);
                break;
            case 'partner':
                $title = 'Edit partenaire';
                $repository = 'AppBundle:Partner';
                $entity = $this->getDoctrine()
                    ->getRepository($repository)
                    ->find($id);
                $form = $this->createForm(PartnerEdit::class, $entity);
                break;
            case 'article':
                $title = 'Edit article';
                $repository = 'AppBundle:Article';
                $entity = $this->getDoctrine()
                    ->getRepository($repository)
                    ->find($id);
                $form = $this->createForm(ArticleEdit::class, $entity);
                break;
            case 'archive':
                $title = 'Edit archive';
                $repository = 'AppBundle:Archive';
                $entity = $this->getDoctrine()
                    ->getRepository($repository)
                    ->find($id);
                $form = $this->createForm(ArchiveEdit::class, $entity);
                break;
            default:
                return $this->redirect($this->generateUrl('admin_404'));
        }

        $oldPdf = null;
        if ( $slug != "partner"){
          $oldPdf = $entity->getPdf();
        }

        $form->add('submit', SubmitType::class, array(
            'label' => 'Modifier',
            'attr'  => array('class' => 'btn-create')
        ));

        $oldPosition = null;
        if ( is_callable(array($entity, 'getPosition')) ){
            $oldPosition = $entity->getPosition();
        }

        //SECTION WHERE WE RECEIVE THE DATA FORM

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $this->perPersistEdit($entity, $oldPdf, $em);

            $this->prePersist($entity, $repository, $oldPosition, $em, $oldPdf);


            $em->persist($entity);
            $em->flush();
            // REDIRECTION TO THE LIST OF DATA
            return $this->redirect($this->generateUrl(
                'admin_list',
                array('slug' => $entity->getClass() )
            ));
        }
        //dump($form->createView());die;
      return $this->render('AppBundle:Admin:edit.html.twig', array(
        'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
          'myTitle'=>  $title,
          'slug' => $slug,
          'form' => $form->createView()
      ));
    }


    /**
     * @Route("/{slug}/delete/{id}", name="admin_delete" )
     */
    public function deleteAction(Request $request, $slug, $id)
    {
        $status;
        $em = $this->getDoctrine()->getEntityManager();

        switch ($slug) {
            case 'association':
                $repository = 'AppBundle:Association';
                $entity = $em->getRepository($repository)
                    ->find($id);

                break;
            case 'service':
                $repository = 'AppBundle:Service';
                $entity = $em->getRepository($repository)
                    ->find($id);
                break;
            case 'event':
                $repository = 'AppBundle:Event';
                $entity = $em->getRepository($repository)
                    ->find($id);
                break;
            case 'partner':
                $repository = 'AppBundle:Partner';
                $entity = $em->getRepository($repository)
                    ->find($id);
                break;
            case 'article':
                $title = 'Edit article';
                $repository = 'AppBundle:Article';
                $entity = $em->getRepository($repository)
                    ->find($id);
                break;
            case 'archive':
                $repository = 'AppBundle:Archive';
                $entity = $em->getRepository($repository)
                    ->find($id);
                break;
            default:
                return new Response("false");
                
        }
        if ( $entity != null ){
            $position = $entity->getPosition();
            $this->positionUpdateEmpty($position, $repository);
            $em->remove($entity);
            $em->flush();
            return new Response("true");
        } else {
            return new Response("false");
        }
    }


    //FIN DES ROUTES

    //FONCTIONS DIVERSES

    public function prePersist($entity, $repository, $oldPosition = null, $em = null, $oldPdf = null)
    {
      if ( is_callable(array($entity, 'getPosition')) ){
        $position = $entity->getPosition();
            if ( ($oldPosition != null) && ($em != null) && ($position > $oldPosition) ){
                $this->positionUpdateEmpty($oldPosition, $repository);
                $em->persist($entity);
                $em->flush();
            }
            $this->positionUpdateAuto($entity, $position, $repository, $oldPosition);
      }
      if ( (is_callable(array($entity, 'getPdf'))) && !empty($entity->getPdf()) ){
        $this->positionUpdateAuto_Pdf($entity, $oldPdf);
      }
    }

    public function perPersistEdit($entity, $oldPdf, $em)
    {
      for ($i = 0; $i < count($oldPdf); $i++ ) {
        if ( !array_key_exists( $i , $entity->getPdf()) ){
          $em->remove($oldPdf[$i]);
        }
      }
    }

    // Check if there any other entity of the same class at position given,
    // and if yes set the others to lower position one by one
    public function positionUpdateAuto($entity, $position, $repository, $oldPosition = null)
    {
        $nextEntity = $this->getDoctrine()
          ->getRepository($repository)
          ->findByPosition($position);
        
        if ( !empty($nextEntity) && $oldPosition != $position){
            $this->positionUpdateAuto($nextEntity, ( $position + 1 ), $repository, $oldPosition);
        }
        if ( gettype($entity) != "array" ){
            $entity->setPosition($position);
        } else {
            $entity[0]->setPosition($position);
        } 
    }

    public function positionUpdateEmpty($position, $repository)
    {
        $allEntities = $this->getDoctrine()
          ->getRepository($repository)
          ->findAll();

        foreach ($allEntities as $key => $value) {
            $otherPosition = $value->getPosition();
            if ( $otherPosition > $position  ){
                $value->setPosition($otherPosition - 1);
            }
        }
    }


    // Regulate the pdf positions
    // for example if there 1 3 4, will convert TO 1 2 3 or even 4 2 2 TO 3 1 2
    public function positionUpdateAuto_Pdf($entity, $oldPdf = null)
    {
      $pdfs = $entity->getPdf();
      $tri = [];
      $index = 0;
      foreach ($pdfs as $key=>$value) {
        if ( $key != $index ){
          $pdfs[$index] = $pdfs[$key];
          unset($pdfs[$key]);
        }
        $tri[$index] = [];
        $tri[$index]['pos'] = $value->getPosition();
        $tri[$index]['id'] = $index;
        $tri[$index]['realId'] = $key;
        $index = $index + 1;
        
      }

      for ( $i = 0; $i < count($tri); $i ++ ){
        for ( $y = ($i + 1); $y < count($tri); $y ++ ){
          if ( $tri[$i]['pos'] > $tri[$y]['pos'] ){
            $tempo = $tri[$i];
            $tri[$i] = $tri[$y];
            $tri[$y] = $tempo;
          }
        }
      }

      $index = 0;
      for ( $i = 0; $i < count($tri); $i ++ ){
        if ( array_key_exists ( $tri[$index]['realId'] , $entity->getPdf() ) ){
          $entity->getPdf()[$tri[$index]['realId']]->setPosition($index + 1);
          $index = $index + 1;
        }
      }
    }
}
