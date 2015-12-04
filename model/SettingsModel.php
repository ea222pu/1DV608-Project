<?php

class SettingsModel {

	/**
	 * @var \model\UserDAL $dal
	 */
	private $dal;

	/**
	 * Constructor
	 * @param UserDAL $dal
	 */
	public function __construct(UserDAL $dal) {
		$this->dal = $dal;
	}

	/**
	 * Used to update the logged in user's information (name, contact).
	 *
	 * @param  String $name
	 * @param  String $contact
	 */
	public function updateUserProfile($name, $contact) {
		$newInfo = json_encode(array('name' => $name, 'contact' => $contact));
		$_SESSION['user']->setProfile($newInfo);
		$username = $_SESSION['user']->getUsername();
		$this->dal->updateUser($username, $newInfo);
	}

}