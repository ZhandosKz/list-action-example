<?php

use yii\db\Schema;

class m140108_185214_list_action_data extends \yii\db\Migration
{
	public function up()
	{
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';


        $this->createTable('tbl_product', [
                'id' => Schema::TYPE_PK,
                'price' => Schema::TYPE_DECIMAL,
                'title' => Schema::TYPE_STRING,
                'description' => Schema::TYPE_TEXT,
                'create_time' => Schema::TYPE_INTEGER . ' NOT NULL',
                'update_time' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);

        $this->createTable('tbl_category', [
                'id' => Schema::TYPE_PK,
                'title' => Schema::TYPE_STRING,
                'description' => Schema::TYPE_TEXT,
                'create_time' => Schema::TYPE_INTEGER . ' NOT NULL',
                'update_time' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);

        $this->createTable('tbl_product_category', [
                'product_id' => Schema::TYPE_INTEGER,
                'category_id' => Schema::TYPE_INTEGER,
            ], $tableOptions);

        $this->createIndex( 'product_category_pk', 'tbl_product_category', 'product_id, category_id', true );

        // Данные для теста
        Yii::$app->db->createCommand( "
INSERT INTO `tbl_category` (`id`, `title`, `description`, `create_time`, `update_time`) VALUES
(1, 'category title #1', 'category description #1', 0, 0),
(2, 'category title #2', 'category description #2', 0, 0),
(3, 'category title #3', 'category description #3', 0, 0);
INSERT INTO `tbl_product` (`id`, `title`, `description`, `price`, `create_time`, `update_time`) VALUES
(1, 'product title #1', 'product description #1', 500, 0, 0),
(2, 'product title #2', 'product description #2', 400, 0, 0),
(3, 'product title #3', 'product description #3', 300, 0, 0),
(4, 'product title #4', 'product description #4', 500, 0, 0),
(5, 'product title #5', 'product description #5', 400, 0, 0),
(6, 'product title #6', 'product description #6', 700, 0, 0),
(7, 'product title #7', 'product description #7', 100, 0, 0),
(8, 'product title #8', 'product description #8', 400, 0, 0),
(9, 'product title #9', 'product description #9', 200, 0, 0),
(10, 'product title #10', 'product description #10', 100, 0, 0);
INSERT INTO `tbl_product_category` (`product_id`, `category_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 3),
(4, 2),
(5, 2),
(6, 1),
(7, 1),
(8, 1),
(8, 2),
(9, 3),
(10, 3);
		" )->execute();

	}

	public function down()
	{
        $this->dropTable('tbl_product_category');
        $this->dropTable('tbl_product');
        $this->dropTable('tbl_category');
		return true;
	}
}
