<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Tasks".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $status
 * @property string|null $endDate
 * @property string $createdAt
 * @property string $updatedAt
 * @property int $boardId
 *
 * @property Boards $board
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Tasks';
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
            [['name', 'status', 'boardId'], 'required'],
            [['endDate', 'createdAt', 'updatedAt'], 'safe'],
            [['boardId'], 'default', 'value' => null],
            [['boardId'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['description'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 20],
            [['boardId'], 'exist', 'skipOnError' => true, 'targetClass' => Boards::className(), 'targetAttribute' => ['boardId' => 'id']],
            // my rules --------------------------------
            [$strings, 'trim'],
            [$strings, 'filter', 'filter'=>'mb_strtolower']
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
            'status' => 'Status',
            'endDate' => 'End Date',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
            'boardId' => 'Board ID',
        ];
    }

    /**
     * Gets query for [[Board]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoard()
    {
        return $this->hasOne(Boards::className(), ['id' => 'boardId']);
    }
}
