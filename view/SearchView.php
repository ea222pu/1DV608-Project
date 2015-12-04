<?php

class SearchView implements iView {

	/**
	 * @var array $searchResults
	 */
	private $searchResult;

	public function __construct() {

	}

	/**
     * Generates the search result.
     *
     * @return String HTML-code
     */
	public function response() {
		return '
			<table>
				' . $this->generateRows() . '
			</table>';
	}

	/**
	 * Set @var $searchResult.
	 * @param array $result
	 */
	public function setResult($result) {
		$this->searchResult = $result;
	}

	/**
	 * Generates the rows for the table if @var $searchResult is not empty,
	 * else a 'No results found' message.
	 * @return String
	 */
	private function generateRows() {
		if(count($this->searchResult) == 0) {
			return 'No results found';
		}
		else {
			$returnString = '';
			foreach($this->searchResult as $user) {
				$returnString .= '<tr><td>' . $user->getUsername() . '</td></tr>';
			}
			return $returnString;
		}
	}

}