<?php

class MainView
{
	private $model;

	public function __construct(Model $model)
	{
		$this->model= $model;
	}

	public function output($page)
	{
		if ($page=="home")
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

		if ($page=="booking")
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

		if ($page=="inventory")
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

		if ($page=="customers")
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

		if ($page=="accountCreate")
		{
		return '<main>
		<h1>Create Account</h1>
		<h2 class="error">* required field.</h2>
		<form action= "'.htmlspecialchars($_SERVER["PHP_SELF"]).'" autocomplete="on" method="post">
			<fieldset>
				<legend>Personal Information</legend>
				First Name: 
				<input type="text" name="firstName" value="'.$this->functionalModel->getFirstName().'">	
				<span class="error">* '.$this->functionalModel->getFirstNameErr().'</span>
				<br><br>
				Last Name: 
				<input type="text" name="lastName" value="'.$this->functionalModel->getLastName().'">	
				<span class="error">* '.$this->functionalModel->getLastNameErr().'</span>
				<br><br>
				Date of Birth:
				<input type="date" name="dateOfBirth" value="'.$this->functionalModel->getDateOfBirth().'">
				<br><br>
				Gender:
				<input type="radio" name="gender" '.($this->functionalModel->getGender()!== NULL and $this->functionalModel->getGender()=="M"? "checked":"").' value="M">Male
				<input type="radio" name="gender" '.($this->functionalModel->getGender()!== NULL and $this->functionalModel->getGender()=="F"? "checked":"").' value="F">Female
				<span class="error">* '.$this->functionalModel->getGenderErr().'</span>
				<br><br>
			</fieldset>
			<fieldset>
				<legend>Address Information</legend>
				Address 1: 
				<input type="text" name="address1" value="'.$this->functionalModel->getAddress1().'">	
				<span class="error">* '.$this->functionalModel->getAddress1Err().'</span>
				<br><br>
				Address 2: 
				<input type="text" name="address2" value="'.$this->functionalModel->getAddress2().'">	
				<br><br>
				City: 
				<input type="text" name="city" value="'.$this->functionalModel->getCity().'">	
				<span class="error">* '.$this->functionalModel->getCityErr().'</span>
				<br><br>
				State:
				<select name="state">
								<option value="AL" '.($this->functionalModel->getState()=="AL"? 'selected':"").'>Alabama</option>
				<option value="AK" '.($this->functionalModel->getState()=="AK"? 'selected':"").'>Alaska</option>
				<option value="AZ" '.($this->functionalModel->getState()=="AZ"? 'selected':"").'>Arizona</option>
				<option value="AR" '.($this->functionalModel->getState()=="AR"? 'selected':"").'>Arkansas</option>
				<option value="CA" '.($this->functionalModel->getState()=="CA"? 'selected':"").'>California</option>
				<option value="CO" '.($this->functionalModel->getState()=="CO"? 'selected':"").'>Colorado</option>
				<option value="CT" '.($this->functionalModel->getState()=="CT"? 'selected':"").'>Connecticut</option>
				<option value="DE" '.($this->functionalModel->getState()=="DE"? 'selected':"").'>Delaware</option>
				<option value="DC" '.($this->functionalModel->getState()=="DC"? 'selected':"").'>District Of Columbia</option>
				<option value="FL" '.($this->functionalModel->getState()=="FL"? 'selected':"").'>Florida</option>
				<option value="GA" '.($this->functionalModel->getState()=="GA"? 'selected':"").'>Georgia</option>
				<option value="HI" '.($this->functionalModel->getState()=="HI"? 'selected':"").'>Hawaii</option>
				<option value="ID" '.($this->functionalModel->getState()=="ID"? 'selected':"").'>Idaho</option>
				<option value="IL" '.($this->functionalModel->getState()=="IL"? 'selected':"").'>Illinois</option>
				<option value="IN" '.($this->functionalModel->getState()=="IN"? 'selected':"").'>Indiana</option>
				<option value="IA" '.($this->functionalModel->getState()=="IA"? 'selected':"").'>Iowa</option>
				<option value="KS" '.($this->functionalModel->getState()=="KS"? 'selected':"").'>Kansas</option>
				<option value="KY" '.($this->functionalModel->getState()=="KY"? 'selected':"").'>Kentucky</option>
				<option value="LA" '.($this->functionalModel->getState()=="LA"? 'selected':"").'>Louisiana</option>
				<option value="ME" '.($this->functionalModel->getState()=="ME"? 'selected':"").'>Maine</option>
				<option value="MD" '.($this->functionalModel->getState()=="MD"? 'selected':"").'>Maryland</option>
				<option value="MA" '.($this->functionalModel->getState()=="MA"? 'selected':"").'>Massachusetts</option>
				<option value="MI" '.($this->functionalModel->getState()=="MI"? 'selected':"").'>Michigan</option>
				<option value="MN" '.($this->functionalModel->getState()=="MN"? 'selected':"").'>Minnesota</option>
				<option value="MS" '.($this->functionalModel->getState()=="MS"? 'selected':"").'>Mississippi</option>
				<option value="MO" '.($this->functionalModel->getState()=="MO"? 'selected':"").'>Missouri</option>
				<option value="MT" '.($this->functionalModel->getState()=="MT"? 'selected':"").'>Montana</option>
				<option value="NE" '.($this->functionalModel->getState()=="NE"? 'selected':"").'>Nebraska</option>
				<option value="NV" '.($this->functionalModel->getState()=="NV"? 'selected':"").'>Nevada</option>
				<option value="NH" '.($this->functionalModel->getState()=="NH"? 'selected':"").'>New Hampshire</option>
				<option value="NJ" '.($this->functionalModel->getState()=="NJ"? 'selected':"").'>New Jersey</option>
				<option value="NM" '.($this->functionalModel->getState()=="NM"? 'selected':"").'>New Mexico</option>
				<option value="NY" '.($this->functionalModel->getState()=="NY"? 'selected':"").'>New York</option>
				<option value="NC" '.($this->functionalModel->getState()=="NC"? 'selected':"").'>North Carolina</option>
				<option value="ND" '.($this->functionalModel->getState()=="ND"? 'selected':"").'>North Dakota</option>
				<option value="OH" '.($this->functionalModel->getState()=="OH"? 'selected':"").'>Ohio</option>
				<option value="OK" '.($this->functionalModel->getState()=="OK"? 'selected':"").'>Oklahoma</option>
				<option value="OR" '.($this->functionalModel->getState()=="OR"? 'selected':"").'>Oregon</option>
				<option value="PA" '.($this->functionalModel->getState()=="PA"? 'selected':"").'>Pennsylvania</option>
				<option value="RI" '.($this->functionalModel->getState()=="RI"? 'selected':"").'>Rhode Island</option>
				<option value="SC" '.($this->functionalModel->getState()=="SC"? 'selected':"").'>South Carolina</option>
				<option value="SD" '.($this->functionalModel->getState()=="SD"? 'selected':"").'>South Dakota</option>
				<option value="TN" '.($this->functionalModel->getState()=="TN"? 'selected':"").'>Tennessee</option>
				<option value="TX" '.($this->functionalModel->getState()=="TX"? 'selected':"").'>Texas</option>
				<option value="UT" '.($this->functionalModel->getState()=="UT"? 'selected':"").'>Utah</option>
				<option value="VT" '.($this->functionalModel->getState()=="VT"? 'selected':"").'>Vermont</option>
				<option value="VA" '.($this->functionalModel->getState()=="VA"? 'selected':"").'>Virginia</option>
				<option value="WA" '.($this->functionalModel->getState()=="WA"? 'selected':"").'>Washington</option>
				<option value="WV" '.($this->functionalModel->getState()=="WV"? 'selected':"").'>West Virginia</option>
				<option value="WI" '.($this->functionalModel->getState()=="WI"? 'selected':"").'>Wisconsin</option>
				<option value="WY" '.($this->functionalModel->getState()=="WY"? 'selected':"").'>Wyoming</option>
				</select>
				<span class="error">* '.$this->functionalModel->getStateErr().'</span>
				<br><br>
				Phone Number:
				<input type="tel" name="phoneNumber" placeholder="123-456-7890" value="'.$this->functionalModel->getPhoneNumber().'">
        		<span class="error">* '.$this->functionalModel->getPhoneNumberErr().'</span>
				<br><br>
			</fieldset>
			<fieldset>
				<legend>Account Information</legend>
				E-Mail Address:
				<input type="text" name="eMail" value="'.$this->functionalModel->getEMailAddress().'">
				<span class="error">* '.$this->functionalModel->getEMailErr().'</span>
				<br><br>
				Password:
				<input type="password" name="password" value="'.$this->functionalModel->getPassword().'">
				<span class="error">* '.$this->functionalModel->getPasswordErr().'</span>
				<br><br>
				Repeat Password:
				<input type="password" name="passwordRepeat" value="'.$this->functionalModel->getPasswordRepeat().'">
				<span class="error">* '.$this->functionalModel->getPasswordRepeatErr().'</span>
				<br><br>
			</fieldset>
			<fieldset>
				<legend>Additional Information</legend>
				Interests:<br>
				<input type="checkbox" name="action" value="action" '.($this->functionalModel->getAction() =="UNHEX('1')"? "checked":"").'>Action<br>
				<input type="checkbox" name="children" value="children"'.($this->functionalModel->getChildren() =="UNHEX('1')"? "checked":"").'>Children<br>
				<input type="checkbox" name="comedy" value="comedy"'. ($this->functionalModel->getComedy() =="UNHEX('1')"? "checked":"").'>Comedy<br>
				<input type="checkbox" name="documentary" value="documentary"'. ($this->functionalModel->getDocumentary() =="UNHEX('1')"? "checked":"") .'>Documentary<br>
				<input type="checkbox" name="drama" value="drama"'. ($this->functionalModel->getDrama() =="UNHEX('1')"? "checked":"") .'>Drama<br>
				<input type="checkbox" name="horror" value="horror"'. ($this->functionalModel->getHorror() =="UNHEX('1')"? "checked":"") .'>Horror<br>
				<input type="checkbox" name="musicals" value="musicals"'. ($this->functionalModel->getMusicals() =="UNHEX('1')"? "checked":"") .'>Musicals<br>
				<input type="checkbox" name="romance" value="romance"'. ($this->functionalModel->getRomance() =="UNHEX('1')"? "checked":"").'>Romance<br>
				<input type="checkbox" name="scienceFiction" value="scienceFiction"'.($this->functionalModel->getScienceFiction() =="UNHEX('1')"? "checked":"") .'>Science Fiction<br>
				<input type="checkbox" name="thriller" value="thriller"'.($this->functionalModel->getThriller() =="UNHEX('1')"? "checked":"").'>Thriller<br>
				Notes:
				<textarea name="notes" rows="10" cols="50" value="'.$this->functionalModel->getNotes().'"></textarea>
				<br><br>
			</fieldset>
			<input type="submit" value="Submit">
			<input type="reset">
		</form>	
		</main>';
		}
	}//function end

}//class end

?>