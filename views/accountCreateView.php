<?php

class AccountCreateView
{
	private $customer;

	public function __construct(Customer $customer)
	{
		$this->customer= $customer;
	}

	public function output()
	{
	return '<main>
		<h1>Create Account</h1>
		<h2 class="error">* required field.</h2>
		<form action= "'.htmlspecialchars($_SERVER["PHP_SELF"]).'?action=accountCreate" autocomplete="on" method="post">
			<fieldset>
				<legend>Personal Information</legend>
				First Name: 
				<input type="text" name="firstName" value="'.$this->customer->getFirstName().'">	
				<span class="error">* '.$this->customer->getFirstNameErr().'</span>
				<br><br>
				Last Name: 
				<input type="text" name="lastName" value="'.$this->customer->getLastName().'">	
				<span class="error">* '.$this->customer->getLastNameErr().'</span>
				<br><br>
				Date of Birth:
				<input type="date" name="dateOfBirth" value="'.$this->customer->getDateOfBirth().'">
				<br><br>
				Gender:
				<input type="radio" name="gender" '.($this->customer->getGender()!== NULL and $this->customer->getGender()=="M"? "checked":"").' value="M">Male
				<input type="radio" name="gender" '.($this->customer->getGender()!== NULL and $this->customer->getGender()=="F"? "checked":"").' value="F">Female
				<span class="error">* '.$this->customer->getGenderErr().'</span>
				<br><br>
			</fieldset>
			<fieldset>
				<legend>Address Information</legend>
				Address 1: 
				<input type="text" name="address1" value="'.$this->customer->getAddress1().'">	
				<span class="error">* '.$this->customer->getAddress1Err().'</span>
				<br><br>
				Address 2: 
				<input type="text" name="address2" value="'.  $this->customer->getAddress2().'">	
				<br><br>
				City: 
				<input type="text" name="city" value="'.  $this->customer->getCity().'">	
				<span class="error">* '.  $this->customer->getCityErr().'</span>
				<br><br>
				State:
				<select name="state">
				<option value="AL" '. ($this->customer->getState()=="AL"? 'selected':"").'>Alabama</option>
				<option value="AK" '. ($this->customer->getState()=="AK"? 'selected':"").'>Alaska</option>
				<option value="AZ" '. ($this->customer->getState()=="AZ"? 'selected':"").'>Arizona</option>
				<option value="AR" '. ($this->customer->getState()=="AR"? 'selected':"").'>Arkansas</option>
				<option value="CA" '. ($this->customer->getState()=="CA"? 'selected':"").'>Calornia</option>
				<option value="CO" '. ($this->customer->getState()=="CO"? 'selected':"").'>Colorado</option>
				<option value="CT" '. ($this->customer->getState()=="CT"? 'selected':"").'>Connecticut</option>
				<option value="DE" '. ($this->customer->getState()=="DE"? 'selected':"").'>Delaware</option>
				<option value="DC" '. ($this->customer->getState()=="DC"? 'selected':"").'>District Of Columbia</option>
				<option value="FL" '. ($this->customer->getState()=="FL"? 'selected':"").'>Florida</option>
				<option value="GA" '. ($this->customer->getState()=="GA"? 'selected':"").'>Georgia</option>
				<option value="HI" '. ($this->customer->getState()=="HI"? 'selected':"").'>Hawaii</option>
				<option value="ID" '. ($this->customer->getState()=="ID"? 'selected':"").'>Idaho</option>
				<option value="IL" '. ($this->customer->getState()=="IL"? 'selected':"").'>Illinois</option>
				<option value="IN" '. ($this->customer->getState()=="IN"? 'selected':"").'>Indiana</option>
				<option value="IA" '. ($this->customer->getState()=="IA"? 'selected':"").'>Iowa</option>
				<option value="KS" '. ($this->customer->getState()=="KS"? 'selected':"").'>Kansas</option>
				<option value="KY" '. ($this->customer->getState()=="KY"? 'selected':"").'>Kentucky</option>
				<option value="LA" '. ($this->customer->getState()=="LA"? 'selected':"").'>Louisiana</option>
				<option value="ME" '. ($this->customer->getState()=="ME"? 'selected':"").'>Maine</option>
				<option value="MD" '. ($this->customer->getState()=="MD"? 'selected':"").'>Maryland</option>
				<option value="MA" '. ($this->customer->getState()=="MA"? 'selected':"").'>Massachusetts</option>
				<option value="MI" '. ($this->customer->getState()=="MI"? 'selected':"").'>Michigan</option>
				<option value="MN" '. ($this->customer->getState()=="MN"? 'selected':"").'>Minnesota</option>
				<option value="MS" '. ($this->customer->getState()=="MS"? 'selected':"").'>Mississippi</option>
				<option value="MO" '. ($this->customer->getState()=="MO"? 'selected':"").'>Missouri</option>
				<option value="MT" '. ($this->customer->getState()=="MT"? 'selected':"").'>Montana</option>
				<option value="NE" '. ($this->customer->getState()=="NE"? 'selected':"").'>Nebraska</option>
				<option value="NV" '. ($this->customer->getState()=="NV"? 'selected':"").'>Nevada</option>
				<option value="NH" '. ($this->customer->getState()=="NH"? 'selected':"").'>New Hampshire</option>
				<option value="NJ" '. ($this->customer->getState()=="NJ"? 'selected':"").'>New Jersey</option>
				<option value="NM" '. ($this->customer->getState()=="NM"? 'selected':"").'>New Mexico</option>
				<option value="NY" '. ($this->customer->getState()=="NY"? 'selected':"").'>New York</option>
				<option value="NC" '. ($this->customer->getState()=="NC"? 'selected':"").'>North Carolina</option>
				<option value="ND" '. ($this->customer->getState()=="ND"? 'selected':"").'>North Dakota</option>
				<option value="OH" '. ($this->customer->getState()=="OH"? 'selected':"").'>Ohio</option>
				<option value="OK" '. ($this->customer->getState()=="OK"? 'selected':"").'>Oklahoma</option>
				<option value="OR" '. ($this->customer->getState()=="OR"? 'selected':"").'>Oregon</option>
				<option value="PA" '. ($this->customer->getState()=="PA"? 'selected':"").'>Pennsylvania</option>
				<option value="RI" '. ($this->customer->getState()=="RI"? 'selected':"").'>Rhode Island</option>
				<option value="SC" '. ($this->customer->getState()=="SC"? 'selected':"").'>South Carolina</option>
				<option value="SD" '. ($this->customer->getState()=="SD"? 'selected':"").'>South Dakota</option>
				<option value="TN" '. ($this->customer->getState()=="TN"? 'selected':"").'>Tennessee</option>
				<option value="TX" '. ($this->customer->getState()=="TX"? 'selected':"").'>Texas</option>
				<option value="UT" '. ($this->customer->getState()=="UT"? 'selected':"").'>Utah</option>
				<option value="VT" '. ($this->customer->getState()=="VT"? 'selected':"").'>Vermont</option>
				<option value="VA" '. ($this->customer->getState()=="VA"? 'selected':"").'>Virginia</option>
				<option value="WA" '. ($this->customer->getState()=="WA"? 'selected':"").'>Washington</option>
				<option value="WV" '. ($this->customer->getState()=="WV"? 'selected':"").'>West Virginia</option>
				<option value="WI" '. ($this->customer->getState()=="WI"? 'selected':"").'>Wisconsin</option>
				<option value="WY" '. ($this->customer->getState()=="WY"? 'selected':"").'>Wyoming</option>
				</select>
				<span class="error">* '.  $this->customer->getStateErr().'</span>
				<br><br>
				Phone Number:
				<input type="tel" name="phoneNumber" placeholder="123-456-7890" value="'.  $this->customer->getPhoneNumber().'">
        		<span class="error">* '.  $this->customer->getPhoneNumberErr().'</span>
				<br><br>
			</fieldset>
			<fieldset>
				<legend>Account Information</legend>
				E-Mail Address:
				<input type="text" name="eMail" value="'.  $this->customer->getEMailAddress().'">
				<span class="error">* '.  $this->customer->getEMailErr().'</span>
				<br><br>
				Password:
				<input type="password" name="password" value="'.  $this->customer->getPassword().'">
				<span class="error">* '.  $this->customer->getPasswordErr().'</span>
				<br><br>
				Repeat Password:
				<input type="password" name="passwordRepeat" value="'.  $this->customer->getPasswordRepeat().'">
				<span class="error">* '.  $this->customer->getPasswordRepeatErr().'</span>
				<br><br>
			</fieldset>
			<fieldset>
				<legend>Additional Information</legend>
				Interests:<br>
				<input type="checkbox" name="action" value="action" '. ($this->customer->getAction() =="UNHEX('1')"? "checked":"") .'>Action<br>
				<input type="checkbox" name="children" value="children"'. ($this->customer->getChildren() =="UNHEX('1')"? "checked":"") .'>Children<br>
				<input type="checkbox" name="comedy" value="comedy"'. ($this->customer->getComedy() =="UNHEX('1')"? "checked":"") .'>Comedy<br>
				<input type="checkbox" name="documentary" value="documentary"'. ($this->customer->getDocumentary() =="UNHEX('1')"? "checked":"") .'>Documentary<br>
				<input type="checkbox" name="drama" value="drama"'. ($this->customer->getDrama() =="UNHEX('1')"? "checked":"") .'>Drama<br>
				<input type="checkbox" name="horror" value="horror"'. ($this->customer->getHorror() =="UNHEX('1')"? "checked":"") .'>Horror<br>
				<input type="checkbox" name="musicals" value="musicals"'. ($this->customer->getMusicals() =="UNHEX('1')"? "checked":"") .'>Musicals<br>
				<input type="checkbox" name="romance" value="romance"'. ($this->customer->getRomance() =="UNHEX('1')"? "checked":"") .'>Romance<br>
				<input type="checkbox" name="scienceFiction" value="scienceFiction"'. ($this->customer->getScienceFiction() =="UNHEX('1')"? "checked":"") .'>Science Fiction<br>
				<input type="checkbox" name="thriller" value="thriller"'. ($this->customer->getThriller() =="UNHEX('1')"? "checked":"") .'>Thriller<br>
				Notes:
				<textarea name="notes" rows="10" cols="50" value="'.  $this->customer->getNotes().'"></textarea>
				<br><br>
			</fieldset>
			<input type="submit" value="Submit">
			<input type="reset">
		</form>	
	</main>';
	}
}
?>
<!-- php Desktop/PHP/SantaMonicaMovieRentals/accountCreate.php -->