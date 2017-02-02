<?php
class Common {
    static function generateRandomString($length)
    {
      $string = "";
      $possible = "0123456789bcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
      $i = 0; 
      while ($i < $length) { 
        $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        if (!strstr($string, $char)) { 
          $string .= $char;
          $i++;
        }
      }
      return $string;
    }
    
    static function generateRandomNumbers($length)
    {
        $string = "";
        $possible = "0123456789";
        $i = 0; 
        while ($i < $length) { 
            $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
            if (!strstr($string, $char)) { 
                $string .= $char;
                $i++;
            }
        }
        return $string;
    }
    
    static function commaDelimit($array, $modelName, $fieldName) {
        $string = "";
        $size = sizeof($array);
        $i = 1;
        foreach ($array as $key => $value) {
            $string .= $value[$modelName][$fieldName];
            if ($i != $size) {
                $string .= ",";
            }
            $i++;
        }
        return $string;
    }

    static function dotdotdot($sText, $iCharacters){
        $sText = stripslashes(strip_tags($sText));
        if($iCharacters < strlen($sText)){
            $cNextChar = $sText[$iCharacters];
            $sText = substr(strip_tags($sText), 0, $iCharacters);
            
            if($cNextChar != " "){
                $iWhiteSpace = strrpos($sText, " ");
            }
            else{
                $iWhiteSpace = 0;   
            }
            
            if($iWhiteSpace){
                $sText = substr($sText, 0, $iWhiteSpace);
            }   
            
            return $sText . "...";
        }
        else{
            return $sText;  
        }
    }
    
    static function getThumbnailPath($sFilename){
        if($sFilename == "") return "";
        
        $aParts = explode("/", $sFilename);
        if(sizeof($aParts) > 1){
            $lastPart = $aParts[sizeof($aParts) - 1];
            $aParts[sizeof($aParts) - 1] = "thumb";
            array_push($aParts, $lastPart); 
            return implode("/", $aParts);   
        }
        else{
            if(strstr($sFilename, "/")) return "/thumbs" . $sFilename;  
            else return "thumbs/" . $sFilename;
        }
    }
    
    static function urlFriendly($string){
        $string = preg_replace("/[^A-Za-z0-9]/","-", $string);
        $string = preg_replace('/[-]+/', '-', $string);
        return strtolower(trim($string, "-"));
    }
    
    static function getFileName($sFilePath){
        $aFilePath = explode("/", $sFilePath);
        return $aFilePath[3] . " - " . "<a href='".$sFilePath."' target='_blank'>view</a>";
    }
    
    static function youtube_id_from_url($url) {
        $pattern = 
            '%# Match any youtube URL in the wild.
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})     # Allow 10-12 for 11 char youtube id.
        \b              # Anchor end to word boundary.
        (?!             # But don\'t match URLs already linked.
          ">            # Not inside <a> start tag,
        | </a>          # or <a> element text contents.
        )               # End negative lookahead assertion.
        %x'
            ;
        $result = preg_match($pattern, $url, $matches);
        if (false !== $result) {
            if(isset($matches[1])){         
                return $matches[1];
            }
        }
        return false;
    }
    
    static function sortArray($aArray, $sKey){      
        $sorter = array();
        $ret = array();
        
        reset($aArray);
        foreach ($aArray as $ii => $va) {
            $sorter[$ii] = $va[$sKey];
        }
        
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$aArray[$ii];
        }
        $aArray = $ret;
        
        return $aArray;
    }

    static function getPhysicalFilePath($path) {
        $tmpPath = str_replace("/img", "/webroot/img", $path);    
        $file = str_replace("/webroot/", "", WWW_ROOT).$tmpPath;
        if(!file_exists($file)) {
            return false;
        }
        return $file;
    }
}
?>