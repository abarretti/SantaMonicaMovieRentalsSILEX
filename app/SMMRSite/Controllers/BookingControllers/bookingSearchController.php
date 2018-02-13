<?php namespace SMMRSite\Controllers\BookingControllers;

use SMMRSite\Models\BookingModels\BookingClass;
use SMMRSite\Models\CustomerModels\CustomerClass;
use SMMRSite\Models\InventoryModels\InventoryClass;
use SMMRSite\DAOs\BookingDAOClass;

class BookingSearchController
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

  	public function searchRecord()
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

      //SUBMIT RETURN
      if (isset($_GET["submitReturn"]))
      {
        $this->booking->setBookingFormBarcodeNumbers($_SESSION["inventoryCount"], $_GET["barCodeNumber1"], $_GET["barCodeNumber2"], $_GET["barCodeNumber3"], $_GET["barCodeNumber4"], $_GET["barCodeNumber5"], $_GET["barCodeNumber6"], $_GET["barCodeNumber7"], $_GET["barCodeNumber8"], $_GET["barCodeNumber9"],$_GET["barCodeNumber10"]);
        
        $this->booking->setReturnDate($_GET["returnDate"]);

        for($x=1;$x<=10;$x++)
        {
            $_SESSION["barCodeNumber".$x]= $this->booking->getBarCodeNumber($x);
        }

        $_SESSION["returnDate"]= $this->booking->getReturnDate();
        $_SESSION["returnDateErr"]= $this->booking->getReturnDateErr();
        
        for($x=1;$x<=10;$x++)
        {
            $_SESSION["barCodeNumber".$x."Err"]= $this->booking->getBarCodeNumberErr($x);
        }
        $_SESSION["barCodeNumberDuplicateErr"]= $this->booking->getBarCodeNumberErr("d");

        if ($this->booking->formSubmitReturnCheck($_SESSION["barCodeNumber1"], $_SESSION["returnDate"], $_SESSION["returnDateErr"], $_SESSION["barCodeNumberDuplicateErr"], $_SESSION["barCodeNumber1Err"], $_SESSION["barCodeNumber2Err"], $_SESSION["barCodeNumber3Err"], $_SESSION["barCodeNumber4Err"], $_SESSION["barCodeNumber5Err"], $_SESSION["barCodeNumber6Err"], $_SESSION["barCodeNumber7Err"], $_SESSION["barCodeNumber8Err"], $_SESSION["barCodeNumber9Err"], $_SESSION["barCodeNumber10Err"])=="FORM COMPLETE")
        {
          $this->bookingDAO->returnBooking($this->booking, $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"], $_SESSION["returnDate"]);
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
        $this->bookingDAO->bookingSearchCustomerQuery($this->booking, $this->customer->getLastName(), $this->customer->getDateOfBirth(), $this->customer->getAddress1(), $this->customer->getPhoneNumber());
        $_SESSION["bookingSearchArray"]= $this->booking->getBookingSearchArray();
        $_SESSION["bookingSearchErr"]= $this->booking->getBookingSearchErr();
      }
      
      //Inventory Search
      if (isset($_GET["submitProduct"]) and $this->inventory->formBookingInventorySearchCheck($this->inventory->getBarCodeNumberErr(), $this->inventory->getSKUNumberErr(), $this->inventory->getProductNameErr())=="FORM COMPLETE")
      {
        $this->bookingDAO->bookingSearchInventoryQuery($this->booking, $this->inventory->getBarCodeNumber(), $this->inventory->getSKUNumber(), $this->inventory->getProductName());
        $_SESSION["bookingSearchArray"]= $this->booking->getBookingSearchArray();
        $_SESSION["bookingSearchErr"]= $this->booking->getBookingSearchErr();
      }

      //Sets Booking BarCode from Customer and Inventory Searches
      for($x=0;$x<10;$x++)
      {
          if (isset($_GET["barCodeSelect".$x]))
          {
              $this->booking->setBarCodeNumber($_SESSION["bookingSearchArray"][$x]["barCodeNumber"],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"]);
              for($y=1;$y<=10;$y++)
              {
                  $_SESSION["barCodeNumber".$y]= $this->booking->getBarCodeNumber($y);
              }
              $_SESSION["bookingSearchArray"]= $this->booking->setBookingSearchArray(NULL);
          }
      }
      
    }
  	}//functionClose

}//class end
?>

<!--  php Desktop/PHP/SantaMonicaMovieRentalsSILEX/app/SMMRSite/Controllers/BookingControllers/bookingSearchController.php --> 