<?php

namespace AppBundle\Form\edit;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\edit\PdfType as EditPdf;


class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array('label' => 'Nom',
                'attr' => array('class' => 'input_admin')
                ))
            ->add('shortDesc', TextareaType::class, array( 
                'label' => 'Petite Déscription',
                'attr' => array('class' => 'tinymce')
                ))
            ->add('body', TextareaType::class, array( 
                'label' => 'Contenu',
                'attr' => array('class' => 'tinymce')
                ))
            ->add('link','text', array('label' => 'Lien',
                'attr' => array('class' => 'input_admin')
                ))
            ->add('position', IntegerType::class, array(
                    'scale' => 0,
                    'label' => 'Position',
                'attr' => array('class' => 'input_admin')
                ))
            ->add('iconFile', 'vich_image', array(
                    'required'      => false,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Icône',
                    'attr' => array('class' => 'image_admin')
                ))
            ->add('imageFile', 'vich_image', array(
                    'required'      => false,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Image',
                    'attr' => array('class' => 'image_admin')
                ))
        ;

        $builder->add('pdf', CollectionType::class, array(
            'entry_type' => EditPdf::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Service'
        ));
    }
}