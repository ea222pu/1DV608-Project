<?php

class SettingsController implements iController {

	/**
	 * @var \view\SettingsView $settingsView
	 */
	private $settingsView;

	/**
	 * @var \model\SettingsModel $settingsModel
	 */
	private $settingsModel;

	/**
	 * @var boolean $renderProfileView
	 */
	private $renderProfileViewVar;

	/**
	 * Constructor
	 * @param \view\SettingsView  	$settingsView
	 * @param \model\SettingsModel 	$settingsModel
	 */
	public function __construct(SettingsView $settingsView, SettingsModel $settingsModel) {
		$this->settingsView = $settingsView;
		$this->settingsModel = $settingsModel;
		$this->renderProfileViewVar = false;
	}

	/**
	 * Handle user input
	 */
	public function listen() {
		$this->settingsView->setUserInfo();

		if($this->settingsView->saveButtonPost()) {
			$name = $this->settingsView->getName();
			$contact = $this->settingsView->getContact();
			$this->settingsModel->updateUserProfile($name, $contact);
			$this->renderProfileViewVar = true;
		}
		else {
			$this->renderProfileViewVar = false;
		}
	}

	public function saveChanges() {
		$name = $this->settingsView->getName();
		$contact = $this->settingsView->getContact();
		$this->settingsModel->updateUserProfile($name, $contact);
	}

	/**
	 * Returns true if the user have pressed the
	 * 'Save' button, else false.
	 *
	 * @return boolean
	 */
	public function renderProfileView() {
		return $this->renderProfileViewVar;
	}

}