<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom : ',
                'attr' => [
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom : '
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email : '
            ])
            ->add('phonenumber', NumberType::class, [
                'label' => 'Votre numéro de téléphone : (facultatif) ',
                'required' => false,
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Écrivez ici votre message : ',
                'attr' => [
                    'rows' => 10,
                    'cols' => 40
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn-contact button'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}