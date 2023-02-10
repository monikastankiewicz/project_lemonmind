<?php

namespace App\Form;

use App\Entity\Transport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\UX\Dropzone\Form\DropzoneType;

/**
 * Transport order form
 * 
 * @package Project_lemonmind/App/Form
 * @author Monika Stankiewicz <moniaastankiewicz@gmailcom>
 */
class TransportType extends AbstractType
{
    /**
     * Form construction
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     * 
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('transport_from', TextType::class, [
                'label' => 'Transport z',
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Wprowadź miejsce początku transportu'
                    )
                ])
            ->add('transport_to', TextType::class, [
                'label' => 'Transport do',
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Wprowadź miejsce końcowe transportu'
                )
                ])
            ->add('aircraft_type', ChoiceType::class, [
                'label' => 'Typ samolotu',
                'required' => true,
                'placeholder' => 'Wybierz typ samolotu',
                'choices'  => [
                    'Airbus A380' => 'Airbus A380',
                    'Boeing 747' => 'Boeing 747'
                ]
                ])
            ->add('shipping_documents', DropzoneType::class, [
                'label' => 'Dokument przewozowy',
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Przeciągnij i upuść plik'
                ),   
                ])
            ->add('shipping_date', DateType::class, [
                'required' => true,
                'label' => 'Data transportu',
                'widget' => 'single_text',
                ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     * 
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transport::class,
        ]);
    }
}
