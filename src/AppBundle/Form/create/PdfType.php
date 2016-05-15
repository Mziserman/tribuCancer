<?php

namespace AppBundle\Form\create;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class PdfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array('label' => 'Nom',
                    'attr' => array('class' => 'input_admin'),
                    'required' => true
                ))
            ->add('position', IntegerType::class, array(
                    'scale' => 0,
                    'data' => '1',
                    'attr' => array('class' => 'pdf-position input_admin'),
                    'label' => 'Position'
                ))
            ->add('pdfFile', 'vich_file', array(
                    'required'      => true,
                    'allow_delete'  => true, // not mandatory, default is true
                    'download_link' => true, // not mandatory, default is true
                    'label' => 'Le fichier',
                    'attr' => array('class' => 'pdf_admin')
                ))
            ->add('color', ChoiceType::class, array(
                    'choices'  => array(
                        'red' => 'Rouge',
                        'blue' => 'Bleu',
                        'grey' => 'Gris',
                    ),
                    'label' => 'Couleur',
                    'attr' => array('class' => 'choices_admin')
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pdf'
        ));
    }
}