<?php

class SettingsView implements iView {

	/**
	 * @var String $name
	 */
	private static $name = 'SettingsView::Name';

	/**
	 * @var String $contact
	 */
	private static $contact = 'SettingsView::Contact';

	/**
	 * @var String $save
	 */
	private static $save = 'SettingsView::Save';

	/**
	 * Current name data stored in $_SESSION['users']
	 * @var String
	 */
	private $nameS;

	/**
	 * Current contact data stored in $_SESSION['users']
	 * @var String
	 */
	private $contactS;

	/**
     * Generates the settings form.
     *
     * @return String HTML-code
     */
	public function response() {
		return '
			<form method="post">
				<label for="' . self::$name . '">Name: </label>
				<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->nameS . '" />

				<label for="' . self::$contact . '">Contact: </label>
				<input type="text" id="' . self::$contact . '" name="' . self::$contact . '" value="' . $this->contactS . '" />

				<input type="submit" name="' . self::$save . '" value="Save" />
			</form>
		';
	}

	/**
	 * Fills the text fields with the current information.
	 */
	public function setUserInfo() {
		$sessionUser = json_decode($_SESSION['user']->getProfile(), true);
		$this->nameS = $sessionUser['name'];
		$this->contactS = $sessionUser['contact'];
	}

	/**
	 * Check if 'Save' button has been pressed.
	 * @return boolean		True if button has been pressed, else false.
	 */
	public function saveButtonPost() {
		return isset($_POST[self::$save]);
	}

	/**
	 * Get contact from text field.
	 * @return String
	 */
	public function getContact() {
		return $_POST[self::$contact];
	}

	/**
	 * Get name from text field.
	 * @return String
	 */
	public function getName() {
		return $_POST[self::$name];
	}
	
}