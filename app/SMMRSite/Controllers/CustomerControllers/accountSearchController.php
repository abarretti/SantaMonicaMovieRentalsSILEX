<?php namespace SMMRSite\Controllers\CustomerControllers;

use SMMRSite\Models\CustomerModels\CustomerClass;
use SMMRSite\Models\CustomerModels\CustomerDAOClass;

class AccountSearchController
{
    private $customer;
    private $customerDAO;

    public function __construct(CustomerClass $customer, CustomerDAOClass $customerDAO)
    {
        $this->customer= $customer;
        $this->customerDAO= $customerDAO;
    }

  	public function searchRecord()
  	{  
      $this->customer->setFirstNameOptional($_GET["firstName"]);
      $this->customer->setLastNameOptional($_GET["lastName"]);
      $this->customer->setDateOfBirth($_GET["dateOfBirth"]);
      $this->customer->setGenderOptional($_GET["gender"]);
      $this->customer->setAddress1Optional($_GET["address1"]);
      $this->customer->setCityOptional($_GET["city"]);
      $this->customer->setStateOptional($_GET["state"]);
      $this->customer->setPhoneNumber($_GET["phoneNumber"]);
      $this->customer->setEmailAddressOptional($_GET["eMail"]);
    
      if (isset($_GET["submitPersonal"]) and $this->customer->formCustomerPersonalSearchCheck($this->customer->getFirstNameErr(), $this->customer->getLastNameErr())=="FORM COMPLETE")
      { 
        //Personal Info Database Query
        return $this->customerDAO->personalInformationQuery($this->customer->getFirstName(), $this->customer->getLastName(), $this->customer->getDateOfBirth(), $this->customer->getGender());
      }

      if (isset($_GET["submitAddress"]) and $this->customer->formCustomerAddressSearchCheck($this->customer->getAddress1Err(), $this->customer->getCityErr(), $this->customer->getPhoneNumberErr())=="FORM COMPLETE")
      {
        //Address Info Database Query
        return $this->customerDAO->addressInformationQuery($this->customer->getAddress1(), $this->customer->getCity(), $this->customer->getState(), $this->customer->getPhoneNumber());
      }

      if (isset($_GET["submitEMail"]) and $this->customer->formCustomerEMailSearchCheck($this->customer->getEMailErr())=="FORM COMPLETE")
      {
        //Email Database Query
        return $this->customerDAO->eMailInformationQuery($this->customer->getEMailAddress()); 
      }
  	}//functionClose

}//class end
?>