<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkAssetRepository")
 */
class LinkAsset
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $url;

    /**
     * @ORM\Column(type="integer")
     */
    private $idAsset;

    /**
     * @ORM\Column(type="integer")
     */
    private $player;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $version;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIdAsset(): ?int
    {
        return $this->idAsset;
    }

    public function setIdAsset(int $idAsset): self
    {
        $this->idAsset = $idAsset;

        return $this;
    }

    public function getPlayer(): ?int
    {
        return $this->player;
    }

    public function setPlayer(int $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}
