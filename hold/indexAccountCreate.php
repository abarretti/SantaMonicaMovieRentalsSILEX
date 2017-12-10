<?php 
session_start(); 

date_default_timezone_set("America/New_York");

require_once __DIR__ . '/vendor/autoload.php';

use SMMRSite\Models\CustomerModels\CustomerClass;
use SMMRSite\Models\CustomerModels\CustomerDAOClass;
use SMMRSite\Controllers\CustomerControllers\AccountCreateController;

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

$app->run();

// php Desktop/PHP/SantaMonicaMovieRentalsSILEX/index.php