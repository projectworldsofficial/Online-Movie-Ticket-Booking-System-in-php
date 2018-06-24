
 			<div class="listview_1_of_3 images_1_of_3">
					<h3>Films in Theaters</h3>
					
					<?php
          	 $today=date("Y-m-d");
          	$qry2=mysqli_query($con,"select * from  tbl_movie where status='0' order by rand() limit 3");
						
          	  while($m=mysqli_fetch_array($qry2))
                   {
                    ?>
            <div class="content-left">
					<div class="listimg listimg_1_of_2">
					<?php
						
						?>
						 <a href="about.php?id=<?php echo $m['movie_id'];?>"><img src="<?php echo $m['image'];?>"></a>
					</div>
					<div class="text list_1_of_2">
						  <div class="extra-wrap1">
                                         <a href="about.php?id=<?php echo $m['movie_id'];?>" class="link4"><?php echo $m['movie_name'];?></a><br>
                                        <span class="data">Release Date:<?php echo $m['release_date'];?></span><br>
                                        Cast:<Span class="data"><?php echo $m['cast'];?></span><br>
                                        Description: <span" class="color2"><?php echo $m['desc'];?></span><br>
                                    </div>
					</div>
					
					<div class="clear"></div>
				</div>
  	    <?php
  	    	}
  	    	?>
					
					
				
				
					
					
				
				
				
				
				</div>		
				<div class="clear"></div>		
			
