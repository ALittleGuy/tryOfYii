<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $studentId
 * @property string $mobile
 * @property string $password_hash
 * @property string|null $email
 * @property string|null $birthday
 * @property string|null $college
 * @property string|null $major
 * @property string|null $dormitory
 * @property string|null $sex
 * @property string|null $auth_key
 * @property string|null $access_toaken
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
    public function rules()
    {
        return [
            [['name', 'studentId', 'mobile', 'password_hash'], 'required'],
            [['birthday'], 'safe'],
            [['name', 'studentId', 'college', 'major'], 'string', 'max' => 10],
            [['mobile'], 'string', 'max' => 11],
            [['password_hash', 'access_toaken'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 25],
            [['dormitory'], 'string', 'max' => 6],
            [['sex'], 'string', 'max' => 2],
            [['auth_key'], 'string', 'max' => 32],
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
            'studentId' => 'Student ID',
            'mobile' => 'Mobile',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'birthday' => 'Birthday',
            'college' => 'College',
            'major' => 'Major',
            'dormitory' => 'Dormitory',
            'sex' => 'Sex',
            'auth_key' => 'Auth Key',
            'access_toaken' => 'Access Toaken',
        ];
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);

    }

    public function setAuthkey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
//        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by name
     *
     * @param string $name
     * @return static|null
     */
    public static function findByUsername($name)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['name'], $name) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        if(Yii::$app->security->validatePassword($password , $this->password_hash)){
            return true;
        }
        return false;
    }
}

