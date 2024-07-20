<?php
/** @var yii\web\View $this */
/** @var app\modules\broadcasts\models\Broadcast $model */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?= $model->judul; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <p><?= $model->greeting; ?></p>

    <?= $model->isi_html; ?>

    <p><?= $model->closing; ?></p>
</body>
</html>