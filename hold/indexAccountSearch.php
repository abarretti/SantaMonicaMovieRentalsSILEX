<?php 
session_start(); 

date_default_timezone_set("America/New_York");

require_once __DIR__ . '/vendor/autoload.php';

use SMMRSite\Models\CustomerModels\CustomerClass;
use SMMRSite\Models\CustomerModels\CustomerDAOClass;
use SMMRSite\Controllers\CustomerControllers\AccountSearchController;

use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$app= new Silex\Application();

$app['debug']=true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/views',
    ));

$url= 'http://'.$_SERVER['SERVER_NAME'].'/SMMRSILEX';

$app->get('/', function () use ($app, $url, $request) {    
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