<?php

namespace AppBundle\Form\create;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text', array('label' => 'Nom',
                    'attr' => array('class' => 'input_admin')
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
                    'data' => '1',
                    'label' => 'Position',
                    'attr' => array('class' => 'input_admin')
                ))
            ->add('imageFile', 'vich_image', array(
                    'required'      => true,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Image',
                    'attr' => array('class' => 'image_admin')
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Partner'
        ));
    }
}