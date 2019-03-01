<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2/28/2019
 * Time: 5:17 PM
 */

namespace App\Service;


class Parser
{
    private $openTag = '{!';
    private $closeTag = '!}';
    private $functions;
    private $openElements;
    private $closeElements;
    private $content;

    public function __construct($data)
    {
        $currentElement = '';
        $curPos = 0;

        $this->content = $data;

        $this->functions = array(
                'table' => array($this, 'parseTable')
        );

        $this->openElements = array(
            'table' => 'starttable'
        );

        $this->closeElements = array(
            'table' => 'endtable'
        );

        foreach ($this->openElements as $type => $element)
        {
            if ($i = strpos($data, $this->openTag.$element.$this->closeTag,$curPos))
            {
                if ($x = strpos($data,$this->openTag.$this->closeElements[$type].$this->closeTag))
                {
                    call_user_func($this->functions[$type], substr($data,($i - 2), ($x +7)),($i - 2), ($x + 7));
                    $curPos = $x;
                }
            }
        }
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function parseTable($data,$start,$end)
    {
        $elementData = substr($data, 16,($end - 13));
        $tmp = "<table>";

        //replace headers
        $tmp .= "<tr>";
        $headers = explode("{!header:", $elementData);
        dump($headers);
        foreach ($headers as $header)
        {
            if (!empty(trim($header)))
            {
                $tmp .= "<th>" . substr($header,0,strlen(trim($header)) - 2) . "</th>";
            }
        }
        $tmp .= "</tr>";
        $tmp .= "</table>";

        $this->content = substr_replace($this->content, $tmp, $start, ($end-$start) +5);
    }
}