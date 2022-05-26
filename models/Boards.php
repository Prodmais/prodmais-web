<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Boards".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property bool|null $isMobile
 * @property string $createdAt
 * @property string $updatedAt
 * @property int $userId
 *
 * @property Users $user
 * @property Tasks[] $tasks
 */
class Boards extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    // carregar as tarefas
    public $lista_tarefa;
    
    public static function tableName()
    {
        return 'Boards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $strings = [
            'name', 'description'
        ];
        return [
            [['name', 'userId'], 'required'],
            [['isMobile'], 'boolean'],
            [['createdAt', 'updatedAt', 'lista_tarefa'], 'safe'],
            [['userId'], 'default', 'value' => null],
            [['userId'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['description'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userId' => 'id']],
            // my rules --------------------------------
            // [['name'], 'unique'],
            [$strings, 'trim'],
            [$strings, 'filter', 'filter'=>'mb_strtolower'],
            // my rules -------------------------------
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
            'description' => 'Description',
            'isMobile' => 'Is Mobile',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
            'userId' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userId']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['boardId' => 'id']);
    }

    // @DESC tudo o que for de ID é preciso criptografar
    public function afterFind()
    {
        parent::afterFind();

        // echo "13";
        // die();
    }

}
