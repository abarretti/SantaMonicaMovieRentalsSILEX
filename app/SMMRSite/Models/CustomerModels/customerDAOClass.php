<?php namespace SMMRSite\Models\CustomerModels;

use SMMRSite\Models\DAOClass as DAOClass;
use mysqli;

class CustomerDAOClass extends DAOClass
{
	public function __construct()
	{
		$this->serverName;
		$this->userName;
		$this->passwordServer;
		$this->dbName;
	}
//Customer Methods
	public function createCustomerRecord ($firstName, $lastName, $dateOfBirth, $gender, $address1, $address2, $city, $state, $phoneNumber, $eMail, $password, $action, $children, $comedy, $documentary, $drama, $horror, $musicals, $romance, $scienceFiction, $thriller, $notes)
	{
		$conn= new mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}

		$sql = "SELECT eMail FROM Customer WHERE eMail= '".$eMail."'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
		{
   		// output data of each row
    	while($row = $result->fetch_assoc()) 
    		{
        	return "<h1 style='color:red;'>".$row["eMail"]." already exists.</h1>";
    		}
		} 
		else 
		{
    		$sqlInsert= "INSERT INTO `".$this->getdbName()."`.`Customer` (`cuID`, `firstName`, `lastName`, `dateOfBirth`, `gender`, `address1`, `address2`, `city`, `state`, `phoneNumber`, `eMail`, `password`, `action`, `children`, `comedy`, `documentary`, `drama`, `horror`, `musicals`, `romance`, `scienceFiction`, `thriller`, `notes`) VALUES (NULL, '".$firstName."', '".$lastName."', '".$dateOfBirth."', '".$gender."', '".$address1."', '".$address2."', '".$city."', '".$state."', '".$phoneNumber."', '".$eMail."', '".$password."', ".$action.", ".$children.", ".$comedy.", ".$documentary.", ".$drama.", ".$horror.", ".$musicals.", ".$romance.", ".$scienceFiction.", ".$thriller.", '".$notes."')";
			
			if ($conn->query($sqlInsert) === TRUE) 
			{
    			return "<h1 style='color:#16e059;'>New record created successfully</h1>";
			} 
			else
			{
    			return "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		$conn->close();
	}

	public function personalInformationQuery($firstName, $lastName, $dateOfBirth, $gender)
	{
		$conn= new mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}
		//0000
		if (empty($firstName) and empty($lastName) and empty($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer";
			$result = $conn->query($sql);
			}
		
		//1000
		elseif (isset($firstName) and empty($lastName) and empty($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."'";
			$result = $conn->query($sql);
			}

		//0100
		elseif (empty($firstName) and isset($lastName) and empty($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."'";
			$result = $conn->query($sql);
			}

		//0010
		elseif (empty($firstName) and empty($lastName) and isset($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE dateOfBirth= '".$dateOfBirth."'";
			$result = $conn->query($sql);
			}

		//0001
		elseif (empty($firstName) and empty($lastName) and empty($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE gender= '".$gender."'";
			$result = $conn->query($sql);
			}

		//1100
		elseif (isset($firstName) and isset($lastName) and empty($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND lastName= '".$lastName."'";
			$result = $conn->query($sql);
			}

		//1010
		elseif (isset($firstName) and empty($lastName) and isset($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND dateOfBirth= '".$dateOfBirth."'";
			$result = $conn->query($sql);
			}

		//1001
		elseif (isset($firstName) and empty($lastName) and empty($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND gender= '".$gender."'";
			$result = $conn->query($sql);
			}

		//0110
		elseif (empty($firstName) and isset($lastName) and isset($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."'";
			$result = $conn->query($sql);
			}

		//0101
		elseif (empty($firstName) and isset($lastName) and empty($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND gender= '".$gender."'";
			$result = $conn->query($sql);
			}

		//0011
		elseif (empty($firstName) and empty($lastName) and isset($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE dateOfBirth= '".$dateOfBirth."' AND gender= '".$gender."'";
			$result = $conn->query($sql);
			}

		//1110
		elseif (isset($firstName) and isset($lastName) and isset($dateOfBirth) and empty($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."'";
			$result = $conn->query($sql);
			}

		//1101
		elseif (isset($firstName) and isset($lastName) and empty($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND lastName= '".$lastName."' AND gender= '".$gender."'";
			$result = $conn->query($sql);
			}

		//1011
		elseif (isset($firstName) and empty($lastName) and isset($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND dateOfBirth= '".$dateOfBirth."' AND gender= '".$gender."'";
			$result = $conn->query($sql);
			}

		//0111
		elseif (empty($firstName) and isset($lastName) and isset($dateOfBirth) and isset($gender))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND gender= '".$gender."'";
			$result = $conn->query($sql);
			}

		//1111
		else
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE firstName= '".$firstName."' AND lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND gender= '".$gender."'";
			$result = $conn->query($sql);
			}
		//check statement
		//echo $sql;

		$tableReturn="";	
		if ($result->num_rows > 0) 
		{
			$tableReturn.= "<h1 style='color:#16e059;'>Results:</h1>";
			$tableReturn.= "<table border='1' style='width:100%'>
				<tr>
					<th>Customer ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Date of Birth</th>
					<th>Gender</th>
					<th>Address 1</th>
					<th>Address 2</th>
					<th>City</th>
					<th>State</th>
					<th>Phone Number</th>
					<th>E-Mail Address</th>
				</tr>
			";
    		// output data of each row
    		$count=0;
    		while(($row = $result->fetch_assoc()) and $count<=100) 
    		{$tableReturn.= "<tr>
					<td>".$row["cuID"]."</td>
					<td>".$row["firstName"]."</td>
					<td>".$row["lastName"]."</td>
					<td>".$row["dateOfBirth"]."</td>
					<td>".$row["gender"]."</td>
					<td>".$row["address1"]."</td>
					<td>".$row["address2"]."</td>
					<td>".$row["city"]."</td>
					<td>".$row["state"]."</td>
					<td>".$row["phoneNumber"]."</td>
					<td>".$row["eMail"]."</td>
				</tr>";
				$count= $count++;
    		}
    		$tableReturn.="</table>";
    		return $tableReturn;
		} 
		
		else 
		{
    		$tableReturn.= "<h1 style='color:red;'>No Results</h1>";
    		return $tableReturn;
		}
		$conn->close();
	}

	public function addressInformationQuery($address1, $city, $state, $phoneNumber)
	{
		$conn= new mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}
		//0000
		if (empty($address1) and empty($city) and empty($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer";
			$result = $conn->query($sql);
			}
		
		//1000
		elseif (isset($address1) and empty($city) and empty($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."'";
			$result = $conn->query($sql);
			}

		//0100
		elseif (empty($address1) and isset($city) and empty($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE city= '".$city."'";
			$result = $conn->query($sql);
			}

		//0010
		elseif (empty($address1) and empty($city) and isset($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE state= '".$state."'";
			$result = $conn->query($sql);
			}

		//0001
		elseif (empty($address1) and empty($city) and empty($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//1100
		elseif (isset($address1) and isset($city) and empty($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND city= '".$city."'";
			$result = $conn->query($sql);
			}

		//1010
		elseif (isset($address1) and empty($city) and isset($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND state= '".$state."'";
			$result = $conn->query($sql);
			}

		//1001
		elseif (isset($address1) and empty($city) and empty($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//0110
		elseif (empty($address1) and isset($city) and isset($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE city= '".$city."' AND state= '".$state."'";
			$result = $conn->query($sql);
			}

		//0101
		elseif (empty($address1) and isset($city) and empty($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE city= '".$city."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//0011
		elseif (empty($address1) and empty($city) and isset($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE state= '".$state."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//1110
		elseif (isset($address1) and isset($city) and isset($state) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND city= '".$city."' AND state= '".$state."'";
			$result = $conn->query($sql);
			}

		//1101
		elseif (isset($address1) and isset($city) and empty($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND city= '".$city."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//1011
		elseif (isset($address1) and empty($city) and isset($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND state= '".$state."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//0111
		elseif (empty($address1) and isset($city) and isset($state) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE city= '".$city."' AND state= '".$state."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//1111
		else
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND city= '".$city."' AND state= '".$state."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}
		//check statement
		//echo $sql;

		$tableReturn="";
		if ($result->num_rows > 0) 
		{
			$tableReturn.= "<h1 style='color:#16e059;'>Results:</h1>";
			$tableReturn.= "<table border='1' style='width:100%'>
				<tr>
					<th>Customer ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Date of Birth</th>
					<th>Gender</th>
					<th>Address 1</th>
					<th>Address 2</th>
					<th>City</th>
					<th>State</th>
					<th>Phone Number</th>
					<th>E-Mail Address</th>
				</tr>
			";
    		// output data of each row
    		$count=0;
    		while(($row = $result->fetch_assoc()) and $count<=100) 
    		{$tableReturn.= "<tr>
					<td>".$row["cuID"]."</td>
					<td>".$row["firstName"]."</td>
					<td>".$row["lastName"]."</td>
					<td>".$row["dateOfBirth"]."</td>
					<td>".$row["gender"]."</td>
					<td>".$row["address1"]."</td>
					<td>".$row["address2"]."</td>
					<td>".$row["city"]."</td>
					<td>".$row["state"]."</td>
					<td>".$row["phoneNumber"]."</td>
					<td>".$row["eMail"]."</td>
				</tr>";
				$count= $count++;
    		}
    		$tableReturn.= "</table>";
    		return $tableReturn;
		} 
		
		else 
		{
    		$tableReturn.= "<h1 style='color:red;'>No Results</h1>";
			return $tableReturn;
		}
		$conn->close();
	}

	public function eMailInformationQuery($eMail)
	{
		$conn= new mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}
		//0
		if (empty($eMail))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer";
			$result = $conn->query($sql);
			}
		
		//1
		else
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE eMail= '".$eMail."'";
			$result = $conn->query($sql);
			}
		//check statement
		//echo $sql;

		$tableReturn="";
		if ($result->num_rows > 0) 
		{
			$tableReturn.= "<h1 style='color:#16e059;'>Results:</h1>";
			$tableReturn.= "<table border='1' style='width:100%'>
				<tr>
					<th>Customer ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Date of Birth</th>
					<th>Gender</th>
					<th>Address 1</th>
					<th>Address 2</th>
					<th>City</th>
					<th>State</th>
					<th>Phone Number</th>
					<th>E-Mail Address</th>
				</tr>
			";
    		// output data of each row
    		$count=0;
    		while(($row = $result->fetch_assoc()) and $count<=100) 
    		{$tableReturn.= "<tr>
					<td>".$row["cuID"]."</td>
					<td>".$row["firstName"]."</td>
					<td>".$row["lastName"]."</td>
					<td>".$row["dateOfBirth"]."</td>
					<td>".$row["gender"]."</td>
					<td>".$row["address1"]."</td>
					<td>".$row["address2"]."</td>
					<td>".$row["city"]."</td>
					<td>".$row["state"]."</td>
					<td>".$row["phoneNumber"]."</td>
					<td>".$row["eMail"]."</td>
				</tr>";
				$count= $count++;
    		}
    		$tableReturn.= "</table>";
    		return $tableReturn;
		} 
		
		else 
		{
    		$tableReturn.= "<h1 style='color:red;'>No Results</h1>";
    		return $tableReturn;
		}
		$conn->close();
	}

}
?>	

<!-- php Desktop/PHP/SantaMonicaMovieRentals/class/DAOcustomerClass.php -->