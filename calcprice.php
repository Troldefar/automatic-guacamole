<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Product {
	private int $price;
	private int $weight;
	private bool $freeShipping = false;
	
	function __construct($price, $weight) {
		$this->price = $price;
		$this->weight = $weight;
	}
	
	public function getWeight() {
		return $this->weight;
	}
	
	public function setFreeShipping() {
		$this->freeShipping = true;
	}
	
	public function getFreeShipping() {
		return $this->freeShipping;
	}
}

class Shipping {
	private int   $totalShipping = 0;
	private int   $pricePerKilo;
	private array $products;
	
	public function __construct($pricePerKilo) {
		$this->pricePerKilo = $pricePerKilo;
	}
	
	public function addProduct(Product $product) {
		$this->products[] = $product;
	}
	
	public function calculateTotalShipping() {
		foreach ($this->products as $product) {
			if ($product->getFreeShipping()) continue;
			$this->totalShipping += $product->getWeight() * $this->pricePerKilo;
		}
	}
	
	public function getTotalShippingPrice() {
		return $this->totalShipping;
	}
}

$product  = new Product(23, 50);
$product2 = new Product(233, 503);
$product2->setFreeShipping();

$shipping = new Shipping(30);
$shipping->addProduct($product);
$shipping->addProduct($product2);
$shipping->calculateTotalShipping();
$total = $shipping->getTotalShippingPrice();
var_dump($total);