<?php namespace SMMRSite\Models\BookingModels;

use SMMRSite\DAOs\BookingDAOClass;

class BookingClass
{
	//Attributes
	private $bookingEMailAddress;
	private $inventoryCount;
	private $barCodeNumber1;
	private $barCodeNumber2;
	private $barCodeNumber3;
	private $barCodeNumber4;
	private $barCodeNumber5;
	private $barCodeNumber6;
	private $barCodeNumber7;
	private $barCodeNumber8;
	private $barCodeNumber9;
	private $barCodeNumber10;
	private $bookingDate;
	private $returnDate;

	//Error Attributes
	private $bookingEMailAddressErr;
	private $barCodeNumberDuplicateErr;
	private $barCodeNumber1Err;
	private $barCodeNumber2Err;
	private $barCodeNumber3Err;
	private $barCodeNumber4Err;
	private $barCodeNumber5Err;
	private $barCodeNumber6Err;
	private $barCodeNumber7Err;
	private $barCodeNumber8Err;
	private $barCodeNumber9Err;
	private $barCodeNumber10Err;
	private $bookingDateErr;
	private $returnDateErr;
    private $returnBookingErr;
    private $bookingSearchErr;
    private $createBookingErr;
    private $bookingCustomerErr;
    private $bookingInventoryErr;

    //Output Attributes
    private $returnBookingOutput;
    private $bookingSearchArray;
    private $createBookingOutput;
    private $bookingCustomerArray;
    private $bookingInventoryArray;

	public function __construct($bookingEMailAddress, $inventoryCount, $barCodeNumber1, $barCodeNumber2, $barCodeNumber3, $barCodeNumber4, $barCodeNumber5, $barCodeNumber6, $barCodeNumber7, $barCodeNumber8, $barCodeNumber9, $barCodeNumber10, $bookingDate, $returnDate, $bookingEMailAddressErr,$barCodeNumberDuplicateErr, $barCodeNumber1Err, $barCodeNumber2Err, $barCodeNumber3Err, $barCodeNumber4Err, $barCodeNumber5Err, $barCodeNumber6Err, $barCodeNumber7Err, $barCodeNumber8Err, $barCodeNumber9Err, $barCodeNumber10Err, $bookingDateErr, $returnDateErr, $returnBookingErr, $bookingSearchErr, $createBookingErr, $bookingCustomerErr, $bookingInventoryErr, $returnBookingOutput, $bookingSearchArray, $createBookingOutput, $bookingCustomerArray, $bookingInventoryArray)
	{
		$this->bookingEMailAddress=$bookingEMailAddress;
		$this->inventoryCount=$inventoryCount;
		$this->barCodeNumber1=$barCodeNumber1;
		$this->barCodeNumber2=$barCodeNumber2;
		$this->barCodeNumber3=$barCodeNumber3;
		$this->barCodeNumber4=$barCodeNumber4;
		$this->barCodeNumber5=$barCodeNumber5;
		$this->barCodeNumber6=$barCodeNumber6;
		$this->barCodeNumber7=$barCodeNumber7;
		$this->barCodeNumber8=$barCodeNumber8;
		$this->barCodeNumber9=$barCodeNumber9;
		$this->barCodeNumber10=$barCodeNumber10;
		$this->bookingDate=$bookingDate;
		$this->returnDate=$returnDate;
		
		$this->bookingEMailAddressErr=$bookingEMailAddressErr;
		$this->barCodeNumberDuplicateErr=$barCodeNumberDuplicateErr;
		$this->barCodeNumber1Err=$barCodeNumber1Err;
		$this->barCodeNumber2Err=$barCodeNumber2Err;
		$this->barCodeNumber3Err=$barCodeNumber3Err;
		$this->barCodeNumber4Err=$barCodeNumber4Err;
		$this->barCodeNumber5Err=$barCodeNumber5Err;
		$this->barCodeNumber6Err=$barCodeNumber6Err;
		$this->barCodeNumber7Err=$barCodeNumber7Err;
		$this->barCodeNumber8Err=$barCodeNumber8Err;
		$this->barCodeNumber9Err=$barCodeNumber9Err;
		$this->barCodeNumber10Err=$barCodeNumber10Err;
		$this->bookingDateErr=$bookingDateErr;
		$this->returnDateErr=$returnDateErr;
        $this->returnBookingErr=$returnBookingErr;
        $this->bookingSearchErr=$bookingSearchErr;
        $this->createBookingErr=$createBookingErr;
        $this->bookingCustomerErr= $bookingCustomerErr;
        $this->bookingInventoryErr= $bookingInventoryErr;

        $this->returnBookingOutput=$returnBookingOutput;
        $this->bookingSearchArray=$bookingSearchArray;
        $this->createBookingOutput=$createBookingOutput;
        $this->bookingCustomerArray= $bookingCustomerArray;
        $this->bookingInventoryArray= $bookingInventoryArray;
	}

