<?php

class UserProfileView implements iView {

	/**
	 * User to be displayed
	 * @var \model\User
	 */
	private $user;

	/**
	 * Generate user profile
	 * @return String   	HTML-code
	 */
	public function response() {
		return
			'<h1>' . $this->user->getUsername() . '</h1>
			' . $this->setInfo();
	}

	/**
	 * Set @var User. If @param $user is null, render the logged in users profile,
	 * else the @param $user profile.
	 * @param \model\User $user | null
	 */
	public function setUser($user) {
		if($user === null) {
			$this->user = $_SESSION['user'];
		}
		else {
			$this->user = $user;
		}
	}

	/**
	 * Decode the profile info JSON and return as HTML-code.
	 * @return  String   	HTML-code
	 */
	private function setInfo() {
		$info = json_decode($this->user->getProfile(), true);
		return '<p><b>Name: </b>' . $info['name'] . '</p>
				<p><b>Contact: </b>' . $info['contact'] . '</p>';
		}
}