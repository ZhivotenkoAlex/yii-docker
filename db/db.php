<?php
namespace app\db;
require '../vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

class Firestore {
    private $db;
    private $projectId = 'development-417611';

    public function __construct() {
        $this->db = new FirestoreClient([
            'projectId' => $this->projectId,
            // 'database' => 'skanuj-wygrywaj' // to use different database we need change rules as in this database
        ]);
    }

    public function getDocuments($collection) {
        $documents = [];
        $querySnapshot = $this->db->collection($collection)->documents();
        foreach ($querySnapshot as $document) {
            if ($document->exists()) {
                $documents[] = $document->data();
            }
        }
        return $documents;
    }
    public function getDocumentById($collection, $id) {
        $document = $this->db->collection($collection)->document($id)->snapshot();
        if ($document->exists()) {
            return $document->data();
        } else {
            return null;
        }
    }

    public function updateDocument($collection, $id, $data) {
        $this->db->collection($collection)->document($id)->set($data);
    }

    public function createDocument($collection, $data) {
        $this->db->collection($collection)->add($data);
    }

    public function deleteDocument($collection, $id) {
        $this->db->collection($collection)->document($id)->delete();
    }
}