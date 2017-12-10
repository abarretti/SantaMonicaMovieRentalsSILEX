<?php 
session_start(); 

date_default_timezone_set("America/New_York");

require_once __DIR__ . '/vendor/autoload.php';

use SMMRSite\Models\CustomerModels\CustomerClass;
use SMMRSite\Models\CustomerModels\CustomerDAOClass;
use SMMRSite\Models\InventoryModels\InventoryClass;
use SMMRSite\Models\InventoryModels\InventoryDAOClass;
use SMMRSite\Models\BookingModels\BookingClass;
use SMMRSite\Models\BookingModels\BookingDAOClass;
use SMMRSite\Controllers\BookingControllers\BookingCreateController;
use SMMRSite\Controllers\BookingControllers\BookingSearchController;
use SMMRSite\Controllers\CustomerControllers\AccountCreateController;
use SMMRSite\Controllers\CustomerControllers\AccountSearchController;
use SMMRSite\Controllers\InventoryControllers\InventorySearchController;
use SMMRSite\Controllers\InventoryControllers\InventoryCreateController;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$app= new Silex\Application();

$app['debug']=true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/views',
    ));

$url= 'http://'.$_SERVER['SERVER_NAME'].'/SMMRSILEX';

//Home View
$app->get('/', function () use ($app, $url) {
    return $app['twig']->render('home.twig', ['url'=>$url]);
});

//Inventory Views
$app->get('/inventory', function () use ($app, $url) {
    return $app['twig']->render('inventory.twig', ['url'=>$url]);
});

$app->get('/inventorySearch', function () use ($app, $url, $request) {    
    $inventory= new InventoryClass();
    $inventoryDAO=  new InventoryDAOClass();
    $inventorySearchController= new InventorySearchController($inventory, $inventoryDAO);

        return $app['twig']->render('inventorySearch.twig', ['url'=>$url,
        'returnContent'=>$inventorySearchController->searchRecord(),
        'sKUNumber'=>$inventory->getSKUNumber(),
        'sKUNumberError'=>$inventory->getSKUNumberErr(),
        'productName'=>$inventory->getProductName(),
        'productNameError'=>$inventory->getProductNameErr(),
        'productionCompanyName'=>$inventory->getProductionCompanyName(),
        'companyNames'=>$inventoryDAO->getCompanyNames($inventory->getProductionCompanyName()),
        'genres'=>$inventoryDAO->getGenres($inventory->getAction(), $inventory->getChildren(), $inventory->getComedy(), $inventory->getDocumentary(), $inventory->getDrama(), $inventory->getHorror(), $inventory->getMusicals(), $inventory->getRomance(), $inventory->getScienceFiction(), $inventory->getThriller())
        ]);
    });

$app->get('/inventoryCreate', function () use ($app, $url, $request) {    
        $inventory= new InventoryClass();
        $inventoryDAO= new InventoryDAOClass();
        $inventoryCreateController= new InventoryCreateController($inventory, $inventoryDAO);

        return $app['twig']->render('inventoryCreate.twig', ['url'=>$url,
        'returnContent'=>$inventoryCreateController->insertRecord(),
        'sKUNumber'=>$inventory->getSKUNumber(),
        'sKUNumberError'=>$inventory->getSKUNumberErr(),
        'productName'=>$inventory->getProductName(),
        'productNameError'=>$inventory->getProductNameErr(),
        'companyNames'=>$inventoryDAO->getCompanyNames($inventory->getProductionCompanyName()),
        'productionCompanyNameError'=>$inventory->getProductionCompanyNameErr(),
        'genres'=>$inventoryDAO->getGenres($inventory->getAction(), $inventory->getChildren(), $inventory->getComedy(), $inventory->getDocumentary(), $inventory->getDrama(), $inventory->getHorror(), $inventory->getMusicals(), $inventory->getRomance(), $inventory->getScienceFiction(), $inventory->getThriller()),
        'genreError'=>$inventory->getGenreErr(),
        'barCodeNumber'=>$inventory->getBarCodeNumber(),
        'barCodeNumberError'=>$inventory->getBarCodeNumberErr(),
        'dateAcquired'=>$inventory->getDateAcquired(),
        'dateAcquiredError'=>$inventory->getDateAcquiredErr(),
        'condition'=>$inventory->getCondition(),
        'conditionError'=>$inventory->getConditionErr()
        ]);
    });

//Booking Views
$app->get('/booking', function () use ($app, $url) {
    return $app['twig']->render('booking.twig', ['url'=>$url]);
});

