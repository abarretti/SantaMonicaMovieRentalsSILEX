<?php

class AccountSearchView
{
	private $customer;

	public function __construct(Customer $customer)
	{
		$this->customer= $customer;
	}

	public function output()
	{
	return 	'<main>
		<h1>Search Customer Accounts</h1>
		<h2 class="notice">* field is subject to input restrictions.</h2>
		<form action= "'.htmlspecialchars($_SERVER["PHP_SELF"]).'?action=accountSearch" autocomplete="on" method="post">
			<fieldset>
				<legend>Search by Personal Information</legend>
				First Name: 
				<input type="text" name="firstName" value="'.$this->customer->getFirstName().'">
				<span class="notice">* '.$this->customer->getFirstNameErr().'</span>
				<br><br>
				Last Name: 
				<input type="text" name="lastName" value="'.$this->customer->getLastName().'">	
				<span class="notice">* '.$this->customer->getLastNameErr().'</span>
				<br><br>
				Date of Birth:
				<input type="date" name="dateOfBirth" value="'.$this->customer->getDateOfBirth().'">
				<br><br>
				Gender:
				<input type="radio" name="gender" value="M">Male
				<input type="radio" name="gender" value="F">Female
				<br><br>
			</fieldset>
				<input type="submit" name="submitPersonal" value="Submit">
				<input type="reset">
		</form>
		<form action= "'.htmlspecialchars($_SERVER["PHP_SELF"]).'?action=accountSearch" autocomplete="on" method="post">
			<fieldset>
				<legend>Search by Address Information</legend>
				Address 1: 
				<input type="text" name="address1" value="'.$this->customer->getAddress1().'">	
				<span class="notice">* '.$this->customer->getAddress1Err().'</span>
				<br><br>
				City: 
				<input type="text" name="city" value="'.$this->customer->getCity().'">	
				<span class="notice">* '.$this->customer->getCityErr().'</span>
				<br><br>
				State:
				<select name="state">
				<option value="" '.($this->customer->getState()==""? 'selected':'').'></option>
				<option value="AL" '.($this->customer->getState()=="AL"? 'selected':'').'>Alabama</option>
				<option value="AK" '.($this->customer->getState()=="AK"? 'selected':'').'>Alaska</option>
				<option value="AZ" '.($this->customer->getState()=="AZ"? 'selected':'').'>Arizona</option>
				<option value="AR" '.($this->customer->getState()=="AR"? 'selected':'').'>Arkansas</option>
				<option value="CA" '.($this->customer->getState()=="CA"? 'selected':'').'>California</option>
				<option value="CO" '.($this->customer->getState()=="CO"? 'selected':'').'>Colorado</option>
				<option value="CT" '.($this->customer->getState()=="CT"? 'selected':'').'>Connecticut</option>
				<option value="DE" '.($this->customer->getState()=="DE"? 'selected':'').'>Delaware</option>
				<option value="DC" '.($this->customer->getState()=="DC"? 'selected':'').'>District Of Columbia</option>
				<option value="FL" '.($this->customer->getState()=="FL"? 'selected':'').'>Florida</option>
				<option value="GA" '.($this->customer->getState()=="GA"? 'selected':'').'>Georgia</option>
				<option value="HI" '.($this->customer->getState()=="HI"? 'selected':'').'>Hawaii</option>
				<option value="ID" '.($this->customer->getState()=="ID"? 'selected':'').'>Idaho</option>
				<option value="IL" '.($this->customer->getState()=="IL"? 'selected':'').'>Illinois</option>
				<option value="IN" '.($this->customer->getState()=="IN"? 'selected':'').'>Indiana</option>
				<option value="IA" '.($this->customer->getState()=="IA"? 'selected':'').'>Iowa</option>
				<option value="KS" '.($this->customer->getState()=="KS"? 'selected':'').'>Kansas</option>
				<option value="KY" '.($this->customer->getState()=="KY"? 'selected':'').'>Kentucky</option>
				<option value="LA" '.($this->customer->getState()=="LA"? 'selected':'').'>Louisiana</option>
				<option value="ME" '.($this->customer->getState()=="ME"? 'selected':'').'>Maine</option>
				<option value="MD" '.($this->customer->getState()=="MD"? 'selected':'').'>Maryland</option>
				<option value="MA" '.($this->customer->getState()=="MA"? 'selected':'').'>Massachusetts</option>
				<option value="MI" '.($this->customer->getState()=="MI"? 'selected':'').'>Michigan</option>
				<option value="MN" '.($this->customer->getState()=="MN"? 'selected':'').'>Minnesota</option>
				<option value="MS" '.($this->customer->getState()=="MS"? 'selected':'').'>Mississippi</option>
				<option value="MO" '.($this->customer->getState()=="MO"? 'selected':'').'>Missouri</option>
				<option value="MT" '.($this->customer->getState()=="MT"? 'selected':'').'>Montana</option>
				<option value="NE" '.($this->customer->getState()=="NE"? 'selected':'').'>Nebraska</option>
				<option value="NV" '.($this->customer->getState()=="NV"? 'selected':'').'>Nevada</option>
				<option value="NH" '.($this->customer->getState()=="NH"? 'selected':'').'>New Hampshire</option>
				<option value="NJ" '.($this->customer->getState()=="NJ"? 'selected':'').'>New Jersey</option>
				<option value="NM" '.($this->customer->getState()=="NM"? 'selected':'').'>New Mexico</option>
				<option value="NY" '.($this->customer->getState()=="NY"? 'selected':'').'>New York</option>
				<option value="NC" '.($this->customer->getState()=="NC"? 'selected':'').'>North Carolina</option>
				<option value="ND" '.($this->customer->getState()=="ND"? 'selected':'').'>North Dakota</option>
				<option value="OH" '.($this->customer->getState()=="OH"? 'selected':'').'>Ohio</option>
				<option value="OK" '.($this->customer->getState()=="OK"? 'selected':'').'>Oklahoma</option>
				<option value="OR" '.($this->customer->getState()=="OR"? 'selected':'').'>Oregon</option>
				<option value="PA" '.($this->customer->getState()=="PA"? 'selected':'').'>Pennsylvania</option>
				<option value="RI" '.($this->customer->getState()=="RI"? 'selected':'').'>Rhode Island</option>
				<option value="SC" '.($this->customer->getState()=="SC"? 'selected':'').'>South Carolina</option>
				<option value="SD" '.($this->customer->getState()=="SD"? 'selected':'').'>South Dakota</option>
				<option value="TN" '.($this->customer->getState()=="TN"? 'selected':'').'>Tennessee</option>
				<option value="TX" '.($this->customer->getState()=="TX"? 'selected':'').'>Texas</option>
				<option value="UT" '.($this->customer->getState()=="UT"? 'selected':'').'>Utah</option>
				<option value="VT" '.($this->customer->getState()=="VT"? 'selected':'').'>Vermont</option>
				<option value="VA" '.($this->customer->getState()=="VA"? 'selected':'').'>Virginia</option>
				<option value="WA" '.($this->customer->getState()=="WA"? 'selected':'').'>Washington</option>
				<option value="WV" '.($this->customer->getState()=="WV"? 'selected':'').'>West Virginia</option>
				<option value="WI" '.($this->customer->getState()=="WI"? 'selected':'').'>Wisconsin</option>
				<option value="WY" '.($this->customer->getState()=="WY"? 'selected':'').'>Wyoming</option>
				</select>
				<br><br>
				Phone Number:
				<input type="tel" name="phoneNumber" value="'.$this->customer->getPhoneNumber().'">
        		<span class="notice">* '.$this->customer->getPhoneNumberErr().'</span>
				<br><br>
			</fieldset>
				<input type="submit" name="submitAddress" value="Submit">
				<input type="reset">
		</form>
		<form action= "'.htmlspecialchars($_SERVER["PHP_SELF"]).'?action=accountSearch" autocomplete="on" method="post">
			<fieldset>
				<legend>Search by E-Mail Address</legend>
				E-Mail Address:
				<input type="text" name="eMail" value="'.$this->customer->getEMailAddress().'">
				<span class="notice">* '.$this->customer->getEMailErr().'</span>
				<br><br>
			</fieldset>
				<input type="submit" name="submitEMail" value="Submit">
				<input type="reset">
		</form>	
	</main>';
	}
}
?>