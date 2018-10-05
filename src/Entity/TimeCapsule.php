<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TimeCapsuleRepository")
 */
class TimeCapsule implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=4000)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $closingAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ownedTimeCapsules")
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TimeCapsuleFragment", mappedBy="timeCapsule")
     */
    private $fragments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="contributedTimeCapsules")
     */
    private $contributors;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $inviteLink;

    public function __construct()
    {
        $this->fragments = new ArrayCollection();
        $this->contributors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        if (strlen($title) < 5) {
            throw new \InvalidArgumentException('Title need to have more than 5 characters');
        }

        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getClosingAt(): ?\DateTimeInterface
    {
        return $this->closingAt;
    }

    public function setClosingAt(\DateTimeInterface $closingAt): self
    {
        $this->closingAt = $closingAt;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|TimeCapsuleFragment[]
     */
    public function getFragments(): Collection
    {
        return $this->fragments;
    }

    public function addFragment(TimeCapsuleFragment $fragment): self
    {
        if (!$this->fragments->contains($fragment)) {
            $this->fragments[] = $fragment;
            $fragment->setTimeCapsule($this);
        }

        return $this;
    }

    public function removeFragment(TimeCapsuleFragment $fragment): self
    {
        if ($this->fragments->contains($fragment)) {
            $this->fragments->removeElement($fragment);
            // set the owning side to null (unless already changed)
            if ($fragment->getTimeCapsule() === $this) {
                $fragment->setTimeCapsule(null);
            }
        }

        return $this;
    }

    public function __toString ()
    {
        return $this->id.$this->title;
    }

    /**
     * @return Collection|User[]
     */
    public function getContributors(): Collection
    {
        return $this->contributors;
    }

    public function addContributor(User $contributor): self
    {
        if (!$this->contributors->contains($contributor)) {
            $this->contributors[] = $contributor;
        }

        return $this;
    }

    public function removeContributor(User $contributor): self
    {
        if ($this->contributors->contains($contributor)) {
            $this->contributors->removeElement($contributor);
        }

        return $this;
    }

    public function getInviteLink(): ?string
    {
        return $this->inviteLink;
    }

    public function setInviteLink(string $inviteLink): self
    {
        $this->inviteLink = $inviteLink;

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'createdAt' => $this->createdAt,
            'closingAt' => $this->closingAt
        ];
    }
}
