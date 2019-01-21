<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SerieRepository")
 */
class Serie
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Genre", inversedBy="series")
     */
    private $Genre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Acteur", inversedBy="series")
     */
    private $Acteur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Realisateur", inversedBy="series")
     */
    private $Realisateur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SerieEpisode", inversedBy="series")
     */
    private $Episode;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_sortie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $notes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="integer")
     */
    private $limitation;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $url_ba;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $url_pochette;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $description;


    public function __construct()
    {
        $this->Genre = new ArrayCollection();
        $this->Acteur = new ArrayCollection();
        $this->Realisateur = new ArrayCollection();
        $this->Episode = new ArrayCollection();

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
     * @return Collection|Genre[]
     */
    public function getGenre(): Collection
    {
        return $this->Genre;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->Genre->contains($genre)) {
            $this->Genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->Genre->contains($genre)) {
            $this->Genre->removeElement($genre);
        }

        return $this;
    }

    /**
     * @return Collection|Acteur[]
     */
    public function getActeur(): Collection
    {
        return $this->Acteur;
    }

    public function addActeur(Acteur $acteur): self
    {
        if (!$this->Acteur->contains($acteur)) {
            $this->Acteur[] = $acteur;
        }

        return $this;
    }

    public function removeActeur(Acteur $acteur): self
    {
        if ($this->Acteur->contains($acteur)) {
            $this->Acteur->removeElement($acteur);
        }

        return $this;
    }

    /**
     * @return Collection|Realisateur[]
     */
    public function getRealisateur(): Collection
    {
        return $this->Realisateur;
    }

    public function addRealisateur(Realisateur $realisateur): self
    {
        if (!$this->Realisateur->contains($realisateur)) {
            $this->Realisateur[] = $realisateur;
        }

        return $this;
    }

    public function removeRealisateur(Realisateur $realisateur): self
    {
        if ($this->Realisateur->contains($realisateur)) {
            $this->Realisateur->removeElement($realisateur);
        }

        return $this;
    }

    /**
     * @return Collection|SerieEpisode[]
     */
    public function getEpisode(): Collection
    {
        return $this->Episode;
    }

    public function addEpisode(SerieEpisode $episode): self
    {
        if (!$this->Episode->contains($episode)) {
            $this->Episode[] = $episode;
        }

        return $this;
    }

    public function removeEpisode(SerieEpisode $episode): self
    {
        if ($this->Episode->contains($episode)) {
            $this->Episode->removeElement($episode);
        }

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getLimitation(): ?int
    {
        return $this->limitation;
    }

    public function setLimitation(int $limitation): self
    {
        $this->limitation = $limitation;

        return $this;
    }

    public function getUrlBa(): ?string
    {
        return $this->url_ba;
    }

    public function setUrlBa(string $url_ba): self
    {
        $this->url_ba = $url_ba;

        return $this;
    }

    public function getUrlPochette(): ?string
    {
        return $this->url_pochette;
    }

    public function setUrlPochette(string $url_pochette): self
    {
        $this->url_pochette = $url_pochette;

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

}
