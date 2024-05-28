<?php

namespace app\modules\references\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use yii\web\Response;
use yii\web\UnprocessableEntityHttpException;

/**
 * EventsController implements the CRUD actions for Program model.
 */
class EventsController extends FController
{
    public $allowedRoles = [Role::ADMIN];
    public $modelClass = 'app\modules\references\models\Program';
    public $searchModelClass = 'app\modules\references\models\ProgramSearch';
    public $title = 'Program';

    /**
     * Enable/disable an existing Program model.
     * If enable/disable is successful, the system will return success message.
     * @param int $id ID
     * @return Response
     * @throws UnprocessableEntityHttpException if the action cannot be executed
     */
    public function actionEnabler($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if ($model->is_disabled == $model::IS_DISABLED) {
            $model->is_disabled = $model::IS_NOT_DISABLED;
        } else {
            $model->is_disabled = $model::IS_DISABLED;
        }

        if (! $model->save()) {
            throw new UnprocessableEntityHttpException('Gagal');
        }

        return [
            'code' => 200,
            'message' => 'Sukses'
        ];
    }
}
