<?php
namespace app\components;

use Yii;
use Yii\base\Component;

class ConvertToBase64 extends \yii\base\Component{
  public function init() {
    parent::init();
  }

  public function convertImage($name_image, $folder) {

    $loadImage = Yii::$app->RequestPath->realPath2(). '/'.$folder.'/' .$name_image;
    // @DESC verifica se a imagem existe no SRV
    if (file_exists($loadImage) && $name_image != '') {

      // echo "<pre>". print_r($name_image, 1) ."</pre>";
      // die();

      $imgData = base64_encode(file_get_contents($loadImage));
      $src = 'data:'.mime_content_type($loadImage).';base64,'.$imgData;

    } else {

      // echo "string";
      // die();

      $loadDefaultImage = Yii::$app->RequestPath->realPath2(). '/'.$folder.'/' .'default.png';
      // @DESC tento carregar a imagem default do SRV
      if (file_exists($loadDefaultImage)) {
        $imgData = base64_encode(file_get_contents($loadDefaultImage));
        $src = 'data: '.mime_content_type($loadDefaultImage).';base64,'.$imgData;
      } else {
        // @DESC se nao existir nem a imagem nem o default carrega em branco
        $src = '#';
      }

    }
    return $src;
  }

}

?>