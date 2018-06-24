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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Theatre
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Add Theatre</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box --> 
      <div class="box">
        <div class="box-body">
            <form action="process_add_theater.php" method="post" id="form1">
              <div class="form-group">
                <label class="control-label">Name</label>
                <input type="text" name="name" class="form-control"/>
                <?php $frm->validate("name",array("required","label"=>"Theatre Name")); // Validating form using form builder written in form.php ?>
              </div>
              <div class="form-group">
                <label class="control-label">Address</label>
                <input type="text" name="address" class="form-control"/>
                <?php $frm->validate("address",array("required","label"=>"Theatre Address")); // Validating form using form builder written in form.php ?>
              </div>
              <div class="form-group">
                <label class="control-label">Place</label>
                <input type="text" name="place" id="autocomplete" onFocus="geolocate()" class="form-control">
                <?php $frm->validate("place",array("required","label"=>"Place")); // Validating form using form builder written in form.php ?>
              </div>
              <div class="form-group">
                 <label class="control-label">State</label>
                <input type="text" name="state" id="administrative_area_level_1" s placeholder="State" class="form-control">
                <?php $frm->validate("state",array("required","label"=>"State")); // Validating form using form builder written in form.php ?>
              </div>
              <div class="form-group">
                <label class="control-label">Pin Code</label>
                 <input type="text" name="pin" id="postal_code"s placeholder="Zip code" class="form-control">
                 <?php $frm->validate("pin",array("required","label"=>"Pin Code","regexp"=>"pin")); // Validating form using form builder written in form.php ?>
              </div>
              <?php
                start:
                $username="USR".rand(123456,999999);
                $u=mysqli_query($con,"select * from tbl_login where username='$username'");
                if(mysqli_num_rows($u))
                {
                  goto start;
                }
              ?>
              <div class="form-group">
                <label class="control-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username ?>">
                <?php $frm->validate("username",array("required","label"=>"Username")); // Validating form using form builder written in form.php ?>
              </div>
              <div class="form-group">
                <label class="control-label">Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo "PWD".rand(123456,999999);?>">
                <?php $frm->validate("password",array("required","label"=>"Password")); // Validating form using form builder written in form.php ?>
              </div>
              <div class="form-group">
                <button class="btn btn-success">Add Theatre</button>
              </div>
              <input type="hidden" name="country" class="form-control" id="country">
              <input type="hidden" class="field" id="route" disabled="true">
              <input type="hidden" class="field" id="street_number" disabled="true">
              <input type="hidden" class="field" id="locality"disabled="true">
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
        // google auto complete API
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfO40iueprTDv0WCf0BCIlbj56JO-HylA&libraries=places&callback=initAutocomplete"
            async defer></script>
            <script>
        <?php $frm->applyvalidations("form1");?>
    </script>