$app->get('/bookingSearch', function () use ($app, $url, $request) {    

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

$app->get('/bookingCreate', function () use ($app, $url, $request) {    

    $booking= new BookingClass($_SESSION["bookingEMail"],$_SESSION["inventoryCount"], $_SESSION["barCodeNumber1"], $_SESSION["barCodeNumber2"], $_SESSION["barCodeNumber3"], $_SESSION["barCodeNumber4"], $_SESSION["barCodeNumber5"], $_SESSION["barCodeNumber6"], $_SESSION["barCodeNumber7"], $_SESSION["barCodeNumber8"], $_SESSION["barCodeNumber9"], $_SESSION["barCodeNumber10"], $_SESSION["bookingDate"], NULL, $_SESSION["bookingEMailAddressErr"],$_SESSION["barCodeNumberDuplicateErr"], $_SESSION["barCodeNumber1Err"], $_SESSION["barCodeNumber2Err"], $_SESSION["barCodeNumber3Err"], $_SESSION["barCodeNumber4Err"], $_SESSION["barCodeNumber5Err"], $_SESSION["barCodeNumber6Err"], $_SESSION["barCodeNumber7Err"], $_SESSION["barCodeNumber8Err"], $_SESSION["barCodeNumber9Err"], $_SESSION["barCodeNumber10Err"], $_SESSION["bookingDateErr"],NULL);
    $customer= new CustomerClass();
    $inventory= new InventoryClass();
    $bookingDAO= new BookingDAOClass();
    $bookingCreateController= new BookingCreateController($booking, $customer, $inventory, $bookingDAO);

        return $app['twig']->render('bookingCreate.twig', ['url'=>$url,
        'returnContent'=>$bookingCreateController->insertRecord(),
        'eMail'=>$_SESSION["bookingEMail"],
        'eMailError'=>$booking->getEMailErr(),
        'inventoryCount'=>$booking->getBookingInventory($_SESSION["inventoryCount"]),
        'bookingDate'=>$booking->getBookingDate(),
        'bookingDateError'=>$booking->getBookingDateErr(),
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

//Customer Views
$app->get('/customers', function () use ($app, $url) {
    return $app['twig']->render('customers.twig', ['url'=>$url]);
});

$app->get('/accountCreate', function () use ($app, $url, $request) {    
        $customer= new CustomerClass();
        $customerDAO= new CustomerDAOClass();
        $accountCreateController= new AccountCreateController($customer, $customerDAO);

        return $app['twig']->render('accountCreate.twig', ['url'=>$url,
        'returnContent'=>$accountCreateController->insertRecord(),
        'firstName'=>$customer->getFirstName(),
        'firstNameError'=>$customer->getFirstNameErr(),
        'lastName'=>$customer->getLastName(),
        'lastNameError'=>$customer->getLastNameErr(),
        'dateOfBirth'=>$customer->getDateOfBirth(),
        'gender'=>$customer->getGender(),
        'genderError'=>$customer->getGenderErr(),
        'address1'=>$customer->getAddress1(),
        'address1Error'=>$customer->getAddress1Err(),
        'address2'=>$customer->getAddress2(),
        'city'=>$customer->getCity(),
        'cityError'=>$customer->getCityErr(),
        'state'=>$customer->getState(),
        'stateError'=>$customer->getStateErr(),
        'phoneNumber'=>$customer->getPhoneNumber(),
        'phoneNumberError'=>$customer->getPhoneNumberErr(),
        'eMail'=>$customer->getEMailAddress(),
        'eMailError'=>$customer->getEMailErr(),
        'password'=>$customer->getPassword(),
        'passwordError'=>$customer->getPasswordErr(),
        'passwordRepeat'=>$customer->getPasswordRepeat(),
        'passwordRepeatError'=>$customer->getPasswordRepeatErr(),
        'action'=>$customer->getAction(),
        'children'=>$customer->getChildren(),
        'comedy'=>$customer->getComedy(),
        'documentary'=>$customer->getDocumentary(),
        'drama'=>$customer->getDrama(),
        'horror'=>$customer->getHorror(),
        'musicals'=>$customer->getMusicals(),
        'romance'=>$customer->getRomance(),
        'scienceFiction'=>$customer->getScienceFiction(),
        'thriller'=>$customer->getThriller(),
        'notes'=>$customer->getNotes()
        ]);
    });

$app->get('/accountSearch', function () use ($app, $url, $request) {    
        $customer= new CustomerClass();
        $customerDAO= new CustomerDAOClass();
        $accountSearchController= new AccountSearchController($customer, $customerDAO);

        return $app['twig']->render('accountSearch.twig', ['url'=>$url,
        'returnContent'=>$accountSearchController->searchRecord(),
        'firstName'=>$customer->getFirstName(),
        'firstNameError'=>$customer->getFirstNameErr(),
        'lastName'=>$customer->getLastName(),
        'lastNameError'=>$customer->getLastNameErr(),
        'dateOfBirth'=>$customer->getDateOfBirth(),
        'address1'=>$customer->getAddress1(),
        'address1Error'=>$customer->getAddress1Err(),
        'city'=>$customer->getCity(),
        'cityError'=>$customer->getCityErr(),
        'state'=>$customer->getState(),
        'phoneNumber'=>$customer->getPhoneNumber(),
        'phoneNumberError'=>$customer->getPhoneNumberErr(),
        'eMail'=>$customer->getEMailAddress(),
        'eMailError'=>$customer->getEMailErr()
        ]);
    });

$app->run();

// php Desktop/PHP/SantaMonicaMovieRentalsSILEX/index.php