<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Le nom du produit est obligatoire.')]
    #[Assert\Length(
	    min       : 2,
	    max       : 255,
	    minMessage: 'Le nom du produit doit contenir au moins {{ limit }} caractères.',
	    maxMessage: 'Le nom du produit ne doit pas dépasser {{ limit }} caractères.')]
    private ?string $name = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Le prix du produit est obligatoire.')]
    #[Assert\Positive(message: 'Le prix du produit doit être un nombre positif.')]
    private ?float $price = null;

    #[ORM\Column(length: 10000)]
    #[Assert\NotBlank(message: 'La description du produit est obligatoire.')]
    #[Assert\Length(
	    min       : 10,
	    max       : 10000,
	    minMessage: 'La description du produit doit contenir au moins {{ limit }} caractères.',
	    maxMessage: 'La description du produit ne doit pas dépasser {{ limit }} caractères.')]
    private ?string $description = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank(message: 'Le chemin de l\'image est obligatoire.')]
    private ?string $image = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Le stock du produit est obligatoire.')]
    #[Assert\PositiveOrZero(message: 'Le stock du produit doit être un nombre positif ou nul.')]
    private ?int $stock = null;

    #[ORM\Column]
    private ?bool $featured = null;

    #[ORM\Column]
    private ?bool $active = null;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function isFeatured(): ?bool
    {
        return $this->featured;
    }

    public function setFeatured(bool $featured): static
    {
        $this->featured = $featured;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }
}
