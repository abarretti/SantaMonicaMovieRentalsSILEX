<?php 
session_start(); 

date_default_timezone_set("America/New_York");

require_once __DIR__ . '/vendor/autoload.php';

use SMMRSite\Models\InventoryModels\InventoryClass;
use SMMRSite\DAOs\InventoryDAOClass;
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
        'companyNames'=>$inventory->getCompanyNames($inventoryDAO),
        'genres'=>$inventory->getGenres($inventoryDAO)
        ]);
    });

$app->run();

// php Desktop/PHP/SantaMonicaMovieRentalsSILEX/index.php