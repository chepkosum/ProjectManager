<?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-warning">
            <?= $this->session->flashdata('msg'); ?>
        </div>
    <?php } ?>
<?php foreach($tasks as $task){?>
<div class="card">
  <div class="container">
    <h4><b>Project Name</b>:::<?php echo $task->project_name; ?></h4>
    <h5><b>Task Name</b>:::<?php echo $task->deliverable_name; ?></h5>    
    
      <?php
      if($task->developer_mark=='no'){?>
        <p><strong>Status</strong>:::Incomplete
          <a href="<?php echo base_url();?>developer/tasks/mark/<?php echo $task->deliverable_id?>">Mark as Complete</a>
        </p>

      <?php
    }
      else{
        ?>
        <p><strong>Status</strong>:::Complete</p>
        <?php
      }
      
      ?>
  </div>
</div>
<?php 
}
?>
