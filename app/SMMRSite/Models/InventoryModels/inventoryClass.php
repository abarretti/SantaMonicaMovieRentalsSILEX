<?php namespace SMMRSite\Models\InventoryModels;

use SMMRSite\DAOs\InventoryDAOClass;

class InventoryClass
{
	private $sKUNumber;
	private $productName;
	private $productionCompanyName;
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
	private $barCodeNumber;
	private $dateAcquired;
	private $condition;

	/*Error Attributes*/
	private $sKUNumberErr;
	private $productNameErr;
	private $productionCompanyErr; 
	private $genreErr;
	private $barCodeNumberErr;
	private $dateAcquiredErr;
	private $conditionErr;
    private $createInventoryErr;
    private $inventoryInformationErr;

    private $createInventoryOutput;
    private $inventoryInformationArray;
    private $companyNamesArray;

	public function __construct()
	{
		$this->sKUNumber=NULL;
		$this->productName=NULL;
		$this->productionCompanyName=NULL;
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
		$this->barCodeNumber=NULL;
		$this->dateAcquired=NULL;
		$this->condition=NULL;

		$this->sKUNumberErr=NULL;
		$this->productNameErr=NULL;
		$this->productionCompanyNameErr=NULL; 
		$this->genreErr=NULL;
		$this->barCodeNumberErr=NULL;
		$this->dateAcquiredErr=NULL;
		$this->conditionErr=NULL;
        $this->createInventoryErr=NULL;
        $this->inventoryInformationErr=NULL;

        $this->createInventoryOutput=NULL;
        $this->inventoryInformationArray=NULL;
        $this->companyNamesArray=NULL;
	}

	/* Cleans Data Input*/
	public function test_input($data) 
	{
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
  	}

	public function setSKUNumber($sKUNumber)
	{
		if (empty($sKUNumber))
		{
    		$this->setSKUNumberErr("SKU Number is required");
  		} 
  		elseif (!preg_match("/^[A-Z]{3}[0-9]{4}$/", $sKUNumber)) 
  		{
  			$this->setSKUNumberErr("Invalid SKU Number. SKU Number must contain 3 alphabetical characters followed by 4 numerical digits (ex. ABC1234)");
  		}
  		else 
  		{
    		$sKUNumber = $this->test_input($sKUNumber);
  			$this->sKUNumber= $sKUNumber;
  		}
	}

	public function setSKUNumberOptional($sKUNumber)
	{
		if (!preg_match("/^[A-Z]{3}[0-9]{4}$/", $sKUNumber) and !empty($sKUNumber)) 
  		{
  			$this->setSKUNumberErr("Invalid SKU Number. SKU Number must contain 3 alphabetical characters followed by 4 numerical digits (ex. ABC1234)");
  		}
  		else 
  		{
    		$sKUNumber = $this->test_input($sKUNumber);
  			$this->sKUNumber= $sKUNumber;
  		}
	}

	public function getSKUNumber()
	{
		return $this->sKUNumber;
	}

	public function setProductName($productName) 
	{	
		if (empty($productName)) 
		{
    		$this->setProductNameErr("Product Name is required");
  		} 
  		elseif (!preg_match("/^[a-zA-Z0-9&()-?!: ]*$/",$productName)) 
  		{
  			$this->setProductNameErr("Only letters, numbers, white space and the following special characters allowed &()-?!:");
  		}
  		else 
  		{
    		$productName= $this->test_input($productName);
			$this->productName=$productName;
		}
	}

	public function setProductNameOptional($productName) 
	{	
		if (!preg_match("/^[a-zA-Z0-9&()-?!: ]*$/",$productName)) 
  		{
  			$this->setProductNameErr("Only letters, numbers, white space and the following special characters allowed &()-?!:");
  		}
  		else 
  		{
    		$productName= $this->test_input($productName);
			$this->productName=$productName;
		}
	}

	public function getProductName() 
	{
		return $this->productName;
	}

	public function setProductionCompanyName($productionCompanyName) 
	{	
		if (empty($productionCompanyName)) 
		{
    		$this->setProductionCompanyNameErr("Production Company Name is required");
  		} 
  		elseif (!preg_match("/^[a-zA-Z0-9 .]*$/",$productionCompanyName)) 
  		{
  			$this->setProductionCompanyNameErr("Only letters, numbers and white space allowed");
  		}
  		else 
  		{
    		$productionCompanyName= $this->test_input($productionCompanyName);
			$this->productionCompanyName=$productionCompanyName;
		}
	}

