<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Service\Parser;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $route;

    /**
     * @ORM\Column(type="string", length=24)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $page_title;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $on_navigation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoute(): ?string
    {
        return $this->route;
    }

    public function setRoute(string $route): self
    {
        $this->route = $route;

        return $this;
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
        $ps = new Parser($this->content);
        return $ps->getContent();
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPageTitle(): ?string
    {
        return $this->page_title;
    }

    public function setPageTitle(string $page_title): self
    {
        $this->page_title = $page_title;

        return $this;
    }

    public function getOnNavigation(): ?bool
    {
        return $this->on_navigation;
    }

    public function setOnNavigation(?bool $on_navigation): self
    {
        $this->on_navigation = $on_navigation;

        return $this;
    }
}
