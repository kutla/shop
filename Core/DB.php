<?php
namespace Core;

class DB
{	
	private static $db;

	public static function Instance()
	{
		if (self::$db == null) {
			self::$db = self::get();
		}
		return self::$db;
	}

	private static function get()
	{
		$db = new \PDO('mysql:host=localhost;dbname=shop_products', 'root', '');
		$db->exec("SET NAMES UTF8");
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		return $db;
	}

}