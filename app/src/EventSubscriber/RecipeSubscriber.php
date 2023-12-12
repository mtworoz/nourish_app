<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use App\Entity\Recipe;

class RecipeSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setNutrientsOnPersist'],
            BeforeEntityUpdatedEvent::class => ['setNutrientsOnUpdate'],
        ];
    }

    public function setNutrientsOnPersist(BeforeEntityPersistedEvent $event)
    {
        $this->setNutrients($event);
    }

    public function setNutrientsOnUpdate(BeforeEntityUpdatedEvent $event)
    {
        $this->setNutrients($event);
    }

    private function setNutrients($event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Recipe)) {
            return;
        }

        $recipeIngredients = $entity->getRecipeIngredients();

        $entity->setFats($this->calculateTotal($recipeIngredients, 'getFats'));
        $entity->setCarbohydrates($this->calculateTotal($recipeIngredients, 'getCarbohydrates'));
        $entity->setProteins($this->calculateTotal($recipeIngredients, 'getProteins'));
        $entity->setTotalEnergy($this->calculateTotal($recipeIngredients, 'getKcalPer100g'));
    }

    private function calculateTotal($recipeIngredients, $getter): float|int
    {
        $total = 0;
        foreach ($recipeIngredients as $recipeIngredient) {
            $total += $recipeIngredient->getIngredient()->$getter() * $recipeIngredient->getWeight() / 100;
        }
        return $total;
    }
}