	public function test_input($data) 
	{
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
  	}

	//E-Mail Methods
	public function setEMailAddress($eMail)
	{
		if (empty($eMail)) 
		{
    		$this->setEMailErr("Email is required");
    		$this->bookingEMailAddress= NULL;
  		} 
  		elseif (!filter_var($eMail, FILTER_VALIDATE_EMAIL)) 
  		{
  			$this->setEMailErr("Invalid email format");
  			$this->bookingEMailAddress= NULL;
  		}
  		else 
  		{
    		$eMail = $this->test_input($eMail);
  			$this->bookingEMailAddress= $eMail;
  			$this->setEMailErr(NULL);
  		}
	}

	public function getEMailAddress()
	{
		return $this->bookingEMailAddress;
	}

	public function setEMailErr($eMailErr)
	{
		$this->bookingEMailAddressErr= $eMailErr;
	}

	public function getEMailErr()
	{
		return $this->bookingEMailAddressErr;
	}

	//Inventory Add/Subtract Methods
	public function setInventoryCount($inventoryNumber)
	{
		$this->inventoryCount= $inventoryNumber;
		
		if ($this->inventoryCount<1)
		{
			$this->inventoryCount=1;
		}

		if ($this->inventoryCount>10)
		{
			$this->inventoryCount=10;
		}
	}

	public function getInventoryCount()
	{
		return $this->inventoryCount;
	}

	public function getBookingInventory($inventoryCount)
	{
		$bookingInventory=array();
		for($i=1;$i<=$inventoryCount;$i++)
		{
			array_push($bookingInventory,array("index"=>$i, "barCodeNumber"=> $this->getBarCodeNumber($i), "barCodeNumberErr"=> $this->getBarCodeNumberErr($i)));
		}
		return $bookingInventory;
	}

	//Barcode Number Methods
	public function setBarCodeNumber($barCodeNumber, $inventoryCount, $barCodeNumber1, $barCodeNumber2, $barCodeNumber3, $barCodeNumber4, $barCodeNumber5, $barCodeNumber6, $barCodeNumber7, $barCodeNumber8, $barCodeNumber9, $barCodeNumber10)
	{
		$barCodeNumbers = array();
		array_push($barCodeNumbers,$barCodeNumber1, $barCodeNumber2, $barCodeNumber3, $barCodeNumber4, $barCodeNumber5, $barCodeNumber6, $barCodeNumber7, $barCodeNumber8, $barCodeNumber9, $barCodeNumber10);
		
		if (in_array($barCodeNumber, $barCodeNumbers))
		{
	       $this->bookingSearchErr="Barcode is already selected";
            return;
        }

		else
		{
			$barCodeCount=1;

			foreach ($barCodeNumbers as $barCode)
			{
				if(empty($barCode) OR $barCodeCount==$inventoryCount)
				{	
    				$barCodeNumber = $this->test_input($barCodeNumber);
  					
  					if ($barCodeCount==1)
  					{
  						$this->barCodeNumber1= $barCodeNumber;
  					}

  					elseif ($barCodeCount==2)
  					{
  						$this->barCodeNumber2= $barCodeNumber;
  					}

  					elseif ($barCodeCount==3)
  					{
  						$this->barCodeNumber3= $barCodeNumber;
  					}

  					elseif ($barCodeCount==4)
  					{
  						$this->barCodeNumber4= $barCodeNumber;
  					}

  					elseif ($barCodeCount==5)
  					{
  						$this->barCodeNumber5= $barCodeNumber;
  					}

  					elseif ($barCodeCount==6)
  					{
  						$this->barCodeNumber6= $barCodeNumber;
  					}

  					elseif ($barCodeCount==7)
  					{
  						$this->barCodeNumber7= $barCodeNumber;
  					}

  					elseif ($barCodeCount==8)
  					{
  						$this->barCodeNumber8= $barCodeNumber;
  					}

  					elseif ($barCodeCount==9)
  					{
  						$this->barCodeNumber9= $barCodeNumber;
  					}

  					else
  					{
  						$this->barCodeNumber10= $barCodeNumber;
  					}
  				break;
				}//if close
			$barCodeCount= $barCodeCount+1;
			}//forloop close
		}//else close
	}//function close

