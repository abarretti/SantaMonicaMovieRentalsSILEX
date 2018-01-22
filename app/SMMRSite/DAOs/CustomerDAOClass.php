<?php namespace SMMRSite\DAOs;

use SMMRSite\DAOs\DAOClass;
use SMMRSite\Models\CustomerModels\CustomerClass;
use PDO;

class CustomerDAOClass extends DAOClass
{
	public function __construct()
	{
		$this->serverName;
		$this->userName;
		$this->passwordServer;
		$this->dbName;
		$this->conn;
	}
//Customer Methods
	public function createCustomerRecord (CustomerClass $customerClass, $firstName, $lastName, $dateOfBirth, $gender, $address1, $address2, $city, $state, $phoneNumber, $eMail, $password, $action, $children, $comedy, $documentary, $drama, $horror, $musicals, $romance, $scienceFiction, $thriller, $notes)
	{
		$this->connect();

		$sql = "SELECT eMail FROM Customer WHERE eMail= '".$eMail."'";
		$result = $this->conn->query($sql);
		if ($result->rowCount() > 0) 
		{
   		// output data of each row
    	while($row = $result->fetch()) 
    		{
        		$customerClass->setCreateCustomerErr($row["eMail"]." already exists.");
        		return;
    		}
		} 
		else 
		{
    		$customerInsert= "INSERT INTO Customer (`cuID`, `firstName`, `lastName`, `dateOfBirth`, `gender`, `address1`, `address2`, `city`, `state`, `phoneNumber`, `eMail`, `password`, `notes`) VALUES (NULL, :firstName, :lastName, :dateOfBirth, :gender, :address1, :address2, :city, :state, :phoneNumber, :eMail, :password, :notes)";
    		$customerResult= $this->conn->prepare($customerInsert);
			$customerResult->execute(array(
				':firstName' => $firstName,
				':lastName' => $lastName,
				':dateOfBirth' => $dateOfBirth,
				':gender' => $gender,
				':address1' => $address1,
				':address2' => $address2,
				':city' => $city,
				':state' => $state,
				':phoneNumber' => $phoneNumber,
				':eMail' => $eMail,
				':password' => $password,
				':notes' => $notes
				));

			$cuIDQuery = "SELECT cuID FROM Customer WHERE eMail= '".$eMail."'";			
			$cuIDResult = $this->conn->query($cuIDQuery);
			$row= $cuIDResult->fetch();
			$cuID= $row["cuID"];

			$genres= array($action, $children, $comedy, $documentary, $drama, $horror, $musicals, $romance, $scienceFiction, $thriller);
			$genreKey=1;
			foreach($genres as $genre)
			{
				if ($genre==1)
				{
					$customerGenreJoinInsert= "INSERT INTO CustomerGenreJoin (cuID, gnID) VALUES ( :cuID, :gnID)";
					$customerGenreJoinResult= $this->conn->prepare($customerGenreJoinInsert);
					if ($customerGenreJoinResult->execute(array(
						':cuID' => $cuID,
						':gnID' => $genreKey
						)) === FALSE)
					{
    					$customerClass->setCreateCustomerErr("Error: " . $sql . "<br>" . $this->conn->errorInfo());
    					return;
					}
				}
				$genreKey= $genreKey+1;
			}
			$customerClass->setCreateCustomerOutput("New record created successfully");
		}
		$this->close();
	}

