<?php

namespace app\components;

use Yii;
use Yii\base\Component;

class RequestPath extends Component {

  // upload form action --------------
  public function realPathRoot2()
  {
    return realpath(dirname(__FILE__).'/../web/custom');
  }

  public function realPath2()
  {
    return realpath(dirname(__FILE__).'/../web/custom/img');
  }

  public function pathUpload()
  {
    return './../web/custom/img/';
  }

  // DELETE IMAGE
  public function removeFromServer($folderName, $file) {

    if (
        $file !== NULL &&
        $file !== 'default.png' &&
        $file !== ''
    ) {

      // @DESC caso encontre no srv entao apagar
      if (file_exists('../web/custom/img' . '/'.$folderName.'/' .$file)) {
        unlink('../web/custom/img' . '/'.$folderName.'/' .$file);
      }

    }

  }

}