	public function clearBarCodeNumber($inventoryCount)
	{
		if ($inventoryCount==10)
		{}

		elseif ($inventoryCount==9)
		{
			$this->barCodeNumber10= NULL;
			$this->barCodeNumber10Err= NULL;
		}

		elseif ($inventoryCount==8)
		{
			$this->barCodeNumber10= NULL;
			$this->barCodeNumber10Err= NULL;
			$this->barCodeNumber9= NULL;
			$this->barCodeNumber9Err= NULL;
		}

		elseif ($inventoryCount==7)
		{
			$this->barCodeNumber10= NULL;
			$this->barCodeNumber10Err= NULL;
			$this->barCodeNumber9= NULL;
			$this->barCodeNumber9Err= NULL;
			$this->barCodeNumber8= NULL;
			$this->barCodeNumber8Err= NULL;
		}

		elseif ($inventoryCount==6)
		{
			$this->barCodeNumber10= NULL;
			$this->barCodeNumber10Err= NULL;
			$this->barCodeNumber9= NULL;
			$this->barCodeNumber9Err= NULL;
			$this->barCodeNumber8= NULL;
			$this->barCodeNumber8Err= NULL;
			$this->barCodeNumber7= NULL;
			$this->barCodeNumber7Err= NULL;
		}

		elseif ($inventoryCount==5)
		{
			$this->barCodeNumber10= NULL;
			$this->barCodeNumber10Err= NULL;
			$this->barCodeNumber9= NULL;
			$this->barCodeNumber9Err= NULL;
			$this->barCodeNumber8= NULL;
			$this->barCodeNumber8Err= NULL;
			$this->barCodeNumber7= NULL;
			$this->barCodeNumber7Err= NULL;
			$this->barCodeNumber6= NULL;
			$this->barCodeNumber6Err= NULL;
		}

		elseif ($inventoryCount==4)
		{
			$this->barCodeNumber10= NULL;
			$this->barCodeNumber10Err= NULL;
			$this->barCodeNumber9= NULL;
			$this->barCodeNumber9Err= NULL;
			$this->barCodeNumber8= NULL;
			$this->barCodeNumber8Err= NULL;
			$this->barCodeNumber7= NULL;
			$this->barCodeNumber7Err= NULL;
			$this->barCodeNumber6= NULL;
			$this->barCodeNumber6Err= NULL;
			$this->barCodeNumber5= NULL;
			$this->barCodeNumber5Err= NULL;
		}

		elseif ($inventoryCount==3)
		{
			$this->barCodeNumber10= NULL;
			$this->barCodeNumber10Err= NULL;
			$this->barCodeNumber9= NULL;
			$this->barCodeNumber9Err= NULL;
			$this->barCodeNumber8= NULL;
			$this->barCodeNumber8Err= NULL;
			$this->barCodeNumber7= NULL;
			$this->barCodeNumber7Err= NULL;
			$this->barCodeNumber6= NULL;
			$this->barCodeNumber6Err= NULL;
			$this->barCodeNumber5= NULL;
			$this->barCodeNumber5Err= NULL;
			$this->barCodeNumber4= NULL;
			$this->barCodeNumber4Err= NULL;
		}

		elseif ($inventoryCount==2)
		{
			$this->barCodeNumber10= NULL;
			$this->barCodeNumber10Err= NULL;
			$this->barCodeNumber9= NULL;
			$this->barCodeNumber9Err= NULL;
			$this->barCodeNumber8= NULL;
			$this->barCodeNumber8Err= NULL;
			$this->barCodeNumber7= NULL;
			$this->barCodeNumber7Err= NULL;
			$this->barCodeNumber6= NULL;
			$this->barCodeNumber6Err= NULL;
			$this->barCodeNumber5= NULL;
			$this->barCodeNumber5Err= NULL;
			$this->barCodeNumber4= NULL;
			$this->barCodeNumber4Err= NULL;
			$this->barCodeNumber3= NULL;
			$this->barCodeNumber3Err= NULL;
		}

		else
		{
			$this->barCodeNumber10= NULL;
			$this->barCodeNumber10Err= NULL;
			$this->barCodeNumber9= NULL;
			$this->barCodeNumber9Err= NULL;
			$this->barCodeNumber8= NULL;
			$this->barCodeNumber8Err= NULL;
			$this->barCodeNumber7= NULL;
			$this->barCodeNumber7Err= NULL;
			$this->barCodeNumber6= NULL;
			$this->barCodeNumber6Err= NULL;
			$this->barCodeNumber5= NULL;
			$this->barCodeNumber5Err= NULL;
			$this->barCodeNumber4= NULL;
			$this->barCodeNumber4Err= NULL;
			$this->barCodeNumber3= NULL;
			$this->barCodeNumber3Err= NULL;
			$this->barCodeNumber2= NULL;
			$this->barCodeNumber2Err= NULL;
		}
  			
	}//function close

