<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class BeerApi extends Model
{
    protected $url;
    public function findBear($data,$endPoint,$url='http://api.brewerydb.com/v2/')
	{

		// search
		$this->url=$url.$endPoint;

		$query = http_build_query($data); 
		$ch    = curl_init($this->url.'?'.$query);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);

		$response = curl_exec($ch);
		curl_close($ch);
		if($response === false)
		{
			return "couldn't find data please try later";
		}

		return $response;

	}
}