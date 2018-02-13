<?php namespace SMMRSite\DAOs;

use SMMRSite\DAOs\DAOClass;
use SMMRSite\Models\InventoryModels\InventoryClass;
use PDO;

class InventoryDAOClass extends DAOClass
{
	public function __construct()
	{
		$this->serverName;
        $this->userName;
        $this->passwordServer;
        $this->dbName;
        $this->conn;
	}
	//Inventory Methods

	public function getCompanyNames(InventoryClass $inventoryClass)
	{
		$this->connect();

		$sql= $this->conn->query("SELECT productionCompanyName FROM ProductionCompany");

		if ($sql->rowCount() > 0)
		{  
   		// output data of each row concatenate into one string
		$companyNames= array();
    	while($row= $sql->fetch()) 
    		{
        	   array_push($companyNames, $row["productionCompanyName"]);
    		}
    	$inventoryClass->setCompanyNamesArray($companyNames);
        } 

		$this->close();
	}

	public function getGenres($action, $children, $comedy, $documentary, $drama, $horror, $musicals, $romance, $scienceFiction, $thriller)
	{
		$genres= array($action, $children, $comedy, $documentary, $drama, $horror, $musicals, $romance, $scienceFiction, $thriller);
		
	    $this->connect();

		$sql = $this->conn->query("SELECT genreName FROM Genre");
		
		if ($sql->rowCount() > 0) 
		{
   		// output data of each row concatenate into one string
    	$genresArray=array();
    	while($row= $sql->fetch()) 
    		{
        	array_push($genresArray, array("lowerCase"=>lcfirst(str_replace(' ','',$row["genreName"])), "normal"=>$row["genreName"]));
    		}
    	return $genresArray;
		} 
        $this->close();
	}

	public function createInventoryRecord (InventoryClass $inventoryClass, $sKUNumber, $productName, $productionCompanyName, $action, $children, $comedy, $documentary, $drama, $horror, $musicals, $romance, $scienceFiction, $thriller, $barCodeNumber, $dateAcquired, $condition)
	{
		$this->connect();

		$sqlDuplicateCheck = $this->conn->query("SELECT barCodeNumber FROM Inventory WHERE barCodeNumber= '".$barCodeNumber."'");

		if ($sqlDuplicateCheck->rowCount() > 0) 
		{
   		// output 
    	while($row = $sqlDuplicateCheck->fetch()) 
    		{
        	   $inventoryClass->setCreateInventoryErr("Barcode Number ".$row["barCodeNumber"]." already exists.");
               return;
    		}
		} 
		
		else 
		{
			//Pull PK for Production Company
			$pcIdQuery = "SELECT pcID FROM ProductionCompany WHERE productionCompanyName = '".$productionCompanyName."'"; 
			$pcIDResult = $this->conn->query($pcIdQuery);
			$rowPcID= $pcIDResult->fetch();
			$pcID=$rowPcID["pcID"];

			//Check if Product Already Exists - Insert new PrID if necessary, pull PrID if it already exists
			$productCheckQuery = "SELECT prID FROM Product WHERE sKUNumber= '".$sKUNumber."'";
			$productCheckResult = $this->conn->query($productCheckQuery);
			
			if ($productCheckResult->rowCount() > 0)
			{	
				$rowPrID= $productCheckResult->fetch();
				$prID = $rowPrID["prID"];
			}
			
			else
			{
				$productInsertQuery= "INSERT INTO Product (prID, pcID, sKUNumber, name) VALUES (NULL, :pcID, :sKUNumber, :productName)";
				$productInsertResult = $this->conn->prepare($productInsertQuery);
                $productInsertResult->execute(array(
                    ':pcID' => $pcID,
                    ':sKUNumber' => $sKUNumber,
                    ':productName' => $productName
                    ));

				$productCheckResult = $this->conn->query($productCheckQuery);
				while($rowPrID= $productCheckResult->fetch())
					{
						$prID= $rowPrID["prID"];
					}

				//Insert into ProductGenreJoin table	
				$gnIDSearchQuery= "SELECT gnID FROM Genre WHERE genreName in ('".$action."', '".$children."', '".$comedy."', '".$documentary."', '".$drama."', '".$horror."', '".$musicals."', '".$romance."', '".$scienceFiction."', '".$thriller."')";
				$gnIDSearchResult= $this->conn->query($gnIDSearchQuery);
				$gnIDRowCount= $gnIDSearchResult->rowCount();
			
				//BUG HERE!!!!!
				while($gnIDRow= $gnIDSearchResult->fetch(PDO::FETCH_ASSOC))
    				{
        				$productGenreJoinInsertQuery= "INSERT INTO ProductGenreJoin (prID, gnID) VALUES (:prID, :gnID)";
        				$productGenreJoinInsertResult= $this->conn->prepare($productGenreJoinInsertQuery);
                        $productGenreJoinInsertResult->execute(array(
                            ':prID' => $prID,
                            ':gnID' => $gnIDRow["gnID"]
                            ));
    				}
			}
			
			//Insert into Inventory table
			$inventoryInsertQuery= "INSERT INTO Inventory (inID, prID, barCodeNumber, dateAcquired, productCondition) VALUES (NULL, :prID, :barCodeNumber, :dateAcquired, :condition)";
            $inventoryInsertResult= $this->conn->prepare($inventoryInsertQuery);

			if ($inventoryInsertResult->execute(array(
                ':prID' => $prID,
                ':barCodeNumber' => $barCodeNumber,
                ':dateAcquired' => $dateAcquired,
                ':condition' => $condition
                )) === TRUE) 
			{
    			$inventoryClass->setCreateInventoryOutput("New Inventory and Product record created successfully");
                return;
			} 
			else
			{
    			$inventoryClass->setCreateInventoryErr("Error: ".$inventoryInsertQuery." ".$this->conn->errorInfo());
                return;
			}
			
		}
		$this->close();
	} //Function Close

