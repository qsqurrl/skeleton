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
    private $headers;
    private $rows;

    public function addHeaders($data)
    {
        foreach ($data as $item)
        {
            $this->headers[] = $item;
        }
    }

    public function addHeader($item)
    {
        $this->headers[] = $item;
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
        $html = '<table>';

        if ($this->headers !== NULL)
        {
            $html .= '<tr>';
            foreach ($this->headers as $item)
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

        $html .= '</table>';
        return $html;
    }
}