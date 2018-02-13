<?php namespace SMMRSite\Controllers\BookingControllers;

use SMMRSite\Models\BookingModels\BookingClass;
use SMMRSite\Models\CustomerModels\CustomerClass;
use SMMRSite\Models\InventoryModels\InventoryClass;
use SMMRSite\DAOs\BookingDAOClass;

class BookingCreateController
{
    private $booking;
    private $customer;
    private $inventory;
    private $bookingDAO;

    public function __construct(BookingClass $booking, CustomerClass $customer, InventoryClass $inventory, BookingDAOClass $bookingDAO)
    {
        $this->booking= $booking;
        $this->customer= $customer;
        $this->inventory= $inventory;
        $this->bookingDAO= $bookingDAO;
    }

  	public function insertRecord()
  	{
      if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $this->customer->setLastNameOptional($_GET["lastName"]);
      $this->customer->setDateOfBirth($_GET["dateOfBirth"]);
      $this->customer->setAddress1Optional($_GET["address1"]);
      $this->customer->setPhoneNumber($_GET["phoneNumber"]);

      $this->inventory->setBarCodeNumberOptional($_GET["barCodeNumber"]);
      $this->inventory->setSKUNumberOptional($_GET["sKUNumber"]);
      $this->inventory->setProductNameOptional($_GET["productName"]);

      //SUBMIT BOOKING
      if (isset($_GET["submitBooking"]))
      {
        $this->booking->setEMailAddress($_GET["eMail"]);
        $this->booking->setBookingFormBarcodeNumbers($_SESSION["inventoryCount"], $_GET["barCodeNumber1"], $_GET["barCodeNumber2"], $_GET["barCodeNumber3"], $_GET["barCodeNumber4"], $_GET["barCodeNumber5"], $_GET["barCodeNumber6"], $_GET["barCodeNumber7"], $_GET["barCodeNumber8"], $_GET["barCodeNumber9"],$_GET["barCodeNumber10"]);
        $this->booking->setBookingDate($_GET["bookingDate"]);

        $_SESSION["bookingEMail"]= $this->booking->getEMailAddress();
        $_SESSION["bookingEMailAddressErr"]= $this->booking->getEmailErr();
        for($x=1;$x<=10;$x++)
        {
            $_SESSION["barCodeNumber".$x]= $this->booking->getBarCodeNumber($x);
        }

        $_SESSION["bookingDate"]= $this->booking->getBookingDate();
        $_SESSION["bookingDateErr"]= $this->booking->getBookingDateErr();

        for($x=1;$x<=10;$x++)
        {
            $_SESSION["barCodeNumber".$x."Err"]= $this->booking->getBarCodeNumberErr($x);
        }

        $_SESSION["barCodeNumberDuplicateErr"]= $this->booking->getBarCodeNumberErr("d");

        if ($this->booking->formSubmitBookingCheck($_SESSION["bookingEMail"], $_SESSION["bookingEMailAddressErr"], $_SESSION["barCodeNumber1"], $_SESSION["bookingDate"], $_SESSION["bookingDateErr"], $_SESSION["barCodeNumberDuplicateErr"], $_SESSION["barCodeNumber1Err"], $_SESSION["barCodeNumber2Err"], $_SESSION["barCodeNumber3Err"], $_SESSION["barCodeNumber4Err"], $_SESSION["barCodeNumber5Err"], $_SESSION["barCodeNumber6Err"], $_SESSION["barCodeNumber7Err"], $_SESSION["barCodeNumber8Err"], $_SESSION["barCodeNumber9Err"], $_SESSION["barCodeNumber10Err"])=="FORM COMPLETE")
        {
          $this->bookingDAO->createBookingRecord($this->booking, $_SESSION["bookingEMail"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"], $_SESSION["bookingDate"]);
        }
      }

      //Add and Remove Inventory Items
      if (isset($_GET["addItem"]))
      {
        $_SESSION["inventoryCount"]= $_SESSION["inventoryCount"]+1;
        $this->booking->setInventoryCount($_SESSION["inventoryCount"]);
        $_SESSION["inventoryCount"]= $this->booking->getInventoryCount();
      }

      if (isset($_GET["removeItem"]))
      { 
        $_SESSION["inventoryCount"]= $_SESSION["inventoryCount"]-1;
        $this->booking->setInventoryCount($_SESSION["inventoryCount"]);
        $_SESSION["inventoryCount"]= $this->booking->getInventoryCount();
        
          //clears variable if inventory item is removed
          $this->booking->clearBarCodeNumber($this->booking->getInventoryCount());
          for($x=1;$x<=10;$x++)
          {
              $_SESSION["barCodeNumber".$x]= $this->booking->getBarCodeNumber($x);
              $_SESSION["barCodeNumber".$x."Err"]= $this->booking->getBarCodeNumberErr($x);
          }
      }
      
      //Customer Search
      if (isset($_GET["submitCustomer"]) and $this->customer->formBookingCustomerSearchCheck($this->customer->getLastNameErr(), $this->customer->getAddress1Err(), $this->customer->getPhoneNumberErr())=="FORM COMPLETE")
      {
        $this->bookingDAO->bookingCustomerQuery($this->booking, $this->customer->getLastName(), $this->customer->getDateOfBirth(), $this->customer->getAddress1(), $this->customer->getPhoneNumber());
        $_SESSION["bookingCustomerArray"]= $this->booking->getBookingCustomerArray();
        $_SESSION["bookingCustomerErr"]= $this->booking->getBookingCustomerErr();
      }

      //Sets Booking E-Mail from Customer Search
      for($x=0;$x<10;$x++)
      {
          if (isset($_GET["eMailSelect".$x]))
          {
              $this->booking->setEMailAddress($_SESSION["bookingCustomerArray"][$x]["eMail"]);
              $_SESSION["bookingEMail"]= $this->booking->getEMailAddress();
              $_SESSION["bookingCustomerArray"]= $this->booking->setBookingCustomerArray(NULL);
          }
      }
      
      //Inventory Search
      if (isset($_GET["submitProduct"]) and $this->inventory->formBookingInventorySearchCheck($this->inventory->getBarCodeNumberErr(), $this->inventory->getSKUNumberErr(), $this->inventory->getProductNameErr())=="FORM COMPLETE")
      {
        $this->bookingDAO->bookingInventoryQuery($this->booking, $this->inventory->getBarCodeNumber(), $this->inventory->getSKUNumber(), $this->inventory->getProductName());
        $_SESSION["bookingInventoryArray"]= $this->booking->getBookingInventoryArray();
        $_SESSION["bookingInventoryErr"]= $this->booking->getBookingInventoryErr();
      }

      //Sets Booking BarCode from Inventory Search
      for($x=0;$x<10;$x++)
      {
          if (isset($_GET["barCodeSelect".$x]))
          {
              $this->booking->setBarCodeNumber($_SESSION["bookingInventoryArray"][$x]["barCodeNumber"],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
              for($y=1;$y<=10;$y++)
              {
                  $_SESSION["barCodeNumber".$y]= $this->booking->getBarCodeNumber($y);
              }
              $_SESSION["bookingInventoryArray"]= $this->booking->setBookingInventoryArray(NULL);
          }
      }

    }
    }//functionClose

}//class end
?>

<!-- php Desktop/PHP/SantaMonicaMovieRentalsSILEX/app/SMMRSite/Controllers/BookingControllers/bookingCreateController.php -->