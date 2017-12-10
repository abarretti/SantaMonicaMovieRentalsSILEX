<?php

class CustomersView
{
	public function __construct()
	{
		
	}

	public function output()
	{
		return '<main>
			<h1>Customers</h1>
			<div class="existing">
				<h2>Find Existing Customer Account</h2>
				<p>Click <a href="index.php?action=accountSearch">here</a> to search for or change an existing customer account.</p>
			</div>
			<div class="create">
				<h2>Create New Customer Account</h2>
				<p>Click <a href="index.php?action=accountCreate">here</a> to create a new customer account.</p>
			</div>
		</main>';
	}
}
?>