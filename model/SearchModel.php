<?php

//Require exceptions
require_once('exceptions/SUsernameMissingException.php');
require_once('exceptions/SInvalidCharactersException.php');

class SearchModel {

	/**
	 * @var \model\UserDAL $dal
	 */
	private $dal;

	/**
	 * @var \model\User | array $searchResult
	 */
	private $searchResult;

	/**
	 * @var boolean $foundMatch
	 */
	private $foundMatch;

	/**
	 * Constructor
	 * @param \model\UserDAL $userDAL
	 */
	public function __construct(UserDAL $userDAL) {
		$this->dal = $userDAL;
		$this->foundMatch = false;
	}

	/**
	 * Search for input username in the database.
	 *
	 * @param  String $username 	Input search term.
	 *
	 * @throws SUsernameMissingException	When search field is empty.
	 * @throws SInvalidCharactersException	When $username contains invalid characters.
	 */
	public function searchUser($username) {
		if(strlen($username) < 1) {
			throw new SUsernameMissingException();
		}
		else if(preg_match("/^[0-9A-Za-z_]+$/", $username) == 0) {
			throw new SInvalidCharactersException();
		}
		else {
			$this->searchResult = $this->dal->searchForUser($username);
			if($this->searchResult instanceof User) {
				$this->foundMatch = true;
			}
			else {
				$this->foundMatch = false;
			}
		}
	}

	/**
	 * Returns true if a match has been found, else false.
	 * @return boolean
	 */
	public function foundMatch() {
		return $this->foundMatch;
	}

	/**
	 * Returns the search result.
	 *
	 * @return \model\User | array 		User if match has been found,
	 *                       			else an array of users with similar usernames.
	 */
	public function getSearchResult() {
		return $this->searchResult;
	}
}