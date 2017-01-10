<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\Category ;
use yii\helpers\ArrayHelper;
use cakebake\actionlog\model\ActionLog;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
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
     * @inheritdoc
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
	    $model = Category::find()->all();
//		$model = ArrayHelper::map($model,'varname', 'varname');
        return $this->render('index',[
	        'model' => $model
        ]);
	    ActionLog::add('success', $this->id);
//    return $this->render('index');
    }


	public function actionCategory($id)
	{
		$query = PostSearch::find()->where(["category_id" => $id]);
		$countQuery = clone $query;
		$pages = new Pagination([/*'defaultPageSize' => 6, */ 'totalCount' => $countQuery->count()]);
		$models = $query->offset($pages->offset)
			->limit($pages->limit)
			->all();

		return $this->render('science', [
			'models' => $models,
			'pages' => $pages,
		]);
	}

	public function actionGallery(){
		return $this->render('gallery');
	}



	public function actionNews(){
		return $this->render('news');
	}


	public function actionReports(){
		return $this->render('reports');
	}
    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
	    ActionLog::add('success', $this->id);
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
	public function actionLanguage()
	{
		if(isset($_POST['lang'])){
			Yii::$app->language = $_POST['lang'];
			$cookie = new yii\web\Cookie([
				'name' => 'lang',
				'value' => $_POST['lang']
			]);

			Yii::$app->getResponse()->getCookies()->add($cookie);
		}
	}


}
