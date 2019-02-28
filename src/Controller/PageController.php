<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2/27/2019
 * Time: 6:31 PM
 */

namespace App\Controller;


use App\Entity\Page;
use App\Service\Layout;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{

    /**
     * @Route("/{route}", name="page_show")
     */
    public function show(Page $page)
    {
        $layout = new Layout();

        $layout->page_title = $page->getPageTitle();
        $layout->addChildRow(['name' => 'top']);
        $layout->addChildColumn(['name' => 'leftcolumn', 'parent' => 'top', 'width' => '1']);
        $layout->addChildColumn(['name' => 'centercolumn', 'title' => $page->getTitle(), 'parent' => 'top', 'width' => '8', 'html' => $page->getContent()]);
        $layout->addChildColumn(['name' => 'rightcolumn', 'parent' => 'top', 'width' => '3']);

        return $this->render('base.html.twig',['layout' => $layout]);
    }
}