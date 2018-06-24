 <?php
 include('../../config.php');
    $sr=mysqli_query($con,"select * from tbl_screens where t_id='".$_POST['id']."'");
    if(mysqli_num_rows($sr))
    {
  ?>
    <table class="table table-bordered table-hover">
      <th class="col-md-1">Slno</th>
      <th class="col-md-3">Screen Name</th>
      <th class="col-md-1">Seats</th>
      <th class="col-md-1">Charge</th>
      <th class="col-md-3">Show Time</th>
      <th class="text-right col-md-3"><button data-toggle="modal" data-target="#view-modal" id="getUser" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Screen</button></th>
        <?php 
        $sl=1;
        while($screen=mysqli_fetch_array($sr))
        {
          ?>
          <tr>
            <td><?php echo $sl;?></td>
            <td><?php echo $screen['screen_name'];?></td>
            <td><?php echo $screen['seats'];?></td>
            <td><?php echo $screen['charge'];?></td>
            <?php 
              $st=mysqli_query($con,"select * from tbl_show_time where screen_id='".$screen['screen_id']."'");
            ?>
            <td><?php if(mysqli_num_rows($st)) { while($stm=mysqli_fetch_array($st))
            { echo date('h:i a',strtotime($stm['start_time']))." ,";}}
            else
            {echo "No Show Time Added";}
            ?></td>
            <td class="text-right"><button data-toggle="modal" data-id="<?php echo $screen['screen_id'];?>" data-target="#view-modal2" id="getUser2" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i> Add Show Times</button></td>
          </tr>
          <?php
          $sl++;
        }
        ?>
    </table>
    <?php
    }
    else
    {
      ?>
      <button data-toggle="modal" data-target="#view-modal" id="getUser" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Screen</button>
      <?php
    }
    ?>