	public function productInventoryQuery(InventoryClass $inventoryClass, $sKUNumber, $productName)
	{
		$this->connect();

		//0
		if (empty($sKUNumber) and empty($productName))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID";
				$result = $this->conn->query($sql);
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
				$result = $this->conn->query($sql);
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
				$result = $this->conn->query($sql);
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
            $inventoryInformationArray=array();
    		for($x=0;$x<count($recordArray);$x++)
    		{
    			if(!in_array($x,$dontDisplay) and $count<=100)
    			{
    				array_push($inventoryInformationArray, array("barCodeNumber"=>$recordArray[$x]["barCodeNumber"], "sKUNumber"=>$recordArray[$x]["sKUNumber"], "name"=>$recordArray[$x]["name"], "productionCompanyName"=>$recordArray[$x]["productionCompanyName"], "genreName"=>$recordArray[$x]["genreName"], "dateAcquired"=>$recordArray[$x]["dateAcquired"], "productCondition"=>$recordArray[$x]["productCondition"]));
				    $count= $count++;
				}
    		}
    		$inventoryClass->setInventoryInformationArray($inventoryInformationArray);
            return;
		} 
		
		else 
		{
    		$inventoryClass->setInventoryInformationErr("No Results");
            return;
		}
		
		$this->close();
	} //Function Close

	public function companyGenreQuery(InventoryClass $inventoryClass, $productionCompanyName, $action, $children, $comedy, $documentary, $drama, $horror, $musicals, $romance, $scienceFiction, $thriller)
	{
		$this->connect();

		//0
		if ($productionCompanyName=="" and empty($action) and empty($children) and empty($comedy) and empty($documentary) and empty($drama) and empty($horror) and empty($musicals) and empty($romance) and empty($scienceFiction) and empty($thriller))
			{
				$sql= "SELECT i.barCodeNumber, p.sKUNumber, p.name, pc.productionCompanyName, g.genreName, i.dateAcquired, i.productCondition
					FROM Inventory i
					JOIN Product p ON i.prID = p.prID
					JOIN ProductGenreJoin pgj ON p.prID = pgj.prID
					JOIN Genre g ON pgj.gnID = g.gnID
					JOIN ProductionCompany pc ON p.pcID = pc.pcID";
				$result = $this->conn->query($sql);
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
				$result = $this->conn->query($sql);
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
				$result = $this->conn->query($sql);
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
            $inventoryInformationArray=array();
            for($x=0;$x<count($recordArray);$x++)
            {
                if(!in_array($x,$dontDisplay) and $count<=100)
                {
                    array_push($inventoryInformationArray, array("barCodeNumber"=>$recordArray[$x]["barCodeNumber"], "sKUNumber"=>$recordArray[$x]["sKUNumber"], "name"=>$recordArray[$x]["name"], "productionCompanyName"=>$recordArray[$x]["productionCompanyName"], "genreName"=>$recordArray[$x]["genreName"], "dateAcquired"=>$recordArray[$x]["dateAcquired"], "productCondition"=>$recordArray[$x]["productCondition"]));
                    $count= $count++;
                }
            }
            $inventoryClass->setInventoryInformationArray($inventoryInformationArray);
            return;
		} 
		
		else 
		{
            $inventoryClass->setInventoryInformationErr("No Results");
            return;
		}
		
		$this->close();
	} //Function Close

} //Class Close

?>

<!-- php Desktop/PHP/SantaMonicaMovieRentalsSILEX/app/SMMRSite/DAOs/inventoryDAOClass.php -->