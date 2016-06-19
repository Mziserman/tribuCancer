<?php

namespace AppBundle\Form\create;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use AppBundle\Form\create\PdfType;


class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array('label' => 'Nom',
                'required'      => true,
                'attr' => array('class' => 'input_admin')
                ))
            ->add('shortDesc', TextareaType::class, array( 
                'label' => 'Petite Déscription',
                'required'      => true,
                'attr' => array('class' => 'tinymce')
                ))
            ->add('body', TextareaType::class, array( 
                'label' => 'Contenu',
                'required'      => true,
                'attr' => array('class' => 'tinymce')
                ))
            ->add('inscription', CheckboxType::class, array(
                    'label'    => 'Formulaire de demande de contact',
                    'required' => false,
                    'attr' => array('class' => 'checkBox_admin')
                ))
            ->add('date','text', array('label' => 'La date, ( une phrase ) ',
                    'attr' => array('class' => 'input_admin'),
                    'required' => false
                ))
            ->add('position', IntegerType::class, array(
                    'scale' => 0,
                    'data' => '1',
                    'label' => 'Position',
                    'attr' => array('class' => 'input_admin', 'min' => '1')
                ))
            ->add('thumbnailFile', 'vich_image', array(
                    'required'      => true,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Vignette',
                    'attr' => array('class' => 'image_admin')
                ))
            ->add('imageFile1', 'vich_image', array(
                    'required'      => false,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Première image',
                    'attr' => array('class' => 'image_admin')
                ))
            ->add('imageFile2', 'vich_image', array(
                    'required'      => false,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Seconde image',
                    'attr' => array('class' => 'image_admin')
                ))
            ->add('imageFile3', 'vich_image', array(
                    'required'      => false,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Troisième image',
                    'attr' => array('class' => 'image_admin')
                ))
            ->add('flickr','text', array('label' => 'Lien Flickr',
                    'attr' => array('class' => 'input_admin'),
                    'required' => false
                ))
            ->add('youtube','text', array('label' => 'Lien Youtube',
                    'attr' => array('class' => 'input_admin'),
                    'required' => false
                ))
        ;

        $builder->add('pdf', CollectionType::class, array(
            'entry_type' => PdfType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }
}