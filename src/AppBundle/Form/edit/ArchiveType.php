<?php

namespace AppBundle\Form\edit;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\edit\PdfType as EditPdf;


class ArchiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text', array('label' => 'Titre',
                'attr' => array('class' => 'input_admin')
                ))
            ->add('body', TextareaType::class, array( 
                'label' => 'Contenu',
                'attr' => array('class' => 'tinymce')
                ))
            ->add('position', IntegerType::class, array(
                    'scale' => 0,
                    'label' => 'Position',
                    'attr' => array('class' => 'input_admin', 'min' => '1')
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
            'data_class' => 'AppBundle\Entity\Archive'
        ));
    }
}