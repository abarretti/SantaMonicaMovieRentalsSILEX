<?php

class BookingView
{
	public function __construct()
	{
		
	}

	public function output()
	{
		return '<main>
			<h1>Booking</h1>
			<div class="existing">
				<h2>Update or Search Bookings &amp; Loans</h2>
				<p>Click <a href="index.php?action=bookingSearch">here</a> to update an active booking or search for a prior booking.</p>
			</div>
			<div class="create">
				<h2>Book a Product for a Customer</h2>
				<p>Click <a href="index.php?action=bookingCreate">here</a> to create a new customer booking.</p>
			</div>
		</main>';
	}
}
?>