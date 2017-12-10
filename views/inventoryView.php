<?php

class InventoryView
{
	public function __construct()
	{
		
	}

	public function output()
	{
		return '<main>
			<h1>Inventory &amp; Products</h1>
			<div class="existing">
				<h2>Find Existing Product</h2>
				<p>Click <a href="index.php?action=inventorySearch">here</a> to search for an existing product or inventory item.</p>
			</div>
			<div class="create">
				<h2>Create New Inventory Item</h2>
				<p>Click <a href="index.php?action=inventoryCreate">here</a> to create a new inventory item.</p>
			</div>
		</main>';
	}
}
?>