<?php

class data extends Controller {

	public function __construct() {
		
		parent::__construct();
	}

	public function buildDBFromJson() {

		$jsonFiles = $this->model->getFilesIteratively(PHY_METADATA_URL, $pattern = '/index.json$/i');

		$db = $this->model->db->useDB();
		$collection = $this->model->db->createCollection($db, ARTEFACT_COLLECTION);

		foreach ($jsonFiles as $jsonFile) {

			$contentString = file_get_contents($jsonFile);
			$content = json_decode($contentString, true);

			foreach ($content['toc'] as $article) {
				# code...

				$data = $content;
				unset($data['toc']);
				$data['article'] = $article;
				$data['id'] = $data['id'] . '/' . $article['page'];
				$data = array_filter($data);
				$result = $collection->insertOne($data);
			}
		}
	}
	
	// Use this method for global changes in json files
	public function modify() {

		$jsonFiles = $this->model->getFilesIteratively(PHY_METADATA_URL, $pattern = '/index.json$/i');
		
		foreach ($jsonFiles as $jsonFile) {

			if(preg_match('/IMFG/', $jsonFile)){

				var_dump($jsonFile);
			}
			// $contentString = file_get_contents($jsonFile);
			// $content = json_decode($contentString, true);

			// $content = array_filter($content);
			// $json = json_encode($content, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	
			// file_put_contents($jsonFile, $json);
		}
	}
}

?>
