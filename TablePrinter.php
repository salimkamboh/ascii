<?php

namespace ascii;

class TablePrinter {

    var $arrInput;
    const black = "\033[0m";
    static $colors = array("\033[31m", "\033[35m", "\033[33m", "\033[32m", "\033[36m");
    const max_width = 20;
    const pad1 = 1;

    function __construct($input) {
        $this->arrInput = $input;
    }

    function printTable() {
        if(empty($this->arrInput))
            return;
        $this->printBorder();
        $this->printHeader();
        $this->printBorder();
        $this->printRows();
        $this->printBorder();
    }

    private function printRows() {
        $titles = array_keys($this->arrInput[0]);
        //print top border
        foreach ($this->arrInput as $row) {
            print self::black.'|';
            for ($k = 0; $k < count($titles); $k++) {
                for ($j = 0; $j < self::pad1; $j++)
                    print ' ';
                print self::$colors[$k].$row[$titles[$k]];
                //print "\033[31m";
                $pad2 = self::max_width - self::pad1 - strlen($row[$titles[$k]]);
                for ($j = 0; $j < $pad2; $j++)
                    print ' ';
                print self::black.'|';
            }
            print "\n";
        }
    }

    private function printHeader() {
        $titles = array_keys($this->arrInput[0]);
        //print top border
        print self::black.'|';
        for ($i=0; $i<count($titles);$i++) {
            $c = $titles[$i];
            for ($j = 0; $j < self::pad1; $j++)
                print ' ';
            print self::$colors[$i].$c;
            $pad2 = self::max_width - self::pad1 - strlen($c);
            for ($j = 0; $j < $pad2; $j++)
                print ' ';
            print self::black.'|';
        }
        print "\n";
    }

    private function printBorder() {
        print self::black.'+';
        for ($i = 0; $i < count(array_keys($this->arrInput[0])); $i++) {
            print self::$colors[$i];
            for ($j = 0; $j < self::max_width; $j++)
                print '-';
            print self::black.'+';
        }
        print "\n";
    }

}

$array = array(
    array(
        'Name' => 'Trixie',
        'Color' => 'Green',
        'Element' => 'Earth',
        'Likes' => 'Flowers'
    ),
    array(
        'Name' => 'Tinkerbell',
        'Element' => 'Air',
        'Likes' => 'Singning',
        'Color' => 'Blue'
    ),
    array(
        'Element' => 'Water',
        'Likes' => 'Dancing',
        'Name' => 'Blum',
        'Color' => 'Pink'
    ),
);

$ascii = new \ascii\TablePrinter($array);
$ascii->printTable();
