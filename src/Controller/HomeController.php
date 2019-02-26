<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2/23/2019
 * Time: 6:53 PM
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Utils\Layout;
use App\Elements\Table;

class HomeController extends AbstractController
{
    private $title = "Homepage";
    private $content;
    private $layout;
    private $table;


    public function index()
    {
        $this->buildMData();
        $this->buildRData();
        $this->content['pagetitle'] = $this->title;

        $this->layout = new Layout();
        $this->table = new Table();

        $this->table->addHeaders(['Test 1', 'Test 2']);
        $this->table->addRow(['Item1&nbsp;', 'Item 2']);
        $this->layout->addChildRow(['name' => 'top', 'title' => 'Row 1']);
        $this->layout->addChildColumn(['name' => 'leftcolumn', 'title' => 'Left', 'parent' => 'top', 'width' => '1']);
        $this->layout->addChildColumn(['name' => 'centercolumn', 'title' => 'Center', 'parent' => 'top', 'width' => '8', 'html' => $this->table->getHTML()]);
        $this->layout->addChildColumn(['name' => 'rightcolumn', 'title' => 'Right', 'parent' => 'top', 'width' => '3']);

        return $this->render('base.html.twig',['layout' => $this->layout, 'content' => $this->content]);
    }

    private function buildMData()
    {
        $this->content['center']['title'] = "Main Grid";
    }

    private function buildRData()
    {
        $this->content['right']['title'] = "Right Grid";
    }
}