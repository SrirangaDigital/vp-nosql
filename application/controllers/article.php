<?php

class article extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function text($query = []) {

		// article/text?volume=001&part=02&page=234&search=sumne
	}

	public function download($query= [], $volume, $issue, $pageRange) {

		(!($this->model->generatePDF($volume, $issue, $pageRange))) ? $this->redirect('article/download/' . $volume . '/' . $issue . '/' . $pageRange) : $this->view('error/index');
	}
}

?>
