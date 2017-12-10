<?php namespace SMMRSite\Models\BookingModels;

use SMMRSite\Models\DAOClass as DAOClass;
use mysqli;

class BookingDAOClass extends DAOClass
{

	public function __construct()
	{
		$this->serverName;
		$this->userName;
		$this->passwordServer;
		$this->dbName;
	}

	public function bookingCustomerQuery($lastName, $dateOfBirth, $address1, $phoneNumber)
	{
		$conn= new mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}
		//0000
		if (empty($lastName) and empty($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer";
			$result = $conn->query($sql);
			}
		
		//1000
		elseif (isset($lastName) and empty($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."'";
			$result = $conn->query($sql);
			}

		//0100
		elseif (empty($lastName) and isset($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE dateOfBirth= '".$dateOfBirth."'";
			$result = $conn->query($sql);
			}

		//0010
		elseif (empty($lastName) and empty($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."'";
			$result = $conn->query($sql);
			}

		//0001
		elseif (empty($lastName) and empty($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//1100
		elseif (isset($lastName) and isset($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."'";
			$result = $conn->query($sql);
			}

		//1010
		elseif (isset($lastName) and empty($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND address1= '".$address1."'";
			$result = $conn->query($sql);
			}

		//1001
		elseif (isset($lastName) and empty($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//0110
		elseif (empty($lastName) and isset($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."'";
			$result = $conn->query($sql);
			}

		//0101
		elseif (empty($lastName) and isset($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE dateOfBirth= '".$dateOfBirth."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//0011
		elseif (empty($lastName) and empty($dateOfBirth) and isset($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE address1= '".$address1."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//1110
		elseif (isset($lastName) and isset($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."'";
			$result = $conn->query($sql);
			}

		//1101
		elseif (isset($lastName) and isset($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//1011
		elseif (isset($lastName) and empty($dateOfBirth) and isset($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND address1= '".$address1."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//0111
		elseif (empty($lastName) and isset($dateOfBirth) and isset($address1) and isset($phoneNumber))
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//1111
		else
			{
			$sql= "SELECT cuID, firstName, lastName, dateOfBirth, gender, address1, address2, city, state, phoneNumber, eMail FROM Customer WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."' AND phoneNumber= '".$phoneNumber."'";
			$result = $conn->query($sql);
			}

		//check statement
		//echo $sql;

		if ($result->num_rows > 0) 
		{
			echo "<span class='notice'>* Search displays first 10 Results</span>";
			echo "<form action= ".htmlspecialchars($_SERVER["PHP_SELF"])."?action=bookingCreate autocomplete='on' method='get'>";
			echo "<h1 style='color:#16e059;'>Results:</h1>";
			echo "<table border='1' style='width:100%'>
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
					<th>Select?</th>
				</tr>
			";
    		// output data of each row
    		$count=0;
    		$eMailArray= array();
    		while(($row = $result->fetch_assoc()) and $count<10) 
    		{echo "<tr>
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
					<td><input type='text' name='eMail".$count."' value='".$row["eMail"]."' disabled></td>
					<td><input type='submit' name='eMailSelect".$count."' value='Select'></td>
				</tr>";
				$count= $count+1;
				array_push($eMailArray,$row["eMail"]);
    		}
    		echo "</table>";
    		echo "</form>";
    		return $eMailArray;
		} 
		
		else 
		{
    		echo "<h1 style='color:red;'>No Results</h1>";
		}
		$conn->close();
	}

	public function bookingSearchCustomerQuery($lastName, $dateOfBirth, $address1, $phoneNumber)
	{
		$conn= new mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}
		//0000
		if (empty($lastName) and empty($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}
		
		//1000
		elseif (isset($lastName) and empty($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//0100
		elseif (empty($lastName) and isset($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE dateOfBirth= '".$dateOfBirth."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//0010
		elseif (empty($lastName) and empty($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE address1= '".$address1."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//0001
		elseif (empty($lastName) and empty($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//1100
		elseif (isset($lastName) and isset($dateOfBirth) and empty($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//1010
		elseif (isset($lastName) and empty($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND address1= '".$address1."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//1001
		elseif (isset($lastName) and empty($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//0110
		elseif (empty($lastName) and isset($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//0101
		elseif (empty($lastName) and isset($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE dateOfBirth= '".$dateOfBirth."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//0011
		elseif (empty($lastName) and empty($dateOfBirth) and isset($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE address1= '".$address1."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//1110
		elseif (isset($lastName) and isset($dateOfBirth) and isset($address1) and empty($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//1101
		elseif (isset($lastName) and isset($dateOfBirth) and empty($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//1011
		elseif (isset($lastName) and empty($dateOfBirth) and isset($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND address1= '".$address1."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//0111
		elseif (empty($lastName) and isset($dateOfBirth) and isset($address1) and isset($phoneNumber))
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//1111
		else
			{
			$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE lastName= '".$lastName."' AND dateOfBirth= '".$dateOfBirth."' AND address1= '".$address1."' AND phoneNumber= '".$phoneNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
			$result = $conn->query($sql);
			}

		//check statement
		//echo $sql;

		if ($result->num_rows > 0) 
		{
			echo "<span class='notice'>* Search displays first 10 Results</span>";
			echo "<form action= ".htmlspecialchars($_SERVER["PHP_SELF"])."?action=bookingSearch autocomplete='on' method='get'>";
			echo "<h1 style='color:#16e059;'>Results:</h1>";
			echo "<table border='1' style='width:100%'>
				<tr>
					<th>Booking Number</th>
					<th>Date of Booking</th>
					<th>Date Returned</th>
					<th>Barcode Number</th>
					<th>SKU Number</th>
					<th>Product Name</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>E-Mail</th>
					<th>Select?</th>
				</tr>
			";
    		// output data of each row
    		$count=0;
    		$inventoryArray= array();
    		while(($row = $result->fetch_assoc()) and $count<10) 
    		{echo "<tr>
					<td>".$row["bkID"]."</td>
					<td>".$row["dateOfBooking"]."</td>
					<td>".$row["dateReturned"]."</td>
					<td><input type='text' name='barCode".$count."' value='".$row["barCodeNumber"]."' disabled></td>
					<td>".$row["sKUNumber"]."</td>
					<td>".$row["name"]."</td>
					<td>".$row["lastName"]."</td>
					<td>".$row["firstName"]."</td>
					<td>".$row["eMail"]."</td>
					<td><input type='submit' name='barCodeSelect".$count."' value='Select'></td>
				</tr>";
				$count= $count+1;
				array_push($inventoryArray,$row["barCodeNumber"]);
    		}
    		echo "</table>";
    		echo "</form>";
    		return $inventoryArray;
		} 
		
		else 
		{
    		echo "<h1 style='color:red;'>No Results</h1>";
		}
		$conn->close();
	}//function close

	public function bookingInventoryQuery($barCodeNumber, $sKUNumber, $productName)
	{
		$conn= new mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}
		//000
		if (empty($barCodeNumber) AND empty($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID";
				$result = $conn->query($sql);
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
				$result = $conn->query($sql);
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
				$result = $conn->query($sql);
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
				$result = $conn->query($sql);
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
				$result = $conn->query($sql);
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
				$result = $conn->query($sql);
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
				$result = $conn->query($sql);
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
				$result = $conn->query($sql);
			}

		//check statement
		//echo $sql;

		if ($result->num_rows > 0) 
		{
			echo "<span class='notice'>* Search displays first 10 Results</span>";
			echo "<form action= ".htmlspecialchars($_SERVER["PHP_SELF"])."?action=bookingCreate autocomplete='on' method='get'>";
			echo "<h1 style='color:#16e059;'>Results:</h1>";
			echo "<table border='1' style='width:100%'>
				<tr>
					<th>Barcode Number</th>
					<th>SKU Number</th>
					<th>Product Name</th>
					<th>Production Company</th>
					<th>Genre(s)</th>
					<th>Date Acquired</th>
					<th>Condition</th>
					<th>Select?</>
				</tr>
			";

    		// Inserts data in each row into an Array
    		$recordArray = array();
    		while(($row = $result->fetch_assoc())) 
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
    				echo "<tr>
					<td><input type='text' name='barCode".$count."' value='".$recordArray[$x]["barCodeNumber"]."' disabled></td>
					<td>".$recordArray[$x]["sKUNumber"]."</td>
					<td>".$recordArray[$x]["name"]."</td>
					<td>".$recordArray[$x]["productionCompanyName"]."</td>
					<td>".$recordArray[$x]["genreName"]."</td>
					<td>".$recordArray[$x]["dateAcquired"]."</td>
					<td>".$recordArray[$x]["productCondition"]."</td>
					<td><input type='submit' name='barCodeSelect".$count."' value='Select'></td>
				</tr>";
				$count= $count+1;
				array_push($inventoryArray,$recordArray[$x]["barCodeNumber"]);
				}
    		}
    		echo "</table>";
    		echo "</form>";
    		return $inventoryArray;
		} 
		
		else 
		{
    		echo "<h1 style='color:red;'>No Results</h1>";
		}
		
		$conn->close();
	} //Function Close

	public function bookingSearchInventoryQuery($barCodeNumber, $sKUNumber, $productName)
	{
		$conn= new mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}
		//000
		if (empty($barCodeNumber) AND empty($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID WHERE dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $conn->query($sql);
			}

		//100
		elseif (isset($barCodeNumber) AND empty($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE barCodeNumber = '".$barCodeNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $conn->query($sql);
			}
	
		//010
		elseif (empty($barCodeNumber) AND isset($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE sKUNumber = '".$sKUNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $conn->query($sql);
			}

		//001
		elseif (empty($barCodeNumber) AND empty($sKUNumber) AND isset($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE name = '".$productName."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $conn->query($sql);
			}

		//110
		elseif (isset($barCodeNumber) AND isset($sKUNumber) AND empty($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE barCodeNumber = '".$barCodeNumber."'
					AND sKUNumber = '".$sKUNumber."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $conn->query($sql);
			}

		//011
		elseif (empty($barCodeNumber) AND isset($sKUNumber) AND isset($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE sKUNumber = '".$sKUNumber."'
					AND name = '".$productName."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $conn->query($sql);
			}

		//101
		elseif (isset($barCodeNumber) AND empty($sKUNumber) AND isset($productName))
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE barCodeNumber = '".$barCodeNumber."'
					AND name = '".$productName."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $conn->query($sql);
			}

		//111
		else
			{
				$sql= "SELECT bi.bkID, dateOfBooking, dateReturned, barCodeNumber, sKUNumber, name, lastName, firstName, eMail FROM Customer c JOIN Booking b ON c.cuID = b.cuID JOIN BookingInventory bi ON b.bkID = bi.bkID JOIN Inventory i ON i.inID = bi.inID JOIN Product p ON i.prID = p.prID
					WHERE barCodeNumber = '".$barCodeNumber."'
					AND sKUNumber = '".$sKUNumber."'
					AND name = '".$productName."' AND dateReturned is NULL ORDER BY bi.bkID desc";
				$result = $conn->query($sql);
			}

		//check statement
		//echo $sql;

		if ($result->num_rows > 0) 
		{
			echo "<span class='notice'>* Search displays first 10 Results</span>";
			echo "<form action= ".htmlspecialchars($_SERVER["PHP_SELF"])."?action=bookingSearch autocomplete='on' method='get'>";
			echo "<h1 style='color:#16e059;'>Results:</h1>";
			echo "<table border='1' style='width:100%'>
				<tr>
					<th>Booking Number</th>
					<th>Date of Booking</th>
					<th>Date Returned</th>
					<th>Barcode Number</th>
					<th>SKU Number</th>
					<th>Product Name</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>E-Mail</th>
					<th>Select?</th>
				</tr>
			";

  			// output data of each row
    		$count=0;
    		$inventoryArray= array();
    		while(($row = $result->fetch_assoc()) and $count<10) 
    		{echo "<tr>
					<td>".$row["bkID"]."</td>
					<td>".$row["dateOfBooking"]."</td>
					<td>".$row["dateReturned"]."</td>
					<td><input type='text' name='barCode".$count."' value='".$row["barCodeNumber"]."' disabled></td>
					<td>".$row["sKUNumber"]."</td>
					<td>".$row["name"]."</td>
					<td>".$row["lastName"]."</td>
					<td>".$row["firstName"]."</td>
					<td>".$row["eMail"]."</td>
					<td><input type='submit' name='barCodeSelect".$count."' value='Select'></td>
				</tr>";
				$count= $count+1;
				array_push($inventoryArray,$row["barCodeNumber"]);
    		}
    		echo "</table>";
    		echo "</form>";
    		return $inventoryArray;
		} 
		
		else 
		{
    		echo "<h1 style='color:red;'>No Results</h1>";
		}
		$conn->close();
	} //Function Close

	public function createBookingRecord($eMail, $barCodeNumber1, $barCodeNumber2, $barCodeNumber3, $barCodeNumber4, $barCodeNumber5, $barCodeNumber6, $barCodeNumber7, $barCodeNumber8, $barCodeNumber9, $barCodeNumber10, $bookingDate)
	{
		//E-Mail Check
		$conn= new mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}

		$eMailSQL = "SELECT cuID, eMail FROM Customer WHERE eMail= '".$eMail."' LIMIT 1";
		$eMailResult = $conn->query($eMailSQL);
		
		if ($eMailResult->num_rows == 0) 
		{
        	return "<h1 style='color:red;'>E-Mail Address is not valid.</h1>";
		}
		//Saves E-Mail's cuID to variable
		$row = $eMailResult->fetch_assoc();
		$cuID= $row["cuID"];
		echo $cuID."<br>";

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

		$barCodeResult= $conn->query($barCodeSQL);

		$inventoryIDArray= array();
		$databaseBarCodeNumbers= array();
		
		if($barCodeResult->num_rows>0)
		{
			while ($row = $barCodeResult->fetch_assoc())
			{
				array_push($inventoryIDArray, $row["inID"]);
				array_push($databaseBarCodeNumbers, $row["barCodeNumber"]);
			}
		}

		else
		{
			return "<h1 style='color:red;'>All Barcodes are not valid.</h1>";
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
			return "<h1 style='color:red;'>The following Barcodes are not valid: ".$notInDataBase[0]." ".$notInDataBase[1]." ".$notInDataBase[2]." ".$notInDataBase[3]." ".$notInDataBase[4]." ".$notInDataBase[5]." ".$notInDataBase[6]." ".$notInDataBase[7]." ".$notInDataBase[8]." ".$notInDataBase[9]."</h1>";
		}

		//Checks if barcodes entered by user are on loan
		$barCodeLoanArray= array();
		foreach($databaseBarCodeNumbers as $barCodeNumber)
		{
			$barCodeLoanCheckSQL= "SELECT bkid, bi.inid, barCodeNumber, dateReturned FROM Inventory i JOIN BookingInventory bi ON i.inid = bi.inid WHERE dateReturned IS NULL AND barCodeNumber= '".$barCodeNumber."'";
			$barCodeLoanCheckResult= $conn->query($barCodeLoanCheckSQL);

			$row= $barCodeLoanCheckResult->fetch_assoc();
			if(isset($row["barCodeNumber"]))
			{
				array_push($barCodeLoanArray, $row["barCodeNumber"]);
			}
		}

		if(count($barCodeLoanArray)>0)
		{
			return "<h1 style='color:red;'>The following Barcodes are currently on loan: ".$barCodeLoanArray[0]." ".$barCodeLoanArray[1]." ".$barCodeLoanArray[2]." ".$barCodeLoanArray[3]." ".$barCodeLoanArray[4]." ".$barCodeLoanArray[5]." ".$barCodeLoanArray[6]." ".$barCodeLoanArray[7]." ".$barCodeLoanArray[8]." ".$barCodeLoanArray[9]."</h1>";
		}

		//INSERTS NEW BOOKING RECORDS INTO DATABASE
		$bookingSQL= "INSERT INTO Booking (cuID, dateOfBooking) VALUES (".$cuID.", '".$bookingDate."')";
		$conn->query($bookingSQL);

		$returnBkIDSQL= "SELECT bkID FROM Booking WHERE cuid=".$cuID." ORDER BY bkID DESC LIMIT 1"; 
		$resultReturnBkIDSQL= $conn->query($returnBkIDSQL);

		//Saves New bkID to variable
		$row = $resultReturnBkIDSQL->fetch_assoc();
		$bkID= $row["bkID"];

		//Insert Records into BookingInventory
		$bookingInventorySQL="";
		foreach($inventoryIDArray as $inID)
		{
			if ($inID == $inventoryIDArray[0])
			{
				$bookingInventorySQL="INSERT INTO BookingInventory (bkID, inID) VALUES (".$bkID.", ".$inID.");";
			}
			else
			{
				$bookingInventorySQL .="INSERT INTO BookingInventory (bkID, inID) VALUES (".$bkID.", ".$inID.");";
			}	
		}

		if($conn->multi_query($bookingInventorySQL)===TRUE)
		{
			return "<h1 style='color:#16e059;'>New Booking created successfully</h1>";
		}

		else
		{
			return "Error: " .$bookingInventorySQL. "<br>" . $conn->error;
		}

		$conn->close();
	}//function close

	public function returnBooking($barCodeNumber1, $barCodeNumber2, $barCodeNumber3, $barCodeNumber4, $barCodeNumber5, $barCodeNumber6, $barCodeNumber7, $barCodeNumber8, $barCodeNumber9, $barCodeNumber10, $returnDate)
	{
		$conn= new mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}

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

		$barCodeResult= $conn->query($barCodeSQL);

		$inventoryIDArray= array();
		$databaseBarCodeNumbers= array();
		
		if($barCodeResult->num_rows>0)
		{
			while ($row = $barCodeResult->fetch_assoc())
			{
				array_push($inventoryIDArray, $row["inID"]);
				array_push($databaseBarCodeNumbers, $row["barCodeNumber"]);
			}
		}

		else
		{
			return "<h1 style='color:red;'>All Barcodes are not valid.</h1>";
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
			return "<h1 style='color:red;'>The following Barcodes are not valid: ".$notInDataBase[0]." ".$notInDataBase[1]." ".$notInDataBase[2]." ".$notInDataBase[3]." ".$notInDataBase[4]." ".$notInDataBase[5]." ".$notInDataBase[6]." ".$notInDataBase[7]." ".$notInDataBase[8]." ".$notInDataBase[9]."</h1>";
		}

		//Checks if barcodes entered by user are on loan
		$barCodeNotOnLoanArray= array();
		foreach($databaseBarCodeNumbers as $barCodeNumber)
		{
			echo $barCodeNumber;
			$barCodeLoanCheckSQL= "SELECT bkid, bi.inid, barCodeNumber, dateReturned FROM Inventory i JOIN BookingInventory bi ON i.inid = bi.inid WHERE dateReturned IS NULL AND barCodeNumber= '".$barCodeNumber."'";
			$barCodeLoanCheckResult= $conn->query($barCodeLoanCheckSQL);

			$row = $barCodeLoanCheckResult->fetch_assoc();
			if (!isset($row["barCodeNumber"]))
			{
				array_push($barCodeNotOnLoanArray, $barCodeNumber);
			}
		}

		if(count($barCodeNotOnLoanArray)>0)
		{
			return "<h1 style='color:red;'>The following Barcodes are NOT currently on loan: ".$barCodeNotOnLoanArray[0]." ".$barCodeNotOnLoanArray[1]." ".$barCodeNotOnLoanArray[2]." ".$barCodeNotOnLoanArray[3]." ".$barCodeNotOnLoanArray[4]." ".$barCodeNotOnLoanArray[5]." ".$barCodeNotOnLoanArray[6]." ".$barCodeNotOnLoanArray[7]." ".$barCodeNotOnLoanArray[8]." ".$barCodeNotOnLoanArray[9]."</h1>";
		}

		//UPDATES DATERETURNED FIELD IN BOOKINGINVENTORY TABLE
		//Pulls bkID for each outstanding inID
		$returnInventorySQL="";
		foreach($inventoryIDArray as $inID)
		{
			$bkIDSQL= "SELECT bkID, bi.inID, barCodeNumber FROM BookingInventory bi JOIN Inventory i ON bi.inID = i.inID WHERE dateReturned IS NULL AND bi.inID= ".$inID;
			$bkIDResult= $conn->query($bkIDSQL);

			//Saves bkID and barCodeNumber to variables
			$row = $bkIDResult->fetch_assoc();
			$bkID= $row["bkID"];
			$barCodeNumber= $row["barCodeNumber"];

			//Checks if Return Date is after Booking Date
			$bookingDateSQL= "SELECT dateOfBooking FROM Booking WHERE bkID= ".$bkID;
			$bookingDateResult= $conn->query($bookingDateSQL);
			$row = $bookingDateResult->fetch_assoc();
			$dateOfBooking= $row["dateOfBooking"];

			if($returnDate<$dateOfBooking)
			{
				return "<h1 style='color:red;'>The Return Date for Barcode Number ".$barCodeNumber." is before the Booking Date. Please select a Return Date that is after or equal to the Booking Date.</h1>";
			}

			//Insert Records into BookingInventory
			if ($inID == $inventoryIDArray[0])
			{
				$returnInventorySQL="UPDATE BookingInventory SET dateReturned='".$returnDate."' WHERE bkID=".$bkID." AND inID=".$inID.";";
			}
			else
			{
				$returnInventorySQL .="UPDATE BookingInventory SET dateReturned='".$returnDate."' WHERE bkID=".$bkID." AND inID=".$inID.";";
			}	
		}
		
		if($conn->multi_query($returnInventorySQL)===TRUE)
		{
			return "<h1 style='color:#16e059;'>Inventory Item(s) successfully returned</h1>";
		}
		else
		{
			return "Error: " .$returnInventorySQL. "<br>" . $conn->error;
		}

		$conn->close();
	}//function close

}//Class Close

?>