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
		$db = $this->model->db->useDB();
		$collection = $this->model->db->createCollection($db, ALPHABET_COLLECTION);
		$data['title'] = array_values($titleAlphabet);
		$data['author'] = array_values($authorAlphabet);

		$result = $collection->insertOne($data);
	}
	
	public function xml2Json() {

		$xml = simplexml_load_file(BASE_URL . 'vp.xml');

		foreach ($xml->volume as $volume) {
			
			foreach ($volume->issue as $issue) {
				
				$completeIssue = [];
				$completeIssue['volume'] = (string)$volume['vnum'];
				
				foreach ($issue->entry as $entry) {

					$completeIssue['issue'] = (string)$issue['inum'];
					$completeIssue['year'] = (string)$issue['year'];
					$completeIssue['month'] = (string)$issue['month'];
					$completeIssue['theme'] = (string)$issue['theme'];
					$completeIssue['id'] = $completeIssue['volume'] . '/' . $completeIssue['issue'];
					
					$array = [];
					$array['title'] = $entry->title->__toString();
					$array['feature'] = $entry->feature->__toString();
					$array['page'] = $entry->page->__toString();
					$splitPage = explode('-', $array['page']);

					$jsonFilePath = PHY_METADATA_URL . $completeIssue['volume'] . '/' . $completeIssue['issue'] . '/';
					$files = glob($jsonFilePath . "text/*.txt");
					$articleStartOffset = array_search($jsonFilePath . 'text/' . $splitPage[0] . '.txt', $files);
					$articleEndOffset = array_search($jsonFilePath . 'text/' . $splitPage[1] . '.txt', $files) + 1;
					$textFiles = array_slice($files, $articleStartOffset, $articleEndOffset - $articleStartOffset);

					$textArray = [];
					$array['fullText'] = [];
					foreach ($textFiles as $textFile) {

						preg_match('/(.*)\/text\/(.*)\.txt/', $textFile, $matches);
						$textArray['page'] = $matches[2];
						$textArray['text'] = trim(file_get_contents($textFile));
						array_push($array['fullText'], $textArray);
					}

					$array['relativePageNumber'] = (array_search($jsonFilePath . 'text/' . $splitPage[0] . '.txt', $files)) ? array_search($jsonFilePath . 'text/' . $splitPage[0] . '.txt', $files) : 1;
					
					foreach ($entry->allauthors->author as $author) {

						$arrayArthor = [];
						$arrayArthor['name'] = $author->__toString();
						$arrayArthor['salutation'] = (string)$author['salut'];
						$array['author'][] = $arrayArthor;
					}

					$completeIssue['toc'][] = $array;
				}
				
				exec("mkdir -p " . $jsonFilePath);
				$json = json_encode($completeIssue, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
				file_put_contents($jsonFilePath . 'index.json' , $json);
			}
		}
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
