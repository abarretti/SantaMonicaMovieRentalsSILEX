<?php

class BookingCreateView
{
	private $booking;
	private $customer;
	private $inventory;

	public function __construct(Booking $booking, Customer $customer, Inventory $inventory)
	{
		$this->booking= $booking;
		$this->customer=$customer;
		$this->inventory= $inventory;
	}

	public function output()
	{
	return '<main>
		<h1>Create Booking</h1>
		<form action= "'.htmlspecialchars($_SERVER["PHP_SELF"]).'?action=bookingCreate" autocomplete="on" method="post">
			<fieldset>
				<legend>Customer Information</legend>
				Customer E-Mail Address: 
				<input type="text" name="eMail" value="'.$_SESSION["bookingEMail"].'">
				<span class="error">* '.$this->booking->getEMailErr().'</span>
				<br><br>
			</fieldset>
			<fieldset>
				<legend>Inventory</legend>
				'.$this->booking->getBookingInventory($_SESSION["inventoryCount"]).'
			<input type="submit" name="addItem" value="Add Item">
			<input type="submit" name="removeItem" value="Remove Item">
			</fieldset>
      <fieldset>
        <legend>Booking Date</legend>
        <input type="date" name="bookingDate" value="'.$this->booking->getBookingDate().'">
        <span class="error">* '.$this->booking->getBookingDateErr().'</span>
      </fieldset>
			<input type="submit" name="submitBooking" value="Submit">
			<input type="reset">
		</form>

		<h2>Search for Customer</h2>
		<h2 class="notice">* field is subject to input restrictions.</h2>
		<form action= "'.htmlspecialchars($_SERVER["PHP_SELF"]).'?action=bookingCreate" autocomplete="on" method="post">
			<fieldset>
				<legend>Search by Personal Information</legend>
				Last Name: 
				<input type="text" name="lastName" value="'.$this->customer->getLastName().'">	
				<span class="notice">* '.$this->customer->getLastNameErr().'</span>
				<br><br>
				Date of Birth:
				<input type="date" name="dateOfBirth" value="'.$this->customer->getDateOfBirth().'">
				<br><br>
				Address 1: 
				<input type="text" name="address1" value="'.$this->customer->getAddress1().'">	
				<span class="notice">* '.$this->customer->getAddress1Err().'</span>
				<br><br>
				Phone Number:
				<input type="tel" name="phoneNumber" value="'.$this->customer->getPhoneNumber().'">
        		<span class="notice">* '.$this->customer->getPhoneNumberErr().'</span>
				<br><br>
			</fieldset>
			<input type="submit" name="submitCustomer" value="Submit">
			<input type="reset">
		</form>

		<h2>Search for Inventory</h2>
		<h2 class="notice">* field is subject to input restrictions.</h2>
		<form action= "'.htmlspecialchars($_SERVER["PHP_SELF"]).'?action=bookingCreate" autocomplete="on" method="post">
			<fieldset>
				<legend>Search by Inventory or Product Information</legend>
				Barcode Number: 
				<input type="text" name="barCodeNumber" value="'.$this->inventory->getBarCodeNumber().'">
				<span class="notice">* '.$this->inventory->getBarCodeNumberErr().'</span>
				<br><br>
				SKU Number: 
				<input type="text" name="sKUNumber" value="'.$this->inventory->getSKUNumber().'">
				<span class="notice">* '.$this->inventory->getSKUNumberErr().'</span>
				<br><br>
				Product Name: 
				<input type="text" name="productName" value="'.$this->inventory->getProductName().'">	
				<span class="notice">* '.$this->inventory->getProductNameErr().'</span>
				<br><br>
			</fieldset>
			<input type="submit" name="submitProduct" value="Submit">
			<input type="reset">
		</form>
	</main>';
	}//function close
}//class close
?>
