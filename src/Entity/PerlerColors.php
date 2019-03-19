<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PerlerColorsRepository")
 */
class PerlerColors
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hex;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Palette", mappedBy="colors")
     */
    private $palettes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PerlerBrands", inversedBy="perlerColors")
     */
    private $brand;

    public function __construct()
    {
        $this->palettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getHex(): ?string
    {
        return $this->hex;
    }

    public function setHex(string $hex): self
    {
        $this->hex = $hex;

        return $this;
    }

    /**
     * @return Collection|Palette[]
     */
    public function getPalettes(): Collection
    {
        return $this->palettes;
    }

    public function addPalette(Palette $palette): self
    {
        if (!$this->palettes->contains($palette)) {
            $this->palettes[] = $palette;
            $palette->addColor($this);
        }

        return $this;
    }

    public function removePalette(Palette $palette): self
    {
        if ($this->palettes->contains($palette)) {
            $this->palettes->removeElement($palette);
            $palette->removeColor($this);
        }

        return $this;
    }

    public function getBrand(): ?PerlerBrands
    {
        return $this->brand;
    }

    public function setBrand(?PerlerBrands $brand): self
    {
        $this->brand = $brand;

        return $this;
    }
}
