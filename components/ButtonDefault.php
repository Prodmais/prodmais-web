<?php
namespace app\components;

use Yii;
use Yii\base\Component;

class ButtonDefault extends \yii\base\Component{

  public function init() {
    parent::init();
  }

  private function result($icon, $title, $alt, $class, $confirm_msg=null) {
    return [
        'icon'        => $icon,
        'title'       => $title,
        'alt'         => $alt,
        'class'       => $class,
        'confirm_msg' => $confirm_msg,
    ];
  }

   public function generate($type, $icon=null, $title=null, $alt=null, $class=null, $confirm_msg=null) {
    switch ($type) {
        // View action Buttton
        case 'view':
            return $this->result(
                '<i class="fa fa-eye"></i>',
                'Visualizar',
                'Visualizar',
                'btn btn-xs btn-primary',
            );
            break;
        // Update action Buttton
        case 'update':
            return $this->result(
                '<i class="fa fa-edit"></i>',
                'Editar',
                'Editar',
                'btn btn-xs btn-info',
            );
            break;
        // Delete action Buttton
        case 'delete':
            return $this->result(
                '<i class="fa fa-trash-o"></i>',
                'Desabilitar',
                'Desabilitar',
                'btn btn-xs btn-danger',
                'Deseja desabilitar o item selecionado?',
            );
            break;
        // Print action Buttton
        // case 'print':
        //     return $this->result(
        //         '<i class="fa fa-file-pdf-o"></i>',
        //         'Pdf',
        //         'Pdf',
        //         'btn btn-xs btn-success',
        //     );
        //     break;
        // Accordeon action Buttton
        // case 'accordeon':
        //     return $this->result(
        //         '<i class="fa fa-cubes"></i>',
        //         'Exibir',
        //         'Exibir',
        //         '',
        //     );
        //     break;
        // DataTable create right button
        case 'dataFloatButton':
            return $this->result(
                '',
                'Cadastrar',
                'Cadastrar',
                'btn btn-sm btn-success',
            );
            break;
        // Update View Button
        case 'update-view':
            return $this->result(
                '',
                'Atualizar',
                'Atualizar',
                'btn btn-sm btn-info',
            );
            break;
        // Delete View Button
        case 'delete-view':
            return $this->result(
                '',
                'Desabilitar',
                'Desabilitar',
                'btn btn-sm btn-danger',
                'Deseja desabilitar o item selecionado?',
            );
            break;
        // Custom Button
        case 'custom':
            return $this->result(
                $icon,
                $title,
                $alt,
                $class,
                $confirm_msg,
            );
            break;
        default:
            # code...
            break;
    }
   }
}

?>