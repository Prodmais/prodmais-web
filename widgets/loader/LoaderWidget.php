<?php
namespace app\widgets\loader;
use yii\base\Widget;

class LoaderWidget extends Widget
{
  public function init() {
    parent::init();
  }

  public function run() {
    parent::run();
    return $this->render('template', [
      // 'input' => $input,
      // 'label' => $label
    ]);
  }

}