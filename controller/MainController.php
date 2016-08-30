<?php

require_once('controller/iController.php');

class MainController implements iController {

	/**
	 * @var \controller\RegisterController $regCtrlr
	 */
	private $regCtrlr;

	/**
	 * @var \controller\LoginController $logCtrlr
	 */
	private $logCtrlr;

	/**
	 * @var \controller\SearchController $searchController
	 */
	private $searchController;

	/**
	 * @var \controller\UserProfileController $userProfileController
	 */
	private $userProfileController;

	/**
	 * @var \controller\SettingsController $settingsController
	 */
	private $settingsController;

	/**
	 * @var \view\LayoutView $layoutView
	 */
	private $layoutView;

	/**
	 * @var \view\SettingsView
	 */
	private $settingsView;

	/**
	 * @var \model\SearchModel $searchModel
	 */
	private $searchModel;

	/**
	 * @var boolean $renderRegView
	 */
	private $renderRegView;

	/**
	 * @var boolean $renderSearchView
	 */
	private $renderSearchView;

	/**
	 * @var boolean $renderSettingsView
	 */
	private $renderSettingsView;

	/**
	 * @var boolean $renderMyProfile
	 */
	private $renderMyProfile;

	/**
	 * Constructor
	 * @param \controller\RegisterController 	 $registerController
	 * @param \controller\LoginController    	 $loginController
	 * @param \controller\SearchController 	 	 $searchController
	 * @param \controller\UserProfileController  $userProfileController
	 * @param \controller\SettingsController  	 $settingsController
	 * @param \view\LayoutView  			 	 $layoutView
	 */
	public function __construct(RegisterController $registerController, LoginController $loginController,
		SearchController $searchController, UserProfileController $userProfileController,
		SettingsController $settingsController, LayoutView $layoutView, SettingsView $settingsView) {

		$this->regCtrlr = $registerController;
		$this->logCtrlr = $loginController;
		$this->searchController = $searchController;
		$this->userProfileController = $userProfileController;
		$this->settingsController = $settingsController;
		$this->layoutView = $layoutView;
		$this->settingsView = $settingsView;
		$this->renderRegView = false;
		$this->renderSeachView = false;
		$this->renderMyProfile = false;
	}

	/**
	 * Handle user input
	 */
	public function listen() {
		if($this->regCtrlr->registerLinkPressed()) {
			$this->regCtrlr->listen();

			$this->renderRegView = true;
			$this->renderSearchView = false;
			$this->renderMyProfile = false;
			$this->renderSettingsView = false;
		}
		else if($this->layoutView->searchButtonPost()) {
			try {
				$usernameSearch = $this->layoutView->getUserSearchTerm();
				$this->searchController->searchUser($usernameSearch);
				$this->searchController->listen();

				$this->renderSearchView = true;
				$this->renderRegView = false;
				$this->renderMyProfile = false;
				$this->renderSettingsView = false;
			} catch(SUsernameMissingException $e) {
				$this->layoutView->setSearchMsgUsernameMissing();
			} catch(SInvalidCharactersException $e) {
				$this->layoutView->setSearchMsgInvalidCharacters();
			}
		}
		else if($this->layoutView->logoutButtonPost()) {
			$this->logCtrlr->logout();
		}
		else if($this->layoutView->myProfileButtonPost()) {
			$this->userProfileController->setUserProfile(null);
			$this->userProfileController->listen();

			$this->renderMyProfile = true;
			$this->renderRegView = false;
			$this->renderSearchView = false;
			$this->renderSettingsView = false;
		}
		else if($this->layoutView->settingsButtonPost()) {
			$this->settingsController->listen();
			$this->renderSettingsView = true;
			$this->renderMyProfile = false;
			$this->renderRegView = false;
			$this->renderSearchView = false;
			/*
			if($this->settingsController->renderProfileView()) {
				var_dump("Profile from settings (nested)");
				$this->userProfileController->setUserProfile(null);
				$this->userProfileController->listen();
				$this->renderMyProfile = true;
				$this->renderRegView = false;
				$this->renderSearchView = false;
				$this->renderSettingsView = false;
			}
			*/
		}
		// Ny: 24/8
		else if($this->settingsView->saveButtonPost()) {
			$this->settingsController->saveChanges();
			$this->renderRegView = false;
			$this->renderSearchView = false;
			$this->renderMyProfile = false;
			$this->renderSettingsView = false;
		}
		else {
			$this->logCtrlr->listen();
			$this->renderRegView = false;
			$this->renderSearchView = false;
			$this->renderMyProfile = false;
			$this->renderSettingsView = false;
		}
	}

	/**
	 * Returns true if user has clicked the
	 * 'Register a new user' link.
	 *
	 * @return boolean
	 */
	public function renderRegView() {
		return $this->renderRegView;
	}

	/**
	 * Returns true if user has clicked the
	 * 'Search' button.
	 *
	 * @return boolean
	 */
	public function renderSearchView() {
		return $this->renderSearchView;
	}

	/**
	 * Return true if user has clicked the
	 * 'My profile' button.
	 * @return boolean
	 */
	public function renderMyProfile() {
		return $this->renderMyProfile;
	}

	/**
	 * Return true if user has clicked the
	 * 'Settings' button
	 * @return boolean
	 */
	public function renderSettingsView() {
		return $this->renderSettingsView;
	}

}