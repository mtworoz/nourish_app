<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
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

    #[ORM\OneToMany(mappedBy: 'recipe', targetEntity: RecipeIngredient::class)]
    private Collection $recipeIngredients;

    #[ORM\Column(nullable: true)]
    private ?int $preparationTime = null;

    public function __construct()
    {
        $this->recipeIngredients = new ArrayCollection();
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
}
