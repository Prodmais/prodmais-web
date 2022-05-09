<ul class="todo-list ui-sortable">

   <!-- verificando se existe tarefa cadastrada -->
   <?php if (count($value->lista_tarefa) >= 1): ?>

      <?php foreach ($value->lista_tarefa as $keyTarefa => $valueTarefa): ?>

         <li class="" style="cursor: pointer;">

            <span class="handle ui-sortable-handle">
               <i class="fa fa-ellipsis-v"></i>
               <i class="fa fa-ellipsis-v"></i>
            </span>

            <input onclick="alterarStatus('<?= $valueTarefa->id ?>')" type="checkbox" value="">

            <span onclick="atualizarTarefaAjax('<?= $valueTarefa->id ?>')">

               <?php if ($valueTarefa->status !== 'Do' ): ?>
                  <span style="text-decoration: line-through !important;" class="text text-danger"><?= $valueTarefa->name ?></span>
               <?php else: ?>
                  <span class="text"><?= $valueTarefa->name ?></span>
               <?php endif ?>

               <small class="label label-default">
                  <i class="fa fa-clock-o"></i>
                  <?= Yii::$app->Utils->exibeData($valueTarefa->createdAt) ?>
               </small>
            </span>

            <div class="tools hidden">
               <i class="fa fa-edit"></i>
               <i class="fa fa-trash-o"></i>
            </div>
         </li>

      <?php endforeach ?>

   <?php else: ?>

      <div class="callout callout-info">
         <h4>Nenhuma tarefa no quadro!</h4>
      </div>

   <?php endif ?>

</ul>

<div class="box-footer clearfix no-border">
   <button onclick="cadastrarTarefaAjax('<?php echo $value->id ?>')" type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Tarefas</button>
</div>
