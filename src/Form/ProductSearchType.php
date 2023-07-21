<?php

namespace App\Form;

use App\DTO\ProductSearchCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit : ',
                'required' => false,
            ])
            ->add('limit', NumberType::class, [
                'label' => 'Limite : ',
                'required' => false,
                'empty_data' => 25,
                'invalid_message' => false,
            ])
            ->add('page', NumberType::class, [
                'label' => 'Page : ',
                'required' => false,
                'empty_data' => 1,
                'invalid_message' => false,
            ])
            ->add('orderBy', ChoiceType::class, [
                'label' => 'Trier par : ',
                'required' => false,
                'invalid_message' => false,
                'empty_data' => 'createdAt',
                'choices' => [
                    'Prix' => 'price',
                    'Nom' => 'name',
                ],
            ])
            ->add('direction', ChoiceType::class, [
                'label' => 'Sens du tri : ',
                'required' => false,
                'empty_data' => 'DESC',
                'choices' => [
                    'Croissant' => 'ASC',
                    'Décroissant' => 'DESC',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductSearchCriteria::class,
            'method' => 'GET',
            'empty_data' => new ProductSearchCriteria(),
            'data' => new ProductSearchCriteria(),
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}