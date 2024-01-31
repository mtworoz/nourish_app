<?php

namespace App\Domain\Entity\Recipe;

use App\Domain\Entity\Blog\Category;
use App\Domain\Entity\Blog\Post;
use App\Infrastructure\Repository\Recipe\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'recipe')]
    private ?Post $post = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $instruction = null;

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: RecipeIngredient::class,
        cascade: ['persist', 'remove'],
        orphanRemoval: true)]
    private Collection $recipeIngredients;

    #[ORM\Column(nullable: true)]
    private ?int $preparationTime = null;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'recipes')]
    private Collection $categories;

    #[ORM\Column]
    private ?int $servings = null;

    #[ORM\Column]
    private ?float $proteins = null;

    #[ORM\Column]
    private ?float $fats = null;

    #[ORM\Column]
    private ?float $carbohydrates = null;

    #[ORM\Column]
    private ?float $totalEnergy = null;

    public function __construct()
    {
        $this->recipeIngredients = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function __toString(){
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): static
    {
        $this->post = $post;

        return $this;
    }

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    public function setInstruction(?string $instruction): static
    {
        $this->instruction = $instruction;

        return $this;
    }

    /**
     * @return Collection<int, RecipeIngredient>
     */
    public function getRecipeIngredients(): Collection
    {
        return $this->recipeIngredients;
    }

    public function addRecipeIngredient(RecipeIngredient $recipeIngredients): static
    {
        if (!$this->recipeIngredients->contains($recipeIngredients)) {
            $this->recipeIngredients->add($recipeIngredients);
            $recipeIngredients->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeIngredient(RecipeIngredient $recipeIngredients): static
    {
        if ($this->recipeIngredients->removeElement($recipeIngredients)) {
            // set the owning side to null (unless already changed)
            if ($recipeIngredients->getRecipe() === $this) {
                $recipeIngredients->setRecipe(null);
            }
        }

        return $this;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(?int $preparationTime): static
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addRecipe($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeRecipe($this);
        }

        return $this;
    }

    public function getServings(): ?int
    {
        return $this->servings;
    }

    public function setServings(int $servings): static
    {
        $this->servings = $servings;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getProteins(): ?float
    {
        return $this->proteins;
    }

    /**
     * @param float|null $proteins
     */
    public function setProteins(?float $proteins): void
    {
        $this->proteins = $proteins;
    }

    /**
     * @return float|null
     */
    public function getFats(): ?float
    {
        return $this->fats;
    }

    /**
     * @param float|null $fats
     */
    public function setFats(?float $fats): void
    {
        $this->fats = $fats;
    }

    /**
     * @return float|null
     */
    public function getCarbohydrates(): ?float
    {
        return $this->carbohydrates;
    }

    /**
     * @param float|null $carbohydrates
     */
    public function setCarbohydrates(?float $carbohydrates): void
    {
        $this->carbohydrates = $carbohydrates;
    }

    /**
     * @return float|null
     */
    public function getTotalEnergy(): ?float
    {
        return $this->totalEnergy;
    }

    /**
     * @param float|null $totalEnergy
     */
    public function setTotalEnergy(?float $totalEnergy): void
    {
        $this->totalEnergy = $totalEnergy;
    }

}
