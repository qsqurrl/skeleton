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

        $top = explode("\r\n", $elementData);

        foreach ($top as $line)
        {
            $sec = explode(":", $line);
            if ($sec[0] == "Header") {
                $table->addHeader($sec[1]);
            }
            elseif ($sec[0] == "Row")
            {
                $rw = explode("|", $sec[1]);
                $table->addRow($rw);
            }
        }

        //echo $table->getHTML();

        //$this->content = substr_replace($this->content,'',$start,$end);
        $this->content = substr($this->content,0, $start) . $table->getHTML() . substr($this->content,($end + $etaglen));
        //$this->content = substr_replace($this->content, $table->getHTML(), $start, 0);
    }
}