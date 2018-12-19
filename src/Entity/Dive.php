<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiveRepository")
 */
class Dive
{
    /**
     * -----------------------
     * -------CONSTANTS-------
     * -----------------------
     */

    const DIVETYPE = [
    0 => 'Technique',
    1 => 'Exploration'
    ];

    /**
     * ------------------------
     * -------ATTRIBUTES-------
     * ------------------------
     */

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dive_site;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_depth;

    /**
     * @ORM\Column(type="integer")
     */
    private $dive_time;

    /**
     * @ORM\Column(type="boolean")
     */
    private $stops;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stops_time;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pre_dive_interval;

    /**
     * @ORM\Column(type="integer")
     */
    private $dive_type;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stop_depth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;


    /**
     * ------------------------
     * ---GETTER AND SETTERS---
     * ------------------------
     */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function getFormatedDate() : string
    {
        return $this->getDate()->format('Y-m-d');
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDiveSite(): ?string
    {
        return $this->dive_site;
    }

    public function setDiveSite(string $dive_site): self
    {
        $this->dive_site = $dive_site;

        return $this;
    }

    public function getMaxDepth(): ?int
    {
        return $this->max_depth;
    }

    public function setMaxDepth(int $max_depth): self
    {
        $this->max_depth = $max_depth;

        return $this;
    }

    public function getDiveTime(): ?int
    {
        return $this->dive_time;
    }

    public function setDiveTime(int $dive_time): self
    {
        $this->dive_time = $dive_time;

        return $this;
    }

    public function getStops(): ?bool
    {
        return $this->stops;
    }

    public function setStops(bool $stops): self
    {
        $this->stops = $stops;

        return $this;
    }

    public function getStopsTime(): ?int
    {
        return $this->stops_time;
    }

    public function setStopsTime(?int $stops_time): self
    {
        $this->stops_time = $stops_time;

        return $this;
    }

    public function getPreDiveInterval(): ?int
    {
        return $this->pre_dive_interval;
    }

    public function setPreDiveInterval(?int $pre_dive_interval): self
    {
        $this->pre_dive_interval = $pre_dive_interval;

        return $this;
    }

    public function getDiveType(): ?int
    {
        return $this->dive_type;
    }

    public function getDiveTypeFormated(): string
    {
        return self::DIVETYPE[$this->dive_type];
    }

    public function setDiveType(int $dive_type): self
    {
        $this->dive_type = $dive_type;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getStopDepth(): ?int
    {
        return $this->stop_depth;
    }

    public function setStopDepth(?int $stop_depth): self
    {
        $this->stop_depth = $stop_depth;

        return $this;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->getTitle());
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

}
