<?php
namespace Services;

class TextProductWriter extends ShopProductWriter
{
	public function write() {
		$str = "ТОВАРЫ: ";
		foreach ($this->products as $shopProduct) {
			$str .= $shopProduct->getSummaryLine();
		}
		print_r ($str);
	}
}