<?php
namespace app\widgets\head;
use yii\base\Widget;

class HeadWidget extends Widget
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