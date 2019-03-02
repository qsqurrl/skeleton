<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2019-02-26
 * Time: 10:55
 */

/**
 * Class InputItem
 * Create an Input element of $type to send to a Form Element
 */
namespace App\Elements;


class InputItem
{
    private $html;
    /**
     * InputItem constructor.
     * @param $data
     */
    public function __construct($data)
    {
        switch (strtolower($data['type']))
        {
            case 'input':
                $this->buildInputType($data);
                break;
            case 'submit':
                $this->buildButtonType($data);
                break;
            case 'datetime':
                $this->buildInputType($data);
                break;
            case 'password':
                $this->buildInputType($data);
                break;
            default:
                $this->html = false;
                break;
        }
    }

    public function getHTML()
    {
        return $this->html;
    }

    private function buildButtonType($data)
    {
        $this->html ="<input type='" . $data['type'] ."' name='" . $data['name'] . "' value='" . $data['label'] . "'";
        if (!empty($data['width']))
        {
            $this->html .= " width='" . $data['width'] . "'";
        }

        $this->html .= " />";
    }

    private function buildInputType($data)
    {
        $this->html = $data['label'] . "&nbsp;&nbsp;<input type='" . $data['type'] . "' name='" . $data['name'] . "'";
        if (!empty($data['width']))
        {
            $this->html .= " width='" . $data['width'] . "'";
        }

        $this->html .= " />";
    }
}