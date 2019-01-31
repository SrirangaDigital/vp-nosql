<?php

class dataModel extends Model {

	public function __construct() {

		parent::__construct();
	}

	public function getFilesIteratively($dir, $pattern = '/*/'){

		$files = [];
	    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(rtrim($dir, "/")));
		$regex = new RegexIterator($iterator, $pattern, RecursiveRegexIterator::GET_MATCH);

	    foreach($regex as $file => $object) {
	        
			array_push($files, $file);
	    }

	    sort($files);
	    return ($files);
	}

	public function getIdFromPath($path){

		$id = str_replace(PHY_METADATA_URL, '', $path);
		$id = str_replace('/index.json', '', $id);
		// $id = str_replace('/', '_', $id);
		return $id;
	}

	public function insertEntries($collection) {

		$titleAlphabet = [];
		$authorAlphabet = [];
		$jsonFiles = $this->getFilesIteratively(PHY_METADATA_URL, $pattern = '/index.json$/i');

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

				// fetching initial letter from author
				if(isset($article['author'])) {

					foreach ($article['author'] as $author) 
					array_push($authorAlphabet, preg_replace('/(^.).*/u', '$1', $author['name']));
				}

				// fetching initial letter from title
				array_push($titleAlphabet, preg_replace('/(^.).*/u', '$1', $article['title']));
			}
		}

		sort($titleAlphabet); sort($authorAlphabet);
		$this->insertAlphabet(array_unique($titleAlphabet), array_unique($authorAlphabet));
	}

	public function insertAlphabet($titleAlphabet, $authorAlphabet) {

		$data = [];
		$db = $this->db->useDB();
		$collection = $this->db->createCollection($db, ALPHABET_COLLECTION);
		$data['title'] = array_values($titleAlphabet);
		$data['author'] = array_values($authorAlphabet);

		$result = $collection->insertOne($data);
	}

}

?>
