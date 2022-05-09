<?php

namespace app\models;
use Yii;

class User extends Users implements \yii\web\IdentityInterface
{

    /**
     * {@inheritdoc}
     */
     // valida a senha do usuario
    public function verifyPassword($senha)
    {
        $dbsenha = static::findOne(['name' => Yii::$app->user->identity->name])->password;
        return Yii::$app->security->validatePassword($senha, $dbsenha);
    }

    /**
     * {@inheritdoc}
     */
    // encontra o usuario por ID
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    // ele procura por uma instância da classe de identidade usando o token de acesso informado.
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented. ');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    // aqui ele procura o Usuario que tenha esse email e seja habilitado...
    public static function findByUsername($email)
    {
        // esse $email é passada pelo submit login
        return static::findOne(['email' => $email]);
    }

    /**
     * {@inheritdoc}
     */
    // recupera o id do Usuario
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        // return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        // return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    // compara se a senha passada por post é igual a senha do Usuario do banco
    public function validatePassword($senha)
    {
        return Yii::$app->security->validatePassword($senha, $this->password);
    }

    // exibe somente o primeiro nome
    public function getNomeSolo() {
        $nome = explode(' ', yii::$app->user->identity->name);
        return "" .ucfirst($nome[0]). "";
    }
}
