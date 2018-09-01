<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\EntryForm;
use app\models\BeerApi;


class BeerController extends Controller
{
	/**
     * {@inheritdoc}
     */

	// public $defaultAction = 'about';
	

	public function behaviors()
	{
		return [
			'access' => [
			'class' => AccessControl::className(),
			'only' => ['logout'],
			'rules' => [
			[
			'actions' => ['logout'],
			'allow' => true,
			'roles' => ['@'],
		],
		],
		],
			'verbs' => [
			'class' => VerbFilter::className(),
			'actions' => [
			'logout' => ['post'],
		],
		],
		];
	}

	/**
     * {@inheritdoc}
     */
	public function actions()
	{
		return [
			'error' => [
			'class' => 'yii\web\ErrorAction',
		],
			'captcha' => [
			'class' => 'yii\captcha\CaptchaAction',
			'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
		],
		];
	}

	/**
     * Displays homepage.
     *
     * @return string
     */
	public function actionIndex()
	{   
		// return $this->render('entry');
		$beer_api=new BeerApi();
		$model = new EntryForm();
		$resultRand=$this->randomBeer(); 

		return $this->render('entry', ['model' => $model,'resultRand'=>$resultRand]);
		
	}

	

	public function actionSearch()
	{   
		$beer_api=new BeerApi();
		$model = new EntryForm();
		$resultRand=$this->randomBeer(); 
		 
		if ($model->load(Yii::$app->request->get()) && $model->validate()) {

			$search_quiry = $model->search;   //from search form
			$search_type = $model->select;
			$data = array(
				'q' => $search_quiry, 
				'type' => $search_type, 
				'key'=> '985aeddea212aa71cac6e71dc675ea57');

			$result= $beer_api->findBear($data,'search');
			$result=@json_decode($result, true);

			return $this->render('search', ['model' => $model ,'result'=>$result,'resultRand'=>$resultRand] );


		}
		 else {

			// either the page is initially displayed or there is some validation error


			return $this->render('entry', ['model' => $model,'resultRand'=>$resultRand]);
		}
		
	}


	public function actionBrewery($id)
	{   
		$model = new EntryForm();
		$beer_api=new BeerApi();
		
		$resultRand=$this->randomBeer();

		$model = new EntryForm();

		$data = array( 'key'=> '985aeddea212aa71cac6e71dc675ea57');

		$endPoint='brewery/'.$id.'/beers';

		$result= $beer_api->findBear($data,$endPoint);
		$result=@json_decode($result, true);

		return $this->render('search', ['model' => $model ,'result'=>$result,'resultRand'=>$resultRand] );
	}



	public function randomBeer()
	{   
		
		$beer_api=new BeerApi();
		
		$dataRand = array(
			'withBreweries' => 'Y',
			'hasLabels'=>'Y',
			'withDescriptions' => 'Y',
			'key'=> '985aeddea212aa71cac6e71dc675ea57');

			do{
				
				$resultRand=@json_decode( $beer_api->findBear($dataRand,'beer/random'),true);
				
			}while(! isset($resultRand['data']['description']) );

		
		return $resultRand; 

	}

}