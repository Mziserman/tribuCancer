<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use AppBundle\Form\PdfType;


class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array('label' => 'Nom'))
            ->add('shortDesc', TextareaType::class, array( 'label' => 'Petite Déscription'))
            ->add('body', TextareaType::class, array( 'label' => 'Contenue'))
            ->add('inscription', CheckboxType::class, array(
                    'label'    => 'Formulaire de demande de contact',
                    'required' => false,
                ))
            ->add('date','text', array('label' => 'La date, ( une phrase ) '))
            ->add('position', IntegerType::class, array(
                    'scale' => 0,
                    'data' => '1',
                    'label' => 'Position'
                ))
            ->add('thumbnailFile', 'vich_file', array(
                    'required'      => true,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Vignette'
                ))
            ->add('imageFile1', 'vich_file', array(
                    'required'      => true,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Première image'
                ))
            ->add('imageFile2', 'vich_file', array(
                    'required'      => true,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Seconde image'
                ))
            ->add('imageFile3', 'vich_file', array(
                    'required'      => true,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Troisième image'
                ))
            ->add('flickr','text', array('label' => 'Lien Flickr'))
            ->add('youtube','text', array('label' => 'Lien Youtube'))
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