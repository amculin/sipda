<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ConfigForm is the model behind the configuration form.
 */
class ConfigForm extends Model
{
    public $smtp_host;
    public $smtp_port;
    public $smtp_user;
    public $smtp_password;
    public $email;
    public $name;
    public $comission_only_for_achieved;
    public $comission_value;
    public $configID = null;

    const SCENARIO_INSERT_NEW = 'new';
    const SCENARIO_UPDATE_EXISTING = 'edit';

    public function init()
    {
        parent::init();

        $this->setConfigData();
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [[
                'smtp_host', 'smtp_port', 'smtp_user', 'smtp_password', 'email', 'name',
                'comission_only_for_achieved', 'comission_value'
            ], 'required', 'on' => $this::SCENARIO_INSERT_NEW],
            [[
                'smtp_host', 'smtp_port', 'smtp_user', 'email', 'name',
                'comission_only_for_achieved', 'comission_value'
            ], 'required', 'on' => $this::SCENARIO_UPDATE_EXISTING],
            [[
                'smtp_host', 'smtp_port', 'smtp_user', 'smtp_password', 'email', 'name',
                'comission_only_for_achieved', 'comission_value'
            ], 'safe'],
            [['configID', 'smtp_port', 'comission_only_for_achieved', 'comission_value'], 'integer'],
            [['smtp_host', 'smtp_user', 'smtp_password', 'email', 'name'], 'string', 'max' => 100],
            [['email'], 'email']
        ];
    }
    
    /**
    * {@inheritdoc}
    */
    public function attributeLabels()
    {
        return [
            'smtp_host' => 'Host SMTP',
            'smtp_port' => 'Port SMTP',
            'smtp_user' => 'User SMTP',
            'smtp_password' => 'Password SMTP',
            'email' => 'Email',
            'name' => 'Nama',
            'comission_only_for_achieved' => 'Komisi Hanya Untuk yang Mencapai Target',
            'comission_value' => 'Prosentase Komisi dari Profit Penjualan (%)'
        ];
    }

    /**
     * Save submitted data to JSOn config in config table
     * 
     * @return bool whether the data is saved successfully
     */
    public function save()
    {
        if ($this->validate()) {
            if (is_null($this->configID)) {
                Yii::$app->db->createCommand()->insert('config', [
                    'id_unit' => Yii::$app->user->identity->id_unit,
                    'config' => json_encode($this->attributes)
                ])->execute();
            } else {
                Yii::$app->db->createCommand()->update('config', [
                    'config' => json_encode($this->attributes)
                ], 'id_unit = :unit_id', [
                    ':unit_id' => Yii::$app->user->identity->id_unit
                ])->execute();
            }

            return true;
        }

        return false;
    }

    /**
     * Populate all JSON config data to this form model attributes
     * 
     * @return void
     */
    public function setConfigData()
    {
        $configData = ConfigSearch::getData();

        if ($configData === false) {
            $this->scenario = $this::SCENARIO_INSERT_NEW;
            $this->load([
                'smtp_host' => '',
                'smtp_port' => '',
                'smtp_user' => '',
                'smtp_password' => '',
                'email' => '',
                'name' => '',
                'comission_only_for_achieved' => '',
                'comission_value' => ''
            ]);
        } else {
            $this->scenario = $this::SCENARIO_UPDATE_EXISTING;
            $data = json_decode(json_decode($configData['config'], true), true);
            $this->attributes = ($data);
            $this->configID = $configData['id'];
        }
    }
}
