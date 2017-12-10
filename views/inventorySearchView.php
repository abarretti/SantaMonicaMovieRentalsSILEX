<?php

class InventorySearchView
{
	private $inventory;
	private $inventoryDAO;

	public function __construct(Inventory $inventory, InventoryDAO $inventoryDAO)
	{
		$this->inventory= $inventory;
		$this->inventoryDAO= $inventoryDAO;
	}

	public function output()
	{
	return '<main>
		<h1>Search Inventory</h1>
		<h2 class="notice">* field is subject to input restrictions.</h2>
		<form action= "'.htmlspecialchars($_SERVER["PHP_SELF"]).'?action=inventorySearch" autocomplete="on" method="post">
			<fieldset>
				<legend>Search by Inventory or Product Information</legend>
				SKU Number: 
				<input type="text" name="sKUNumber" value="'.$this->inventory->getSKUNumber().'">
				<span class="notice">* '.$this->inventory->getSKUNumberErr().'</span>
				<br><br>
				Product Name: 
				<input type="text" name="productName" value="'.$this->inventory->getProductName().'">	
				<span class="notice">* '.$this->inventory->getProductNameErr().'</span>
				<br><br>
			</fieldset>
			<input type="submit" name="submitSKUProduct" value="Submit">
			<input type="reset">
		</form>
		<form action= "'.htmlspecialchars($_SERVER["PHP_SELF"]).'?action=inventorySearch" autocomplete="on" method="post">
			<fieldset>
			<legend>Search by Production Company Name or Genre</legend>
				Production Company Name:
				<select name="productionCompanyName">
				<option value="" '.($this->inventory->getProductionCompanyName()==""? 'selected':'').'></option>
				'.$this->inventoryDAO->getCompanyNames($this->inventory->getProductionCompanyName()).'
				</select>
				<br><br>
				Genre:<br>
				'.$this->inventoryDAO->getGenres($this->inventory->getAction(), $this->inventory->getChildren(), $this->inventory->getComedy(), $this->inventory->getDocumentary(), $this->inventory->getDrama(), $this->inventory->getHorror(), $this->inventory->getMusicals(), $this->inventory->getRomance(), $this->inventory->getScienceFiction(), $this->inventory->getThriller()).'
				<br><br>
			</fieldset>
				<input type="submit" name="submitProductionGenre" value="Submit">
				<input type="reset">
		</form>
	</main>';
	}
}
?>