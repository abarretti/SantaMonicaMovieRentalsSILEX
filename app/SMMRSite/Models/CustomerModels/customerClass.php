<?php namespace SMMRSite\Models\CustomerModels;

class CustomerClass
{
	private $firstName;
	private $lastName;
	private $dateOfBirth;
	private $gender;
	private $address1;
	private $address2;
	private $city;
	private $state;
	private $phoneNumber;
	private $eMail;
	private $password;
	private $passwordRepeat;
	private $action;
	private $children;
	private $comedy;
	private $documentary;
	private $drama;
	private $horror;
	private $musicals;
	private $romance;
	private $scienceFiction;
	private $thriller;
	private $notes;

	/*Error Attributes*/
	private $firstNameErr;
	private $lastNameErr;
	private $genderErr; 
	private $address1Err;
	private $cityErr;
	private $stateErr;
	private $phoneNumberErr;
	private $eMailErr; 
	private $passwordErr;
	private $passwordRepeatErr;

	public function __construct()
	{
		$this->firstName=NULL;
		$this->lastName=NULL;
		$this->dateOfBirth=NULL;
		$this->gender=NULL;
		$this->address1=NULL;
		$this->address2=NULL;
		$this->city=NULL;
		$this->state=NULL;
		$this->phoneNumber=NULL;
		$this->eMail=NULL;
		$this->password=NULL;
		$this->passwordRepeat=NULL;
		$this->action=NULL;
		$this->children=NULL;
		$this->comedy=NULL;
		$this->documentary=NULL;
		$this->drama=NULL;
		$this->horror=NULL;
		$this->musical=NULL;
		$this->romance=NULL;
		$this->scienceFiction=NULL;
		$this->thriller=NULL;
		$this->notes=NULL;

		$this->firstNameErr=NULL;
		$this->lastNameErr=NULL; 
		$this->genderErr=NULL;
		$this->address1Err=NULL;
		$this->cityErr=NULL;
		$this->stateErr=NULL; 
		$this->phoneNumberErr=NULL;
		$this->eMailErr=NULL;
		$this->passwordErr=NULL;
		$this->passwordRepeatErr=NULL;
	}

	/* Cleans Data Input*/
	public function test_input($data) 
	{
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
  	}
	
	public function setFirstName($firstName) 
	{	
		if (empty($firstName)) 
		{
    		$this->setFirstNameErr("First Name is required");
  		} 
  		elseif (!preg_match("/^[a-zA-Z ]*$/",$firstName)) 
  		{
  			$this->setFirstNameErr("Only letters and white space allowed");
  		}
  		else 
  		{
    		$firstName= $this->test_input($firstName);
			$firstName= strtolower($firstName);
			$firstName= ucfirst($firstName);
			$this->firstName=$firstName;
		}
	}

