<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

//---------------------
use app\models\Pessoa;
use app\models\Usuario;
use app\models\Aluno;
use app\models\Servidor;
use app\models\CadastroToken;
use app\models\InstrutorUsuario;

//-----------------
use app\models\UsuarioSearch;



/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex($matricula = null)
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $matricula);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {   
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($token)
    {
        $token = CadastroToken::findOne(['token_acesso' => $token]);
        $this->layout = 'layout-cadastro';

        /*Autorização para que o usuário possa se cadastrar, deverar verifica se tem o token.*/
        if( true/*$token != null*/){

            $modelPessoa = new Pessoa();
            $modelUsuario = new Usuario();
            $modelAluno = new Aluno();
            $modelServidor = new Servidor();


            $modelPessoa->setScenario(Pessoa::SCENARIO_CADASTRO);            

            if($modelPessoa->load(Yii::$app->request->post()) && $modelUsuario->load(Yii::$app->request->post())){
                    
                $modelPessoa->imageFile = UploadedFile::getInstance($modelPessoa, 'imageFile');

                if ($modelPessoa->upload()) {
                    //Isso serve para que o metodo $modelPessoa->save não tente salvar o arquivo de imagem.
                    $modelPessoa->imageFile = '';

            
                    $modelPessoa->type = 'usuario';

                    if($modelPessoa->save()){
                        
                        $modelUsuario->usuario_matricula = $modelPessoa->matricula;

                        //Associa o usuário a um instrutor
                        $modelInstrutorUsuario = new InstrutorUsuario();
                        $modelInstrutorUsuario->mat_instrutor = $token->matricula_instrutor;
                        $modelInstrutorUsuario->mat_usuario = $modelUsuario->usuario_matricula;
                        
                        if($modelUsuario->save() && $modelInstrutorUsuario->save()){
                            
                            //Deleta o token para que não tenha outro acesso!
                            $token->delete();

                            //Se $tipo for false é Aluno, se não for é servidor.
                            if(!$modelPessoa->tipo_usuario && $modelAluno->load(Yii::$app->request->post())){
                                //Usuário é um aluno.
                                $modelAluno->mat_aluno = $modelUsuario->usuario_matricula;
                                $modelAluno->save();

                                //TERMINAR!
                                //modificar para ir para a página do usuário
                                // return $this->redirect([
                                //     'pessoa/view', 
                                //     'id' => $modelAluno->mat_aluno
                                // ]);

                                return $this->goHome();

                            }else if($modelServidor->load(Yii::$app->request->post())){

                                //Usuário é um servidor
                                $modelServidor->mat_servidor = $modelUsuario->usuario_matricula;
                                $modelServidor->save();

                                 //TERMINAR!
                                //modificar para ir para a página do usuário
                                //  return $this->redirect([
                                //     'pesssoa/view', 
                                //     'id' => $modelServidor->mat_servidor
                                // ]);

                                return $this->goHome();
                            }

                            throw new NotFoundHttpException("Não funciona !");
                            //Usuário esqueceu de colocar o tipo !
                        }
                    }
                }    
            }
                
            return $this->render('create',[
                'modelPessoa' => $modelPessoa,
                'modelUsuario' => $modelUsuario,
                'modelAluno' => $modelAluno,
                'modelServidor' => $modelServidor,
                'horariosTreino' => $modelUsuario::getHorariosTreino(),
                'niveis' => $modelUsuario::getNiveis(),
                'periodos' => $modelAluno::getPeriodos(),
            ]); 
        }
       
        throw new NotFoundHttpException(Yii::t('app', 'Token incorreto !'));
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->usuario_matricula]);
        }

        return $this->render('update', [
            'model' => $model,
            'horariosTreino' => $model::getHorariosTreino(),
            'niveis' => $model::getNiveis(),
        ]);
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {   
        
        if(($aluno = Aluno::findOne($id)) != null){
            $aluno->delete();
        }

        if(($servidor = Servidor::findOne($id)) != null){
            $servidor->delete();
        }

        if(($instrutorUsuario = InstrutorUsuario::findOne(['mat_usuario' => $id ])) != null){
            $instrutorUsuario->delete();
        }

        if (($usuario = Usuario::findOne($id)) !== null) {
            $usuario->delete();
        }

        if(($pessoa = Pessoa::findOne($id)) != null){
            $pessoa->delete();
        }

        return $this->redirect(['adm/index']);
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

     public function actionCadastro($token){

        $token = CadastroToken::findOne(['token_acesso' => $token]);

        /*Autorização para que o usuário possa se cadastrar, deverar verifica se tem o token.*/
        if($token != null){

            $modelPessoa = new Pessoa();
            $modelUsuario = new Usuario();
            $modelAluno = new Aluno();
            $modelServidor = new Servidor();


            $modelPessoa->setScenario(Pessoa::SCENARIO_CADASTRO);            
            
            if($modelPessoa->load(Yii::$app->request->post()) && $modelUsuario->load(Yii::$app->request->post())){ 
                
                if($modelPessoa->save()){
                    
                    $modelUsuario->usuario_matricula = $modelPessoa->matricula;

                    //Associa o usuário a um instrutor
                    $modelInstrutorUsuario = new InstrutorUsuario();
                    $modelInstrutorUsuario->mat_instrutor = $token->matricula_instrutor;
                    $modelInstrutorUsuario->mat_usuario = $modelUsuario->usuario_matricula;
                    
                    if($modelUsuario->save() && $modelInstrutorUsuario->save()){
                        
                        //Deleta o token para que não tenha outro acesso!
                        $token->delete();

                        //Se $tipo for false é Aluno, se não for é servidor.
                        if(!$modelPessoa->tipo_usuario && $modelAluno->load(Yii::$app->request->post())){
                            //Usuário é um aluno.
                            $modelAluno->mat_aluno = $modelUsuario->usuario_matricula;
                            $modelAluno->save();

                            //modificar para ir para a página do usuário
                            return $this->redirect([
                                'pessoa/view', 
                                'id' => $modelAluno->mat_aluno
                            ]);

                        }else if($modelServidor->load(Yii::$app->request->post())){

                            //Usuário é um servidor
                            $modelServidor->mat_servidor = $modelUsuario->usuario_matricula;
                            $modelServidor->save();

                            //modificar para ir para a página do usuário
                             return $this->redirect([
                                'pesssoa/view', 
                                'id' => $modelServidor->mat_servidor
                            ]);
                        }

                        throw new NotFoundHttpException("Não funciona !");
                        //Usuário esqueceu de colocar o tipo !
                    }
                }
            }

            return $this->render('cadastro',[
                'modelPessoa' => $modelPessoa,
                'modelUsuario' => $modelUsuario,
                'modelAluno' => $modelAluno,
                'modelServidor' => $modelServidor,
            ]); 
        }
       
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
           
    }

    public function actionPerfil(){
        $this->layout = 'layout-pessoa';
        return $this->render('perfil');
    }
}