	public function getProductionCompanyName() 
	{
		return $this->productionCompanyName;
	}

	public function setAction($action)
	{	
		if (empty($action)) 
		{
    		$this->action = "";
  		} 
  		else 
  		{
    		$this->action = "Action";
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
    		$this->children = "";
  		} 
  		else 
  		{
    		$this->children = "Children";
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
    		$this->comedy = "";
  		} 
  		else 
  		{
    		$this->comedy = "Comedy";
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
    		$this->documentary = "";
  		} 
  		else 
  		{
    		$this->documentary = "Documentary";
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
    		$this->drama = "";
  		} 
  		else 
  		{
    		$this->drama = "Drama";
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
    		$this->horror = "";
  		} 
  		else 
  		{
    		$this->horror = "Horror";
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
    		$this->musicals = "";
  		} 
  		else 
  		{
    		$this->musicals = "Musicals";
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
    		$this->romance = "";
  		} 
  		else 
  		{
    		$this->romance = "Romance";
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
    		$this->scienceFiction = "";
  		} 
  		else 
  		{
    		$this->scienceFiction = "Science Fiction";
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
    		$this->thriller = "";
  		} 
  		else 
  		{
    		$this->thriller = "Thriller";
  		}
	}

	public function getThriller()
	{
		return $this->thriller;
	}

	public function setBarCodeNumber($barCodeNumber)
	{
		if (empty($barCodeNumber))
		{
    		$this->setBarCodeNumberErr("Barcode Number is required");
  		} 
  		elseif (!preg_match("/^[0-9]{12}$/", $barCodeNumber)) 
  		{
  			$this->setBarCodeNumberErr("Invalid Barcode Number. Number must contain 12 numerical digits");
  		}
  		else 
  		{
    		$barCodeNumber = $this->test_input($barCodeNumber);
  			$this->barCodeNumber= $barCodeNumber;
  		}
	}

	public function setBarCodeNumberOptional($barCodeNumber)
	{
  		if (!preg_match("/^[0-9]{12}$/", $barCodeNumber) and !empty($barCodeNumber)) 
  		{
  			$this->setBarCodeNumberErr("Invalid Barcode Number. Number must contain 12 numerical digits");
  		}
  		else 
  		{
    		$barCodeNumber = $this->test_input($barCodeNumber);
  			$this->barCodeNumber= $barCodeNumber;
  		}
	}

	public function getBarCodeNumber()
	{
		return $this->barCodeNumber;
	}

	public function setDateAcquired($dateAcquired)
	{
		if (empty($dateAcquired)) 
		{
    		$this->setDateAcquiredErr("Acquisition Date is required");
  		} 
  		else 
  		{
  			$dateAcquired= date("Y-m-d", strtotime($dateAcquired));
			$this->dateAcquired=$dateAcquired;
		}
	}

	public function getDateAcquired()
	{
		return $this->dateAcquired;
	}

	public function setCondition($condition)
	{
		if (empty($condition)) 
		{
    		$this->setConditionErr("Condition is required");
  		} 
  		else 
  		{
    		$condition = $this->test_input($condition);
  			$this->condition= $condition;	
  		}  
	}

	public function getCondition()
	{
		return $this->condition;
	}

  	//Error Attributes
  	
  	public function setSKUNumberErr($sKUNumberErr)
	{
		$this->sKUNumberErr= $sKUNumberErr;
	}

	public function getSKUNumberErr()
	{
		return $this->sKUNumberErr;
	}

	public function setProductNameErr($productNameErr)
	{
		$this->productNameErr= $productNameErr;
	}

	public function getProductNameErr()
	{
		return $this->productNameErr;
	}

	public function setProductionCompanyNameErr($productionCompanyNameErr)
	{
		$this->productionCompanyNameErr= $productionCompanyNameErr;
	}

	public function getProductionCompanyNameErr()
	{
		return $this->productionCompanyNameErr;
	}

