<?php

namespace app\components;

use Yii;
use Yii\base\Component;

class Messages extends Component {

private function list() {

    $array = [
        "Acredite que você pode, assim você já está no meio do caminho",
        "Não atrase o seu progresso com medo de fracassar!",
        "Se não puder fazer tudo, faça tudo o que puder",
        "Persistência é o caminho para o sucesso",
        "Você é forte, não desista!",
        "Você é capa de fazer o que você quiser!",
        "Novo dia, nova semana, nova meta, nova missão",
        "O passo que você está com medo de dar pode ser o que vai mudar tudo!",
        "Tenha paciência e persistência para aquilo que você deseja",
        "Os dias difíceis são uma forma de você apreciar os bons",
        "Tenha confiança no seu potencial",
        "Tenha em mente que seu corpo precisa de descanso para recarregar as energias! Não exija tudo de si",
        "Quando tudo parecer um caos, é possível que a vida esteja te encaminhando para uma grande mudança!",
        "A única forma de saber se está crescendo ou não, é quando se sente incomodado onde está",
        "O primeiro passo é sempre o mais difícil"
    ];

    shuffle($array);

    return $array[0];


}

  // upload form action --------------
  public function getMessage()
  {
    return $this->list();
  }

}
