<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;

class SiteController extends Controller
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
        $model = new EntryForm();
        $dataRand = array('withBreweries' => 'Y','hasLabels'=>'Y', 'withDescriptions' => 'Y', 'key'=> '985aeddea212aa71cac6e71dc675ea57');
        $resultRand= $this->searchBear($dataRand,'beer/random');
        $resultRand=@json_decode($resultRand, true); 


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...
            $search_quiry = $model->search;
            $search_type = $model->select;
            $data = array('q' => $search_quiry, 
            'type' => $search_type, 
            'key'=> '985aeddea212aa71cac6e71dc675ea57');
            
          $result= $this->searchBear($data,'search');
          $result=@json_decode($result, true);
                  
       
          
              
         

           
          return $this->render('search', ['model' => $model ,'result'=>$result,'resultRand'=>$resultRand] );
           
           
        } else {


             
            // either the page is initially displayed or there is some validation error
            
         
            return $this->render('entry', ['model' => $model,'resultRand'=>$resultRand]);
        }
    }






    public function searchBear($data,$endPoint )
    {
    // search
        $url = 'http://api.brewerydb.com/v2/'.$endPoint;
     
        $query = http_build_query($data); 
        $ch    = curl_init($url.'?'.$query);
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

    public function actionBrewery($id)
    {   
        $model = new EntryForm();
        $model->select='brewerie';
        $dataRand = array('withBreweries' => 'Y','hasLabels'=>'Y', 'withDescriptions' => 'Y', 'key'=> '985aeddea212aa71cac6e71dc675ea57');
        $resultRand= $this->searchBear($dataRand,'beer/random');
        $resultRand=@json_decode($resultRand, true); 
        
        $model = new EntryForm();
        
         $data = array( 'key'=> '985aeddea212aa71cac6e71dc675ea57');

         $endPoint='brewery/'.$id.'/beers';
            
          $result= $this->searchBear($data,$endPoint);
          $result=@json_decode($result, true);

     
                  
       
          
              
         

           
          return $this->render('search', ['model' => $model ,'result'=>$result,'resultRand'=>$resultRand] );
    }

    // public function randomBear()
    // {
    
    //     $url = 'http://api.brewerydb.com/v2/beer/random';
       
    //     $query = http_build_query($data);
    //     $ch    = curl_init($url.'?'.$query);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HEADER, false);
        
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    //     $lol = @json_decode($response, true);
        
    //     echo "<pre>";
    //     print_r($lol);
    //     echo "</pre>";
    
    // }
    


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionUser()
    {
        $model=new UserForm();
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {

        }
        else
        {
            return $this->render('UserForm', [
                'model' => $model,
            ]);
        }
    }


    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...
            echo $model->name;

           // return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }



    
}
