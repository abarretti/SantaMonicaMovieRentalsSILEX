<?php 
session_start(); 

date_default_timezone_set("America/New_York");

require_once __DIR__ . '/vendor/autoload.php';

use SMMRSite\Models\InventoryModels\InventoryClass;
use SMMRSite\Models\InventoryModels\InventoryDAOClass;
use SMMRSite\Controllers\InventoryControllers\InventorySearchController;

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

$app->run();

// php Desktop/PHP/SantaMonicaMovieRentalsSILEX/index.php