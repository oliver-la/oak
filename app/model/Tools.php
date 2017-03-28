<?php
/**
 * Created by PhpStorm.
 * User: Oliver
 * Date: 3/28/2017
 * Time: 6:04 PM
 */

namespace M152;


class Tools
{
    public static function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}