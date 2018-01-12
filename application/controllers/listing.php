<?php

class listing extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function structure($query = []) {

		// Get structural params from json-precast
		// listing/structure
	}

	public function articles($query = []) {

		// Redirect to articles/all/A
		// listing/articles
	}

	public function authors($query = [], $letter = DEFAULT_LETTER) {

		// Albhabetic list of authors displayed letter wise
		// listing/authors/A
	}

	public function category($query = [], $param = DEFAULT_PARAM) {

		// Listing of various categories such as features and series
		// listing/category/feature
	}
}

?>
