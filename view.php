<?php

function __autoload($name)
{
	include_once str_replace("\\", DIRECTORY_SEPARATOR, $name) . '.php';
}

$product1 = new Services\BookProduct(    "My Antonia", "Willa", "Cather", 5.99, 300 );
$product2 =   new Services\CDProduct(    "Exile on Coldharbour Lane", 
                                "The", "Alabama 3", 10.99, 60.33 );

$textwriter = new Services\XmlProductWriter();
$textwriter->addProduct($product1);
$textwriter->write();
