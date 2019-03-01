<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2/28/2019
 * Time: 5:17 PM
 */

namespace App\Service;

use App\Elements\Table;


class Parser
{
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
            'table' => '{!starttable!}'
        );

        $this->closeElements = array(
            'table' => '{!endtable!}'
        );

        foreach ($this->openElements as $type => $element)
        {
            if ($i = strpos($data, $element, $curPos))
            {
                if ($x = strpos($data, $this->closeElements[$type], $i))
                {
                    $olen = strlen($element);
                    $clen = strlen($this->closeElements[$type]);

                    call_user_func($this->functions[$type], substr($data,$i, $x),$i, $x, $olen, $clen );
                    $curPos = $x;
                }
            }
        }
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function parseTable($data, $start, $end, $staglen, $etaglen)
    {
        $table = new Table();
        $elementData = substr($data, $staglen, ($end-$start) - $staglen);

        foreach (explode("\r\n", $elementData) as $line)
        {
            foreach (explode(":",$line) as $key => $value)
            {
                if ($key == "Header")
                {
                    $table->addHeader($value);
                }
                elseif ($key == "Row")
                {
                    $table->addRow(explode("|", $value));
                }
            }
        }

        //replace content section with HTML output
    }
}