	public function setFirstNameOptional($firstName) 
	{	
  		if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) 
  		{
  			$this->setFirstNameErr("Only letters and white space allowed");
  		}
  		else 
  		{
    		$firstName= $this->test_input($firstName);
			$firstName= strtolower($firstName);
			$firstName= ucfirst($firstName);
			$this->firstName=$firstName;
		}
	}

	public function getFirstName() 
	{
		return $this->firstName;
	}

	public function setLastName($lastName) 
	{	
		if (empty($lastName)) 
		{
    		$this->setLastNameErr("Last Name is required");
  		} 
  		elseif (!preg_match("/^[a-zA-Z ]*$/",$lastName)) 
  		{
  			$this->setLastNameErr("Only letters and white space allowed");
  		}
  		else 
  		{
    		$lastName= $this->test_input($lastName);
			$lastName= strtolower($lastName);
			$lastName= ucfirst($lastName);
			$this->lastName=$lastName;
		}
	}

	public function setLastNameOptional($lastName) 
	{	
  		if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) 
  		{
  			$this->setLastNameErr("Only letters and white space allowed");
  		}
  		else 
  		{
    		$lastName= $this->test_input($lastName);
			$lastName= strtolower($lastName);
			$lastName= ucfirst($lastName);
			$this->lastName=$lastName;
		}
	}

	public function getLastName() 
	{
		return $this->lastName;
	}

	public function setDateOfBirth($dateOfBirth)
	{
		if (empty($dateOfBirth)) 
		{
    		$this->dateOfBirth=NULL;
  		} 
  		else 
  		{
  			$dateOfBirth= date("Y-m-d", strtotime($dateOfBirth));
			$this->dateOfBirth=$dateOfBirth;
		}
	}

	public function getDateOfBirth()
	{
		return $this->dateOfBirth;
	}

	public function setGender($gender)
	{
		if (empty($gender))
			{
    			$this->setGenderErr("Gender is required");
  			} 
  		else 
  			{
				$gender= $this->test_input($gender);			
    			$this->gender= $gender;
  			}
	}

	public function setGenderOptional($gender)
	{
		$gender= $this->test_input($gender);			
    	$this->gender= $gender;
	}

	public function getGender()
	{
		return $this->gender;
	}

	public function setAddress1($address1)
	{
		if (empty($address1))
			{
    			$this->setAddress1Err("Address 1 is required");
  			} 
  		else 
  			{
    			$address1 = $this->test_input($address1);
    			$this->address1= $address1;
  			}  
	}

	public function setAddress1Optional($address1)
	{
    	$address1 = $this->test_input($address1);
    	$this->address1= $address1;  
	}

	public function getAddress1()
	{
		return $this->address1;
	}

	public function setAddress2($address2)
	{
		if (empty($address2)) 
		{
    		$this->address2= NULL;
  		} 
  		else 
  		{
    		$address2 = $this->test_input($address2);
    		$this->address2= $address2;
  		}
	}

	public function getAddress2()
	{
		return $this->address2;
	}

	public function setCity($city)
	{
		if (empty($city))
		{
    		$this->setCityErr("City is required");
  		} 
  		else 
  		{
    		$city = $this->test_input($city);
    		$this->city= $city;
  		}  
	}

	public function setCityOptional($city)
	{		
    	$city = $this->test_input($city);
    	$this->city= $city;
	}

	public function getCity()
	{
		return $this->city;
	}

	public function setState($state)
	{
		if (empty($state)) 
		{
    		$this->setStateErr("State is required");
  		} 
  		else 
  		{
    		$state = $this->test_input($state);
  			$this->state= $state;	
  		}  
	}

	public function setStateOptional($state)
	{
    	$state = $this->test_input($state);
  		$this->state= $state;  
	}

	public function getState()
	{
		return $this->state;
	}

	public function setPhoneNumber($phoneNumber)
	{
		if (empty($phoneNumber))
		{
    		$this->phoneNumber=NULL;
  		} 
  		elseif (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phoneNumber)) 
  		{
  			$this->setPhoneNumberErr("Invalid phone number. Use following format: XXX-XXX-XXXX");
  		}
  		else 
  		{
    		$phoneNumber = $this->test_input($phoneNumber);
  			$this->phoneNumber= $phoneNumber;
  		}
	}

	public function getPhoneNumber()
	{
		return $this->phoneNumber;
	}

	public function setEMailAddress($eMail)
	{
		if (empty($eMail)) 
		{
    		$this->setEMailErr("Email is required");
  		} 
  		elseif (!filter_var($eMail, FILTER_VALIDATE_EMAIL)) 
  		{
  			$this->setEMailErr("Invalid email format");
  		}
  		else 
  		{
    		$eMail = $this->test_input($eMail);
  			$this->eMail= $eMail;
  		}
	}

	public function setEMailAddressOptional($eMail)
	{
  		if (!filter_var($eMail, FILTER_VALIDATE_EMAIL) and !empty($eMail)) 
  		{
  			$this->setEMailErr("Invalid email format");
  		}
  		else 
  		{
    		$eMail = $this->test_input($eMail);
  			$this->eMail= $eMail;
  		}
	}

	public function getEMailAddress()
	{
		return $this->eMail;
	}

	public function setPassword($password,$passwordRepeat)
	{
		if (empty($password)) 
		{
  			$this->setPasswordErr("Password is required"); 
  		}
  		elseif (empty($passwordRepeat))
  		{
  			$this->setPasswordRepeatErr("Password is required"); 
  		}
        elseif (strlen($password) <= '8') 
        {
            $this->setPasswordErr("Your Password Must Contain At Least 8 Characters!");
        	$this->setPasswordRepeatErr("Your Password Must Contain At Least 8 Characters!");
        }
 		elseif ($password != $passwordRepeat) 
 		{
        	$this->setPasswordErr("Password and confirm password do not match");
           	$this->setPasswordRepeatErr("Password and confirm password do not match");
        }
        else 
        {
        	$this->password= $password;
        	$this->passwordRepeat= $passwordRepeat;
        }
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getPasswordRepeat()
	{
		return $this->passwordRepeat;
	}

	public function setAction($action)
	{	
		if (empty($action)) 
		{
    		$this->action = "UNHEX('0')";
  		} 
  		else 
  		{
    		$this->action = "UNHEX('1')";
  		}
	}

	public function getAction()
	{
		return $this->action;
	}

	public function setChildren($children)
	{	
		if (empty($children)) 
		{
    		$this->children = "UNHEX('0')";
  		} 
  		else 
  		{
    		$this->children = "UNHEX('1')";
  		}
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function setComedy($comedy)
	{	
		if (empty($comedy)) 
		{
    		$this->comedy = "UNHEX('0')";
  		} 
  		else 
  		{
    		$this->comedy = "UNHEX('1')";
  		}
	}

	public function getComedy()
	{
		return $this->comedy;
	}

	public function setDocumentary($documentary)
	{	
		if (empty($documentary)) 
		{
    		$this->documentary = "UNHEX('0')";
  		} 
  		else 
  		{
    		$this->documentary = "UNHEX('1')";
  		}
	}

	public function getDocumentary()
	{
		return $this->documentary;
	}

	public function setDrama($drama)
	{	
		if (empty($drama)) 
		{
    		$this->drama = "UNHEX('0')";
  		} 
  		else 
  		{
    		$this->drama = "UNHEX('1')";
  		}
	}

	public function getDrama()
	{
		return $this->drama;
	}

	public function setHorror($horror)
	{	
		if (empty($horror)) 
		{
    		$this->horror = "UNHEX('0')";
  		} 
  		else 
  		{
    		$this->horror = "UNHEX('1')";
  		}
	}

	public function getHorror()
	{
		return $this->horror;
	}

	public function setMusicals($musicals)
	{	
		if (empty($musicals)) 
		{
    		$this->musicals = "UNHEX('0')";
  		} 
  		else 
  		{
    		$this->musicals = "UNHEX('1')";
  		}
	}

	public function getMusicals()
	{
		return $this->musicals;
	}

	public function setRomance($romance)
	{	
		if (empty($romance)) 
		{
    		$this->romance = "UNHEX('0')";
  		} 
  		else 
  		{
    		$this->romance = "UNHEX('1')";
  		}
	}

	public function getRomance()
	{
		return $this->romance;
	}

	public function setScienceFiction($scienceFiction)
	{	
		if (empty($scienceFiction)) 
		{
    		$this->scienceFiction = "UNHEX('0')";
  		} 
  		else 
  		{
    		$this->scienceFiction = "UNHEX('1')";
  		}
	}

	public function getScienceFiction()
	{
		return $this->scienceFiction;
	}

	public function setThriller($thriller)
	{	
		if (empty($thriller)) 
		{
    		$this->thriller = "UNHEX('0')";
  		} 
  		else 
  		{
    		$this->thriller = "UNHEX('1')";
  		}
	}

	public function getThriller()
	{
		return $this->thriller;
	}

	public function setNotes($notes)
	{
		$this->notes=$notes;
	}

	public function getNotes()
	{
		return $this->notes;
	}
  	
  	/* Error Attributes */
  	public function setFirstNameErr($firstNameErr)
	{
		$this->firstNameErr= $firstNameErr;
	}

	public function getFirstNameErr()
	{
		return $this->firstNameErr;
	}

	public function setLastNameErr($lastNameErr)
	{
		$this->lastNameErr= $lastNameErr;
	}

	public function getLastNameErr()
	{
		return $this->lastNameErr;
	}
 
 	public function setGenderErr($genderErr)
	{
		$this->genderErr= $genderErr;
	}

	public function getGenderErr()
	{
		return $this->genderErr;
	}

	public function setAddress1Err($address1Err)
	{
		$this->address1Err= $address1Err;
	}

	public function getAddress1Err()
	{
		return $this->address1Err;
	}

	public function setCityErr($cityErr)
	{
		$this->cityErr= $cityErr;
	}

	public function getCityErr()
	{
		return $this->cityErr;
	}

	public function setStateErr($stateErr)
	{
		$this->stateErr= $stateErr;
	}

	public function getStateErr()
	{
		return $this->stateErr;
	}

	public function setPhoneNumberErr($phoneNumberErr)
	{
		$this->phoneNumberErr= $phoneNumberErr;
	}

	public function getPhoneNumberErr()
	{
		return $this->phoneNumberErr;
	}

	public function setEMailErr($eMailErr)
	{
		$this->eMailErr= $eMailErr;
	}

	public function getEMailErr()
	{
		return $this->eMailErr;
	}

	public function setPasswordErr($passwordErr)
	{
		$this->passwordErr= $passwordErr;
	}

	public function getPasswordErr()
	{
		return $this->passwordErr;
	}

	public function setPasswordRepeatErr($passwordRepeatErr)
	{
		$this->passwordRepeatErr= $passwordRepeatErr;
	}

	public function getPasswordRepeatErr()
	{
		return $this->passwordRepeatErr;
	}

	public function formCustomerCreateCheck($firstNameErr, $lastNameErr, $genderErr,$address1Err, $cityErr, $stateErr, $phoneNumberErr, $eMailErr, $passwordErr, $passwordRepeatErr, $firstName, $lastName, $gender, $address1, $city, $state, $eMail, $password, $passwordRepeat)
	{
		if($firstNameErr!=NULL or $lastNameErr!=NULL or $genderErr!=NULL or $address1Err!=NULL or $cityErr!=NULL or $stateErr!=NULL or $phoneNumberErr!=NULL or $eMailErr!=NULL or $passwordErr!=NULL or $passwordRepeatErr!=NULL or $firstName==NULL or $lastName==NULL or $gender==NULL or $address1==NULL or $city==NULL or $state==NULL or $eMail==NULL or $password==NULL or $passwordRepeat==NULL)
		{
			return "Form Incomplete";
		}
		else
		{
			return "FORM COMPLETE";
		}
	}

	public function formCustomerPersonalSearchCheck($firstNameErr, $lastNameErr)
	{
		if($firstNameErr!=NULL or $lastNameErr!=NULL)
		{
			return "Form Incomplete";
		}
		else
		{
			return "FORM COMPLETE";
		}
	}

	public function formCustomerAddressSearchCheck($address1Err, $cityErr, $phoneNumberErr)
	{
		if($address1Err!=NULL or $cityErr!=NULL or $phoneNumberErr!=NULL)
		{
			return "Form Incomplete";
		}
		else
		{
			return "FORM COMPLETE";
		}
	}

	public function formCustomerEMailSearchCheck($eMailErr)
	{
		if($eMailErr!=NULL)
		{
			return "Form Incomplete";
		}
		else
		{
			return "FORM COMPLETE";
		}
	}

	public function formBookingCustomerSearchCheck($lastNameErr, $address1Err, $phoneNumberErr)
	{
		if($lastNameErr!=NULL or $address1Err!=NULL or $phoneNumberErr!=NULL)
		{
			return "Form Incomplete";
		}
		else
		{
			return "FORM COMPLETE";
		}
	}

}
?>