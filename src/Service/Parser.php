<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2/28/2019
 * Time: 5:17 PM
 */

namespace App\Service;

use App\Elements\Table;
use App\Elements\InputItem;


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
                'table' => array($this, 'parseTable'),
                'input' => array($this, 'parseInput')
        );

        $this->openElements = array(
            'table' => '{!starttable!}',
            'input' => '{!startinput!}'
        );

        $this->closeElements = array(
            'table' => '{!endtable!}',
            'input' => '{!endinput!}'
        );

        foreach ($this->openElements as $type => $element)
        {
            if ($i = strpos($data, $element))
            {
                if ($x = strpos($data, $this->closeElements[$type], $i))
                {
                    $olen = strlen($element);
                    $clen = strlen($this->closeElements[$type]);

                    call_user_func($this->functions[$type], substr($data,$i, $x),$i, $x, $olen, $clen );
                    $curPos = $x;
                    $data = $this->content;
                }
            }
        }
    }

    public function getContent(): string
    {
        return $this->content;
    }

    private function replaceString($string, $replace, $start, $end)
    {
        return substr($string,0, $start) . $replace . substr($string,$end);
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
        $this->content = $this->replaceString($this->content, $table->getHTML(), $start, ($end + $etaglen));
    }

    public function parseInput($data, $start, $end, $staglen, $etaglen)
    {
        $itm = array();
        $elementData = substr($data, $staglen, ($end-$start) - $staglen);

        $top = explode("\r\n", $elementData);
        foreach ($top as $line)
        {
            $sec = explode(":", $line);
            if (!empty(trim($sec[0])))
            {
                $itm[strtolower($sec[0])] = $sec[1];
            }
        }

        $input = new InputItem($itm);

        $this->content = $this->replaceString($this->content, $input->getHTML(), $start, ($end + $etaglen));
    }
}