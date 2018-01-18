<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 17/01/18
 * Time: 09:25
 */

class NasaAdapter
{
    function __construct($class_name, $attribute_name)
    {
        $this->class_name = $class_name;
        $this->attribute_name = $attribute_name;
        $this->instance = new $class_name;
    }

    static function fromJson()
    {
        return json_decode(file_get_contents(NasaAPI::$url));
    }

    static function get_article($content_array)
    {
        $return_article = "";
        foreach ($content_array as $value=>$key) {
            if($value === "title"){
                $return_article .= $key . "\n";
            }
        }

        foreach ($content_array as $value=>$key) {
            if ($value === "explanation") {
                $return_article .= $key . "\n";
            }
        }

        foreach ($content_array as $value=>$key) {
            if ($value === "hdurl") {
                $return_article .= $key . "\n";
            }
        }

        foreach ($content_array as $value=>$key) {
            if ($value === "date") {
                $return_article .= "Article publié le " . $key . "\n";
            }
        }
        return $return_article;
    }

    function get_asteroid_description($content_array)
    {
        $return_asteroid = "DESCRIPTION DE L'ASTEROID\n";

        //Foreachception to get what matter in the array of array of array, etc.
        // + increment a var to return
        foreach($content_array as $key=>$value) {
            if(gettype($key) !== "array" && gettype($key) !== "object"){
                foreach($value as $key2=>$value2) {
                    if(gettype($key2) !== "array" && gettype($key2) !== "object") {
                        foreach($value2 as $key3=>$value3) {
                            if(gettype($key3) !== "array" && gettype($key3) !== "object") {
                                foreach($value3 as $key4=>$value4) {
                                    if(gettype($key4) !== "array" && gettype($key4) !== "object") {
                                        foreach($value4 as $key5=>$value5) {
                                            if(gettype($key5) !== "array" && gettype($key5) !== "object") {
                                                foreach ($value5 as $key6=>$value6) {
                                                    //echo "key 6 : " . $key6 . "\n";
                                                    //echo "value 6 : " . $value6 . "\n";
                                                    if(gettype($key6) !== "array" && gettype($key6) !== "object" && gettype($value6) !== "object") {
                                                        $return_asteroid .= "============================================\n" . $key4 . " - " . $key ."\n============================================\n";
                                                        $return_asteroid .= $key6 . " : " . $value6 . "\n";
                                                        $return_asteroid .= "Publié le " . $key2 . "\n";
                                                    }
                                                }
                                            }
                                            $return_asteroid .= ":::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::\n";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $return_asteroid;
    }

}