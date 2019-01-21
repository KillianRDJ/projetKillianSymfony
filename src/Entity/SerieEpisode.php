<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SerieEpisodeRepository")
 */
class SerieEpisode
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
     * @ORM\Column(type="integer")
    */
    private $episode_number;

    /**
     * @ORM\Column(type="integer")
     */
    private $saison_number;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Serie", mappedBy="Episode")
     */
    private $series;

    public function __construct()
    {
        $this->series = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEpisodeNumber()
    {
        return $this->episode_number;
    }

    /**
     * @param mixed $episode_number
     */
    public function setEpisodeNumber($episode_number): void
    {
        $this->episode_number = $episode_number;
    }

    /**
     * @return mixed
     */
    public function getSaisonNumber()
    {
        return $this->saison_number;
    }

    /**
     * @param mixed $saison_number
     */
    public function setSaisonNumber($saison_number): void
    {
        $this->saison_number = $saison_number;
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
     * @return Collection|Serie[]
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSeries(Serie $series): self
    {
        if (!$this->series->contains($series)) {
            $this->series[] = $series;
            $series->addGenre($this);
        }

        return $this;
    }

    public function removeSeries(Serie $series): self
    {
        if ($this->series->contains($series)) {
            $this->series->removeElement($series);
            $series->removeGenre($this);
        }

        return $this;
    }
}