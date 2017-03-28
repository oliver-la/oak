<?php
/**
 * Created by PhpStorm.
 * User: Oliver
 * Date: 3/25/2017
 * Time: 6:33 PM
 */

namespace M152;


class Gallery
{
    public function __construct($id = "")
    {
        
    }

    public function getAlbums() {
        $dirs = array_filter(glob(DIR_UPLOADS . DIRECTORY_SEPARATOR . '*'), 'is_dir');
        $albums = array();
        foreach($dirs as $dir) {
            $albumId = basename($dir);
            $album = new Album($albumId);
            $albums[] = [
                "id" => $albumId,
                "thumb" => basename($album->getAlbumSettingsManager()->getSettings()->getThumb())
            ];
            unset($album);
        }
        return $albums;
    }
}