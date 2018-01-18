<?php
/**
 * Created by PhpStorm.
 * User: apprenant
 * Date: 17/01/18
 * Time: 09:44
 */

include_once 'NasaAdapter.php';

class NasaAPI
{
    //API key : f3Rx5I0CDCG4KtyRY8YwUyBfJn9JXOdPSFFUusH4

    //static public $url = "https://api.nasa.gov/neo/rest/v1/feed?start_date=2015-09-07&end_date=2015-09-08&api_key=f3Rx5I0CDCG4KtyRY8YwUyBfJn9JXOdPSFFUusH4";
    static public $url = "";
    static public $choice_u_made = 0;

    function __construct()
    {
        $this->data = file_get_contents(self::choose_API(intval(self::$choice_u_made)));
        //var_dump($this->data);
    }

    public function choose_API($API)
    {
        if($API === 1) {
            self::$url = "https://api.nasa.gov/neo/rest/v1/feed?start_date=2015-09-07&end_date=2015-09-08&api_key=f3Rx5I0CDCG4KtyRY8YwUyBfJn9JXOdPSFFUusH4";
        }
        elseif ($API === 2) {
            self::$url = "https://api.nasa.gov/planetary/apod?api_key=f3Rx5I0CDCG4KtyRY8YwUyBfJn9JXOdPSFFUusH4";
        }
        return self::$url;
    }

    static function get_article($content_array)
    {
        $return_article = "";
        foreach ($content_array as $value=>$key) {
            if($value === "title"){
                $return_article .= $key . "\n";
                $return_article .= "\n";
            }
        }

        foreach ($content_array as $value=>$key) {
            if ($value === "explanation") {
                $return_article .= $key . "\n";
                $return_article .= "\n";
            }
        }

        foreach ($content_array as $value=>$key) {
            if ($value === "hdurl") {
                $return_article .= $key . "\n";
                $return_article .= "\n";
            }
        }

        foreach ($content_array as $value=>$key) {
            if ($value === "date") {
                $return_article .= "Article publié le " . $key . "\n";
            }
        }
        return $return_article;
    }
}