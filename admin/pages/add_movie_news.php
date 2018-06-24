<?php
include('header.php');
?>
<link rel="stylesheet" href="../../validation/dist/css/bootstrapValidator.css"/>
    
<script type="text/javascript" src="../../validation/dist/js/bootstrapValidator.js"></script>
  <!-- =============================================== -->
  <?php
    include('../../form.php');
    $frm=new formBuilder;      
  ?>   
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Movies News
      </h1>
      <?php
      if($_SESSION['add'])
      {?>
      <div class="alert alert-success">
  <strong>Success!</strong> News added successfully..
</div>
<?php
}?>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Add Movies News</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box --> 
      <div class="box">
        <div class="box-body">
            <form action="process_add_news.php" method="post" enctype="multipart/form-data" id="form1">
              <div class="form-group">
                <label class="control-label">Movie name</label>
                <input type="text" name="name" class="form-control"/>
                <?php $frm->validate("name",array("required","label"=>"Movie Name")); // Validating form using form builder written in form.php ?>
              </div>
              <div class="form-group">
                 <label class="control-label">Cast</label>
                <input type="text" name="cast" class="form-control">
                <?php $frm->validate("cast",array("required","label"=>"Cast","regexp"=>"text")); // Validating form using form builder written in form.php ?>
              </div>
              
              <div class="form-group">
                <label class="control-label">Release Date</label>
                <input type="date" name="date" class="form-control"/>
                <?php $frm->validate("date",array("required","label"=>"Release Date")); // Validating form using form builder written in form.php ?>
              </div>
              
              <div class="form-group">
                <label class="control-label">Description</label>
                 <input type="text" name="description" class="form-control">
                 <?php $frm->validate("description",array("required","label"=>"Description")); // Validating form using form builder written in form.php ?>
              </div>
              <div class="form-group">
                  <label class="control-label">Images</label>
              <input type="file"  name="attachment" class="form-control" placeholder="Images">
               <?php $frm->validate("attachment",array("required","label"=>"Image")); // Validating form using form builder written in form.php ?>
              </div>
              <div class="form-group">
                <button class="btn btn-success">Add News</button>
              </div>
        </form>
        </div> 
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <?php
include('footer.php');
?>
<script>
        <?php $frm->applyvalidations("form1");?>
    </script>