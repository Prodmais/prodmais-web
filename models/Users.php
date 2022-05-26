<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Users".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $type
 * @property string|null $token
 * @property string $createdAt
 * @property string $updatedAt
 * @property string|null $deletedAt
 *
 * @property Boards[] $boards
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $password_confirm;

    public static function tableName()
    {
        return 'Users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        // @DESC strings para refinamento
        $strings = [
            'name', 'email','type'
        ];
        return [
            [['name', 'email', 'password', 'password_confirm'], 'required'],
            [['createdAt', 'updatedAt', 'deletedAt'], 'safe'],
            [['name'], 'string', 'max' => 40],
            [['email', 'password', 'token'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 25],
            
            // my rules --------------------------------
            [['email'], 'unique', 'message' => '{attribute} indisponível'],
            [['email'], 'email'],
            [['password', 'password_confirm'], 'string', 'min' => 6],
            [$strings, 'trim'],
            [$strings, 'filter', 'filter'=>'mb_strtolower'],
            [['password_confirm'], 'compare', 'compareAttribute' => 'password'],
            // my rules --------------------------------

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirm' => 'Password Confirm',
            'type' => 'Type',
            'token' => 'Token',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
            'deletedAt' => 'Deleted At',
        ];
    }

    /**
     * Gets query for [[Boards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoards()
    {
        return $this->hasMany(Boards::className(), ['userId' => 'id']);
    }
}
