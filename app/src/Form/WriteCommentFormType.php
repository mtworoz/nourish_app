<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WriteCommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'content',
                TextareaType::class,
                [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Napisz tutaj swój komentarz',
                        'cols' => 30,
                        'rows' => 10
                    ]
                ]
            )
            ->add('author',
                TextType::class,
                [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Imię'
                    ]
                ]
            )
            ->add('submit', SubmitType::class,
                [
                    'label' => 'Opublikuj komentarz',
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
