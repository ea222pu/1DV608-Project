<?php

class RegisterView implements iView {

    /**
     * @var String $register
     */
    private static $register = 'RegisterView::Register';

    /**
     * @var String $messageId
     */
    private static $messageId = 'RegisterView::Message';

    /**
     * @var String $username
     */
    private static $username = 'RegisterView::Username';

    /**
     * @var String $password
     */
    private static $password = 'RegisterView::Password';

    /**
     * @var String $passwordRepeat
     */
    private static $passwordRepeat = 'RegisterView::PasswordRepeat';

    /**
     * @var String $name
     */
    private static $name = 'RegisterView::Name';

    /**
     * @var String $contact
     */
    private static $contact = 'RegisterView::Contact';

    /**
     * @var String $successfulRegister
     */
    public static $successfulRegister = 'RegisterView::SuccessfulRegister';

    /**
     * Used for remembering the username during registration attempt.
     *
     * @var String $rememberName
     */
    private $rememberName;

    /**
     * The message being displayed in the register form.
     *
     * @var String $message
     */
    private $message;

    /**
     * @var \model\RegisterModel $regModel
     */
    private $regModel;

    /**
     * Constructor
     */
    public function __construct() {
        
    }

    /**
     * Generates the register form.
     *
     * @return String HTML-code
     */
    public function response() {
        return '
            <h2>Register new user</h2>
            <form method="post">
                <fieldset>
                    <legend>Register a new user - Write username and password</legend>
                    <p id="' . self::$messageId . '">' . $this->message . '</p>

                    <label for="' . self::$username . '">Username: </label>
                    <input type="text" id="' . self::$username . '" name="' . self::$username . '" value="' . strip_tags($this->rememberName) . '" />
                    <br>
                    <label for="' . self::$password . '">Password: </label>
                    <input type="password" id="' . self::$password . '" name="' . self::$password . '" />
                    <br>
                    <label for="' . self::$passwordRepeat . '">Repeat password: </label>
                    <input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />
                    <br>
                    <label for="' . self::$name .'">Name: </label>
                    <input type="text" id="' . self::$name . '" name="' . self::$name . '" />
                    <br>
                    <label for="' . self::$contact . '">Contact: </label>
                    <input type="text" id="' . self::$contact . '" name="' . self::$contact . '" />
                    <br>
                    <input type="submit" name="' . self::$register . '" value="Register"/>
                </fieldset>
            </form>
        ';
    }

    /**
     * Generates the link for returning back to \view\LoginView from \view\RegisterView.
     *
     * @return String HTML-code
     */
    public function generateBackToLoginLink() {
        return "<a href='?'>Back to login</a>";
    }

    /**
     * Check if register button has been pressed.
     * Sets $rememberName to the requested username.
     *
     * @return boolean
     */
    public function registerButtonPost() {
        if(isset($_POST[self::$register])) {
            $this->rememberName = $_POST[self::$username];
        }
        return isset($_POST[self::$register]);
    }

    /**
     * Returns the username used for registration.
     *
     * @return String
     */
    public function getUsername() {
        return $_POST[self::$username];
    }

    /**
     * Returns the password used for registration.
     * @return String
     */
    public function getPassword() {
        return $_POST[self::$password];
    }

    /**
     * Returns the repeated password used for registration.
     * @return String
     */
    public function getPasswordRepeat() {
        return $_POST[self::$passwordRepeat];
    }

    /**
     * Returns the name used for registration
     * @return String
     */
    public function getName() {
        return $_POST[self::$name];
    }

    /**
     * Returns the contact information used for registration
     * @return String
     */
    public function getContact() {
        return $_POST[self::$contact];
    }

    /**
     * Set message.
     */
    public function setMsgUsernameAndPasswordException() {
        $this->message = 'Username has too few characters, at least 3 characters.
                        <br>Password has too few characters, at least 6 characters.';
    }

    /**
     * Set message.
     */
    public function setMsgPassWordLengthException() {
        $this->message =  'Password has too few characters, at least 6 characters.';
    }

    /**
     * Set message.
     */
    public function setMsgUsernameLengthException() {
        $this->message = 'Username has too few characters, at least 3 characters.';
    }

    /**
     * Set message.
     */
    public function setMsgPasswordMismatchException() {
        $this->message = 'Passwords do not match.';
    }

    /**
     * Set message.
     */
    public function setMsgUserExistsException() {
        $this->message = 'User exists, pick another username.';
    }

    /**
     * Set message.
     */
    public function setMsgInvalidCharacterException() {
        $this->message = 'Username contains invalid characters.';
    }

    /**
     * Redirects back to \view\LoginView.
     */
    public function redirectToLogin() {
        setcookie(self::$successfulRegister, true, time()+3600);
        header("Location: ?");
    }

}