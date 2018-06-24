
<div class="panel panel-default">
            <div class="panel-body" id="disp"><?php
    extract($_POST);
    include('../../config.php');
    $w=mysqli_query($con,"select * from tbl_shows where st_id='$id' and r_status='1'");
    $swt=mysqli_fetch_array($w);
    $qq=mysqli_query($con,"select * from tbl_bookings where show_id='".$swt['s_id']."' and date=CURDATE()");
    if(mysqli_num_rows($qq))
    {
        $m=mysqli_query($con,"select * from tbl_movie where movie_id='".$swt['movie_id']."'");
        $movie=mysqli_fetch_array($m);
        ?>
        
         <h3><small>Movie : </small><?php echo $movie['movie_name'];?></h3>
        <table class="table">
            <th>
                Slno
            </th>
            <th>
                Ticket id
            </th>
            <th>
                Viewer Name
            </th>
            <th>
                Phone
            </th>
            <th>
                Number of Tickets
            </th>
        <?php
    $sl=1;
    while($sh=mysqli_fetch_array($qq))
    {
        $us=mysqli_query($con,"select * from tbl_registration where user_id='".$sh['user_id']."'");
        $user=mysqli_fetch_array($us);
        ?>
        <tr>
            <td><?php echo $sl; $sl++;?></td>
            <td><?php echo $sh['ticket_id'];?></td>
            <td><?php echo $user['name'];?></td>
            <td><?php echo $user['phone'];?></td>
            <td><?php echo $sh['no_seats'];?></td>
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
        <h3>No Show</h3>
        <?php
    }
?></div>
          </div>