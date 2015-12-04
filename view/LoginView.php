<?php

class LoginView implements iView {

	/**
	 * @var String $login
	 */
	public static $login = 'LoginView::Login';

	/**
	 * @var String $name
	 */
	private static $name = 'LoginView::UserName';

	/**
	 * @var String $password
	 */
	private static $password = 'LoginView::Password';

	/**
	 * @var String $cookieName
	 */
	private static $cookieName = 'LoginView::CookieName';

	/**
	 * @var String $cookiePassword
	 */
	private static $cookiePassword = 'LoginView::CookiePassword';

	/**
	 * @var String $keep
	 */
	private static $keep = 'LoginView::KeepMeLoggedIn';

	/**
	 * @var String $messageId
	 */
	private static $messageId = 'LoginView::Message';

	/**
	 * @var String $rememberName
	 */
	private $rememberName = '';

	/**
	 * @var String $message
	 */
	private $message = '';

	/**
	 * @var String $register
	 */
	private $register = "register";

	/**
	* Constructor
	*/
	public function __construct() {

	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$response = '';
		$response = $this->generateLoginFormHTML($this->message);
		return $response;
	}

	/**
	 * Generate HTML code on the output buffer for the logout button
	 * @param $message, String output message
	 * @return  void, BUT writes to standard output!
	 */
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" >
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->rememberName . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />

					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}

	/**
	 * Generates the link for getting to the register form.
	 *
	 * @return String HTML-code
	 */
	public function generateRegisterLink() {
		return "<a href='?" . $this->register . "'>Register a new user</a>";
	}

	/**
	 * Check if register link has been pressed
	 *
	 * @return boolean
	 */
	public function registerLinkPressed() {
		return isset($_GET[$this->register]);
	}

	/**
	 * Returns the username entered by the user.
	 *
	 * @return String
	 */
	public function getUsername() {
		return $_POST[self::$name];
	}

	/**
	 * Returns the password entered by the user.
	 *
	 * @return String
	 */
	public function getPassword() {
		return $_POST[self::$password];
	}

	/**
	 * Check if user wants to user the 'Keep me logged in' function.
	 *
	 * @return boolean
	 */
	public function isSetPersistentLogin() {
		return isset($_POST[self::$keep]);
	}

	/**
	 * Returns the username stored in cookie.
	 *
	 * @return String
	 */
	public function getCookieName() {
		return $_COOKIE[self::$cookieName];
	}

	/**
	 * Returns the password stored in cookie.
	 *
	 * @return String
	 */
	public function getCookiePassword() {
		return $_COOKIE[self::$cookiePassword];
	}

	/**
	 * Check if cookies with login credentials are set
	 *
	 * @return boolean
	 */
	public function isCookiesSet() {
		if(isset($_COOKIE[self::$cookieName]) && isset($_COOKIE[self::$cookiePassword])) {
			return true;
		}
		return false;
	}

	/**
	 * Check if cookie with username stored is set.
	 * Used for remembering username after successful registration.
	 *
	 * @return boolean
	 */
	public function isCookieNameSet() {
		return isset($_COOKIE[self::$cookieName]);
	}

	/**
	 * Stores username in cookie.
	 * Used for remembering username after successful registration.
	 *
	 * @param String $username
	 */
	public function setCookieUsername($username) {
		setcookie(self::$cookieName, $username, time()+3600);
	}

	/**
	 * Sets username.
	 * Used for remembering username after successful registration.
	 * @param String $username
	 */
	public function setLoginName($username) {
		$this->rememberName = $username;
	}

	/**
	 * Check if login button has been pressed.
	 * Set cookies if requested.
	 * Also for remembering username from login attempt.
	 *
	 * @return boolean
	 */
	public function loginButtonPost() {
		if(isset($_POST[self::$login])) {
			$this->rememberName = $_POST[self::$name];
			if(isset($_POST[self::$keep])) {
				setcookie(self::$cookieName, $_POST[self::$name], time()+3600);
				setcookie(self::$cookiePassword, base64_encode($_POST[self::$password]), time()+3600);
			}
			return true;
		}
		return false;
	}

	/**
	 * Check if user resends information.
	 *
	 * @return boolean
	 */
	public function isPost() {
		return $_POST;
	}

	/**
	 * Used to repost page.
	 */
	public function redirect() {
		header('Location: ' . $_SERVER['REQUEST_URI']);
		exit;
	}

	/**
	 * Set message.
	 */
	public function setMsgWelcome() {
		$this->message = 'Welcome';
	}

	/**
	 * Set message.
	 */
	public function setMsgWelcomeAndRemembered() {
		$this->message = 'Welcome and you will be remembered';
	}

	/**
	 * Set message.
	 */
	public function setMsgRegistered() {
		$this->message = 'Registered new user.';
	}

	/**
	 * Set message.
	 */
	public function setMsgUsernameMissing() {
		$this->message = 'Username is missing';
	}

	/**
	 * Set message.
	 */
	public function setMsgPasswordMissing() {
		$this->message = 'Password is missing';
	}

	/**
	 * Set message.
	 */
	public function setMsgUsernameOrPassword() {
		$this->message = 'Wrong name or password';
	}

	/**
	 * Set message.
	 */
	public function setMsgWelcomeWithCookies() {
		$this->message = 'Welcome back with cookie';
	}

	/**
	 * Set message.
	 */
	public function setMsgWrongCookieInfo() {
		$this->message = 'Wrong information in cookies';
	}

	public function setMsgLogout() {
		$this->message = 'Bye bye!';
	}

	/**
	 * Check if has been set after successfull registration.
	 * Used for remembering username after successful registration.
	 *
	 * @return boolean
	 */
	public function isRegisteredCookieSet() {
		return isset($_COOKIE[RegisterView::$successfulRegister]);
	}

	/**
	 * Delete cookie set after successfull registration.
	 * Used for remembering username after successful registration.
	 */
	public function deleteRegisteredCookie() {
		setcookie(RegisterView::$successfulRegister, "", time()-3600);
	}

	/**
	 * Deletes cookies containing login credentials.
	 */
	public function deleteCredentialCookies() {
		if(isset($_COOKIE[self::$cookieName])) {
			setcookie(self::$cookieName, "", time()-3600);
		}
		if(isset($_COOKIE[self::$cookiePassword])) {
			setcookie(self::$cookiePassword, "", time()-3600);
		}
		$this->rememberName = '';
	}
}