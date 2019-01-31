<?php

class data extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function buildDBFromJson() {

		$db = $this->model->db->useDB();
		$collection = $this->model->db->createCollection($db, ARTEFACT_COLLECTION);
		$this->model->insertEntries($collection);
	}
		
	// Use this method for global changes in json files
	public function modify() {

		$db = $this->model->db->useDB();
		$collection = $this->model->db->selectCollection($db, ARTEFACT_COLLECTION);

		$iterator = $collection->find(['volume' => ['$regex' => '01[2-9]', ], 'issue' => '01'], ['projection' => ['id' => 1, 'volume' => 1, '_id' => 0], 'sort' => ['volume' => 1, 'page' => 1]]);
		foreach ($iterator as $value) {
		
			var_dump((array)$value);
		}
	}
}

?>
