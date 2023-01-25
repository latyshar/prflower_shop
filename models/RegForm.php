<?php

namespace app\models;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\User;
use Yii;

class RegForm extends User
{
 public $confirm_password;
 public $agree;
 public function rules()
 {
 return [
 [['name_u', 'surname', 'patronymic', 'login',  'email', 'password', 'confirm_password', 'agree'], 'required'],
 [['name_u', 'surname', 'patronymic'], 'match', 'pattern'=>'/^[А-ЯЁа-яё]{5,}$/u', 'message'=>'Используйте минимум 5 русских букв'],
 [['login'], 'match', 'pattern'=>'/^[A-Za-z0-9]{5,}$/', 'message'=>'Используйте минимум 5 латинских букв'],
 [['password'], 'match', 'pattern'=>'/^[A-Za-z0-9]{5,}$/', 'message'=>'Используйте минимум 5 латинских букв и цифр'],
 [['email'], 'email'],
 [['confirm_password'], 'compare','compareAttribute'=>'password'],
 [['email','login'], 'unique'],
 [['agree'], 'compare', 'compareValue'=>true, 'message'=>''],
 [['name_u', 'surname', 'patronymic', 'login', 'email', 'password'], 'string', 'max' => 255],
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
 'email' => 'Email',
 'login' => 'Логин',
 'password' => 'Пароль',
 'confirm_password' => 'Повторите пароль',
 'administrator' => 'Права админа',
 'agree' => 'Подтвердите согласие на обработку персональных
данных',
 ];
 }
}
