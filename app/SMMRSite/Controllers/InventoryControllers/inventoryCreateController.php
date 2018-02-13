<?php namespace SMMRSite\Controllers\InventoryControllers;

use SMMRSite\Models\InventoryModels\InventoryClass;
use SMMRSite\DAOs\InventoryDAOClass;

class InventoryCreateController
{
    private $inventory;
    private $inventoryDAO;

    public function __construct(InventoryClass $inventory, InventoryDAOClass $inventoryDAO)
    {
        $this->inventory= $inventory;
        $this->inventoryDAO= $inventoryDAO;
    }

  	public function insertRecord()
  	{
  		if (isset($_GET["submitInventoryCreate"]))
      {
      $this->inventory->setSKUNumber($_GET["sKUNumber"]);
      $this->inventory->setProductName($_GET["productName"]);
      $this->inventory->setProductionCompanyName($_GET["productionCompanyName"]);
      $this->inventory->setAction($_GET["action"]);
      $this->inventory->setChildren($_GET["children"]);
      $this->inventory->setComedy($_GET["comedy"]);
      $this->inventory->setDocumentary($_GET["documentary"]);
      $this->inventory->setDrama($_GET["drama"]);
      $this->inventory->setHorror($_GET["horror"]);
      $this->inventory->setMusicals($_GET["musicals"]);
      $this->inventory->setRomance($_GET["romance"]);
      $this->inventory->setScienceFiction($_GET["scienceFiction"]);
      $this->inventory->setThriller($_GET["thriller"]);
      $this->inventory->setBarCodeNumber($_GET["barCodeNumber"]);
      $this->inventory->setDateAcquired($_GET["dateAcquired"]);
      $this->inventory->setCondition($_GET["condition"]);
      $this->inventory->setGenreErr($this->inventory->getAction(), $this->inventory->getChildren(), $this->inventory->getComedy(), $this->inventory->getDocumentary(), $this->inventory->getDrama(), $this->inventory->getHorror(), $this->inventory->getMusicals(), $this->inventory->getRomance(), $this->inventory->getScienceFiction(), $this->inventory->getThriller());
    
      if($this->inventory->formInventoryCreateCheck($this->inventory->getSKUNumber(), $this->inventory->getProductName(), $this->inventory->getProductionCompanyName(), $this->inventory->getBarCodeNumber(), $this->inventory->getDateAcquired(), $this->inventory->getCondition(), $this->inventory->getSKUNumberErr(), $this->inventory->getProductNameErr(), $this->inventory->getProductionCompanyNameErr(), $this->inventory->getGenreErr(), $this->inventory->getBarCodeNumberErr(), $this->inventory->getDateAcquiredErr(), $this->inventory->getConditionErr())=="FORM COMPLETE")
      {
        $this->inventoryDAO->createInventoryRecord($this->inventory, $this->inventory->getSKUNumber(), $this->inventory->getProductName(), $this->inventory->getProductionCompanyName(), $this->inventory->getAction(), $this->inventory->getChildren(), $this->inventory->getComedy(), $this->inventory->getDocumentary(), $this->inventory->getDrama(), $this->inventory->getHorror(), $this->inventory->getMusicals(), $this->inventory->getRomance(), $this->inventory->getScienceFiction(), $this->inventory->getThriller(), $this->inventory->getBarCodeNumber(), $this->inventory->getDateAcquired(), $this->inventory->getCondition());
      }
      }
  	}//functionClose

}//class end
?>