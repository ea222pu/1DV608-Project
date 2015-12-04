<?php

class LayoutView {

	/**
	 * @var String $searchTerm
	 */
	private static $searchTerm = 'LayoutView::SearchTerm';

	/**
	 * @var String $search
	 */
	private static $search = 'LayoutView::Search';

	/**
	 * @var String $logout
	 */
	private static $logout = 'LayoutView::Logout';

	/**
	 * @var String $myProfile
	 */
	private static $myProfile = 'LayoutView::MyProfile';

	/**
	 * @var String $mySettings
	 */
	private static $mySettings = 'LayoutView::Settings';

	/**
	 * @var String $messageId
	 */
	private static $messageId = 'LayoutView::Message';

	/**
	 * @var String $searchMessage
	 */
	private $searchMessage = '';

	/**
	 * Render the HTML code
	 * @param  boolean 		$isLoggedIn
	 * @param  \view\iView  $v 			Any view-class that implements the \view\iView interface.
	 */
	public function render($isLoggedIn, iView $v) {
		echo '<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8">
					<title>Project</title>
				</head>
				<body>
					<form method="post">
						<div style="height: 50px; text-align: center;">
							<label for="' . self::$searchTerm . '">Search for user: </label>
							<input type="text" id="' . self::$searchTerm .'" name="' . self::$searchTerm .'"/>
							<input type="submit" name="' . self::$search .'" value="Search"/>' .
							$this->renderMyProfileButton($isLoggedIn) .
							$this->renderSettingsButton($isLoggedIn) .
							$this->renderLogoutButton($isLoggedIn) . '
							<p id="' . self::$messageId . '">' . $this->searchMessage .'</p>
						</div>
					</form>
					<div class="container">
							' . $v->response() . '

							' . $this->renderRegisterLink($isLoggedIn, $v) . '
					</div>
				 </body>
			</html>
		';
	}

	/**
	 * Renders correct link based on what view is displayed to the user.
	 *
	 * @param  boolean $isLoggedIn
	 * @param  \view\iView $v 	  \view\LoginView or \view\RegisterView
	 * @return String | null      Correct link based on $v, else null.
	 */
	private function renderRegisterLink($isLoggedIn, $v) {
		if(!$isLoggedIn && $v instanceof LoginView) {
			return $v->generateRegisterLink();
		}
		else if($v instanceof RegisterView) {
			return $v->generateBackToLoginLink();
		}
		else {
			return null;
		}
	}

	/**
	 * Cheack if 'Search' button has been pressed.
	 * @return boolean 		True if button has been pressed, else false.
	 */
	public function searchButtonPost() {
		return isset($_POST[self::$search]);
	}

	/**
	 * Get the input search term from the search field.
	 * @return String
	 */
	public function getUserSearchTerm() {
		return $_POST[self::$searchTerm];
	}

	/**
	 * Render the 'My profile' button if the user is logged in.
	 * @param  boolean $isLoggedIn
	 * @return String | null 		Returns HTML-code if $isLoggedIn is true, else null.
	 */
	private function renderMyProfileButton($isLoggedIn) {
		if($isLoggedIn) {
			return '<input type="submit" name="' . self::$myProfile . '" value="My profile" />';
		}
		else {
			return null;
		}
	}

	/**
	 * Check uf 'My profile' button has been pressed.
	 * @return boolean		True if buttons has been pressed, else false.
	 */
	public function myProfileButtonPost() {
		return isset($_POST[self::$myProfile]);
	}

	/**
	 * Render the 'Logout' button if the user is logged in.
	 * @param  boolean $isLoggedIn
	 * @return String | null 		Returns HTML-code if $isLoggedIn is true, else null.
	 */
	private function renderLogoutButton($isLoggedIn) {
		if($isLoggedIn) {
			return '<input type="submit" name="' . self::$logout . '" value="Logout" />';
		}
		else {
			return null;
		}
	}

	/**
	 * Check if 'Logout' button has been pressed.
	 * @return boolean		True if button has been pressed, else false.
	 */
	public function logoutButtonPost() {
		return isset($_POST[self::$logout]);
	}

	/**
	 * Render the 'Settings' button if the user is logged in.
	 * @param  boolean $isLoggedIn
	 * @return String | null 		Returns HTML-code if $isLoggedIn is true, else null.
	 */
	public function renderSettingsButton($isLoggedIn) {
		if($isLoggedIn) {
			return '<input type="submit" name="' . self::$mySettings . '" value="Settings" />';
		}
		else {
			return null;
		}
	}

	/**
	 * Check if 'Settings' button has been pressed.
	 * @return boolean  	True if button has been pressed, else false.
	 */
	public function settingsButtonPost() {
		return isset($_POST[self::$mySettings]);
	}

	/**
	 * Set message
	 */
	public function setSearchMsgUsernameMissing() {
		$this->searchMessage = 'Username missing';
	}

	/**
	 * Set message
	 */
	public function setSearchMsgInvalidCharacters() {
		$this->searchMessage = 'Username contains invalid characters';
	}

}