	public function getBarCodeNumber($barCodeNumber)
	{
		if ($barCodeNumber==1)
		{
			return $this->barCodeNumber1;
		}
			
		elseif ($barCodeNumber==2)
		{
			return $this->barCodeNumber2;
		}
		
		elseif ($barCodeNumber==3)
		{
			return $this->barCodeNumber3;
		}

		elseif ($barCodeNumber==4)
		{
			return $this->barCodeNumber4;
		}

		elseif ($barCodeNumber==5)
		{
			return $this->barCodeNumber5;
		}

		elseif ($barCodeNumber==6)
		{
			return $this->barCodeNumber6;
		}

		elseif ($barCodeNumber==7)
		{
			return $this->barCodeNumber7;
		}
		
		elseif ($barCodeNumber==8)
		{
			return $this->barCodeNumber8;
		}
		
		elseif ($barCodeNumber==9)
		{
			return $this->barCodeNumber9;
		}

		else
		{
			return $this->barCodeNumber10;
		}
	}

	public function setBarCodeNumberErr($barCodeNumber, $barCodeNumberErr)
	{
		if ($barCodeNumber==1)
		{
			$this->barCodeNumber1Err= $barCodeNumberErr;
		}
			
		elseif ($barCodeNumber==2)
		{
			$this->barCodeNumber2Err= $barCodeNumberErr;
		}
		
		elseif ($barCodeNumber==3)
		{
			$this->barCodeNumber3Err= $barCodeNumberErr;
		}

		elseif ($barCodeNumber==4)
		{
			$this->barCodeNumber4Err= $barCodeNumberErr;
		}

		elseif ($barCodeNumber==5)
		{
			$this->barCodeNumber5Err= $barCodeNumberErr;
		}

		elseif ($barCodeNumber==6)
		{
			$this->barCodeNumber6Err= $barCodeNumberErr;
		}

		elseif ($barCodeNumber==7)
		{
			$this->barCodeNumber7Err= $barCodeNumberErr;
		}
		
		elseif ($barCodeNumber==8)
		{
			$this->barCodeNumber8Err= $barCodeNumberErr;
		}
		
		elseif ($barCodeNumber==9)
		{
			$this->barCodeNumber9Err= $barCodeNumberErr;
		}

		else
		{
			$this->barCodeNumber10Err= $barCodeNumberErr;
		}
	}

