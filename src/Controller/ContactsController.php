<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2/23/2019
 * Time: 9:29 PM
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactsController extends AbstractController
{
    private $title = "Contacts";
    private $body = "";
    private $grid = array();
    private $gridContent = array();

    public function index()
    {
        $this->buildGrid();
        $this->buildLeftGrid();
        $this->buildRightGrid();
        $this->buildBody();

        return $this->render('contacts.html.twig',['title' => $this->title, 'body' => $this->body]);
    }

    private function buildGrid()
    {
        $this->grid['parentbegin'] = "<div class='row'>";
        $this->grid['parentend'] = "</div>";

        $this->grid['leftbuffer'] = "<div class='col-sm-1'></div>";

        $this->grid['leftgridbegin'] = "<div class='col-sm-7'>";
        $this->grid['leftgridend'] = "</div>";

        $this->grid['rightgridbegin'] = "<div class='col-sm-4'>";
        $this->grid['rightgridend'] = "</div>";
    }

    private function buildLeftGrid()
    {
        $this->gridContent['leftgrid'] = "<h3>Left Grid</h3>";
    }

    private function buildRightGrid()
    {
        $this->gridContent['rightgrid'] = "<h3>Right Grid</h3>";
    }

    private function buildBody()
    {
        $this->body .= $this->grid['parentbegin'];
        $this->body .= $this->grid['leftbuffer'];

        $this->body .= $this->grid['leftgridbegin'];
        $this->body .= $this->gridContent['leftgrid'];
        $this->body .= $this->grid['leftgridend'];

        $this->body .= $this->grid['rightgridbegin'];
        $this->body .= $this->gridContent['rightgrid'];
        $this->body .= $this->grid['rightgridend'];

        $this->body .= $this->grid['parentend'];
    }
}