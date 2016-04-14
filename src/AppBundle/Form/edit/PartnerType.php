<?php

namespace AppBundle\Form\edit;

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
            ->add('title','text', array('label' => 'Titre'))
            ->add('body', TextareaType::class, array( 'label' => 'Contenue'))
            ->add('link','text', array('label' => 'Lien'))
            ->add('position', IntegerType::class, array(
                    'scale' => 0,
                    'data' => '1',
                    'label' => 'Position'
                ))
            ->add('imageFile', 'vich_file', array(
                    'required'      => false,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Image'
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