	public function getBarCodeNumberErr($barCodeNumber)
	{
		if ($barCodeNumber==1)
		{
			return $this->barCodeNumber1Err;
		}
			
		elseif ($barCodeNumber==2)
		{
			return $this->barCodeNumber2Err;
		}
		
		elseif ($barCodeNumber==3)
		{
			return $this->barCodeNumber3Err;
		}

		elseif ($barCodeNumber==4)
		{
			return $this->barCodeNumber4Err;
		}

		elseif ($barCodeNumber==5)
		{
			return $this->barCodeNumber5Err;
		}

		elseif ($barCodeNumber==6)
		{
			return $this->barCodeNumber6Err;
		}

		elseif ($barCodeNumber==7)
		{
			return $this->barCodeNumber7Err;
		}
		
		elseif ($barCodeNumber==8)
		{
			return $this->barCodeNumber8Err;
		}
		
		elseif ($barCodeNumber==9)
		{
			return $this->barCodeNumber9Err;
		}

		elseif ($barCodeNumber==10)
		{
			return $this->barCodeNumber10Err;
		}

		else
		{
			return $this->barCodeNumberDuplicateErr;
		}
	}

	public function setBookingFormBarcodeNumbers($inventoryCount, $barCodeNumber1, $barCodeNumber2, $barCodeNumber3, $barCodeNumber4, $barCodeNumber5, $barCodeNumber6, $barCodeNumber7, $barCodeNumber8, $barCodeNumber9, $barCodeNumber10)
	{
		$allBarCodeNumbers = array();
		array_push($allBarCodeNumbers,$barCodeNumber1, $barCodeNumber2, $barCodeNumber3, $barCodeNumber4, $barCodeNumber5, $barCodeNumber6, $barCodeNumber7, $barCodeNumber8, $barCodeNumber9, $barCodeNumber10);
		
		//Enters only Inventory Quantity Barcodes into Array
		$barCodeNumbers = array();
		$notNullBarCodeNumbers = array();
		for ($i=0;$i<$inventoryCount;$i++)
		{
			array_push($barCodeNumbers, $allBarCodeNumbers[$i]);
			if ($allBarCodeNumbers[$i]!=NULL)
			{
				array_push($notNullBarCodeNumbers, $allBarCodeNumbers[$i]);
			}
		}

		//Checks for Repeating Barcodes
		if (count(array_unique($notNullBarCodeNumbers))<count($notNullBarCodeNumbers))
		{
			$this->barCodeNumberDuplicateErr="A barcode has been selected more than once";
		}
		else
		{
			$this->barCodeNumberDuplicateErr=NULL;	
		}
		
		//Sets Barcodes and Errors for Form Submission

		//Barcode 1
		if (empty($barCodeNumbers[0]))
		{
    		$this->setBarCodeNumberErr(1, "Barcode Number is required");
  		} 
  		
  		elseif (!preg_match("/^[0-9]{12}$/", $barCodeNumbers[0])) 
  		{
  			$this->setBarCodeNumberErr(1,"Invalid Barcode Number. Number must contain 12 numerical digits");
  		}
  		
  		else 
  		{
    		$barCodeNumbers[0] = $this->test_input($barCodeNumbers[0]);
  			$this->barCodeNumber1= $barCodeNumbers[0];
  			$this->setBarCodeNumberErr(1, NULL);
  		}

  		//Barcode 2
		if (2 <= $inventoryCount)
		{
			if (empty($barCodeNumbers[1]))
			{
    			$this->setBarCodeNumberErr(2, "Barcode Number is required");
  			} 
  		
  			elseif (!preg_match("/^[0-9]{12}$/", $barCodeNumbers[1])) 
  			{
  				$this->setBarCodeNumberErr(2,"Invalid Barcode Number. Number must contain 12 numerical digits");
  			}
  		
  			else 
  			{
    			$barCodeNumbers[1] = $this->test_input($barCodeNumbers[1]);
  				$this->barCodeNumber2= $barCodeNumbers[1];
  				$this->setBarCodeNumberErr(2,NULL);
  			}
  		}

  		//Barcode 3
		if (3 <= $inventoryCount)
		{
			if (empty($barCodeNumbers[2]))
			{
    			$this->setBarCodeNumberErr(3, "Barcode Number is required");
  			} 
  		
  			elseif (!preg_match("/^[0-9]{12}$/", $barCodeNumbers[2])) 
  			{
  				$this->setBarCodeNumberErr(3,"Invalid Barcode Number. Number must contain 12 numerical digits");
  			}
  		
  			else 
  			{
    			$barCodeNumbers[2] = $this->test_input($barCodeNumbers[2]);
  				$this->barCodeNumber3= $barCodeNumbers[2];
  				$this->setBarCodeNumberErr(3,NULL);
  			}
  		}

  		//Barcode 4
		if (4 <= $inventoryCount)
		{
			if (empty($barCodeNumbers[3]))
			{
    			$this->setBarCodeNumberErr(4, "Barcode Number is required");
  			} 
  		
  			elseif (!preg_match("/^[0-9]{12}$/", $barCodeNumbers[3])) 
  			{
  				$this->setBarCodeNumberErr(4,"Invalid Barcode Number. Number must contain 12 numerical digits");
  			}
  		
  			else 
  			{
    			$barCodeNumbers[3] = $this->test_input($barCodeNumbers[3]);
  				$this->barCodeNumber4= $barCodeNumbers[3];
  				$this->setBarCodeNumberErr(4,NULL);
  			}
  		}

  		//Barcode 5
		if (5 <= $inventoryCount)
		{
			if (empty($barCodeNumbers[4]))
			{
    			$this->setBarCodeNumberErr(5, "Barcode Number is required");
  			} 
  		
  			elseif (!preg_match("/^[0-9]{12}$/", $barCodeNumbers[4])) 
  			{
  				$this->setBarCodeNumberErr(5,"Invalid Barcode Number. Number must contain 12 numerical digits");
  			}
  		
  			else 
  			{
    			$barCodeNumbers[4] = $this->test_input($barCodeNumbers[4]);
  				$this->barCodeNumber5= $barCodeNumbers[4];
  				$this->setBarCodeNumberErr(5,NULL);
  			}
  		}

  		//Barcode 6
		if (6 <= $inventoryCount)
		{
			if (empty($barCodeNumbers[5]))
			{
    			$this->setBarCodeNumberErr(6, "Barcode Number is required");
  			} 
  		
  			elseif (!preg_match("/^[0-9]{12}$/", $barCodeNumbers[5])) 
  			{
  				$this->setBarCodeNumberErr(6,"Invalid Barcode Number. Number must contain 12 numerical digits");
  			}
  		
  			else 
  			{
    			$barCodeNumbers[5] = $this->test_input($barCodeNumbers[5]);
  				$this->barCodeNumber6= $barCodeNumbers[5];
  				$this->setBarCodeNumberErr(6,NULL);
  			}
  		}

  		//Barcode 7
		if (7 <= $inventoryCount)
		{
			if (empty($barCodeNumbers[6]))
			{
    			$this->setBarCodeNumberErr(7, "Barcode Number is required");
  			} 
  		
  			elseif (!preg_match("/^[0-9]{12}$/", $barCodeNumbers[6])) 
  			{
  				$this->setBarCodeNumberErr(7,"Invalid Barcode Number. Number must contain 12 numerical digits");
  			}
  		
  			else 
  			{
    			$barCodeNumbers[6] = $this->test_input($barCodeNumbers[6]);
  				$this->barCodeNumber7= $barCodeNumbers[6];
  				$this->setBarCodeNumberErr(7,NULL);
  			}
  		}

  		//Barcode 8
		if (8 <= $inventoryCount)
		{
			if (empty($barCodeNumbers[7]))
			{
    			$this->setBarCodeNumberErr(8, "Barcode Number is required");
  			} 
  		
  			elseif (!preg_match("/^[0-9]{12}$/", $barCodeNumbers[7])) 
  			{
  				$this->setBarCodeNumberErr(8,"Invalid Barcode Number. Number must contain 12 numerical digits");
  			}
  		
  			else 
  			{
    			$barCodeNumbers[7] = $this->test_input($barCodeNumbers[7]);
  				$this->barCodeNumber8= $barCodeNumbers[7];
  				$this->setBarCodeNumberErr(8,NULL);
  			}
  		}

  		//Barcode 9
		if (9 <= $inventoryCount)
		{
			if (empty($barCodeNumbers[8]))
			{
    			$this->setBarCodeNumberErr(9, "Barcode Number is required");
  			} 
  		
  			elseif (!preg_match("/^[0-9]{12}$/", $barCodeNumbers[8])) 
  			{
  				$this->setBarCodeNumberErr(9,"Invalid Barcode Number. Number must contain 12 numerical digits");
  			}
  		
  			else 
  			{
    			$barCodeNumbers[8] = $this->test_input($barCodeNumbers[8]);
  				$this->barCodeNumber9= $barCodeNumbers[8];
  				$this->setBarCodeNumberErr(9,NULL);
  			}
  		}

  		//Barcode 10
		if (10 <= $inventoryCount)
		{
			if (empty($barCodeNumbers[9]))
			{
    			$this->setBarCodeNumberErr(10, "Barcode Number is required");
  			} 
  		
  			elseif (!preg_match("/^[0-9]{12}$/", $barCodeNumbers[9])) 
  			{
  				$this->setBarCodeNumberErr(10,"Invalid Barcode Number. Number must contain 12 numerical digits");
  			}
  		
  			else 
  			{
    			$barCodeNumbers[9] = $this->test_input($barCodeNumbers[9]);
  				$this->barCodeNumber10= $barCodeNumbers[9];
  				$this->setBarCodeNumberErr(10,NULL);
  			}
  		}
	}//function close

