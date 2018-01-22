<?php namespace SMMRSite\Controllers\InventoryControllers;

use SMMRSite\Models\InventoryModels\InventoryClass;
use SMMRSite\DAOs\InventoryDAOClass;

class InventorySearchController
{
    private $inventory;
    private $inventoryDAO;

    public function __construct(InventoryClass $inventory, InventoryDAOClass $inventoryDAO)
    {
        $this->inventory= $inventory;
        $this->inventoryDAO= $inventoryDAO;
    }

  	public function searchRecord()
  	{
    if ($_SERVER["REQUEST_METHOD"] == "GET") 
    {
        $this->inventory->setSKUNumberOptional($_GET["sKUNumber"]);
        $this->inventory->setProductNameOptional($_GET["productName"]);
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

        if (isset($_GET["submitSKUProduct"]) and $this->inventory->formInventorySearchCheck($this->inventory->getSKUNumberErr(), $this->inventory->getProductNameErr())=="FORM COMPLETE")
        {
          $this->inventoryDAO->productInventoryQuery($this->inventory, $this->inventory->getSKUNumber(), $this->inventory->getProductName());
        }
        
        if (isset($_GET["submitProductionGenre"]))
        {
          $this->inventoryDAO->companyGenreQuery($this->inventory, $this->inventory->getProductionCompanyName(), $this->inventory->getAction(), $this->inventory->getChildren(), $this->inventory->getComedy(), $this->inventory->getDocumentary(), $this->inventory->getDrama(), $this->inventory->getHorror(), $this->inventory->getMusicals(), $this->inventory->getRomance(), $this->inventory->getScienceFiction(), $this->inventory->getThriller());
        }
    }
  	}//functionClose

}//class end
?>