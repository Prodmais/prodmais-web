<?php
  namespace app\components;

  use Yii;
  use Yii\base\Component;

  class Utils extends \yii\base\Component{

    public function init()
    {
      parent::init();
    }

    public function formatDate($data)
    {
      return Yii::$app->formatter->asDate($data, 'dd/MM/yyyy'); // 20/02/2022
    }

    // @DESC verifica se o usuario logado é admin
    public function isAdmin()
    {
      return yii::$app->user->identity->peti_codigo == 1 ? true : false;
    }

      // @DESC scape tags para os inputs
      public function scapeTags($model, $attr_criacao, $attr_alteracao)
      {
        $notScape = [
          $attr_criacao,
          $attr_alteracao
        ];
        foreach ($model->getAttributes() as $key => $value) {
          if ($value) {
            if (!in_array($key, $notScape))
              $model[$key] = strip_tags($value);
          }
        }
      }

      // @DESC validando errors atrributes
      public function verififyErrors($model)
      {
        // @DESC isso evita que seja enviado para BD com errors ja que não tratamos ID clean
        if (empty($model->getErrors())) {
          return true; // envia para o banco
        } else {
          return false; // nao envia para o banco
        }
      }

    // @DESC validando errors atrributes
    public function organizaData($data)
    {
        $pos = strpos($data, '/');
        // Note o uso de ===.  Simples == não funcionaria como esperado
        // por causa da posição de 'a' é 0 (primeiro) caractere.
        if ($pos === false) {
            return $data;
        } else {
           // @DESC esse / vem do form datepicker
           $explode = explode('/', $data);
           $dateFormatted = $explode[2] .'-'. $explode[1] .'-'. $explode[0];
           return $dateFormatted;
        }
    }

    // @DESC validando errors atrributes
    public function exibeData($data)
    {
      $explode = explode(" ", $data);
      $dt = explode("-", $explode[0]);
      $dateFormatted = $dt[2] .'/'. $dt[1] .'/'. $dt[0];

      return $dateFormatted;
    }

    public function gen_uuid() {
      return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
      );
    }

  }

?>