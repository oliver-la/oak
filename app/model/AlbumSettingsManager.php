<?php
/**
 * Created by PhpStorm.
 * User: Oliver
 * Date: 3/25/2017
 * Time: 7:44 PM
 */

namespace M152;


class AlbumSettingsManager
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var AlbumSettings
     */
    private $settings;

    public function __construct(Album $album)
    {
        $this->path = $album->getPath() . DIRECTORY_SEPARATOR . "album.obj";
        if(!file_exists($this->path)) {
            $this->settings = new AlbumSettings();
            $this->settings->setId($album->getId());
            $this->save();
        } else {
            $this->settings = unserialize(file_get_contents($this->path));
        }
    }

    /**
     * @return AlbumSettings
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }


    public function save() {
        file_put_contents($this->path, serialize($this->settings));
    }
}