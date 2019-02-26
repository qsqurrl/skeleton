<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2/24/2019
 * Time: 6:12 PM
 */

namespace App\Utils;


class Layout
{
    public $rows;
    public $columns;

    public function __construct()
    {
    }

    /*
     * data is an array as follows
     * name is unique identifier
     * title is title for row in H2 tag
     */
    public function addChildRow($data)
    {
        $this->rows[$data['name']] = $data;
    }

    /*
     * data is an array as follows
     * name is unique identifier
     * title is title for column in H3 tag
     * parent is name of parent row
     * width is Bootstrap col-* width
     * html is the HTML data to be displayed
     */
    public function addChildColumn($data)
    {
        $this->rows[$data['parent']]['children'][] = $data;
    }
}