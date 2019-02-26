<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2/24/2019
 * Time: 7:18 PM
 */

namespace App\Elements;


class Table
{
    private $tableOpen;
    private $tableClose;
    private $header;
    private $rows;

    public function __construct()
    {
        $this->tableOpen = "<table>";
        $this->tableClose = "</table>";
    }

    public function addHeaders($data)
    {
        foreach ($data as $item)
        {
            $this->header[] = $item;
        }
    }

    public function addHeader($item)
    {
        $this->header[] = $item;
    }

    public function addRows($data)
    {
        foreach ($data as $item)
        {
            $this->rows[] = $item;
        }
    }

    public function addRow($item)
    {
        $this->rows[] = $item;
    }

    public function getHTML()
    {
        $html .= $this->tableOpen;

        if ($this->header !== NULL)
        {
            $html .= '<tr>';
            foreach ($this->header as $item)
            {
                $html .= '<th>'.$item.'</th>';
            }
            $html .= '</tr>';

        }

        if ($this->rows !== NULL)
        {
            $html .= '<tr>';
            foreach ($this->rows as $row)
            {
                foreach ($row as $item)
                {
                    $html .= '<td>'.$item.'</td>';
                }
            }
            $html .= '</tr>';
        }

        $html .= $this->tableClose;
        return $html;
    }
}