<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use vinicinbgs\Autentique\Documents;

class DocumentsController extends Controller {

    protected $documents;

    public function __construct() {
        $this->documents = new Documents(env('AUTENTIQUE_TOKEN'));
    }

    public function create(Request $request) {
        $attributes = $request->all();
        $documentCreated = $this->documents->create($attributes);

        return response()->json($documentCreated);
    }

    public function listAll($page = 1) {
        $documentsPaginated = $this->documents->listAll($page);
        
        return response()->json($documentsPaginated);
    }

    public function getById($documentId) {
        $document = $this->documents->listById($documentId);

        return response()->json($document);
    }

    public function signById($documentId) {
        $documentSign = $this->documents->signById($documentId);

        return response()->json($documentSign);
    }

    public function deleteById($documentId) {
        $documentDeleted = $this->documents->deleteById($documentId);

        return response()->json($documentDeleted);
    }
}

