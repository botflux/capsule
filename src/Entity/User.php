<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="app_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 1,
     *     max = 255,
     *     minMessage = "Your first name must at least be {{ limit }} character long.",
     *     maxMessage = "Your first name cannot be longer than {{ limit }} characters."
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 1,
     *     max = 255,
     *     minMessage = "Your last name must at least be {{ limit }} character long.",
     *     maxMessage = "Your last name cannot be longer than {{ limit }} characters."
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 1,
     *     max = 255,
     *     minMessage = "Your email must be at least {{ limit }} character long.",
     *     maxMessage = "Your email cannot be longer than {{ limit }} characters."
     * )
     * @Assert\Email(
     *     message = "The email {{ value }} is not a valid email."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 8,
     *     max = 255,
     *     minMessage = "Your password must at least be {{ limit }} characters long.",
     *     maxMessage = "Your password cannot be longer than {{ limit }} characters."
     * )
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TimeCapsule", mappedBy="owner")
     */
    private $ownedTimeCapsules;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TimeCapsuleFragment", mappedBy="author")
     */
    private $contributedFragments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TimeCapsule", mappedBy="contributors")
     */
    private $contributedTimeCapsules;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $apiKey;

    public function __construct()
    {
        $this->ownedTimeCapsules = new ArrayCollection();
        $this->contributedFragments = new ArrayCollection();
        $this->contributedTimeCapsules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->email,
            $this->password
        ]);
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->email,
            $this->password
        ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials() {}

    /**
     * @return Collection|TimeCapsule[]
     */
    public function getOwnedTimeCapsules(): Collection
    {
        return $this->ownedTimeCapsules;
    }

    public function addOwnedTimeCapsule(TimeCapsule $ownedTimeCapsule): self
    {
        if (!$this->ownedTimeCapsules->contains($ownedTimeCapsule)) {
            $this->ownedTimeCapsules[] = $ownedTimeCapsule;
            $ownedTimeCapsule->setOwner($this);
        }

        return $this;
    }

    public function removeOwnedTimeCapsule(TimeCapsule $ownedTimeCapsule): self
    {
        if ($this->ownedTimeCapsules->contains($ownedTimeCapsule)) {
            $this->ownedTimeCapsules->removeElement($ownedTimeCapsule);
            // set the owning side to null (unless already changed)
            if ($ownedTimeCapsule->getOwner() === $this) {
                $ownedTimeCapsule->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TimeCapsuleFragment[]
     */
    public function getContributedFragments(): Collection
    {
        return $this->contributedFragments;
    }

    public function addContributedFragment(TimeCapsuleFragment $contributedFragment): self
    {
        if (!$this->contributedFragments->contains($contributedFragment)) {
            $this->contributedFragments[] = $contributedFragment;
            $contributedFragment->setAuthor($this);
        }

        return $this;
    }

    public function removeContributedFragment(TimeCapsuleFragment $contributedFragment): self
    {
        if ($this->contributedFragments->contains($contributedFragment)) {
            $this->contributedFragments->removeElement($contributedFragment);
            // set the owning side to null (unless already changed)
            if ($contributedFragment->getAuthor() === $this) {
                $contributedFragment->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TimeCapsule[]
     */
    public function getContributedTimeCapsules(): Collection
    {
        return $this->contributedTimeCapsules;
    }

    public function addContributedTimeCapsule(TimeCapsule $contributedTimeCapsule): self
    {
        if (!$this->contributedTimeCapsules->contains($contributedTimeCapsule)) {
            $this->contributedTimeCapsules[] = $contributedTimeCapsule;
            $contributedTimeCapsule->addContributor($this);
        }

        return $this;
    }

    public function removeContributedTimeCapsule(TimeCapsule $contributedTimeCapsule): self
    {
        if ($this->contributedTimeCapsules->contains($contributedTimeCapsule)) {
            $this->contributedTimeCapsules->removeElement($contributedTimeCapsule);
            $contributedTimeCapsule->removeContributor($this);
        }

        return $this;
    }

    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }
}