	//Booking Date Methods
	public function setBookingDate($bookingDate)
	{
		if (empty($bookingDate)) 
		{
    		$this->setBookingDateErr("Booking Date is Required");
  		} 
  		else 
  		{
  			$bookingDate= date("Y-m-d", strtotime($bookingDate));
			$this->bookingDate=$bookingDate;
			$this->bookingDateErr=NULL;
		}
	}

	public function getBookingDate()
	{
		return $this->bookingDate;
	}

	public function setBookingDateErr($bookingDateErr)
	{
		$this->bookingDateErr= $bookingDateErr;
	}

	public function getBookingDateErr()
	{
		return $this->bookingDateErr;
	}

	///Return Date Methods
	public function setReturnDate($returnDate)
	{
		if (empty($returnDate)) 
		{
    		$this->setReturnDateErr("Return Date is Required");
  		} 
  		else 
  		{
  			$returnDate= date("Y-m-d", strtotime($returnDate));
			$this->returnDate=$returnDate;
			$this->returnDateErr=NULL;
		}
	}

	public function getReturnDate()
	{
		return $this->returnDate;
	}

	public function setReturnDateErr($returnDateErr)
	{
		$this->returnDateErr= $returnDateErr;
	}

	public function getReturnDateErr()
	{
		return $this->returnDateErr;
	}

