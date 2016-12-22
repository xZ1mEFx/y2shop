<?php
namespace backend\controllers;

use backend\models\User;
use xz1mefx\multilang\actions\translation\IndexAction;
use xz1mefx\multilang\actions\translation\UpdateAction;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Class TranslationController
 * @package backend\controllers
 */
class TranslationController extends BaseController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['allow' => TRUE, 'roles' => [User::ROLE_ROOT]], // default rule
                    [
                        'actions' => ['index'],
                        'allow' => TRUE,
                        'roles' => [
                            User::ROLE_ROOT,
                            User::ROLE_ADMIN,
                        ],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => TRUE,
                        'roles' => [
                            User::ROLE_ROOT,
                            User::PERMISSION_EDIT_TRANSLATES,
                        ],
                    ],
                    ['allow' => FALSE], // default rule
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['get'],
                    'update' => ['get', 'put', 'post'],
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
            'index' => [
                'class' => IndexAction::className(),
                'theme' => IndexAction::THEME_ADMINLTE,
                'canUpdate' => Yii::$app->user->can(User::PERMISSION_EDIT_TRANSLATES),
            ],
            'update' => [
                'class' => UpdateAction::className(),
                'theme' => UpdateAction::THEME_ADMINLTE,
            ],
        ];
    }

}
