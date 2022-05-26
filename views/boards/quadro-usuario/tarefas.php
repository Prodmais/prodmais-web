<style>
.task-item:hover{
   border-color: #00AFB7 !important;
}
</style>

<ul class="todo-list ui-sortable" style="cursor: pointer !important;">

   <!-- verificando se existe tarefa cadastrada -->
   <?php if (count($value->lista_tarefa) >= 1): ?>

      <?php foreach ($value->lista_tarefa as $keyTarefa => $valueTarefa): ?>

         <li class="task-item" style="cursor: pointer !important;" onclick="atualizarTarefaAjax('<?= $valueTarefa->id ?>')">
            <div class="overflow-spaces">

               <span class="handle ui-sortable-handle">

                  <?php
                     switch ($valueTarefa->status) {
                        case 'Doing':
                           echo '<small style="color: #dd4b39" class="text"> '.strtoupper($valueTarefa->status). ' | ' .$valueTarefa->name .'</small>';
                           break;

                           case 'Done':
                              echo '<small style="color: green;  text-decoration: line-through !important;" class="text"> '.strtoupper($valueTarefa->status). ' | ' .$valueTarefa->name .'</small>';
                              break;
                        
                        default:
                           echo '<small style="color: gray" class="text"> '.strtoupper($valueTarefa->status). ' | ' .$valueTarefa->name .'</small>';
                           break;
                     }
                  ?>
                  
               </span>

            </div>
         </li>

      <?php endforeach ?>

   <?php else: ?>

      <div class="callout callout-info">
         <h4>No Task!</h4>
      </div>

   <?php endif ?>

</ul>

<div class="box-footer clearfix no-border">
   <button onclick="cadastrarTarefaAjax('<?php echo $value->id ?>')" type="button" class="btn btn-xs btn-default pull-right"><i class="fa fa-plus"></i> TASK</button>
</div>
