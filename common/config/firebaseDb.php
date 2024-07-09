<?php
namespace app\db;
require '../../vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

use Google\Cloud\Firestore\FirestoreClient;
use Google\Auth\Credentials\ServiceAccountCredentials;
use yii\helpers\Env;

class Firestore {
    private $db;
    private $projectId;

    public function __construct() {
    $config = json_decode($_ENV['FIREBASE_CONFIG'], true);
    $this->projectId = $config['project_id'];
    $this->db = new FirestoreClient([
        'projectId' => $config['project_id'],
        'database' => 'skanuj-wygrywaj',
        'credentials' => $config
    ]);
    }

    public function getDatabase() {
        return $this->db;
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
    public function getDocumentByFieldValue($collection, $field, $value) {
        $query = $this->db->collection($collection)->where($field, '=', $value);
        $querySnapshot = $query->documents();

        foreach ($querySnapshot as $document) {
            if ($document->exists()) {
                return $document->data();
            }
        }

        return null; // No matching document found
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