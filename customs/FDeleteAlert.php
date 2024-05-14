<?php
namespace app\customs;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Custom delete alert widget using sweetalert
 * 
 * @author Fahmi Auliya Tsani <fahmi.auliya.tsani@gmail.com>
 */
class FDeleteAlert extends Widget
{
    public $viewPath = '@app/customs/views/delete-alert';

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $rendered = $this->getView()->render($this->viewPath, [], $this);

        return Html::encode($rendered);
    }
}