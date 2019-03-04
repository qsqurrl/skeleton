<?php

namespace App\Service;

use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class NavigationMenu
{
    protected $em;
    protected $router;

    private $repository;
    private $pages;
    private $currentPage;
    private $html;

    public function __construct(EntityManagerInterface $em, UrlGeneratorInterface $router, $route)
    {
        $this->em = $em;
        $this->router = $router;
        $this->currentPage = $route;
        $this->repository = $em->getRepository(Page::class);
        $this->pages = $this->repository->findByNavigation();

        $this->buildMenu();
    }
    
    private function buildMenu()
    {
        $html ="<ul class='nav navbar-nav'>";

        for ($i = 1; $i <= count($this->pages); $i++)
        {
            $html .= "<li class='" . ($this->currentPage == $this->pages[$i-1]->getRoute() ? 'active' : '') . "'>";
            $html .="<a href='" . $this->router->generate('page_show',array("route" => $this->pages[$i-1]->getRoute())) . "'>";
            if ($this->pages[$i-1]->getNavigationIcon() !== NULL && !empty($this->pages[$i-1]->getNavigationIcon()))
            {
                $html .= "<span class='glyphicon glyphicon-" . $this->pages[$i-1]->getNavigationIcon() . "'>&nbsp;</span>";
            }
            $html .= $this->pages[$i-1]->getTitle();
            $html .= "</a>";
            $html .= "</li>";
        }

        $html .= "</ul>";

        $this->html = $html;
    }

    public function getHTML()
    {
        return $this->html;
    }
}