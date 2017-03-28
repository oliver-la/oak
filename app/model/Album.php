<?php
/**
 * Created by PhpStorm.
 * User: Oliver
 * Date: 3/25/2017
 * Time: 6:34 PM
 */

namespace M152;


class Album
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $path;
    /**
     * @var AlbumSettingsManager
     */
    private $album_settings_manager;
    /**
     * @var bool
     */
    private $read_only = true;

    /**
     * @var Image[]
     */
    private $images;


    public function __construct($id = "")
    {
        $this->id = ($id == "") ? uniqid() : $id;
        $this->path = DIR_UPLOADS . DIRECTORY_SEPARATOR . $this->id;
        if(!file_exists($this->path)) {
            mkdir($this->path);
        }
        $this->read_only = !(isset($_SESSION['album_id']) && $_SESSION['album_id'] == $this->id);
        $this->album_settings_manager = new AlbumSettingsManager($this);
        $this->images = $this->album_settings_manager->getSettings()->getImages();
    }

    public function __destruct()
    {
        $this->album_settings_manager->save();
    }

    public function uploadImage($file) {
        $tmp_name = $file["tmp_name"];
        $base_name = basename($file["name"]);

        // Sanitize file name
        $base_name = strtolower(preg_replace('/[^a-z0-9\._-]+/i', '', $base_name));

        // Prefix the filename with randomness, if it exists already.
        if(file_exists($this->path . DIRECTORY_SEPARATOR . $base_name)) {
            $base_name = substr(uniqid(), 0, 5) . "_" . $base_name;
        }

        move_uploaded_file($tmp_name, $this->path . DIRECTORY_SEPARATOR . $base_name);

        // Do some post-processing here.
        $image = new Image($this->path . DIRECTORY_SEPARATOR . $base_name);

        $small = array('150', '150');
        $medium = array('800', '500');
        $sizes = array($small, $medium);
        $image->generateThumbnails($sizes);

        // If this is the first image of the album, use this as the album thumbnail.
        if($this->album_settings_manager->getSettings()->getThumb() == null) {
            $this->album_settings_manager->getSettings()->setThumb($base_name . "_" . $small[0] . "x" . $small[1] . ".jpg");
        }

        $this->album_settings_manager->getSettings()->addImage($image);
    }

    public function delete() {
        Tools::rrmdir($this->path);
    }

    public function getImages() {
        return $this->album_settings_manager->getSettings()->getImages();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }


    /**
     * @return boolean
     */
    public function isReadOnly()
    {
        return $this->read_only;
    }

    /**
     * @return AlbumSettingsManager
     */
    public function getAlbumSettingsManager()
    {
        return $this->album_settings_manager;
    }


}