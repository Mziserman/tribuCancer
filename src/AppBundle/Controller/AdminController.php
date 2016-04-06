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
		    case 'associtation':
		    	$entity = new Pdf();
		        $form = $this->createForm(PdfType::class, $entity);
		        break;
		    case 'service':
		    	$entity = new Pdf();
		        $form = $this->createForm(PdfType::class, $entity);
		        break;
		    case 'event':
		    	$entity = new Pdf();
		        $form = $this->createForm(PdfType::class, $entity);
		        break;
		    case 'partner':
		    	$entity = new Pdf();
		        $form = $this->createForm(PdfType::class, $entity);
		        break;
		    case 'article':
		    	$entity = new Article();
		        $form = $this->createForm(ArticleType::class, $entity);
		        break;
		    case 'archive':
		    	$entity = new Pdf();
		        $form = $this->createForm(PdfType::class, $entity);
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
			'myTitle'=>  'Création de données',
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
}
