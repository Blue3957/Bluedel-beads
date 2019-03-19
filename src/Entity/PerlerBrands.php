<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PerlerBrandsRepository")
 */
class PerlerBrands
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PerlerColors", mappedBy="brand")
     */
    private $perlerColors;

    public function __construct()
    {
        $this->perlerColors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|PerlerColors[]
     */
    public function getPerlerColors(): Collection
    {
        return $this->perlerColors;
    }

    public function addPerlerColor(PerlerColors $perlerColor): self
    {
        if (!$this->perlerColors->contains($perlerColor)) {
            $this->perlerColors[] = $perlerColor;
            $perlerColor->setBrand($this);
        }

        return $this;
    }

    public function removePerlerColor(PerlerColors $perlerColor): self
    {
        if ($this->perlerColors->contains($perlerColor)) {
            $this->perlerColors->removeElement($perlerColor);
            // set the owning side to null (unless already changed)
            if ($perlerColor->getBrand() === $this) {
                $perlerColor->setBrand(null);
            }
        }

        return $this;
    }
}
