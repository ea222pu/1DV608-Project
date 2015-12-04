<?php

class SearchController implements iController {

	/**
	 * @var \view\SearchView $searchView
	 */
	private $searchView;

	/**
	 * @var \view\UserProfileView $profileView
	 */
	private $profileView;

	/**
	 * @var \model\SearchModel $seachModel
	 */
	private $searchModel;

	/**
	 * Constructor
	 * @param \view\searchView 			$searchView
	 * @param \view\UserProfileView		$profileView
	 * @param \model\SearchModel 		$searchModel
	 */
	public function __construct(SearchView $searchView, UserProfileView $profileView, SearchModel $searchModel) {
		$this->searchView = $searchView;
		$this->profileView = $profileView;
		$this->searchModel = $searchModel;
	}

	/**
	 * Handle user input
	 */
	public function listen() {

	}

	public function searchUser($searchTerm) {
		$this->searchModel->searchUser($searchTerm);
		if($this->searchModel->foundMatch()) {
			$this->profileView->setUser($this->searchModel->getSearchResult());
		}
		else {
			$this->searchView->setResult($this->searchModel->getSearchResult());
		}
	}
}