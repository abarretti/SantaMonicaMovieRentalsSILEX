<?php namespace SMMRSite\Models\InventoryModels;

use SMMRSite\Models\DAOClass as DAOClass;
use mysqli;

class InventoryDAOClass extends DAOClass
{
	public function __construct()
	{
		$this->serverName;
		$this->userName;
		$this->passwordServer;
		$this->dbName;
	}
	//Inventory Methods

	public function getCompanyNames($productionCompanyName)
	{
		$conn= new \mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}

		$sql = "SELECT productionCompanyName FROM ProductionCompany";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) 
		{

   		// output data of each row concatenate into one string
		$companyNames="";
    	while($row = $result->fetch_assoc()) 
    		{
        	$companyNames.= "<option value='".$row["productionCompanyName"]."'";
        	if($productionCompanyName == $row["productionCompanyName"]) 
        		{
        			$companyNames.= 'selected';
        		}
        	$companyNames.= ">".$row["productionCompanyName"]."</option>";
    		}
    	return $companyNames;
		} 
		$conn->close();
	}

	public function getGenres($action, $children, $comedy, $documentary, $drama, $horror, $musicals, $romance, $scienceFiction, $thriller)
	{
		$genres= array($action, $children, $comedy, $documentary, $drama, $horror, $musicals, $romance, $scienceFiction, $thriller);
		
		$conn= new \mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}

		$sql = "SELECT genreName FROM Genre";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) 
		{
   		// output data of each row concatenate into one string
    	$genres="";
    	while($row = $result->fetch_assoc()) 
    		{
        	$genres.= "<input type='checkbox' name='".lcfirst(str_replace(' ','',$row["genreName"]))."' value='".lcfirst(str_replace(' ','',$row["genreName"]))."' ";
        	foreach($genres as $genre)
        	{
        		if ($genre == $row["genreName"]) 
        		{
        			$genres.= 'checked';
        		}
        	}
        	$genres.= ">".$row["genreName"]."<br>";
    		}
    	return $genres;
		} 
		$conn->close();
	}

	public function createInventoryRecord ($sKUNumber, $productName, $productionCompanyName, $action, $children, $comedy, $documentary, $drama, $horror, $musicals, $romance, $scienceFiction, $thriller, $barCodeNumber, $dateAcquired, $condition)
	{
		$conn= new \mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}

		$sqlDuplicateCheck = "SELECT barCodeNumber FROM Inventory WHERE barCodeNumber= '".$barCodeNumber."'";
		$result = $conn->query($sqlDuplicateCheck);

		if ($result->num_rows > 0) 
		{
   		// output 
    	while($row = $result->fetch_assoc()) 
    		{
        	return "<h1 style='color:red;'>Barcode Number ".$row["barCodeNumber"]." already exists.</h1>";
    		}
		} 
		
		else 
		{
			//Pull PK for Production Company
			$pcIdQuery = "SELECT pcID FROM ProductionCompany WHERE productionCompanyName = '".$productionCompanyName."'"; 
			$pcIDResult = $conn->query($pcIdQuery);
			$rowPcID= $pcIDResult->fetch_assoc();
			$pcID=$rowPcID["pcID"];

			//Check if Product Already Exists - Insert new PrID if necessary, pull PrID if it already exists
			$productCheckQuery = "SELECT prID FROM Product WHERE sKUNumber= '".$sKUNumber."'";
			$productCheckResult = $conn->query($productCheckQuery);
			
			if ($productCheckResult->num_rows > 0)
			{	
				$rowPrID= $productCheckResult->fetch_assoc();
				$prID = $rowPrID["prID"];
			}
			
			else
			{
				$productInsertQuery= "INSERT INTO Product (prID, pcID, sKUNumber, name) VALUES (NULL, ".$pcID.",'".$sKUNumber."', '".$productName."')";
				$productInsertResult = $conn->query($productInsertQuery);
				
				$productCheckResult = $conn->query($productCheckQuery);
				while($rowPrID= $productCheckResult->fetch_assoc())
					{
						$prID= $rowPrID["prID"];
					}

				//Insert into ProductGenreJoin table	
				$gnIDSearchQuery= "SELECT gnID FROM Genre WHERE genreName in ('".$action."', '".$children."', '".$comedy."', '".$documentary."', '".$drama."', '".$horror."', '".$musicals."', '".$romance."', '".$scienceFiction."', '".$thriller."')";
				$gnIDSearchResult= $conn->query($gnIDSearchQuery);
				$gnIDRowCount= mysqli_num_rows($gnIDSearchResult);
			
				//BUG HERE!!!!!
				while($gnIDRow= mysqli_fetch_array($gnIDSearchResult))
    				{
        				$productGenreJoinInsertQuery= "INSERT INTO ProductGenreJoin (prID, gnID) VALUES (".$prID.",".$gnIDRow["gnID"].")";
        				$conn->query($productGenreJoinInsertQuery);
    				}
			}
			
			//Insert into Inventory table
			$inventoryInsertQuery= "INSERT INTO Inventory (inID, prID, barCodeNumber, dateAcquired, productCondition) VALUES (NULL,".$prID.",'".$barCodeNumber."', '".$dateAcquired."', '".$condition."')";

			if ($conn->query($inventoryInsertQuery) === TRUE) 
			{
    			return "<h1 style='color:#16e059;'>New Inventory and Product record created successfully</h1>";
			} 
			else
			{
    			return "Error: " . $inventoryInsertQuery . "<br>" . $conn->error;
			}
			
		}
		$conn->close();
	} //Function Close

	public function productInventoryQuery($sKUNumber, $productName)
	{
		$conn= new \mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}
		//0
		if (empty($sKUNumber) and empty($productName))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID";
				$result = $conn->query($sql);
			}

		elseif (isset($sKUNumber) and empty($productName))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
						WHERE p.sKUNumber = '".$sKUNumber."'";
				$result = $conn->query($sql);
			}
	
		elseif (empty($sKUNumber) and isset($productName))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
						WHERE p.name = '".$productName."'
						ORDER BY i.barCodeNumber";
				$result = $conn->query($sql);
			}

		else
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
						WHERE p.sKUNumber = '".$sKUNumber."' 
						AND p.name = '".$productName."'";
				$result = $conn->query($sql);
			}
		//check statement
		//echo $sql;

        $productInventoryTable="";
		if ($result->num_rows > 0) 
		{
			$productInventoryTable.= "<h1 style='color:#16e059;'>Results:</h1>";
			$productInventoryTable.= "<table border='1' style='width:100%'>
				<tr>
					<th>Barcode Number</th>
					<th>SKU Number</th>
					<th>Product Name</th>
					<th>Production Company Name</th>
					<th>Genre(s)</th>
					<th>Date Acquired</th>
					<th>Condition</th>
				</tr>
			";

    		// Inserts data in each row into an Array
    		$recordArray = array();
    		while(($row = $result->fetch_assoc())) 
    		{
    			array_push($recordArray, array("barCodeNumber"=>$row["barCodeNumber"],"sKUNumber"=> $row["sKUNumber"],"name"=>$row["name"],"productionCompanyName"=>$row["productionCompanyName"],"genreName"=>$row["genreName"],"dateAcquired"=>$row["dateAcquired"], "productCondition"=>$row["productCondition"]));
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
    		for($x=0;$x<count($recordArray);$x++)
    		{
    			if(!in_array($x,$dontDisplay) and $count<=100)
    			{
    				$productInventoryTable.= "<tr>
					<td>".$recordArray[$x]["barCodeNumber"]."</td>
					<td>".$recordArray[$x]["sKUNumber"]."</td>
					<td>".$recordArray[$x]["name"]."</td>
					<td>".$recordArray[$x]["productionCompanyName"]."</td>
					<td>".$recordArray[$x]["genreName"]."</td>
					<td>".$recordArray[$x]["dateAcquired"]."</td>
					<td>".$recordArray[$x]["productCondition"]."</td>
				</tr>";
				$count= $count++;
				}
    		}
    		$productInventoryTable.="</table>";
            return $productInventoryTable;
		} 
		
		else 
		{
    		$productInventoryTable.="<h1 style='color:red;'>No Results</h1>";
            return $productInventoryTable;
		}
		
		$conn->close();
	} //Function Close

	public function companyGenreQuery($productionCompanyName, $action, $children, $comedy, $documentary, $drama, $horror, $musicals, $romance, $scienceFiction, $thriller)
	{
		$conn= new \mysqli($this->getServerName(), $this->getUserName(), $this->getPasswordServer(), $this->getdbName());
		if ($conn->connect_error)
		{
			die("Connection failed; " . $conn->connect_error);
		}
		//0
		if ($productionCompanyName=="" and empty($action) and empty($children) and empty($comedy) and empty($documentary) and empty($drama) and empty($horror) and empty($musicals) and empty($romance) and empty($scienceFiction) and empty($thriller))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID";
				$result = $conn->query($sql);
			}

		elseif ($productionCompanyName!="" and empty($action) and empty($children) and empty($comedy) and empty($documentary) and empty($drama) and empty($horror) and empty($musicals) and empty($romance) and empty($scienceFiction) and empty($thriller))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
					WHERE productionCompanyName = '".$productionCompanyName."'";
				$result = $conn->query($sql);
			}
	
		elseif ($productionCompanyName=="" and (isset($action) or isset($children) or isset($comedy) or isset($documentary) or isset($drama) or isset($horror) or isset($musicals) or isset($romance) or isset($scienceFiction) or isset($thriller)))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
					WHERE genreName in ('".$action."', '".$children."', '".$comedy."', '".$documentary."', '".$drama."', '".$horror."', '".$musicals."', '".$romance."', '".$scienceFiction."', '".$thriller."')";
				$result = $conn->query($sql);
			}

		else
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID
					WHERE productionCompanyName = '".$productionCompanyName."'
					AND genreName in ('".$action."', '".$children."', '".$comedy."', '".$documentary."', '".$drama."', '".$horror."', '".$musicals."', '".$romance."', '".$scienceFiction."', '".$thriller."')";
				$result = $conn->query($sql);
			}
		//check statement
		//echo $sql;

        $productInventoryTable="";
		if ($result->num_rows > 0) 
		{
			$productInventoryTable.= "<h1 style='color:#16e059;'>Results:</h1>";
			$productInventoryTable.= "<table border='1' style='width:100%'>
				<tr>
					<th>Barcode Number</th>
					<th>SKU Number</th>
					<th>Product Name</th>
					<th>Production Company</th>
					<th>Genre(s)</th>
					<th>Date Acquired</th>
					<th>Condition</th>
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
    		for($x=0;$x<count($recordArray);$x++)
    		{
    			if(!in_array($x,$dontDisplay) and $count<=100)
    			{
    				$productInventoryTable.= "<tr>
					<td>".$recordArray[$x]["barCodeNumber"]."</td>
					<td>".$recordArray[$x]["sKUNumber"]."</td>
					<td>".$recordArray[$x]["name"]."</td>
					<td>".$recordArray[$x]["productionCompanyName"]."</td>
					<td>".$recordArray[$x]["genreName"]."</td>
					<td>".$recordArray[$x]["dateAcquired"]."</td>
					<td>".$recordArray[$x]["productCondition"]."</td>
				</tr>";
				$count= $count++;
				}
    		}
    		$productInventoryTable.= "</table>";
            return $productInventoryTable;
		} 
		
		else 
		{
    		$productInventoryTable.= "<h1 style='color:red;'>No Results</h1>";
            return $productInventoryTable;
		}
		
		$conn->close();
	} //Function Close

} //Class Close

?>

<!-- php Desktop/PHP/SantaMonicaMovieRentalsSILEX/app/SMMRSite/Models/InventoryModels/inventoryDAOClass.php -->