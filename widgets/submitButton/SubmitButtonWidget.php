<?php
  namespace app\widgets\submitButton;
  use yii\base\Widget;

// Widget
class SubmitButtonWidget extends Widget
{
  // Parameters Widget
  public $text;   // Text
  public $classButton;   // Text
  public $url;   // Text

  // Init Widget
  public function init() {
    parent::init();

    if ($this->classButton == '')
      $this->classButton = 'btn-lg btn-block btn btn-success';

    if ($this->text == '')
      $this->text = 'SALVAR';
  }

  // Run Widget
  public function run() {
    parent::run();
    return $this->render('template', [
      'text' => $this->text,
      'classButton' => $this->classButton,
      'url' => $this->url,
    ]);
  }
}