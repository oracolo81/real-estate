<?php
class Util
{
    public static function getPropertyUrl($property)
    {
        $id = (!empty($advert["Advert"]["id"])) ? $advert["Advert"]["id"] : $advert["id"];
        $name = (!empty($advert["Advert"]["name"])) ? $advert["Advert"]["name"] : $advert["name"];
        $url = "/";
        $url .= $id . "/property-" . self::getSlug($advert["AdvertType"]["name"]) . "-from-owner/";
        $url .= self::getSlug($advert["PropertyType"]["name"]) . "/";
        $url .= $advert["GeoLocation"]["friendly_name"] . "/";
        $url .= self::getSlug($name);
        return $url;
    }

    public static function getSlug($string)
    {
        return strtolower(
            preg_replace(
                "/[^\w]+/",
                "-",
                str_replace("/", "_", $string)
            )
        );
    }

    public static function resizeImage($sourceFileName, $destinationFilename, $width = 500, $destroyOriginal = false)
    {
        //not sure if this will complain on live.
        ini_set('memory_limit', '512M');
        $size = GetimageSize($sourceFileName);
        if (($width*$size[1]) > $size[0]) {
            $height = round(($width*$size[1])/$size[0]);
        } else {
            $height = 500;
            $width = round(($height*$size[0])/$size[1]);
        }
        try {
            $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
            $mime_type = finfo_file($finfo, $sourceFileName);
            finfo_close($finfo);
            
            $ext = pathinfo($sourceFileName, PATHINFO_EXTENSION);
            if (strtolower($ext) == "png" && $mime_type=='image/png') {
                $images_orig = imagecreatefrompng($sourceFileName);
                imagealphablending($images_orig, false);
                imagesavealpha($images_orig, true);
            } elseif (strtolower($ext) == "jpg" && $mime_type == 'image/jpeg') {
                $images_orig = ImageCreateFromJPEG($sourceFileName);
            }
            
            $photoX = ImagesX($images_orig);
            $photoY = ImagesY($images_orig);
            $images_fin = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
            if (strtolower($ext) == "png" && $mime_type=='image/png') {
                imagepng($images_fin, $destinationFilename);
            } elseif (strtolower($ext) == "jpg" && $mime_type == 'image/jpeg') {
                ImageJPEG($images_fin, $destinationFilename);
            }
            ImageDestroy($images_orig);
            ImageDestroy($images_fin);
            if ($destroyOriginal && $sourceFileName != $destinationFilename) {
                unlink($sourceFileName);
            }
        } catch (Exception $ex) {
            $this->log($ex->getMessage());
        }
    }

    public static function getPhotoUrl($propertyPhoto)
    {
        if (!empty($propertyPhoto["file_name"])) {
            $imageUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/img/property/' . $propertyPhoto["file_name"];
        } else {
            $imageUrl = 'http://' . $_SERVER['HTTP_HOST'] . "/img/sample.jpg";
        }
        return $imageUrl;
    }

    public static function getThumbUrl($propertyPhoto)
    {
        if (!empty($propertyPhoto["file_name"])) {
            $imageUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/img/property/thumb/' . $propertyPhoto["file_name"];
        } else {
            $imageUrl = 'http://' . $_SERVER['HTTP_HOST'] . "/img/sample.jpg";
        }
        return $imageUrl;
    }
}
