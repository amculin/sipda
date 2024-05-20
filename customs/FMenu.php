<?php
namespace app\customs;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

/**
 * Custom widget to generate sidebar menu
 *
 * @author Fahmi Auliya Tsani <fahmi.auliya.tsani@gmail.com>
 */
class FMenu extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $items = Yii::$app->params['menu'];
        $groupID = Yii::$app->user->identity->id_grup;

        return $this->render('@app/customs/views/fmenu', [
            'menu' => $items,
            'groupID' => $groupID
        ]);
    }
}
