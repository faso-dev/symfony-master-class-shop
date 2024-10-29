<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Assert\Email(
		message: 'Cette adresse email n\'est pas valide.'
    )]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\Length(
		min: 8,
	    max: 120,
	    minMessage: 'Le mot de passe doit contenir au moins {{ limit }} caractères.',
	    maxMessage: 'Le mot de passe doit contenir au maximum {{ limit }} caractères.'
    )]
    #[Assert\Regex(
		pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
	    message: 'Le mot de passe doit contenir au moins une lettre minuscule(az), une lettre majuscule(AZ) et un chiffre(0-9).'
	)]
    private ?string $password = null;

    #[ORM\Column(length: 120)]
    #[Assert\Blank]
    #[Assert\Length(
		min: 2,
	    max: 60,
	    minMessage: 'Le prénom doit contenir au moins {{ limit }} caractères.',
	    maxMessage: 'Le prénom doit contenir au maximum {{ limit }} caractères.'
    )]
    private ?string $first_name = null;

    #[ORM\Column(length: 60)]
    #[Assert\Blank]
    #[Assert\Length(
		min: 2,
	    max: 60,
	    minMessage: 'Le nom doit contenir au moins {{ limit }} caractères.',
	    maxMessage: 'Le nom doit contenir au maximum {{ limit }} caractères.'
	)]
    private ?string $last_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): static
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): static
    {
        $this->last_name = $last_name;

        return $this;
    }
}
