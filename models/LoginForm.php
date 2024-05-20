<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    public $unit;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'unit'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password or unit.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $sql = 'SELECT u.kode, u.nama AS unit_name, g.nama AS group_name FROM unit u, user_grup g WHERE u.id = :unit_id AND g.id = :group_id';
            $data = Yii::$app->db->createCommand($sql, [
                ':unit_id' => $this->getUser()->id_unit,
                ':group_id' => $this->getUser()->id_grup
            ])->queryOne();
            $session = Yii::$app->session;
            $session['user_data'] = $data;

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 : 0);
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = UserAuth::findUser($this->username, $this->unit);
        }

        return $this->_user;
    }

    public function updateLog()
    {
        $user = $this->getUser();
        $user->last_login = date('Y-m-d H:i:s');

        $user->save();
    }
}
