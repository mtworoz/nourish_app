<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApiIngredientFormType extends AbstractType
{

//    private $apiClient;
//
//    public function __construct(ApiClient $apiClient)
//    {
//        $this->apiClient = $apiClient;
//    }
//
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $choices = $this->apiClient->getEntities();
//
//        $resolver->setDefaults([
//            'choices' => array_combine($choices, $choices),
//        ]);
//    }
//
//    public function getParent()
//    {
//        return ChoiceType::class;
//    }
}
