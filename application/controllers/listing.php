<?php

class listing extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function structure($query = []) {

		// Get structural params from json-precast
		// listing/structure
	}

	public function articles() {

		// Redirect to articles/all/A
		// listing/articles
		$this->redirect('articles/all/' . DEFAULT_LETTER);
	}

	public function authors($query = [], $letter = DEFAULT_LETTER) {

		// Albhabetic list of authors displayed letter wise
		// listing/authors/A
		$url = BASE_URL . 'api/distinct/author.name?author.name=@^' . $letter;
		$result = json_decode($this->model->getDataFromApi($url), true);
		$result['pageTitle'] = ARCHIVE . ' > ' . AUTHORS;
		$result['subTitle'] = AUTHORS;
		$result['nextUrl'] = BASE_URL . 'articles/author/';
		$result['alphabet'] = $this->model->getAlphabiticalList('author.name');
		($result) ? $this->view('listing/items', json_encode($result)) : $this->view('error/index');
	}

	public function category($query = [], $param = DEFAULT_PARAM) {

		// Listing of various categories such as features and series
		// listing/category/feature

		$url = BASE_URL . 'api/distinct/' . $param;
		// $url = BASE_URL . 'api/distinct/' . $param . '?'  . $param . '=@^' . $letter;
		$result = json_decode($this->model->getDataFromApi($url), true);
		$result['pageTitle'] = ARCHIVE . ' > ' . constant(strtoupper($param));
		$result['nextUrl'] = BASE_URL . 'articles/category/' . $param . '/';
		// $result['alphabet'] = $this->model->getAlphabiticalList('author.name');
		($result) ? $this->view('listing/items', json_encode($result)) : $this->view('error/index');

	}
}

?>
