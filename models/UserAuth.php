<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

class UserAuth extends User implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {}

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findUser($username, $unit)
    {
        return static::findOne([
            'username' => $username,
            'id_unit' => $unit,
            'is_disabled' => User::IS_NOT_DISABLED
        ]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
        //return $this->password === (Yii::$app->getSecurity()->generatePasswordHash($password));
    }
}