<?php

require_once('model/User.php');

class UserDAL {

	/**
	 * Name of the table where the user data is stored in the database.
	 * @var String $table
	 */
	private $table = "users";

	/**
	 * Name of the column where usernames are stored in the database.
	 * @var String $usernameCol
	 */
	private $usernameCol = "username";

	/**
	 * Name of the column where profile information is stored in the database.
	 * @var String $profileinfoCol
	 */
	private $profileinfoCol = "profileinfo";

	/**
	 * Name of the column where passwords are stored in the database.
	 * @var String $passwordCol
	 */
	private $passwordCol = "password";

	/**
	 * @var \model\Database $database
	 */
	private $database;

	/**
	 * Constructor
	 * @param \model\Database $db
	 */
	public function __construct(Database $db) {
		$this->database = $db;
	}

	/**
	 * Find user in database using username.
	 * Used for login and registration.
	 *
	 * @param  String $username    		The username being searched for.
	 * @return boolean | \model\User    False if $username does not exist in
	 *                   				database, else User.
	 */
	public function findUserByUsername($username) {
		$sqli = $this->database->connect();
		$stmt = $sqli->prepare("SELECT * FROM " . $this->table);

		if($stmt === FALSE) {
			throw new Exception($sqli->error);
		}

		$stmt->execute();
		$stmt->bind_result($dbUsername, $dbPassword, $dbProfileInfo);
		while($stmt->fetch()) {
			if($dbUsername === $username) {
				$user = new User($dbUsername, $dbPassword);
				$user->setProfile($dbProfileInfo);
				return $user;
			}
		}
		return false;
	}

	/**
	 * Add user to the database.
	 * User for registration.
	 *
	 * @param \model\User $user The user to be added to the database
	 */
	public function add(User $user) {
		$sqli = $this->database->connect();
		$stmt = $sqli->prepare("INSERT INTO " . $this->table . "(" . $this->usernameCol . ", " . $this->passwordCol . ", " . $this->profileinfoCol . ") VALUES (?, ?, ?)");

		if($stmt === FALSE) {
			throw new Exception($sqli->error);
		}

		$username = $user->getUsername();
		$password = $user->getPassword();
		$profileinfo = $user->getProfile();

		$stmt->bind_param('sss', $username, $password, $profileinfo);
		$stmt->execute();
	}

	/**
	 * Search for a user in the database, and users with similar names.
	 *
	 * @param  String $username 	The search term.
	 * @return \model\User | array 	User if match has been found,
	 *                       		else an array of users with similar names.
	 */
	public function searchForUser($username) {
		$searchResult = array();
		$sqli = $this->database->connect();
		$stmt = $sqli->prepare("SELECT * FROM " . $this->table . " WHERE " . $this->usernameCol . " LIKE '%" . $username . "%'");

		if($stmt === false) {
			throw new Exception($sqli->error);
		}

		$stmt->execute();
		$stmt->bind_result($dbUsername, $dbPassword, $dbProfileInfo);
		while($stmt->fetch()) {
			if($username === $dbUsername) {
				$user = new User($dbUsername, $dbPassword);
				$user->setProfile($dbProfileInfo);
				return $user;
			}
			else {
				$user = new User($dbUsername, $dbPassword);
				$user->setProfile($dbProfileInfo);
				$searchResult[] = $user;
			}
		}
		return $searchResult;
	}

	/**
	 * Update user information
	 * @param  String $username 	The user that will be updated.
	 * @param  String $info     	String in JSON-format to be stored in the database.
	 */
	public function updateUser($username, $info) {
		$sqli = $this->database->connect();
		$stmt = $sqli->prepare("UPDATE " . $this->table . " SET " . $this->profileinfoCol . "='" . $info . "' WHERE " . $this->usernameCol . "='" . $username . "'");

		if($stmt === FALSE) {
			throw new Exception($sqli->error);
		}

		$stmt->execute();
	}

}