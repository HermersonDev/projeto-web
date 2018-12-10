<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\helpers\Html;


//MODELOS
use app\models\CadastroToken;
use app\models\Horario;
use app\models\Usuario;

//MODELOS DE PESQUISA
use app\models\PessoaSearch;
use app\models\EquipamentoSearch;
use app\models\ExercicioSearch;
use app\models\HorarioSearch;



class AdmController extends Controller
{   

    public $layout = 'layout-adm';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
    
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
        return $this->redirect(['adm/usuarios','matricula' => Yii::$app->user->identity->matricula]);
    }

    public function actionUsuarios($matricula){

        $searchModel = new PessoaSearch();

        $usuarios = $searchModel->searchUsuarios($matricula);

        if(!is_null($usuarios)){
            
            $count = $usuarios->count();

            $pages = new Pagination(['totalCount' => $count]);

            $usuarios = $usuarios->offset($pages->offset)
                        ->limit($pages->limit)->all();

            return $this->render('usuarios',[
                'usuarios' => $usuarios,
                'pages' => $pages,
            ]);
        }
        
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAddUsuario(){
        
        $modelToken = new CadastroToken();

        if($modelToken->load(Yii::$app->request->post())){
            //Criar o token antes de salvar
            $token = $modelToken->matricula_usuario .''. date('H:i:s');
            $modelToken->token_acesso = sha1($token);

            if($modelToken->save()){
                //Manda o email com a url de acesso!

                Yii::$app->mailer->compose()
                    ->setFrom('ne.hermerson@gmail.com')
                    ->setTo($modelToken->email)
                    ->setSubject('Projeto Web 2')
                    ->setHtmlBody('<a href='.Url::to(['usuario/create', 'token'=> $modelToken->token_acesso], true).'>Cadastre-se Aqui!</a>')
                    ->send();

                return $this->redirect(['adm/index']);
            }  
        }

        return $this->render('add-usuario',[
            'modelToken' => $modelToken,
        ]);
    }

    public function actionEquipamentos(){

        $searchModel = new EquipamentoSearch();

        $equipamentos = $searchModel->searchEquipamentos();


        if(!is_null($equipamentos)){
            
            $count = $equipamentos->count();

            $pages = new Pagination(['totalCount' => $count]);

            $equipamentos = $equipamentos->offset($pages->offset)
                        ->limit($pages->limit)->all();

            return $this->render('equipamentos',[
                'equipamentos' => $equipamentos,
                'pages' => $pages,
            ]);
        }
    }

    public function actionExercicios(){

        $searchModel = new ExercicioSearch();

        $exercicios = $searchModel->searchExercicios();


        if(!is_null($exercicios)){
            
            $count = $exercicios->count();

            $pages = new Pagination(['totalCount' => $count]);

            $exercicios = $exercicios->offset($pages->offset)
                        ->limit($pages->limit)->all();

            return $this->render('exercicios',[
                'exercicios' => $exercicios,
                'pages' => $pages,
            ]);
        }
    }

    public function actionIniciarTreino(){

        $matricula = Yii::$app->request->post('matricula');
        
        if($matricula != null){
            if(($modelUsuario = Usuario::findOne($matricula)) != null){
                
                $modelHorario = new Horario();

                $modelHorario->mat_usuario = Html::encode($matricula);
                $modelHorario->data = Yii::$app->formatter->asDate('now');
                $modelHorario->hora_inicio = Yii::$app->formatter->asTime(time());

                if($modelHorario->save()){
                    return $this->redirect(['adm/usuarios-ativos']);
                }
            }
        }

        return $this->redirect(['adm/index']);
    }

    public function actionUsuariosAtivos(){

        $modelSearch = new HorarioSearch();

        $usuariosAtivos = $modelSearch->searchUsuariosAtivos();

        $treinosConcluidos = $modelSearch->searchTreinoConcluido();

        if(!is_null($usuariosAtivos) && !is_null($treinosConcluidos)){
            
            $countAtivos = $usuariosAtivos->count();
            $countConcluidos = $treinosConcluidos->count();

            $pagesAtivos = new Pagination(['totalCount' => $countAtivos]);
            $pagesConcluidos = new Pagination(['totalCount' => $countConcluidos]);

            $usuariosAtivos = $usuariosAtivos->offset($pagesAtivos->offset)
                        ->limit($pagesAtivos->limit)->all();
            $treinosConcluidos = $treinosConcluidos->offset($pagesConcluidos->offset)
                ->limit($pagesConcluidos->limit)->all();

            return $this->render('usuarios-ativos',[
                'ativos' => $usuariosAtivos,
                'pagesAtivos' => $pagesAtivos,
                'concluidos' => $treinosConcluidos,
                'pagesConcluidos' => $pagesConcluidos,
            ]);
        }
    }
    public function actionTerminaTreino($id,$matricula){

        //TERMINA !!!!
    
        $modelHorario = Horario::findOne(['id' => $id,'mat_usuario' => $matricula]);
        
        if($modelHorario != null){
            
            $modelHorario->hora_final = Yii::$app->formatter->asTime(time());
            
            if($modelHorario->save()){

                return $this->redirect(['/adm/usuarios-ativos']);
            }
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
