<?php
include('header.php');
?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Todays Shows
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Todays Shows</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box --> 
      <div class="box">
         <div class="box-header with-border">
              <h3 class="box-title">Available Shows</h3>
            </div>
        <div class="box-body">
          <?php
          $sw=mysqli_query($con,"select * from tbl_shows where st_id in(select st_id from tbl_show_time where screen_id in(select screen_id from  tbl_screens where t_id='".$_SESSION['theatre']."')) and status='1' and r_status='1'");
          if(mysqli_num_rows($sw))
          {?>
            <table class="table">
              <th class="col-md-1">
                Sl.no
              </th>
              <th class="col-md-2">
                Screen
              </th>
              <th class="col-md-3">
                Show Time
              </th>
              <th class="col-md-3">
                Movie
              </th>
              <?php
              $sl=1;
              while($shows=mysqli_fetch_array($sw))
              {
                ?>
                <tr>
                  <td>
                    <?php echo $sl; $sl++;?>
                  </td>
                  <?php
                  $st=mysqli_query($con,"select * from tbl_show_time where st_id='".$shows['st_id']."'");
                  $show_time=mysqli_fetch_array($st);
                  $sr=mysqli_query($con,"select * from tbl_screens where screen_id='".$show_time['screen_id']."'");
                  $screen=mysqli_fetch_array($sr);
                  $mv=mysqli_query($con,"select * from tbl_movie where movie_id='".$shows['movie_id']."'");
                  $movie=mysqli_fetch_array($mv);
                  ?>
                  <td>
                    <?php echo $screen['screen_name'];?>
                  </td>
                  <td>
                    <?php echo date('h:i A',strtotime($show_time['start_time']))." ( ".$show_time['name']." Show )";?>
                  </td>
                  <td>
                    <?php echo $movie['movie_name'];?>
                  </td>
                </tr>
                <?php
              }
              ?>
            </table>
            <?php
          }
          else
          {
            ?>
            <h3>No Shows Added</h3>
            <?php
          }
          ?>
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