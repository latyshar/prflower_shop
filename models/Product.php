<?php

namespace app\models;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id_p
 * @property string $name_p
 * @property string $img
 * @property string $country
 * @property int $id_category
 * @property int $count
 * @property float $price
 * @property string $date_p
 *
 * @property Cart[] $carts
 * @property Category $category
 * @property Order[] $orders
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_p', 'country', 'id_category', 'count', 'price'], 'required'],
            [['id_category', 'count'], 'integer'],
            [['price'], 'number'],
            [['img'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 2*1024*1024, 'skipOnEmpty' => false],
            [['date_p'], 'safe'],
            [['name_p', 'img', 'country'], 'string', 'max' => 100],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['id_category' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_p' => 'ID',
            'name_p' => 'Название товара',
            'img' => 'Фото',
            'country' => 'Страна',
            'id_category' => 'Категория',
            'count' => 'Количество',
            'price' => 'Цена',
            'date_p' => 'Дата добавления',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['id_product' => 'id_p']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'id_category']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['id_product' => 'id_p']);
    }
}
