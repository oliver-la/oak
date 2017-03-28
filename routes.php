<?php

    $klein->respond('GET', BASE_DIR, function () {
        global $smarty;
        $gallery = new \M152\Gallery();
        $smarty->assign("albums", $gallery->getAlbums());
        $smarty->display('gallery/index.tpl');
    });

    $klein->respond('POST', BASE_DIR . 'gallery', function ($request) {
        $album = new \M152\Album($request->id);
        $album->uploadImage($_FILES['file']);
    });

    $klein->respond('GET', BASE_DIR . 'gallery/new', function () {
        global $smarty;
        $id = uniqid();
        $_SESSION['album_id'] = $id;
        $smarty->assign("id", $id);
        $smarty->display('gallery/new.tpl');
    });

    $klein->respond('GET', BASE_DIR . 'album/[:id]', function($request) {
        global $smarty;
        $album = new \M152\Album($request->id);
        $smarty->assign("images", $album->getImages());
        $smarty->assign("album", $album);
        $smarty->display('album/index.tpl');
    });

    $klein->respond('GET', BASE_DIR . 'album/[:id]/delete', function($request, $response) {
        global $smarty;
        $album = new \M152\Album($request->id);
        $album->delete();
        $response->redirect(BASE_DIR, 410);
    });