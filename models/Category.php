<?php

namespace app\modules\shop\models;

/**
 * This is the model class for table "tbl_category".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $create_time
 * @property integer $update_time
 */
class Category extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tbl_category';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['description'], 'string'],
			[['create_time', 'update_time'], 'required'],
			[['create_time', 'update_time'], 'integer'],
			[['title'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		];
	}
}