	public function setGenreErr($action, $children, $comedy, $documentary, $drama, $horror, $musicals, $romance, $scienceFiction, $thriller)
	{
		if(empty($action) and empty($children) and empty($comedy) and empty($documentary) and empty($drama) and empty($horror) and empty($musicals) and empty($romance) and empty($scienceFiction) and empty($thriller))
		{
			$this->genreErr= "Atleast 1 Genre must be selected";
		}
	}

	public function getGenreErr()
	{
		return $this->genreErr;
	}


	public function setBarCodeNumberErr($barCodeNumberErr)
	{
		$this->barCodeNumberErr= $barCodeNumberErr;
	}

	public function getBarCodeNumberErr()
	{
		return $this->barCodeNumberErr;
	}
	
	public function setDateAcquiredErr($dateAcquiredErr)
	{
		$this->dateAcquiredErr= $dateAcquiredErr;
	}

	public function getDateAcquiredErr()
	{
		return $this->dateAcquiredErr;
	}
	
	public function setConditionErr($conditionErr)
	{
		$this->conditionErr= $conditionErr;
	}

	public function getConditionErr()
	{
		return $this->conditionErr;
	}

    public function setCreateInventoryErr($createInventoryErr)
    {
        $this->createInventoryErr=$createInventoryErr;
    }

    public function getCreateInventoryErr()
    {
        return $this->createInventoryErr;
    }

    public function setCreateInventoryOutput($createInventoryOutput)
    {
        $this->createInventoryOutput=$createInventoryOutput;
    }

    public function getCreateInventoryOutput()
    {
        return $this->createInventoryOutput;
    }

    public function setInventoryInformationArray($inventoryInformationArray)
    {
        $this->inventoryInformationArray=$inventoryInformationArray;
    }

    public function getInventoryInformationArray()
    {
        return $this->inventoryInformationArray;
    }

    public function setInventoryInformationErr($inventoryInformationErr)
    {
        $this->inventoryInformationErr=$inventoryInformationErr;
    }

    public function getInventoryInformationErr()
    {
        return $this->inventoryInformationErr;
    }
	
	//Form Complete Check

	public function formInventoryCreateCheck($sKUNumber, $productName, $productionCompanyName, $barCodeNumber, $dateAcquired, $condition, $sKUNumberErr, $productNameErr, $productionCompanyNameErr, $genreErr, $barCodeNumberErr, $dateAcquiredErr, $conditionErr)
	{
		if($sKUNumber== NULL or $productName==NULL or $productionCompanyName==NULL or $barCodeNumber==NULL or $dateAcquired==NULL or $condition==NULL or $sKUNumberErr!=NULL or $productNameErr!=NULL or $productionCompanyNameErr!=NULL or $genreErr!=NULL or $barCodeNumberErr!=NULL or $dateAcquiredErr!=NULL or $conditionErr!=NULL)
		{
			return "Form Incomplete";
		}
		else
		{
			return "FORM COMPLETE";
		}
	}

	public function formInventorySearchCheck($sKUNumberErr, $productNameErr)
	{
		if($sKUNumberErr!=NULL or $productNameErr!=NULL)
		{
			return "Form Incomplete";
		}
		else
		{
			return "FORM COMPLETE";
		}
	}

	public function formBookingInventorySearchCheck($barCodeNumberErr, $sKUNumberErr, $productNameErr)
	{
		if($barCodeNumberErr!=NULL or $sKUNumberErr!=NULL or $productNameErr!=NULL)
		{
			return "Form Incomplete";
		}
		else
		{
			return "FORM COMPLETE";
		}
	}

    public function setCompanyNamesArray($companyNamesArray)
    {
        $this->companyNamesArray= $companyNamesArray;
    }

    public function getCompanyNamesArray(InventoryDAOClass $inventoryDAO)
    {
        $inventoryDAO->getCompanyNames($this);
        return $this->companyNamesArray;
    }

    public function getGenres(InventoryDAOClass $inventoryDAOClass)
    {
        return $inventoryDAOClass->getGenres($this->action, $this->children, $this->comedy, $this->documentary, $this->drama, $this->horror, $this->musicals, $this->romance, $this->scienceFiction, $this->thriller);
    }

}
?>

<!-- php Desktop/PHP/SantaMonicaMovieRentalsSILEX/app/SMMRSite/Models/InventoryModels/inventoryClass.php -->