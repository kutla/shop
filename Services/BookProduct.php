<?php
namespace Services;

class BookProduct extends ShopProduct 
{
    private $numPages = 0;

    public function __construct($title, $firstName, $mainName, $price, $numPages ) { 
        parent::__construct($title, $firstName, $mainName, $price );
        $this->numPages = $numPages;
    }

    public function getNumberOfPages() {
        return $this->numPages;
    }
   
    function getSummaryLine() {
        $base = parent::getSummaryLine();
        $base .= ": page count - $this->numPages";
        return $base;
    }

}