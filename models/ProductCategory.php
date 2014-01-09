<?php

namespace app\modules\shop\models;

/**
 * This is the model class for table "tbl_product_category".
 *
 * @property integer $product_id
 * @property integer $category_id
 */
class ProductCategory extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tbl_product_category';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['product_id', 'category_id'], 'integer'],
			[['product_id', 'category_id'], 'unique', 'targetAttribute' => ['product_id', 'category_id'], 'message' => 'The combination of Product ID and Category ID has already been taken.']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'product_id' => 'Product ID',
			'category_id' => 'Category ID',
		];
	}
}
