<?php

namespace app\models;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id_u
 * @property string $name_u
 * @property string $surname
 * @property string $patronymic
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $reg_date
 * @property int|null $administrator
 *
 * @property Cart[] $carts
 * @property Order[] $orders
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
     
     
    public static function findIdentity($id)
    {
     return static::findOne($id);
    }
 
    public static function findIdentityByAccessToken($token, $type = null)
    {
     return static::findOne(['access_token' => $token]);
    }
 
    public function getId()
    {
      return $this->id_u;
    }
    
    public function getAuthKey()
    {
       return ;
    }

    public function validateAuthKey($authKey)
    {
        return ;
    }

    public function validatePassword($password)
    {
        return $this->password==$password;
    }

    public static function findByLogin($login)
    {
        return self::find()->where(['login'=> $login])->one();
    }
     
    public function rules()
    {
        return [
            [['name_u', 'surname', 'patronymic', 'login', 'email', 'password'], 'required'],
            [['reg_date'], 'safe'],
            [['administrator'], 'integer'],
            [['name_u', 'surname', 'patronymic', 'login', 'email', 'password'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_u' => 'ID',
            'name_u' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'reg_date' => 'Дата регистрации',
            'administrator' => 'Админ',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['id_user' => 'id_u']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['id_user' => 'id_u']);
    }
}
