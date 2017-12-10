<?php 
session_start(); 

date_default_timezone_set("America/New_York");

require_once __DIR__ . '/vendor/autoload.php';

use SMMRSite\Models\InventoryModels\InventoryClass;
use SMMRSite\Models\InventoryModels\InventoryDAOClass;
use SMMRSite\Controllers\InventoryControllers\InventoryCreateController;

use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$app= new Silex\Application();

$app['debug']=true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/views',
    ));

$url= 'http://'.$_SERVER['SERVER_NAME'].'/SMMRSILEX';

$app->get('/', function () use ($app, $url, $request) {    
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

$app->run();

// php Desktop/PHP/SantaMonicaMovieRentalsSILEX/index.php