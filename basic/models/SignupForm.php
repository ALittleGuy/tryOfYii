<?php


namespace app\models;


use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $studentId;
    public $password;
    public $name;
    public $mobile;
    public $password_confirm;

    public function rules()
    {
        return [
            [['name', 'studentId', 'mobile', 'password' , 'password_confirm' ], 'required'],
            [['name', 'studentId'], 'string', 'max' => 10],
            [['mobile'], 'string', 'max' => 11],
            [['password','password_confirm'], 'string', 'max' => 30],
            ['password' , 'compare' , 'compareAttribute' => 'password_confirm' , 'message' =>'different password' ],
            ['studentId', 'unique', 'targetClass' => 'app\models\User', 'message' => 'user already exits']
        ];
    }


    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'studentId' => 'Student ID',
            'mobile' => 'Mobile',
            'password' => 'Password',
//            'password_confirm' => 'verify Password'
        ];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->studentId = $this->studentId;
        $user->name = $this->name;
        $user->mobile = $this->mobile;
        $user->setPassword($this->password);
        $user->setAuthkey();

        return $user->save() ? $user : null ;


    }

}