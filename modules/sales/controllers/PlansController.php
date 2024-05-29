<?php

namespace app\modules\sales\controllers;

use app\customs\FController;
use app\models\UserGrup as Role;
use app\modules\sales\models\PlanForm;
use yii\helpers\Json;

/**
 * PlansController implements the CRUD actions for Plan model.
 */
class PlansController extends FController
{
    public $allowedRoles = [Role::ADMIN];
    public $modelClass = 'app\modules\sales\models\Plan';
    public $searchModelClass = 'app\modules\sales\models\PlanSearch';
    public $title = 'Planning';

    /**
     * Updates an existing Plan model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model      = $this->findModel($id);
        $data       = is_null($model->data) ? null : Json::decode($model->data, true);
        $formData   = ['model' => $model];

        var_dump($data);

        for ($i = 1; $i <= 12; $i++) {
            $dataModels[$i] = new PlanForm();

            if (! is_null($data)) {
                $dataModels[$i]->data_sale_target = $data[$i]['sale_target'];
                $dataModels[$i]->data_comission_target = $data[$i]['comission_target'];
            }

            $formData["dataModel"][$i] = $dataModels[$i];
        }

        if ($this->request->isPost) {
            if (PlanForm::loadMultiple($dataModels, $this->request->post()) && PlanForm::validateMultiple($dataModels)
                && $model->load($this->request->post())) {

                $i = 1;
                foreach ($dataModels as $dataModel) {
                    $data[$i] = [
                        'sale_target' => $dataModel->data_sale_target,
                        'comission_target' => $dataModel->data_comission_target
                    ];
                    $i++;
                }

                $model->data = Json::encode($data);
                $model->save();

                return $this->redirect('index');
            }
        }

        return $this->render('form', $formData);
    }
}
