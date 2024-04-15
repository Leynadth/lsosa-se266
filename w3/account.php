<?php
// This is the base class for checking and savings accounts
// It is declared **abstract** so that it can not be instantiated
// Child classes must be derived that 
// implement the withdrawal and getAccountDetails methods

/* Note:
	You should implement all other methods in the class
*/
require "./atm_starter.php";

abstract class Account 
{
	protected $accountId;
	protected $balance;
	protected $startDate;
	
	public function __construct($id, $bal, $startDt) 
	{
		$this->accountId = $id;
		$this->balance = $bal;
		$this->startDate = $startDt;
	}// end constructor
	
	public function deposit($amount) 
	{
		if ($amount > 0) {
			$this->balance += $amount;
			return true;
		} else {
			return false;
		}
	} // end deposit

	// This is an abstract method. 
	// This method must be defined in all classes
	// that inherit from this class
	abstract public function withdrawal($amount);
	
	public function getStartDate() 
	{
		return $this-> startDate;
	} // end getStartDate

	public function getBalance() 
	{
		return $this-> balance;
	} // end getBalance

	public function getAccountId() 
	{
		return $this-> accountId;
	} // end getAccountId
}

class aAccount extends Account 
{
	public function withdrawal($amount) 
	{
		if ($this->balance >= $amount) {
			$this->balance -= $amount;
			return true;
		} else {
			return false;
		}
	}

	public function getAccountDetails()
	{
		$accountDetails = "";
		$accountDetails .= "Account ID: " . $this->getAccountId() . "<br>";
		$accountDetails .= "Balance: " . $this->getBalance() . "<br>";
		$accountDetails .= "Start Date: " . $this->getStartDate() . "<br>";
		
		return $accountDetails;	
	}
}

$c = new aAccount('A123', 1000, '12-20-2019');
echo $c->getAccountDetails();
