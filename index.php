<?php

//INCLUDE THE FILES NEEDED...
//Model classes
require_once('model/LoginModel.php');
require_once('model/RegisterModel.php');
require_once('model/SearchModel.php');
require_once('model/SettingsModel.php');
require_once('model/UserDAL.php');
require_once('model/Database.php');

//View classes
require_once('view/iView.php');
require_once('view/LayoutView.php');
require_once('view/LoginView.php');
require_once('view/RegisterView.php');
require_once('view/SearchView.php');
require_once('view/UserProfileView.php');
require_once('view/SettingsView.php');

//Controller classes
require_once('controller/iController.php');
require_once('controller/LoginController.php');
require_once('controller/RegisterController.php');
require_once('controller/SearchController.php');
require_once('controller/UserProfileController.php');
require_once('controller/SettingsController.php');
require_once('controller/MainController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Initialize session
session_start();

//Create models
$db = new Database();
$dal = new UserDAL($db);
$loginModel = new LoginModel($dal);
$registerModel = new RegisterModel($dal);
$searchModel = new SearchModel($dal);
$settingsModel = new SettingsModel($dal);

//CREATE OBJECTS OF THE VIEWS
$loginView = new LoginView($loginModel);
$registerView = new RegisterView($registerModel);
$searchView = new SearchView();
$userProfileView = new UserProfileView();
$settingsView = new SettingsView();
$layoutView = new LayoutView();

//Create controllers
$loginController = new LoginController($loginView, $loginModel);
$registerController = new RegisterController($registerView, $loginView, $registerModel);
$searchController = new SearchController($searchView, $userProfileView, $searchModel);
$userProfileController = new UserProfileController($userProfileView);
$settingsController = new SettingsController($settingsView, $settingsModel);

$mainController = new MainController($registerController, $loginController,
	$searchController, $userProfileController, $settingsController, $layoutView);

$mainController->listen();


// What view to render within LayoutView
if($mainController->renderRegView()) {
	$layoutView->render(false, $registerView);
}
else if($mainController->renderSearchView()) {
	if($searchModel->foundMatch()) {
		$layoutView->render($loginModel->isLoggedIn(), $userProfileView);
	}
	else {
		$layoutView->render($loginModel->isLoggedIn(), $searchView);
	}
}
else if($mainController->renderSettingsView()) {
	$layoutView->render($loginModel->isLoggedIn(), $settingsView);
}
else if($mainController->renderMyProfile()) {
	$layoutView->render($loginModel->isLoggedIn(), $userProfileView);
}
else {
	if($loginModel->isLoggedIn()) {
		$userProfileView->setUser(null);
		$layoutView->render($loginModel->isLoggedIn(), $userProfileView);
	}
	else {
		$layoutView->render($loginModel->isLoggedIn(), $loginView);
	}
}
