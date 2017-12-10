<?php

class InventoryCreateView
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
		<h1>Create Inventory/Product</h1>
		<h2 class="error">* required field.</h2>
		<form action= "'.htmlspecialchars($_SERVER["PHP_SELF"]).'?action=inventoryCreate" autocomplete="on" method="post">
			<fieldset>
				<legend>Product Information</legend>
				SKU Number:
				<input type="text" name="sKUNumber" value="'.$this->inventory->getSKUNumber().'">	
				<span class="error">* '.$this->inventory->getSKUNumberErr().'</span>
				<br><br>
				Product Name: 
				<input type="text" name="productName" value="'.$this->inventory->getProductName().'">	
				<span class="error">* '.$this->inventory->getProductNameErr().'</span>
				<br><br>
				Production Company Name: 
				<select name="productionCompanyName">
				'.$this->inventoryDAO->getCompanyNames($this->inventory->getProductionCompanyName()).'
				</select>
				<span class="error">* '.$this->inventory->getProductionCompanyNameErr().'</span>
				<br><br>
				Product Genres:<br>
				'.$this->inventoryDAO->getGenres($this->inventory->getAction(), $this->inventory->getChildren(), $this->inventory->getComedy(), $this->inventory->getDocumentary(), $this->inventory->getDrama(), $this->inventory->getHorror(), $this->inventory->getMusicals(), $this->inventory->getRomance(), $this->inventory->getScienceFiction(), $this->inventory->getThriller()).'
				<span class="error">* '.$this->inventory->getGenreErr().'</span>
				<br>
			</fieldset>
			<fieldset>
				<legend>Inventory Information</legend>
				Barcode Number:
				<input type="text" name="barCodeNumber" value="'.$this->inventory->getBarCodeNumber().'">	
				<span class="error">* '.$this->inventory->getBarCodeNumberErr().'</span>
				<br><br>
				Date Acquired:
				<input type="date" name="dateAcquired" value="'.$this->inventory->getDateAcquired().'">
				<span class="error">* '.$this->inventory->getDateAcquiredErr().'</span>
				<br><br>
				Condition:
				<select name="condition">
					<option value="Excellent" '.($this->inventory->getCondition()=="Excellent"? 'selected':'').'>Excellent</option>
					<option value="Very Good" '.($this->inventory->getCondition()=="Very Good"? 'selected':'').'>Very Good</option>
					<option value="Good" '.($this->inventory->getCondition()=="Good"? 'selected':'').'>Good</option>
					<option value="Fair" '.($this->inventory->getCondition()=="Fair"? 'selected':'').'>Fair</option>
					<option value="Poor" '.($this->inventory->getCondition()=="Poor"? 'selected':'').'>Poor</option>
					<option value="Very Poor" '.($this->inventory->getCondition()=="Very Poor"? 'selected':'').'>Very Poor</option>
				</select>
				<span class="error">* '.$this->inventory->getConditionErr().'</span>
			</fieldset>
			<input type="submit" value="Submit">
			<input type="reset">
		</form>	
	</main>';
	}
}
?>
<!-- php Desktop/PHP/SantaMonicaMovieRentals/accountCreate.php -->