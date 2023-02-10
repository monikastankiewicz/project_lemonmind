<?php

namespace App\Form;

use App\Entity\Cargo;
use App\Entity\Transport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
* The form for entering the cargo for transport
 * 
 * @package Project_lemonmind/App/Form
 * @author Monika Stankiewicz <moniaastankiewicz@gmailcom>
 */
class CargoType extends AbstractType
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
            ->add('name', TextType::class, [
                'label' => 'Nazwa ładunku',
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Wprowadź nazwę ładunku'
                )
                ])
            ->add('weight_kg', TextType::class, [
                'label' => 'Waga ładunku',
                'required' => true,
                'attr' => array(
                    'placeholder' => 'Wprowadź wagę w kiloragmach'
                )
                ])
            ->add('type', ChoiceType::class, [
                'placeholder' => 'Wybierz typ ładunku',
                'required' => true,
                'label' => 'Typ ładunku',
                'choices'  => [
                    'Ładunek zwykły' => 'Zwykły',
                    'Ładunek niebezpieczny' => 'Niebiezpieczny',
                ],
            ])
            ->add('transport', EntityType::class, [
                'class' => Transport::class
            ]
        );
    }

    /**
     * @param OptionsResolver $resolver
     * 
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cargo::class,
        ]);
    }
}
