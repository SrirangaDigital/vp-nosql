<?php

class data extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function buildDBFromJson() {

		$jsonFiles = $this->model->getFilesIteratively(PHY_METADATA_URL, $pattern = '/index.json$/i');

		$db = $this->model->db->useDB();
		$collection = $this->model->db->createCollection($db, ARTEFACT_COLLECTION);
		$titleAlphabet = [];
		$authorAlphabet = [];

		foreach ($jsonFiles as $jsonFile) {

			$contentString = file_get_contents($jsonFile);
			$content = json_decode($contentString, true);

			foreach ($content['toc'] as $article) {

				$data = $content;
				$data['Type'] = 'Journal';
				if(isset($data['toc']))	unset($data['toc']);
				$data = $data + $article;
				$data['id'] = $data['id'] . '/' . $article['page'];
				$data = array_filter($data);
				$result = $collection->insertOne($data);

				if(isset($article['author'])) {

					foreach ($article['author'] as $author) 
					array_push($authorAlphabet, preg_replace('/(^.).*/u', '$1', $author['name']));
				}

				array_push($titleAlphabet, preg_replace('/(^.).*/u', '$1', $article['title']));
			}
		}

		sort($titleAlphabet); sort($authorAlphabet);
		$this->insertAlphabet(array_unique($titleAlphabet), array_unique($authorAlphabet));
	}
	
	public function insertAlphabet($titleAlphabet, $authorAlphabet) {

		$data = [];
		$db = $this->model->db->useDB();
		$collection = $this->model->db->createCollection($db, ALPHABET_COLLECTION);
		$data['title'] = array_values($titleAlphabet);
		$data['author'] = array_values($authorAlphabet);

		$result = $collection->insertOne($data);
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
