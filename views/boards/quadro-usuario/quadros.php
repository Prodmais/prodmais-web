<!-- Listando todos os quadros e suas atividades -->
<div class="quadro-usuario-index testimonial-group">
   <div class="row" >

      <?php foreach ($dataQuadro as $key => $value): ?>

         <div class="col-xs-3">
            <div class="box box-primary" style="position: relative; left: 0px; top: 0px;">
               <div class="box-header ui-sortable-handle">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title"><?php echo ucfirst($value['name']) ?></h3>
                  <div class="box-tools pull-right">

                     <div class="tools" style="cursor: pointer;">
                        <i onclick="atualizarAjax('<?= $value['id'] ?>')" style="color: #3c8dbc" class="fa fa-edit"></i>
                        <i onclick="excluirQuadro('<?= $value->id ?>')" style="color: #dd4b39" class="fa fa-trash-o"></i>
                     </div>

                  </div>
               </div>
               <div class="box-body">
                  <?php require(__DIR__ . '/tarefas.php'); ?>
               </div>
            </div>
         </div>

      <?php endforeach ?>

   </div>
</div>
