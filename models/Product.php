<?php

namespace app\modules\shop\models;

/**
 * This is the model class for table "tbl_product".
 *
 * @property integer $id
 * @property string $price
 * @property string $title
 * @property string $description
 * @property integer $create_time
 * @property integer $update_time
 * @property array $categories
 */
class Product extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tbl_product';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['price'], 'number'],
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
			'price' => 'Price',
			'title' => 'Title',
			'description' => 'Description',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
		];
	}

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable( 'tbl_product_category', [ 'product_id' => 'id' ] );
    }
}
