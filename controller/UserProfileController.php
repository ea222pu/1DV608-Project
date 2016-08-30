<?php

class UserProfileController implements iController {

	/**
	 * @var \view\UserProfileView
	 */
	private $userProfileView;

	/**
	 * Constructor
	 * @param \view\UserProfileView 	$userProfileView
	 */
	public function __construct(UserProfileView $userProfileView) {
		$this->userProfileView = $userProfileView;
	}

	/**
	 * Handle user input
	 */
	public function listen() {
	}

	/**
	 * Calls \view\UserProfileView to set correct user profile to be rendered.
	 */
	public function setUserProfile($user) {
		$this->userProfileView->setUser($user);
	}
}