    public function setReturnBookingErr($returnBookingErr)
    {
        $this->returnBookingErr=$returnBookingErr;
    }

    public function getReturnBookingErr()
    {
        return $this->returnBookingErr;
    }

    public function setReturnBookingOutput($returnBookingOutput)
    {
        $this->returnBookingOutput=$returnBookingOutput;
    }

    public function getReturnBookingOutput()
    {
        return $this->returnBookingOutput;
    }

    public function setBookingSearchArray($bookingSearchArray)
    {
        $this->bookingSearchArray=$bookingSearchArray;
    }

    public function getBookingSearchArray()
    {
        return $this->bookingSearchArray;
    }

    public function setBookingSearchErr($bookingSearchErr)
    {
        $this->bookingSearchErr=$bookingSearchErr;
    }

    public function getBookingSearchErr()
    {
        return $this->bookingSearchErr;
    }

    public function setCreateBookingErr($createBookingErr)
    {
        $this->createBookingErr=$createBookingErr;
    }

    public function getCreateBookingErr()
    {
        return $this->createBookingErr;
    }

    public function setCreateBookingOutput($createBookingOutput)
    {
        $this->createBookingOutput=$createBookingOutput;
    }

    public function getCreateBookingOutput()
    {
        return $this->createBookingOutput;
    }