	public function personalInformationQuery(CustomerClass $customerClass, $firstName, $lastName, $dateOfBirth, $gender)
	{
		$this->connect();

		//0000
		if (empty($firstName) and empty($lastName) and empty($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer";
			$result = $this->conn->query($sql);
			}
		
		//1000
		elseif (isset($firstName) and empty($lastName) and empty($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."'";
			$result = $this->conn->query($sql);
			}

		//0100
		elseif (empty($firstName) and isset($lastName) and empty($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."'";
			$result = $this->conn->query($sql);
			}

		//0010
		elseif (empty($firstName) and empty($lastName) and isset($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE dateOfBirth= '".$dateOfBirth."'";
			$result = $this->conn->query($sql);
			}

		//0001
		elseif (empty($firstName) and empty($lastName) and empty($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE gender= '".$gender."'";
			$result = $this->conn->query($sql);
			}

		//1100
		elseif (isset($firstName) and isset($lastName) and empty($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND lastName= '".$lastName."'";
			$result = $this->conn->query($sql);
			}

		//1010
		elseif (isset($firstName) and empty($lastName) and isset($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND dateOfBirth= '".$dateOfBirth."'";
			$result = $this->conn->query($sql);
			}

		//1001
		elseif (isset($firstName) and empty($lastName) and empty($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND gender= '".$gender."'";
			$result = $this->conn->query($sql);
			}

		//0110
		elseif (empty($firstName) and isset($lastName) and isset($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."'";
			$result = $this->conn->query($sql);
			}

		//0101
		elseif (empty($firstName) and isset($lastName) and empty($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND gender= '".$gender."'";
			$result = $this->conn->query($sql);
			}

		//0011
		elseif (empty($firstName) and empty($lastName) and isset($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE dateOfBirth= '".$dateOfBirth."' AND gender= '".$gender."'";
			$result = $this->conn->query($sql);
			}

		//1110
		elseif (isset($firstName) and isset($lastName) and isset($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."'";
			$result = $this->conn->query($sql);
			}

		//1101
		elseif (isset($firstName) and isset($lastName) and empty($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND lastName= '".$lastName."' AND gender= '".$gender."'";
			$result = $this->conn->query($sql);
			}

		//1011
		elseif (isset($firstName) and empty($lastName) and isset($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND dateOfBirth= '".$dateOfBirth."' AND gender= '".$gender."'";
			$result = $this->conn->query($sql);
			}

		//0111
		elseif (empty($firstName) and isset($lastName) and isset($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND gender= '".$gender."'";
			$result = $this->conn->query($sql);
			}

		//1111
		else
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND gender= '".$gender."'";
			$result = $this->conn->query($sql);
			}
		//check statement
		//echo $sql;
	
		if ($result->rowCount() > 0) 
		{
    		// output data of each row
    		$count=0;
    		$customerInformationArray=array();
    		while(($row = $result->fetch()) and $count<=100) 
    		{
				array_push($customerInformationArray, array("cuID"=>$row["cuID"], "firstName"=>$row["firstName"], "lastName"=>$row["lastName"], "dateOfBirth"=>$row["dateOfBirth"], "gender"=>$row["gender"], "address1"=>$row["address1"], "address2"=>$row["address2"], "city"=>$row["city"], "state"=>$row["state"], "phoneNumber"=>$row["phoneNumber"], "eMail"=>$row["eMail"]));
				$count= $count++;
    		}
    		$customerClass->setCustomerInformationArray($customerInformationArray);
    		return;
		} 
		
		else 
		{
    		$customerClass->setCustomerInformationErr("No Results");
    		return;
		}
		$this->close();
	}

	public function addressInformationQuery(CustomerClass $customerClass, $address1, $city, $state, $phoneNumber)
	{
		$this->connect();

		//0000
		if (empty($address1) and empty($city) and empty($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer";
			$result = $this->conn->query($sql);
			}
		
		//1000
		elseif (isset($address1) and empty($city) and empty($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."'";
			$result = $this->conn->query($sql);
			}

		//0100
		elseif (empty($address1) and isset($city) and empty($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE city= '".$city."'";
			$result = $this->conn->query($sql);
			}

		//0010
		elseif (empty($address1) and empty($city) and isset($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE state= '".$state."'";
			$result = $this->conn->query($sql);
			}

		//0001
		elseif (empty($address1) and empty($city) and empty($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//1100
		elseif (isset($address1) and isset($city) and empty($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND city= '".$city."'";
			$result = $this->conn->query($sql);
			}

		//1010
		elseif (isset($address1) and empty($city) and isset($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND state= '".$state."'";
			$result = $this->conn->query($sql);
			}

		//1001
		elseif (isset($address1) and empty($city) and empty($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//0110
		elseif (empty($address1) and isset($city) and isset($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE city= '".$city."' AND state= '".$state."'";
			$result = $this->conn->query($sql);
			}

		//0101
		elseif (empty($address1) and isset($city) and empty($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE city= '".$city."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//0011
		elseif (empty($address1) and empty($city) and isset($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE state= '".$state."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//1110
		elseif (isset($address1) and isset($city) and isset($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND city= '".$city."' AND state= '".$state."'";
			$result = $this->conn->query($sql);
			}

		//1101
		elseif (isset($address1) and isset($city) and empty($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND city= '".$city."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//1011
		elseif (isset($address1) and empty($city) and isset($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND state= '".$state."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//0111
		elseif (empty($address1) and isset($city) and isset($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE city= '".$city."' AND state= '".$state."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//1111
		else
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND city= '".$city."' AND state= '".$state."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}
		//check statement
		//echo $sql;

		if ($result->rowCount() > 0) 
		{
			// output data of each row
    		$count=0;
    		$customerInformationArray=array();
    		while(($row = $result->fetch()) and $count<=100) 
    		{
				array_push($customerInformationArray, array("cuID"=>$row["cuID"], "firstName"=>$row["firstName"], "lastName"=>$row["lastName"], "dateOfBirth"=>$row["dateOfBirth"], "gender"=>$row["gender"], "address1"=>$row["address1"], "address2"=>$row["address2"], "city"=>$row["city"], "state"=>$row["state"], "phoneNumber"=>$row["phoneNumber"], "eMail"=>$row["eMail"]));
				$count= $count++;
    		}
    		//return Array
    		$customerClass->setCustomerInformationArray($customerInformationArray);
    		return;
		} 
		
		else 
		{
    		$customerClass->setCustomerInformationErr("No Results");
    		return;
		}
		$this->close();
	}

	public function eMailInformationQuery(CustomerClass $customerClass, $eMail)
	{
		$this->connect();

		//0
		if (empty($eMail))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer";
			$result = $this->conn->query($sql);
			}
		
		//1
		else
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE eMail= '".$eMail."'";
			$result = $this->conn->query($sql);
			}
		//check statement
		//echo $sql;

		if ($result->rowCount() > 0) 
		{
			// output data of each row
    		$count=0;
    		$customerInformationArray=array();
    		while(($row = $result->fetch()) and $count<=100) 
    		{
				array_push($customerInformationArray, array("cuID"=>$row["cuID"], "firstName"=>$row["firstName"], "lastName"=>$row["lastName"], "dateOfBirth"=>$row["dateOfBirth"], "gender"=>$row["gender"], "address1"=>$row["address1"], "address2"=>$row["address2"], "city"=>$row["city"], "state"=>$row["state"], "phoneNumber"=>$row["phoneNumber"], "eMail"=>$row["eMail"]));
				$count= $count++;
    		}
    		//return Array
    		$customerClass->setCustomerInformationArray($customerInformationArray);
    		return;
		} 
		
		else 
		{
    		$customerClass->setCustomerInformationErr("No Results");
    		return;
		}
		$this->close();
	}

}
?>	

<!-- php Desktop/PHP/SantaMonicaMovieRentalsSILEX/app/SMMRSite/DAOs/customerDAOClass.php -->