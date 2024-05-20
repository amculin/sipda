<?php

use yii\helpers\Html;
use yii\helpers\Url;

echo Html::beginTag('ul', ['class' => 'navbar-nav align-items-start mt-lg-3']);

foreach ($menu as $key => $val) {
    if (in_array($groupID, $val['groupID'])) {
        $itemAttributes = ['class' => 'nav-item'];
        $linkAttributes = ['class' => 'nav-link'];
        $childContent = '';

        if (array_key_exists('children', $val)) {
            $itemAttributes = ['class' => 'nav-item dropdown'];
            $linkAttributes = [
                'class' => 'nav-link dropdown-toggle',
                'data-bs-toggle' => 'dropdown'
            ];

            $childContent .= Html::beginTag('div', ['class' => 'dropdown-menu']);

            foreach ($val['children'] as $index => $item) {
                if (in_array($groupID, $item['groupID'])) {
                    $childContent .= Html::a($item['label'], Url::to($item['url'], true), ['class' => 'dropdown-item']);
                }
            }

            $childContent .= Html::endTag('div');
        }

        $icon = '<i class="bi ' . $val['icon'] . ' fs-3 me-3"></i>'; //Html::tag('i', '', ['class' => 'bi ' . $val['icon'] . ' fs-3 me-3']);
        $content = Html::a($icon . ' ' . $val['label'], Url::to($val['url'], true), $linkAttributes);

        echo Html::tag('li', $content . $childContent, $itemAttributes);
    }
}

echo Html::endTag('ul');