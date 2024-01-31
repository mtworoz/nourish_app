<?php

namespace App\Domain\Entity\Recipe;

use App\Infrastructure\Repository\Recipe\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[ORM\Unique]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $kcalPer100g = null;

    #[ORM\ManyToOne(inversedBy: 'ingredient')]
    private ?IngredientsCategory $ingredientsCategory = null;

    #[ORM\OneToMany(mappedBy: 'ingredient', targetEntity: RecipeIngredient::class, cascade: ['persist', 'remove'])]
    private Collection $recipeIngredients;

    #[ORM\Column]
    private ?float $proteins = null;

    #[ORM\Column]
    private ?float $fats = null;

    #[ORM\Column]
    private ?float $carbohydrates = null;

    public function __construct()
    {
        $this->recipeIngredients = new ArrayCollection();
    }

    public function __toString(){
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getKcalPer100g(): ?float
    {
        return $this->kcalPer100g;
    }

    public function setKcalPer100g(float $kcalPer100g): static
    {
        $this->kcalPer100g = $kcalPer100g;

        return $this;
    }

    public function getIngredientsCategory(): ?IngredientsCategory
    {
        return $this->ingredientsCategory;
    }

    public function setIngredientsCategory(?IngredientsCategory $ingredientsCategory): static
    {
        $this->ingredientsCategory = $ingredientsCategory;

        return $this;
    }

    /**
     * @return Collection<int, RecipeIngredient>
     */
    public function getRecipeIngredients(): Collection
    {
        return $this->recipeIngredients;
    }

    public function addRecipeIngredient(RecipeIngredient $recipeIngredient): static
    {
        if (!$this->recipeIngredients->contains($recipeIngredient)) {
            $this->recipeIngredients->add($recipeIngredient);
            $recipeIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removeRecipeIngredient(RecipeIngredient $recipeIngredient): static
    {
        if ($this->recipeIngredients->removeElement($recipeIngredient)) {
            // set the owning side to null (unless already changed)
            if ($recipeIngredient->getIngredient() === $this) {
                $recipeIngredient->setIngredient(null);
            }
        }

        return $this;
    }

    public function getProteins(): ?float
    {
        return $this->proteins;
    }

    public function setProteins(?float $proteins): static
    {
        $this->proteins = $proteins;

        return $this;
    }

    public function getFats(): ?float
    {
        return $this->fats;
    }

    public function setFats(?float $fats): static
    {
        $this->fats = $fats;

        return $this;
    }

    public function getCarbohydrates(): ?float
    {
        return $this->carbohydrates;
    }

    public function setCarbohydrates(?float $carbohydrates): static
    {
        $this->carbohydrates = $carbohydrates;

        return $this;
    }
}
