<?php
namespace Services;

use Core\DB;

class ShopProduct implements Chargeable {
    private $title;
    private $producerMainName;
    private $producerFirstName;
    protected $price;
    private $discount = 0; 
    private $id = 0;
    protected $db;
    
    public function __construct($title, $firstName, $mainName, $price) { 
        $this->title             = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName  = $mainName;
        $this->price             = $price;
        $this->db                = DB::Instance();
    }

    public function setID( $id ) {
        $this->id = $id;
    }

    public function getProducerFirstName() {
        return $this->producerFirstName;
    }

    public function getProducerMainName() {
        return $this->producerMainName;
    }

    public function setDiscount( $num ) {
        $this->discount=$num;
    }

    public function getDiscount() {
        return $this->discount;
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function getPrice() {
        return ($this->price - $this->discount);
    }

    public function getProducer() {
        return "{$this->producerFirstName}".
               " {$this->producerMainName}";
    }

    function getSummaryLine() {
        $base  = "$this->title ( $this->producerMainName, ";
        $base .= "$this->producerFirstName )"; 
        return $base;
    }

    public static function getInstance($id) {
        $stmp = DB::Instance()->prepare("SELECT * FROM products WHERE id='$id'");
        $res = $stmp->execute(array ($id));

        $row = $stmp->fetch();

        if (empty($row)) {return null;}

        if ($row['type'] == "book") {
            $product = new BookProduct(
                                        $row['title'],
                                        $row['firstname'],
                                        $row['mainname'],
                                        $row['price'],                                       
                                        $row['numpages']
                                        );
        }
        else if ($row['type'] == "cd") {
            $product = new CDProduct(
                                        $row['title'],
                                        $row['firstname'],
                                        $row['mainname'],
                                        $row['price'],
                                        $row['playlength']
                                        );
        
        }else{
            $product = new ShopProduct( 
                                        $row['title'],
                                        $row['firstname'],
                                        $row['mainname'],
                                        $row['price']
                                        );
        }
        $product->setID($row['id']);
        $product->setDiscount($row['discount']);
        return $product;
    }

}

