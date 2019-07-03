<?php if ($this->session->flashdata()) { ?>
        <div class="alert alert-warning">
            <?= $this->session->flashdata('msg'); ?>
        </div>
    <?php 

  } ?>

<?php foreach($projects as $project){?>

<div class="card">
  <img class='logo' src="<?php echo base_url('assets/img/logo.jpg'); ?>" alt="Logo">
  <div class="container">
    <h4>Project Name::<b><?php echo $project->project_name; ?></b></h4> 
    <p><strong>Start Date</strong>::<?php echo $project->start_date; ?></p>
    <p><strong>End Date</strong><?php echo $project->end_date; ?></p>
    <p><strong>Project Manager</strong><?php echo $project->full_name; ?></p>
    <p>Deliverables</p>
    <div class="Table">
      <div class="Heading">
        <div class="Cell">
            <p>S/N</p>
        </div>
        <div class="Cell">
            <p>Deliverable Name</p>
        </div>
        <div class="Cell">
            <p>Developer</p>
        </div>
        <div class="Cell">
            <p>Developer Status</p>
        </div>
        <div class="Cell">
            <p>Manager Status</p>
        </div>
        <div class="Cell">
            <p>Actions</p>
        </div>
    </div>

<?php
$count=1;
 foreach($delivers as $deliver)
{
  if($project->project_id==$deliver->project_id){
  ?>
   <div class="Row">
     <div class="Cell"><p><?php echo $count; ?></p></div>
     <div class="Cell"><p><?php echo $deliver->deliverable_name; ?></p></div>
     <div class="Cell"><p><?php echo $deliver->full_name; ?></p></div>
     <div class="Cell"><p><?php 
                           if($deliver->developer_mark==='no'){
                            echo 'not complete';
                           }
                           else{
                            echo "marked complete";
                           }
                          ?></p></div>
     <div class="Cell"><p><?php
                             if($deliver->developer_mark==='no'){
                            echo 'not complete';
                           }
                           elseif($deliver->manager_mark==='no'){?>
                            <a class="btn btn-primary" href="<?php echo base_url() ?>manager/project/mark/<?php echo $deliver->deliverable_id; ?>">Mark As Complete</a>
                            <?php
                          }
                            else{
                              echo "Marked as Complete";
                            }
                           
                           ?>
                             
    </p></div>
    <div class="Cell"> <p>
       <a class="btn btn-primary" href="<?php echo base_url() ?>manager/project/edit_project/<?php echo $deliver->deliverable_id; ?>">Edit</a>
         <a class="btn btn-primary" href="<?php echo base_url() ?>manager/project/delete_project/<?php echo $deliver->deliverable_id; ?>">Delete</a>
    </p>
  </div>
  <!--<div class="Cell"><p>
    <select  name='developer'>
    <?php

    foreach ($developers as $developer) {
      ?>
      <option value='<?php echo $developer->developer_id;?>'><?php echo $developer->full_name;?></option>
      <?php

      # code...
    }
    ?>
    </select>
    <a class="btn btn-primary" href="<?php echo base_url() ?>manager/project/assign_project/<?php echo $deliver->deliverable_id; ?>">Submit</a>
  </p></div>
-->

  </div>
  <?php 
  $count++;
}
}
?>
  </div>
</div>
</div>
<?php 
}
?>
