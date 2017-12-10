<?php

class HeaderView
{
	private $model;

	public function __construct(Model $model)
	{
		$this->model= $model;
	}

	public function output()
	{
		return '<header>
		<h1>Santa Monica Movie Rentals</h1>
		<h2>Movies - TV Shows - Video Games</h2>
		<nav id="1">
			<a href="index.php?action=home"'.($this->model->page=="home"? 'class="active"':'').'>Home</a>
			<div class="dropdown">
				<a href="index.php?action=inventory"'.($this->model->page=="inventory"? 'class="active"':'').'>Inventory</a>
				<div class="dropdown-content">
					<a href="index.php?action=inventoryCreate"'.($this->model->page=="inventoryCreate"? 'class="active"':'').'>Inventory Create</a>
					<a href="index.php?action=inventorySearch"'.($this->model->page=="inventorySearch"? 'class="active"':'').'>Inventory Search</a>
				</div>
			</div>
			<div class="dropdown">
				<a href="index.php?action=booking"'.($this->model->page=="booking"? 'class="active"':'').'>Booking</a> 
				<div class="dropdown-content">
					<a href="index.php?action=bookingCreate"'.($this->model->page=="bookingCreate"? 'class="active"':'').'>Booking Create</a>
					<a href="index.php?action=bookingSearch"'.($this->model->page=="bookingSearch"? 'class="active"':'').'>Booking Search</a>
				</div>
			</div>
			<div class="dropdown">
				<a href="index.php?action=customers"'.($this->model->page=="customers"? 'class="active"':'').'>Customers</a>
				<div class="dropdown-content">
					<a href="index.php?action=accountCreate"'.($this->model->page=="accountCreate"? 'class="active"':'').'>Account Create</a>
					<a href="index.php?action=accountSearch"'.($this->model->page=="accountSearch"? 'class="active"':'').'>Account Search</a>
				</div>
			</div>
		</nav>
		</header>';
	}

}//class end
?>