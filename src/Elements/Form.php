<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2019-02-26
 * Time: 12:16
 */

namespace App\Elements;


class Form
{
    private $html;

    public function __construct($items, $action, $newline)
    {
        $this->html = "<form " . (is_null($action) ? "": "action='" . $action . "'") . "><br />";

        foreach ($items as $item)
        {
            $this->html .= $this->checkType($item)->getHTML();

            $this->html .= ($newline ? "<br />" : '');
        }

        $this->html .= "</form><br />";
    }

    public function getHTML()
    {
        return $this->html;
    }

    private function checkType($item): InputItem
    {
        return $item;
    }
}