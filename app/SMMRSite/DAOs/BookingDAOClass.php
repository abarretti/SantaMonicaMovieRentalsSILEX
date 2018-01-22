<?php namespace SMMRSite\DAOs;

use SMMRSite\DAOs\DAOClass;
use SMMRSite\Models\BookingModels\BookingClass;
use PDO;

class BookingDAOClass extends DAOClass
{

	public function __construct()
	{
		$this->serverName;
		$this->userName;
		$this->passwordServer;
		$this->dbName;
		$this->conn;
	}

	public function bookingCustomerQuery(BookingClass $bookingClass, $lastName, $dateOfBirth, $address1, $phoneNumber)
	{
		$this->connect();

		//0000
		if (empty($lastName) and empty($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer";
			$result = $this->conn->query($sql);
			}
		
		//1000
		elseif (isset($lastName) and empty($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."'";
			$result = $this->conn->query($sql);
			}

		//0100
		elseif (empty($lastName) and isset($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE dateOfBirth= '".$dateOfBirth."'";
			$result = $this->conn->query($sql);
			}

		//0010
		elseif (empty($lastName) and empty($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."'";
			$result = $this->conn->query($sql);
			}

		//0001
		elseif (empty($lastName) and empty($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//1100
		elseif (isset($lastName) and isset($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."'";
			$result = $this->conn->query($sql);
			}

		//1010
		elseif (isset($lastName) and empty($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND address1= '".$address1."'";
			$result = $this->conn->query($sql);
			}

		//1001
		elseif (isset($lastName) and empty($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//0110
		elseif (empty($lastName) and isset($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."'";
			$result = $this->conn->query($sql);
			}

		//0101
		elseif (empty($lastName) and isset($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE dateOfBirth= '".$dateOfBirth."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//0011
		elseif (empty($lastName) and empty($dateOfBirth) and isset($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//1110
		elseif (isset($lastName) and isset($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."'";
			$result = $this->conn->query($sql);
			}

		//1101
		elseif (isset($lastName) and isset($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//1011
		elseif (isset($lastName) and empty($dateOfBirth) and isset($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND address1= '".$address1."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//0111
		elseif (empty($lastName) and isset($dateOfBirth) and isset($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//1111
		else
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."' AND phoneNumber= '".$phoneNumber."'";
			$result = $this->conn->query($sql);
			}

		//check statement
		//echo $sql;

		if ($result->rowCount() > 0) 
		{
    		// output data of each row
    		$count=0;
    		$eMailArray= array();
    		while(($row = $result->fetch()) and $count<10) 
    		{
    			array_push($eMailArray, array("cuID"=>$row["cuID"], "firstName"=>$row["firstName"], "lastName"=>$row["lastName"], "dateOfBirth"=>$row["dateOfBirth"], "gender"=>$row["gender"], "address1"=>$row["address1"], "address2"=>$row["address2"], "city"=>$row["city"], "state"=>$row["state"], "phoneNumber"=>$row["phoneNumber"], "eMail"=>$row["eMail"], "count"=>$count));
				$count= $count+1;
    		}
    		$bookingClass->setBookingCustomerArray($eMailArray);
    		return;
		} 
		
		else 
		{
    		$bookingClass->setBookingCustomerErr("No Results");
    		return;
		}
		$this->close();
	}

	public function bookingSearchCustomerQuery(BookingClass $bookingClass, $lastName, $dateOfBirth, $address1, $phoneNumber)
	{
		$this->connect();

		//0000
		if (empty($lastName) and empty($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}
		
		//1000
		elseif (isset($lastName) and empty($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//0100
		elseif (empty($lastName) and isset($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE dateOfBirth= '".$dateOfBirth."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//0010
		elseif (empty($lastName) and empty($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE address1= '".$address1."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//0001
		elseif (empty($lastName) and empty($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//1100
		elseif (isset($lastName) and isset($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//1010
		elseif (isset($lastName) and empty($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND address1= '".$address1."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//1001
		elseif (isset($lastName) and empty($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//0110
		elseif (empty($lastName) and isset($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//0101
		elseif (empty($lastName) and isset($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE dateOfBirth= '".$dateOfBirth."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//0011
		elseif (empty($lastName) and empty($dateOfBirth) and isset($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE address1= '".$address1."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//1110
		elseif (isset($lastName) and isset($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//1101
		elseif (isset($lastName) and isset($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//1011
		elseif (isset($lastName) and empty($dateOfBirth) and isset($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND address1= '".$address1."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//0111
		elseif (empty($lastName) and isset($dateOfBirth) and isset($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//1111
		else
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $this->conn->query($sql);
			}

		//check statement

		if ($result->rowCount() > 0) 
		{
    		// output data of each row
    		$count=0;
    		$inventoryArray= array();
    		while(($row = $result->fetch()) and $count<10) 
    		{
				array_push($inventoryArray,array("bkID"=>$row["bkID"], "dateOfBooking"=>$row["dateOfBooking"], "dateReturned"=>$row["dateReturned"], "count"=>$count, "barCodeNumber"=>$row["barCodeNumber"], "sKUNumber"=>$row["sKUNumber"], "name"=>$row["name"], "lastName"=>$row["lastName"], "firstName"=>$row["firstName"], "eMail"=>$row["eMail"]));
				$count= $count+1;
    		}
    		//return Array
    		$bookingClass->setBookingSearchArray($inventoryArray);
    		return;
		} 
		
		else 
		{
    		$bookingClass->setBookingSearchErr("No Results");
    		return;
		}
		$this->close();
	}//function close

	public function bookingInventoryQuery(BookingClass $bookingClass, $barCodeNumber, $sKUNumber, $productName)
	{
		$this->connect();
		
		//000
		if (empty($barCodeNumber) AND empty($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID";
				$result = $this->conn->query($sql);
			}

		//100
		elseif (isset($barCodeNumber) AND empty($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
					WHERE barCodeNumber = '".$barCodeNumber."'";
				$result = $this->conn->query($sql);
			}
	
		//010
		elseif (empty($barCodeNumber) AND isset($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
					WHERE sKUNumber = '".$sKUNumber."'";
				$result = $this->conn->query($sql);
			}

		//001
		elseif (empty($barCodeNumber) AND empty($sKUNumber) AND isset($productName))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
					WHERE name = '".$productName."'";
				$result = $this->conn->query($sql);
			}

		//110
		elseif (isset($barCodeNumber) AND isset($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
					WHERE barCodeNumber = '".$barCodeNumber."'
					AND sKUNumber = '".$sKUNumber."'";
				$result = $this->conn->query($sql);
			}

		//011
		elseif (empty($barCodeNumber) AND isset($sKUNumber) AND isset($productName))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
					WHERE sKUNumber = '".$sKUNumber."'
					AND name = '".$productName."'";
				$result = $this->conn->query($sql);
			}

		//101
		elseif (isset($barCodeNumber) AND empty($sKUNumber) AND isset($productName))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
					WHERE barCodeNumber = '".$barCodeNumber."'
					AND name = '".$productName."'";
				$result = $this->conn->query($sql);
			}

		//111
		else
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
					WHERE barCodeNumber = '".$barCodeNumber."'
					AND sKUNumber = '".$sKUNumber."'
					AND name = '".$productName."'";
				$result = $this->conn->query($sql);
			}

		//check statement
		//echo $sql;

		if ($result->rowCount() > 0) 
		{
    		// Inserts data in each row into an Array
    		$recordArray = array();
    		while(($row = $result->fetch())) 
    		{
    			array_push($recordArray, array("barCodeNumber"=>$row["barCodeNumber"],"sKUNumber"=> $row["sKUNumber"],"name"=>$row["name"],"productionCompanyName"=>$row["productionCompanyName"], "genreName"=>$row["genreName"],"dateAcquired"=>$row["dateAcquired"], "productCondition"=>$row["productCondition"]));
    		}
    	
    		//Checks for repeating rows and concatenates products with multiple genres into 1 row
    		$lastBarcode= "";
    		$allGenres= "";
    		$dontDisplay= array();
    		for($x=0;$x<count($recordArray);$x++)
    		{
    			if($recordArray[$x]["barCodeNumber"] == $lastBarcode)
    			{
    				$allGenres= $allGenres.", ".$recordArray[$x]["genreName"];
    				$recordArray[$x]["genreName"]= $allGenres;
    				array_push($dontDisplay, $x-1);
    			}
    			else
    			{
    				$lastBarcode= $recordArray[$x]["barCodeNumber"];
    				$allGenres= $recordArray[$x]["genreName"];
    			}
    		}

    		//Checks which products have repeating rows and only displays the one with all genres concatenated
    		$count=0;
    		$inventoryArray= array();
    		for($x=0;$x<count($recordArray);$x++)
    		{
    			if(!in_array($x,$dontDisplay) and $count<10)
    			{
    				array_push($inventoryArray,array("count"=>$count, "barCodeNumber"=>$recordArray[$x]["barCodeNumber"], "sKUNumber"=>$recordArray[$x]["sKUNumber"], "name"=>$recordArray[$x]["name"], "productionCompanyName"=>$recordArray[$x]["productionCompanyName"], "genreName"=>$recordArray[$x]["genreName"], "dateAcquired"=>$recordArray[$x]["dateAcquired"], "productCondition"=>$recordArray[$x]["productCondition"]));
					$count= $count+1;
				}
    		}
    		$bookingClass->setBookingInventoryArray($inventoryArray);
    		return;
		} 
		
		else 
		{
    		$bookingClass->setBookingInventoryErr("No Results");
    		return;
		}
		$this->close();
	} //Function Close

	public function bookingSearchInventoryQuery(BookingClass $bookingClass, $barCodeNumber, $sKUNumber, $productName)
	{
		$this->connect();

		//000
		if (empty($barCodeNumber) AND empty($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $this->conn->query($sql);
			}

		//100
		elseif (isset($barCodeNumber) AND empty($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE barCodeNumber = '".$barCodeNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $this->conn->query($sql);
			}
	
		//010
		elseif (empty($barCodeNumber) AND isset($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE sKUNumber = '".$sKUNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $this->conn->query($sql);
			}

		//001
		elseif (empty($barCodeNumber) AND empty($sKUNumber) AND isset($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE name = '".$productName."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $this->conn->query($sql);
			}

		//110
		elseif (isset($barCodeNumber) AND isset($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE barCodeNumber = '".$barCodeNumber."'
					AND sKUNumber = '".$sKUNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $this->conn->query($sql);
			}

		//011
		elseif (empty($barCodeNumber) AND isset($sKUNumber) AND isset($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE sKUNumber = '".$sKUNumber."'
					AND name = '".$productName."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $this->conn->query($sql);
			}

		//101
		elseif (isset($barCodeNumber) AND empty($sKUNumber) AND isset($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE barCodeNumber = '".$barCodeNumber."'
					AND name = '".$productName."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $this->conn->query($sql);
			}

		//111
		else
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE barCodeNumber = '".$barCodeNumber."'
					AND sKUNumber = '".$sKUNumber."'
					AND name = '".$productName."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $this->conn->query($sql);
			}

		//check statement
		//echo $sql;

		if ($result->rowCount() > 0) 
		{
    		// output data of each row
    		$count=0;
    		$inventoryArray= array();
    		while(($row = $result->fetch()) and $count<10) 
    		{
				array_push($inventoryArray,array("bkID"=>$row["bkID"], "dateOfBooking"=>$row["dateOfBooking"], "dateReturned"=>$row["dateReturned"], "count"=>$count, "barCodeNumber"=>$row["barCodeNumber"], "sKUNumber"=>$row["sKUNumber"], "name"=>$row["name"], "lastName"=>$row["lastName"], "firstName"=>$row["firstName"], "eMail"=>$row["eMail"]));
				$count= $count+1;
    		}
    		//return Array
    		$bookingClass->setBookingSearchArray($inventoryArray);
    		return;
		} 
		
		else 
		{
    		$bookingClass->setBookingSearchErr("No Results");
    		return;
		}
		$this->close();
	} //Function Close

	public function createBookingRecord(BookingClass $bookingClass, $eMail, $barCodeNumber1, $barCodeNumber2, $barCodeNumber3, $barCodeNumber4, $barCodeNumber5, $barCodeNumber6, $barCodeNumber7, $barCodeNumber8, $barCodeNumber9, $barCodeNumber10, $bookingDate)
	{
		//E-Mail Check
		$this->connect();

		$eMailSQL = "SELECT cuID, eMail FROM Customer WHERE eMail= '".$eMail."' LIMIT 1";
		$eMailResult = $this->conn->query($eMailSQL);
		
		if ($eMailResult->rowCount() == 0) 
		{
        	$bookingClass->setCreateBookingErr("E-Mail Address is not valid.");
        	return;
		}
		//Saves E-Mail's cuID to variable
		$row = $eMailResult->fetch();
		$cuID= $row["cuID"];

		//Barcode number check
		$allBarCodeNumbers= array();
		
		array_push($allBarCodeNumbers, $barCodeNumber1, $barCodeNumber2, $barCodeNumber3, $barCodeNumber4, $barCodeNumber5, $barCodeNumber6, $barCodeNumber7, $barCodeNumber8, $barCodeNumber9, $barCodeNumber10);

		$notNullBarCodeNumbers= array();
		foreach($allBarCodeNumbers as $barCode)
		{
			if($barCode != NULL)
			{
				array_push($notNullBarCodeNumbers, $barCode);
			}
		}

		$barCodeSQL= "SELECT inID, barCodeNumber FROM Inventory WHERE barCodeNumber in ('".$barCodeNumber1."', '".$barCodeNumber2."', '".$barCodeNumber3."', '".$barCodeNumber4."', '".$barCodeNumber5."', '".$barCodeNumber6."', '".$barCodeNumber7."', '".$barCodeNumber8."', '".$barCodeNumber9."', '".$barCodeNumber10."')";

		$barCodeResult= $this->conn->query($barCodeSQL);

		$inventoryIDArray= array();
		$databaseBarCodeNumbers= array();
		
		if($barCodeResult->rowCount()>0)
		{
			while ($row = $barCodeResult->fetch())
			{
				array_push($inventoryIDArray, $row["inID"]);
				array_push($databaseBarCodeNumbers, $row["barCodeNumber"]);
			}
		}

		else
		{
			$bookingClass->setCreateBookingErr("All Barcodes are not valid.");
			return;
		}

		//Checks if the barcodes entered by the user are in the database
		$notInDataBase= array();
		foreach($notNullBarCodeNumbers as $barCodeNumber)
		{
			if (!in_array($barCodeNumber, $databaseBarCodeNumbers))
			{
				array_push($notInDataBase, $barCodeNumber);
			}
		}

		if(count($notInDataBase)>0)
		{
			$bookingClass->setCreateBookingErr("The following Barcodes are not valid: ".$notInDataBase[0]." ".$notInDataBase[1]." ".$notInDataBase[2]." ".$notInDataBase[3]." ".$notInDataBase[4]." ".$notInDataBase[5]." ".$notInDataBase[6]." ".$notInDataBase[7]." ".$notInDataBase[8]." ".$notInDataBase[9]);
			return;
		}

		//Checks if barcodes entered by user are on loan
		$barCodeLoanArray= array();
		foreach($databaseBarCodeNumbers as $barCodeNumber)
		{
			$barCodeLoanCheckSQL= "SELECT bkid, bi.inid, barCodeNumber, dateReturned FROM Inventory i JOIN BookingInventory bi ON i.inid = bi.inid WHERE dateReturned IS NULL AND barCodeNumber= '".$barCodeNumber."'";
			$barCodeLoanCheckResult= $this->conn->query($barCodeLoanCheckSQL);

			$row= $barCodeLoanCheckResult->fetch();
			if(isset($row["barCodeNumber"]))
			{
				array_push($barCodeLoanArray, $row["barCodeNumber"]);
			}
		}

		if(count($barCodeLoanArray)>0)
		{
			$bookingClass->setCreateBookingErr("The following Barcodes are currently on loan: ".$barCodeLoanArray[0]." ".$barCodeLoanArray[1]." ".$barCodeLoanArray[2]." ".$barCodeLoanArray[3]." ".$barCodeLoanArray[4]." ".$barCodeLoanArray[5]." ".$barCodeLoanArray[6]." ".$barCodeLoanArray[7]." ".$barCodeLoanArray[8]." ".$barCodeLoanArray[9]);
			return;
		}

		//INSERTS NEW BOOKING RECORDS INTO DATABASE
		$bookingSQL= "INSERT INTO Booking (cuID, dateOfBooking) VALUES (:cuID, :bookingDate)";
		$bookingResult= $this->conn->prepare($bookingSQL);
		$bookingResult->execute(array(
			':cuID' => $cuID,
			':bookingDate' => $bookingDate
			));

		$returnBkIDSQL= "SELECT bkID FROM Booking WHERE cuid=".$cuID." ORDER BY bkID DESC LIMIT 1"; 
		$resultReturnBkIDSQL= $this->conn->query($returnBkIDSQL);

		//Saves New bkID to variable
		$row = $resultReturnBkIDSQL->fetch();
		$bkID= $row["bkID"];

		//Insert Records into BookingInventory
		$bookingInventorySQL=array();
		foreach($inventoryIDArray as $inID)
		{
			array_push($bookingInventorySQL,array("bkID"=>$bkID, "inID"=>$inID));
		}

		foreach($bookingInventorySQL as $sql)
		{
			$sqlResult= $this->conn->prepare("INSERT INTO BookingInventory (bkID, inID) VALUES (:bkID, :inID);");
			
			if($sqlResult->execute(array(
			':bkID' => $sql['bkID'],
			':inID' => $sql['inID']
			))===FALSE)
			{
				$bookingClass->setCreateBookingErr("Error: " .$bookingInventorySQL. "<br>" . $this->conn->error);
                return;
			}
        }
        $bookingClass->setCreateBookingOutput("New Booking created successfully.");
		$this->close();
	}//function close

	public function returnBooking(BookingClass $bookingClass, $barCodeNumber1, $barCodeNumber2, $barCodeNumber3, $barCodeNumber4, $barCodeNumber5, $barCodeNumber6, $barCodeNumber7, $barCodeNumber8, $barCodeNumber9, $barCodeNumber10, $returnDate)
	{
		$this->connect();

		//Barcode number check
		$allBarCodeNumbers= array();
		
		array_push($allBarCodeNumbers, $barCodeNumber1, $barCodeNumber2, $barCodeNumber3, $barCodeNumber4, $barCodeNumber5, $barCodeNumber6, $barCodeNumber7, $barCodeNumber8, $barCodeNumber9, $barCodeNumber10);

		$notNullBarCodeNumbers= array();
		foreach($allBarCodeNumbers as $barCode)
		{
			if($barCode != NULL)
			{
				array_push($notNullBarCodeNumbers, $barCode);
			}
		}

		$barCodeSQL= "SELECT inID, barCodeNumber FROM Inventory WHERE barCodeNumber in ('".$barCodeNumber1."', '".$barCodeNumber2."', '".$barCodeNumber3."', '".$barCodeNumber4."', '".$barCodeNumber5."', '".$barCodeNumber6."', '".$barCodeNumber7."', '".$barCodeNumber8."', '".$barCodeNumber9."', '".$barCodeNumber10."')";

		$barCodeResult= $this->conn->query($barCodeSQL);

		$inventoryIDArray= array();
		$databaseBarCodeNumbers= array();
		
		if($barCodeResult->rowCount()>0)
		{
			while ($row = $barCodeResult->fetch())
			{
				array_push($inventoryIDArray, $row["inID"]);
				array_push($databaseBarCodeNumbers, $row["barCodeNumber"]);
			}
		}

		else
		{
			$bookingClass->setReturnBookingErr("All Barcodes are not valid.");
			return;
		}

		//Checks if the barcodes entered by the user are in the database
		$notInDataBase= array();
		foreach($notNullBarCodeNumbers as $barCodeNumber)
		{
			if (!in_array($barCodeNumber, $databaseBarCodeNumbers))
			{
				array_push($notInDataBase, $barCodeNumber);
			}
		}

		if(count($notInDataBase)>0)
		{
			$bookingClass->setReturnBookingErr("The following Barcodes are not valid: ".$notInDataBase[0]." ".$notInDataBase[1]." ".$notInDataBase[2]." ".$notInDataBase[3]." ".$notInDataBase[4]." ".$notInDataBase[5]." ".$notInDataBase[6]." ".$notInDataBase[7]." ".$notInDataBase[8]." ".$notInDataBase[9]);
			return;
		}

		//Checks if barcodes entered by user are on loan
		$barCodeNotOnLoanArray= array();
		foreach($databaseBarCodeNumbers as $barCodeNumber)
		{
			echo $barCodeNumber;
			$barCodeLoanCheckSQL= "SELECT bkid, bi.inid, barCodeNumber, dateReturned FROM Inventory i JOIN BookingInventory bi ON i.inid = bi.inid WHERE dateReturned IS NULL AND barCodeNumber= '".$barCodeNumber."'";
			$barCodeLoanCheckResult= $this->conn->query($barCodeLoanCheckSQL);

			$row = $barCodeLoanCheckResult->fetch();
			if (!isset($row["barCodeNumber"]))
			{
				array_push($barCodeNotOnLoanArray, $barCodeNumber);
			}
		}

		if(count($barCodeNotOnLoanArray)>0)
		{
			$bookingClass->setReturnBookingErr("The following Barcodes are NOT currently on loan: ".$barCodeNotOnLoanArray[0]." ".$barCodeNotOnLoanArray[1]." ".$barCodeNotOnLoanArray[2]." ".$barCodeNotOnLoanArray[3]." ".$barCodeNotOnLoanArray[4]." ".$barCodeNotOnLoanArray[5]." ".$barCodeNotOnLoanArray[6]." ".$barCodeNotOnLoanArray[7]." ".$barCodeNotOnLoanArray[8]." ".$barCodeNotOnLoanArray[9]);
			return;
		}

		//UPDATES DATERETURNED FIELD IN BOOKINGINVENTORY TABLE
		//Pulls bkID for each outstanding inID
		$returnInventorySQL=array();
		foreach($inventoryIDArray as $inID)
		{
			$bkIDSQL= "SELECT bkID, bi.inID, barCodeNumber FROM BookingInventory bi JOIN Inventory i ON bi.inID = i.inID WHERE dateReturned IS NULL AND bi.inID= ".$inID;
			$bkIDResult= $this->conn->query($bkIDSQL);

			//Saves bkID and barCodeNumber to variables
			$row = $bkIDResult->fetch();
			$bkID= $row["bkID"];
			$barCodeNumber= $row["barCodeNumber"];

			//Checks if Return Date is after Booking Date
			$bookingDateSQL= "SELECT dateOfBooking FROM Booking WHERE bkID= ".$bkID;
			$bookingDateResult= $this->conn->query($bookingDateSQL);
			$row = $bookingDateResult->fetch();
			$dateOfBooking= $row["dateOfBooking"];

			if($returnDate<$dateOfBooking)
			{
				$bookingClass->setReturnBookingErr("The Return Date for Barcode Number ".$barCodeNumber." is before the Booking Date. Please select a Return Date that is after or equal to the Booking Date");
				return;
			}

			//Insert Records into BookingInventory
			array_push($returnInventorySQL,array("dateReturned"=>$returnDate,"bkID"=>$bkID, "inID"=>$inID));
		}

		foreach($returnInventorySQL as $sql)
		{
			$sqlResult= $this->conn->prepare("UPDATE BookingInventory SET dateReturned= :returnDate WHERE bkID= :bkID AND inID= :inID;");
			
			if($sqlResult->execute(array(
			':returnDate' => $sql['dateReturned'],
			':bkID' => $sql['bkID'],
			':inID' => $sql['inID']
			))===FALSE)
			{
				$bookingClass->setReturnBookingErr("Error: ".$returnInventorySQL." ". $this->conn->error);
				return;
			}
		}
		
		$bookingClass->setReturnBookingOutput("Inventory Item(s) successfully returned");
		$this->close();
	}//function close

}//Class Close

?>

<!-- php Desktop/PHP/SantaMonicaMovieRentalsSILEX/app/SMMRSite/DAOs/bookingDAOClass.php -->