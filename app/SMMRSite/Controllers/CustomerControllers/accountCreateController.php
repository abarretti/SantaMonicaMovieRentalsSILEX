<?php namespace SMMRSite\Controllers\CustomerControllers;

use SMMRSite\Models\CustomerModels\CustomerClass;
use SMMRSite\Models\CustomerModels\CustomerDAOClass;

class AccountCreateController
{
    private $customer;
    private $customerDAO;

    public function __construct(CustomerClass $customer, CustomerDAOClass $customerDAO)
    {
        $this->customer= $customer;
        $this->customerDAO= $customerDAO;
    }

  	public function insertRecord()
  	{
      if(isset($_GET["accountCreate"]))
      {
  		$this->customer->setFirstName($_GET["firstName"]);
      $this->customer->setLastName($_GET["lastName"]);
      $this->customer->setDateOfBirth($_GET["dateOfBirth"]);
      $this->customer->setGender($_GET["gender"]);
      $this->customer->setAddress1($_GET["address1"]);
      $this->customer->setAddress2($_GET["address2"]);
      $this->customer->setCity($_GET["city"]);
      $this->customer->setState($_GET["state"]);
      $this->customer->setPhoneNumber($_GET["phoneNumber"]);
      $this->customer->setEmailAddress($_GET["eMail"]);  
      $this->customer->setPassword($_GET["password"],$_GET["passwordRepeat"]);
      $this->customer->setAction($_GET["action"]);
      $this->customer->setChildren($_GET["children"]);
      $this->customer->setComedy($_GET["comedy"]);
      $this->customer->setDocumentary($_GET["documentary"]);
      $this->customer->setDrama($_GET["drama"]);
      $this->customer->setHorror($_GET["horror"]);
      $this->customer->setMusicals($_GET["musicals"]);
      $this->customer->setRomance($_GET["romance"]);
      $this->customer->setScienceFiction($_GET["scienceFiction"]);
      $this->customer->setThriller($_GET["thriller"]);
      $this->customer->setNotes($_GET["notes"]);
    
    //Database Insert
   if ($this->customer->formCustomerCreateCheck($this->customer->getFirstNameErr(), $this->customer->getLastNameErr(), $this->customer->getGenderErr(), $this->customer->getAddress1Err(), $this->customer->getCityErr(), $this->customer->getStateErr(), $this->customer->getPhoneNumberErr(), $this->customer->getEMailErr(), $this->customer->getPasswordErr(), $this->customer->getPasswordRepeatErr(), $this->customer->getFirstName(), $this->customer->getLastName(), $this->customer->getGender(), $this->customer->getAddress1(), $this->customer->getCity(), $this->customer->getState(), $this->customer->getEMailAddress(), $this->customer->getPassword(), $this->customer->getPasswordRepeat())=="FORM COMPLETE")
    {
    return $this->customerDAO->createCustomerRecord($this->customer->getFirstName(), $this->customer->getLastName(),$this->customer->getDateOfBirth(), $this->customer->getGender(), $this->customer->getAddress1(), $this->customer->getAddress2(), $this->customer->getCity(), $this->customer->getState(), $this->customer->getPhoneNumber(), $this->customer->getEmailAddress(), $this->customer->getPassword(), $this->customer->getAction(), $this->customer->getChildren(), $this->customer->getComedy(), $this->customer->getDocumentary(), $this->customer->getDrama(), $this->customer->getHorror(), $this->customer->getMusicals(), $this->customer->getRomance(), $this->customer->getScienceFiction(), $this->customer->getThriller(), $this->customer->getNotes());
		}
    }
  	}//functionClose

}//class end
?>