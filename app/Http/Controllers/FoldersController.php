<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use vinicinbgs\Autentique\Folders;

class FoldersController extends Controller {

    protected $folders;

    public function __construct() {
        $this->folders = new Folders(env('AUTENTIQUE_TOKEN'));
    }

    public function listAll($page = 1) {
        $foldersPaginated = $this->folders->listAll($page);

        return response()->json($foldersPaginated);
    }

    public function getById($folderId) {
        $folder = $this->folders->listById($folderId);

        return response()->json($folder);
    }

    public function create(Request $request) {
        $attributes = $request->all();
        $folder = $this->folders->create($attributes);

        return response()->json($folder);
    }

    public function listContentsById($folderId, $page = 1) {
        $folderContents = $this->folders->listContentsById($folderId, $page);

        return response()->json($folderContents);
    }

    public function deleteById($folderId) {
        $folderDeleted = $this->folders->deleteById($folderId);

        return response()->json($folderDeleted);
    }
}
