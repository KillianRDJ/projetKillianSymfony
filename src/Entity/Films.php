<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmsRepository")
 */
class Films
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
     * @ORM\Column(type="string", length=255)
     */
    private $time_film;

    /**
     * @ORM\Column(type="date")
     */
    private $date_sortie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $notes_allocine;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $notes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", length=1)
     */
    private $limitation;

    /**
     * @ORM\Column(type="string", length=1500)
     */
    private $url_ba;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $url_pochette;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Genre", inversedBy="films")
     */
    private $genres;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Acteur", inversedBy="films")
     */
    private $acteurs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Realisateur", inversedBy="films")
     */
    private $realisateurs;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->acteurs = new ArrayCollection();
        $this->realisateurs = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * @param mixed $nationalite
     */
    public function setNationalite($nationalite): void
    {
        $this->nationalite = $nationalite;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLimitation()
    {
        return $this->limitation;
    }

    /**
     * @param mixed $limit
     */
    public function setLimitation($limitation): void
    {
        $this->limitation = $limitation;
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


    public function getTimeFilm(): ?string
    {
        return $this->time_film;
    }

    public function setTimeFilm(string $time_film): self
    {
        $this->time_film = $time_film;

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


    public function getNotesAllocine(): ?string
    {
        return $this->notes_allocine;
    }

    public function setNotesAllocine(string $notes_allocine): self
    {
        $this->notes_allocine = $notes_allocine;

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
    public function getSlug() :string
    {
       return (new Slugify())->slugify($this->name);

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

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
            $genre->addFilm($this);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        if ($this->genres->contains($genre)) {
            $this->genres->removeElement($genre);
            $genre->removeFilm($this);
        }

        return $this;
    }

    /**
     * @return Collection|Acteur[]
     */
    public function getActeurs(): Collection
    {
        return $this->acteurs;
    }

    public function addActeur(Acteur $acteur): self
    {
        if (!$this->acteurs->contains($acteur)) {
            $this->acteurs[] = $acteur;
            $acteur->addFilm($this);
        }

        return $this;
    }

    public function removeActeur(Acteur $acteur): self
    {
        if ($this->acteurs->contains($acteur)) {
            $this->acteurs->removeElement($acteur);
            $acteur->removeFilm($this);
        }

        return $this;
    }

    /**
     * @return Collection|Realisateur[]
     */
    public function getRealisateurs(): Collection
    {
        return $this->realisateurs;
    }

    public function addRealisateur(Realisateur $realisateur): self
    {
        if (!$this->realisateurs->contains($realisateur)) {
            $this->realisateurs[] = $realisateur;
            $realisateur->addFilm($this);
        }

        return $this;
    }

    public function removeRealisateur(Realisateur $realisateur): self
    {
        if ($this->realisateurs->contains($realisateur)) {
            $this->realisateurs->removeElement($realisateur);
            $realisateur->removeFilm($this);
        }

        return $this;
    }

}
