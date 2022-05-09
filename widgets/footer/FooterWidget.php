<?php
namespace app\widgets\footer;
use yii\base\Widget;

class FooterWidget extends Widget
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