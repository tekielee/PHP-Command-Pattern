<?php
class Stock {
	function __construct() {
		$this->name = 'ABC';
		$this->quantity = 10;
	}
	
	public function buy(): void {
		echo 'Stock [ Name: ' . $this->name . ', Quantity: ' . $this->quantity . ' ] bought<br/>';
	}
	
	public function sell(): void {
		echo 'Stock [ Name: ' . $this->name . ', Quantity: ' . $this->quantity . ' ] sold<br/>';
	}
}

class BuyStock {
	function __construct(Stock $stock) {
		$this->stock = $stock;
	}
	
	public function execute(): void {
		$this->stock->buy();
	}
}

class SellStock {
	function __construct(Stock $stock) {
		$this->stock = $stock;
	}
	
	public function execute(): void {
		$this->stock->sell();
	}
}

class Broker {
	function __construct() {
		$this->orderList = [];
	}
	
	public function takeOrder(object $order) {
		array_push($this->orderList, $order);
	}
	
	public function placeOrders(): void {
		for($i = 0; $i < sizeof($this->orderList); $i++) {
			$this->orderList[$i]->execute();
		}
		
		$this->orderList = [];
	}
}

$stock = new Stock();

$buyStock = new BuyStock($stock);
$sellStock = new SellStock($stock);

$broker = new Broker();
$broker->takeOrder($buyStock);
$broker->takeOrder($sellStock);

$broker->placeOrders();
?>