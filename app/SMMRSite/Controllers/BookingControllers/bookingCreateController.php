<?php namespace SMMRSite\Controllers\BookingControllers;

use SMMRSite\Models\BookingModels\BookingClass;
use SMMRSite\Models\CustomerModels\CustomerClass;
use SMMRSite\Models\InventoryModels\InventoryClass;
use SMMRSite\Models\BookingModels\BookingDAOClass;

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
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);

        $_SESSION["bookingDate"]= $this->booking->getBookingDate();
        $_SESSION["bookingDateErr"]= $this->booking->getBookingDateErr();

        $_SESSION["barCodeNumberDuplicateErr"]= $this->booking->getBarCodeNumberErr("d");
        echo $_SESSION["barCodeNumberDuplicateErr"];
        $_SESSION["barCodeNumber1Err"]= $this->booking->getBarCodeNumberErr(1);
        $_SESSION["barCodeNumber2Err"]= $this->booking->getBarCodeNumberErr(2);
        $_SESSION["barCodeNumber3Err"]= $this->booking->getBarCodeNumberErr(3);
        $_SESSION["barCodeNumber4Err"]= $this->booking->getBarCodeNumberErr(4);
        $_SESSION["barCodeNumber5Err"]= $this->booking->getBarCodeNumberErr(5);
        $_SESSION["barCodeNumber6Err"]= $this->booking->getBarCodeNumberErr(6);
        $_SESSION["barCodeNumber7Err"]= $this->booking->getBarCodeNumberErr(7);
        $_SESSION["barCodeNumber8Err"]= $this->booking->getBarCodeNumberErr(8);
        $_SESSION["barCodeNumber9Err"]= $this->booking->getBarCodeNumberErr(9);
        $_SESSION["barCodeNumber10Err"]= $this->booking->getBarCodeNumberErr(10);

        if ($this->booking->formSubmitBookingCheck($_SESSION["bookingEMail"], $_SESSION["bookingEMailAddressErr"], $_SESSION["barCodeNumber1"], $_SESSION["bookingDate"], $_SESSION["bookingDateErr"], $_SESSION["barCodeNumberDuplicateErr"], $_SESSION["barCodeNumber1Err"], $_SESSION["barCodeNumber2Err"], $_SESSION["barCodeNumber3Err"], $_SESSION["barCodeNumber4Err"], $_SESSION["barCodeNumber5Err"], $_SESSION["barCodeNumber6Err"], $_SESSION["barCodeNumber7Err"], $_SESSION["barCodeNumber8Err"], $_SESSION["barCodeNumber9Err"], $_SESSION["barCodeNumber10Err"])=="FORM COMPLETE")
        {
          echo $this->bookingDAO->createBookingRecord($_SESSION["bookingEMail"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"], $_SESSION["bookingDate"]);
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
          $this->booking->clearBarCodeNumber($_SESSION["inventoryCount"]);
          $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
          $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
          $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
          $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
          $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
          $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
          $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
          $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
          $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
          $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
          $_SESSION["barCodeNumber1Err"]= $this->booking->getBarCodeNumberErr(1);
        $_SESSION["barCodeNumber2Err"]= $this->booking->getBarCodeNumberErr(2);
        $_SESSION["barCodeNumber3Err"]= $this->booking->getBarCodeNumberErr(3);
        $_SESSION["barCodeNumber4Err"]= $this->booking->getBarCodeNumberErr(4);
        $_SESSION["barCodeNumber5Err"]= $this->booking->getBarCodeNumberErr(5);
        $_SESSION["barCodeNumber6Err"]= $this->booking->getBarCodeNumberErr(6);
        $_SESSION["barCodeNumber7Err"]= $this->booking->getBarCodeNumberErr(7);
        $_SESSION["barCodeNumber8Err"]= $this->booking->getBarCodeNumberErr(8);
        $_SESSION["barCodeNumber9Err"]= $this->booking->getBarCodeNumberErr(9);
        $_SESSION["barCodeNumber10Err"]= $this->booking->getBarCodeNumberErr(10);
      }
      
      //Customer Search
      if (isset($_GET["submitCustomer"]) and $this->customer->formBookingCustomerSearchCheck($this->customer->getLastNameErr(), $this->customer->getAddress1Err(), $this->customer->getPhoneNumberErr())=="FORM COMPLETE")
      {
        $_SESSION["eMailList"]= $this->bookingDAO->bookingCustomerQuery($this->customer->getLastName(), $this->customer->getDateOfBirth(), $this->customer->getAddress1(), $this->customer->getPhoneNumber());
      }

      //Sets Booking E-Mail from Customer Search
      if (isset($_GET["eMailSelect0"]))
      {
        $this->booking->setEMailAddress($_SESSION["eMailList"][0]);
        $_SESSION["bookingEMail"]= $this->booking->getEMailAddress();
      }

      if (isset($_GET["eMailSelect1"]))
      {
        $this->booking->setEMailAddress($_SESSION["eMailList"][1]);
        $_SESSION["bookingEMail"]= $this->booking->getEMailAddress();
      }

      if (isset($_GET["eMailSelect2"]))
      {
        $this->booking->setEMailAddress($_SESSION["eMailList"][2]);
        $_SESSION["bookingEMail"]= $this->booking->getEMailAddress();
      }

      if (isset($_GET["eMailSelect3"]))
      {
        $this->booking->setEMailAddress($_SESSION["eMailList"][3]);
        $_SESSION["bookingEMail"]= $this->booking->getEMailAddress();
      }

      if (isset($_GET["eMailSelect4"]))
      {
        $this->booking->setEMailAddress($_SESSION["eMailList"][4]);
        $_SESSION["bookingEMail"]= $this->booking->getEMailAddress();
      }

      if (isset($_GET["eMailSelect5"]))
      {
        $this->booking->setEMailAddress($_SESSION["eMailList"][5]);
        $_SESSION["bookingEMail"]= $this->booking->getEMailAddress();
      }

      if (isset($_GET["eMailSelect6"]))
      {
        $this->booking->setEMailAddress($_SESSION["eMailList"][6]);
        $_SESSION["bookingEMail"]= $this->booking->getEMailAddress();
      }

      if (isset($_GET["eMailSelect7"]))
      {
        $this->booking->setEMailAddress($_SESSION["eMailList"][7]);
        $_SESSION["bookingEMail"]= $this->booking->getEMailAddress();
      }

      if (isset($_GET["eMailSelect8"]))
      {
        $this->booking->setEMailAddress($_SESSION["eMailList"][8]);
        $_SESSION["bookingEMail"]= $this->booking->getEMailAddress();
      }

      if (isset($_GET["eMailSelect9"]))
      {
        $this->booking->setEMailAddress($_SESSION["eMailList"][9]);
        $_SESSION["bookingEMail"]= $this->booking->getEMailAddress();
      }
      
      //Inventory Search
      if (isset($_GET["submitProduct"]) and $this->inventory->formBookingInventorySearchCheck($this->inventory->getBarCodeNumberErr(), $this->inventory->getSKUNumberErr(), $this->inventory->getProductNameErr())=="FORM COMPLETE")
      {
        $_SESSION["inventoryList"]= $this->bookingDAO->bookingInventoryQuery($this->inventory->getBarCodeNumber(), $this->inventory->getSKUNumber(), $this->inventory->getProductName());
      }

      //Sets Booking BarCode from Inventory Search
      if (isset($_GET["barCodeSelect0"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][0],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_GET["barCodeSelect1"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][1],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_GET["barCodeSelect2"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][2],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_GET["barCodeSelect3"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][3],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_GET["barCodeSelect4"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][4],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_GET["barCodeSelect5"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][5],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_GET["barCodeSelect6"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][6],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_GET["barCodeSelect7"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][7], $_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_GET["barCodeSelect8"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][8],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }

      if (isset($_GET["barCodeSelect9"]))
      {
        $this->booking->setBarCodeNumber($_SESSION["inventoryList"][9],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
        $_SESSION["barCodeNumber1"]= $this->booking->getBarCodeNumber(1);
        $_SESSION["barCodeNumber2"]= $this->booking->getBarCodeNumber(2);
        $_SESSION["barCodeNumber3"]= $this->booking->getBarCodeNumber(3);
        $_SESSION["barCodeNumber4"]= $this->booking->getBarCodeNumber(4);
        $_SESSION["barCodeNumber5"]= $this->booking->getBarCodeNumber(5);
        $_SESSION["barCodeNumber6"]= $this->booking->getBarCodeNumber(6);
        $_SESSION["barCodeNumber7"]= $this->booking->getBarCodeNumber(7);
        $_SESSION["barCodeNumber8"]= $this->booking->getBarCodeNumber(8);
        $_SESSION["barCodeNumber9"]= $this->booking->getBarCodeNumber(9);
        $_SESSION["barCodeNumber10"]= $this->booking->getBarCodeNumber(10);
      }
    }
  	}//functionClose

}//class end
?>