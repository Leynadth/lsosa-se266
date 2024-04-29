<?php
// This is the base class for checking and savings accounts
// It is declared **abstract** so that it can not be instantiated
// Child classes must be derived that 
// implement the withdrawal and getAccountDetails methods

/* Note:
	You should implement all other methods in the class
*/

abstract class Account 
{
	protected $accountId;
	protected $balance;
	protected $startDate;
	
	public function __construct ($id, $bal, $startDt) 
	{
		$this->accountId = $id;
		$this->balance = $bal;
		$this->startDate = $startDt;
	} // end constructor
	


	public function deposit ($amount) 
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

	// Display AccountID, Balance and StartDate in a nice format
	protected function getAccountDetails()
	{
		$accountDetails = "";
		$accountDetails  .= "<p><span style='font-weight: 900;'>Account ID:</span>" .  $this->getAccountId() . "</p>";
		$accountDetails  .= "<p><span style='font-weight: 900;'>Balance:</span>" .  $this->getBalance() . "</p>";
		$accountDetails  .= "<p><span style='font-weight: 900;'>Start Date:</span>" .  $this->getStartDate() . "</p>";
		
		return $accountDetails;	
	} // end getAccountDetails
	
} // end account

?>