    public function setBookingCustomerArray($bookingCustomerArray)
    {
        $this->bookingCustomerArray=$bookingCustomerArray;
    }

    public function getBookingCustomerArray()
    {
        return $this->bookingCustomerArray;
    }

    public function setBookingCustomerErr($bookingCustomerErr)
    {
        $this->bookingCustomerErr=$bookingCustomerErr;
    }

    public function getBookingCustomerErr()
    {
        return $this->bookingCustomerErr;
    }

    public function setBookingInventoryArray($bookingInventoryArray)
    {
        $this->bookingInventoryArray=$bookingInventoryArray;
    }

    public function getBookingInventoryArray()
    {
        return $this->bookingInventoryArray;
    }

    public function setBookingInventoryErr($bookingInventoryErr)
    {
        $this->bookingInventoryErr=$bookingInventoryErr;
    }

    public function getBookingInventoryErr()
    {
        return $this->bookingInventoryErr;
    }

	//Validation Methods
	public function formSubmitBookingCheck($eMail, $eMailErr, $barCodeNumber1, $bookingDate, $bookingDateErr, $barCodeNumberDuplicateErr, $barCodeNumber1Err, $barCodeNumber2Err, $barCodeNumber3Err, $barCodeNumber4Err, $barCodeNumber5Err, $barCodeNumber6Err, $barCodeNumber7Err, $barCodeNumber8Err, $barCodeNumber9Err, $barCodeNumber10Err)
	{
		if($eMail!=NULL and $eMailErr==NULL and $barCodeNumber1!=NULL and $bookingDate!=NULL and $bookingDateErr==NULL and $barCodeNumberDuplicateErr==NULL and $barCodeNumber1Err==NULL and $barCodeNumber2Err==NULL and $barCodeNumber3Err==NULL and $barCodeNumber4Err==NULL and $barCodeNumber5Err==NULL and $barCodeNumber6Err==NULL and $barCodeNumber7Err==NULL and $barCodeNumber8Err==NULL and $barCodeNumber9Err==NULL and $barCodeNumber10Err==NULL)
		{
			return "FORM COMPLETE";
		}
		else
		{
			return "Form Incomplete";
		}
	}//Function Close

	public function formSubmitReturnCheck($barCodeNumber1, $returnDate, $returnDateErr, $barCodeNumberDuplicateErr, $barCodeNumber1Err, $barCodeNumber2Err, $barCodeNumber3Err, $barCodeNumber4Err, $barCodeNumber5Err, $barCodeNumber6Err, $barCodeNumber7Err, $barCodeNumber8Err, $barCodeNumber9Err, $barCodeNumber10Err)
	{
		if($barCodeNumber1!=NULL and $returnDate!=NULL and $returnDateErr==NULL and $barCodeNumberDuplicateErr==NULL and $barCodeNumber1Err==NULL and $barCodeNumber2Err==NULL and $barCodeNumber3Err==NULL and $barCodeNumber4Err==NULL and $barCodeNumber5Err==NULL and $barCodeNumber6Err==NULL and $barCodeNumber7Err==NULL and $barCodeNumber8Err==NULL and $barCodeNumber9Err==NULL and $barCodeNumber10Err==NULL)
		{
			return "FORM COMPLETE";
		}
		else
		{
			return "Form Incomplete";
		}
	}//Function Close

}
?>

<!-- php Desktop/PHP/SantaMonicaMovieRentalsSILEX/app/SMMRSite/Models/BookingModels/bookingClass.php -->