<?php

class User {

    /**
     * This user's username.
     * @var String $username
     */
    private $username;

    /**
     * This user's password
     * @var String $password
     */
    private $password;

    /**
     * JSON-format string containing profile info
     * @var String $profileInfo
     */
    private $profileInfo;

    /**
     * Constructor
     * @param String $username   Username for user.
     * @param String $password   Password for user.
     */
    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
        $this->profileInfo = '{"name": "", "contact": ""}';
    }

    /**
     * Get @var $username
     * @return String $username
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Get @var $password
     * @return String $password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set @var $profileInfo
     * @param String $info
     */
    public function setProfile($info) {
        $this->profileInfo = $info;
    }

    /**
     * Get @var $profileInfo
     * @return String
     */
    public function getProfile() {
        return $this->profileInfo;
    }


}