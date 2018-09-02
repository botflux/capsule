<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TimeCapsuleFragmentRepository")
 */
class TimeCapsuleFragment
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
     * @ORM\Column(type="string", length=1000)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="contributedFragments")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TimeCapsule", inversedBy="fragments")
     */
    private $timeCapsule;

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
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getTimeCapsule(): ?TimeCapsule
    {
        return $this->timeCapsule;
    }

    public function setTimeCapsule(?TimeCapsule $timeCapsule): self
    {
        $this->timeCapsule = $timeCapsule;

        return $this;
    }
}
