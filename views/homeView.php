<?php

class HomeView
{
	public function __construct()
	{
		
	}

	public function output()
	{
		return '<main>
			<h1>Welcome!</h1>
			<div class="newArrivals">
				<h2>New Arrivals</h2>
				<ol>
					<li>Newest Title</li>
					<li>Second Newest</li>
					<li>Third Newest</li>
				</ol>
			</div>
			<div class="announcements">
				<h2>Announcements</h2>
				<ul>
					<li>We are raising late fees by 5% starting in a week.</li>
					<li>Congrats to the employee of the month: Jeff Jackson!</li>
					<li>Jim Carey will be at the store on Wednesday for an autograph signing session!</li>
				</ul>
			</div>
		</main>';
	}
}
?>
<!-- php Desktop/PHP/SantaMonicaMovieRentals/accountCreate.php -->