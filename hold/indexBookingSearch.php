<?php 
session_start(); 

date_default_timezone_set("America/New_York");

require_once __DIR__ . '/vendor/autoload.php';

use SMMRSite\Models\CustomerModels\CustomerClass;
use SMMRSite\Models\InventoryModels\InventoryClass;
use SMMRSite\Models\BookingModels\BookingClass;
use SMMRSite\Models\BookingModels\BookingDAOClass;
use SMMRSite\Controllers\BookingControllers\BookingSearchController;

use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$app= new Silex\Application();

$app['debug']=true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/views',
    ));

$url= 'http://'.$_SERVER['SERVER_NAME'].'/SMMRSILEX';

$app->get('/', function () use ($app, $url, $request) {    

        $booking= new BookingClass($_SESSION["bookingEMail"],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"], $_SESSION["bookingDate"], $_SESSION["returnDate"],$_SESSION["bookingEMailAddressErr"],$_SESSION["barCodeNumberDuplicateErr"], $_SESSION["barCodeNumber1Err"], $_SESSION["barCodeNumber2Err"], $_SESSION["barCodeNumber3Err"], $_SESSION["barCodeNumber4Err"], $_SESSION["barCodeNumber5Err"], $_SESSION["barCodeNumber6Err"], $_SESSION["barCodeNumber7Err"], $_SESSION["barCodeNumber8Err"], $_SESSION["barCodeNumber9Err"], $_SESSION["barCodeNumber10Err"], $_SESSION["bookingDateErr"], $_SESSION["returnDateErr"]);
        $customer= new CustomerClass();
        $inventory= new InventoryClass();
        $bookingDAO= new BookingDAOClass();
        $bookingSearchController= new BookingSearchController($booking, $customer, $inventory, $bookingDAO);

        return $app['twig']->render('bookingSearch.twig', ['url'=>$url,
        'returnContent'=>$bookingSearchController->searchRecord(),
        'bookingInventory'=>$booking->getBookingInventory($_SESSION["inventoryCount"]),
        'returnDate'=>$booking->getReturnDate(),
        'returnDateError'=>$booking->getReturnDateErr(),
        'lastName'=>$customer->getLastName(),
        'lastNameError'=>$customer->getLastNameErr(),
        'dateOfBirth'=>$customer->getDateOfBirth(),
        'address1'=>$customer->getAddress1(),
        'address1Error'=>$customer->getAddress1Err(),
        'phoneNumber'=>$customer->getPhoneNumber(),
        'phoneNumberError'=>$customer->getPhoneNumberErr(),
        'barCodeNumber'=>$inventory->getBarCodeNumber(),
        'barCodeNumberError'=>$inventory->getBarCodeNumberErr(),
        'sKUNumber'=>$inventory->getSKUNumber(),
        'sKUNumberError'=>$inventory->getSKUNumberErr(),
        'productName'=>$inventory->getProductName(),
        'productNameError'=>$inventory->getProductNameErr()
        ]);
    });

$app->run();

// php Desktop/PHP/SantaMonicaMovieRentalsSILEX/index.php