<?php
/**
 * Created by PhpStorm.
 * User: Oliver
 * Date: 3/25/2017
 * Time: 7:13 PM
 */

namespace M152;


class Image
{
    private $path;
    private $mime;
    private $thumbs = array();

    public function __construct($path)
    {
        $this->path = $path;
        $this->mime = mime_content_type($this->path);
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getThumbs()
    {
        return $this->thumbs;
    }

    public function getDetails() {
        if($this->mime == "image/jpeg") {
            return exif_read_data($this->path, 'EXIF');
        } else {
            return array();
        }
    }


    /**
     * Generates a thumbnail with the given width and height.
     * @param $thumb_width
     * @param $thumb_height
     * @return bool
     */
    public function generateThumbnail($thumb_width, $thumb_height) {
        switch($this->mime) {
            case "image/jpeg":
                $image = imagecreatefromjpeg($this->path);
                break;
            case "image/png":
                $image = imagecreatefrompng($this->path);
                break;
            case "image/gif":
                $image = imagecreatefromgif($this->path);
                break;
            default:
                return false;
                break;
        }

        $filename = $this->path . "_${thumb_width}x${thumb_height}.jpg";

        $thumb = new Thumb();
        $thumb->setWidth($thumb_width);
        $thumb->setHeight($thumb_height);
        $thumb->setPath($filename);
        array_push($this->thumbs, $thumb);

        $width = imagesx($image);
        $height = imagesy($image);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ( $original_aspect >= $thumb_aspect )
        {
            // If image is wider than thumbnail (in aspect ratio sense)
            $new_height = $thumb_height;
            $new_width = $width / ($height / $thumb_height);
        }
        else
        {
            // If the thumbnail is wider than the image
            $new_width = $thumb_width;
            $new_height = $height / ($width / $thumb_width);
        }

        $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

        // Resize and crop
        imagecopyresampled($thumb,
            $image,
            0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
            0 - ($new_height - $thumb_height) / 2, // Center the image vertically
            0, 0,
            $new_width, $new_height,
            $width, $height);
        return imagejpeg($thumb, $filename, 100);
    }

    /**
     * Generates thumbnails with the given sizes as an array.
     * @param $sizes array
     * @return bool
     */
    public function generateThumbnails($sizes) {
        foreach($sizes as $size) {
            $this->generateThumbnail($size[0], $size[1]);
        }

        return true;
    }
}