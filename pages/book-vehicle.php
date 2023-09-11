<?php
ob_start();
session_start();
require_once('../config/config.php');
if (isset($_SESSION['user-status']) != "userLoggedIn") {
   echo "<script>window.location.href='" . base_url('newuser/login') . "'</script>";
} else {
}

require_once('../config/db.php');

$title = "Book Vehicle";

require_once('../includes/header.php');

require_once('../includes/navbar.php');

$booking_data = $obj->select('vehicles', '*', 'id', array($_GET['id']));

$vehicle_category = $booking_data['0']['category'];
$c_cate_quer = $obj->select('category', '*', 'id', array($vehicle_category));
$category_name = $c_cate_quer[0]['vname'];

//book vehicle with driver
if (isset($_POST['submit'])) {
   if ($_POST['submit'] == 'withDriver') {
      $_POST['category'] = $vehicle_category;
      $_POST['vehicle_no'] = $booking_data['0']['v_no'];
      $_POST['user'] = $_SESSION['u_id'];

      $v_no = $booking_data['0']['v_no'];

      $fd =  $_POST['from_date'];
      $td =  $_POST['to_date'];

      $check = $obj->Query("SELECT * from bookings where from_date = '$fd' and vehicle_no = '$v_no' and status between -1 and 2 order by from_date asc");

      $check2 = $obj->Query("SELECT * from bookings where from_date = '$fd' and vehicle_no = '$v_no' and status between -1 and 2 order by to_date desc");

      $check3 = $obj->Query("SELECT min(from_date) as mid  from bookings where vehicle_no = '$v_no' and status between -1 and 2");

      $check4 = $obj->Query("SELECT max(to_date) as mad from bookings where vehicle_no = '$v_no' and status between -1 and 2");


      if ($check3 || $check4) {
         $min_d = $check3[0]->mid;

         $max_d = $check4[0]->mad;

         $_SESSION['bookingWithDriverError'] = "This vehicle is already booked!";
      }

      if ($check2) {
      } else {

         unset($_POST['submit']);
         $aaa = $obj->insert('bookings', $_POST);
         if ($aaa) {
            echo "<script>alert('Booking successfully');</script>";
            echo "<script>window.location.href='" . base_url('') . "'</script>";
         } else {
            echo "<script>alert('Error adding Vehicle!');</script>";
            echo "<script>window.location.href='" . base_url('') . "'</script>";
         }
      }
   }
}

//book vehicle without driver
if (isset($_POST['submit'])) {
   if ($_POST['submit'] == 'withoutDriver') {
      $old = $_POST;
      $_POST['category'] = $vehicle_category;
      $_POST['vehicle_no'] = $booking_data['0']['v_no'];
      $_POST['user'] = $_SESSION['u_id'];

      $imgName = $_FILES['lcs_photo']['name'];
      $tmp_name = $_FILES['lcs_photo']['tmp_name'];
      $location = '../uploads' . '/' . $imgName;
      move_uploaded_file($tmp_name, $location);

      if (empty($_POST['lcs_photo_updating'])) {
         $_POST['lcs_photo'] = $imgName;
         unset($_POST['lcs_photo_updating']);
      }

      $fd =  $_POST['from_date'];
      $td =  $_POST['to_date'];

      $fdd = new DateTime($fd);
      $tdd = new DateTime($td);

      $interval = $fdd->diff($tdd);
      $duration = $interval->d;

      $_POST['duration'] = $duration;

      if (empty($_POST['lcs_photo'])) {
         $_POST['lcs_photo'] = $_POST['lcs_photo_updating'];
         unset($_POST['lcs_photo_updating']);
      }

      // print_r($_POST);

      $lc_n = $_POST['lcs_no'];
      $lc_p = $_POST['lcs_photo'];
      $updateUserId = $_SESSION['u_id'];

      if ($td <= $fd) {
         $_SESSION['dateError'] = "Minimum booking date must be 1 day after the date of booking.";
      } else {

         $v_no = $booking_data['0']['v_no'];


         $check2 = $obj->Query("SELECT * from bookings where from_date = '$fd' and vehicle_no = '$v_no' and status between -1 and 2 order by to_date desc");

         $check3 = $obj->Query("SELECT min(from_date) as mid  from bookings where vehicle_no = '$v_no' and status between -1 and 2");

         $check4 = $obj->Query("SELECT max(to_date) as mad from bookings where vehicle_no = '$v_no' and status between -1 and 2");


         if ($check3 || $check4) {
            $min_d = $check3[0]->mid;

            $max_d = $check4[0]->mad;

            $_SESSION['bookingWithDriverError'] = "This vehicle is already booked!";
         }

         if ($check2) {
         } else {
            if ($lc_n && $lc_p) {
               unset($_POST['lcs_photo_updating']);
               $updateUserProfileLicense = $obj->Query("UPDATE users set license_photo = '$lc_p', license_no = '$lc_n' where id =$updateUserId");
            }
            unset($_POST['submit']);
            $am = $obj->insert('bookings', $_POST);
            if ($am) {
               echo "<script>alert('Booking successfully');</script>";
               echo "<script>window.location.href='" . base_url('') . "'</script>";
            } else {
               echo "<script>alert('Error adding Vehicle!');</script>";
               echo "<script>window.location.href='" . base_url('') . "'</script>";
            }
         }
      }
   }
}

// license photo and number IF // Without Driver
$uuid = $_SESSION['u_id'];

$lccs_q = $obj->select('users', '*', 'id', array($uuid));
$lccn = $lccs_q[0]['license_no'];
// $lccn = $lccs_q[0]['license_no'];
$lccp = $lccs_q[0]['license_photo'];
?>

<section class="sect-intro d-flex flex-column justify-content-center align-items-center" style="height:17vh;background-color:#008ecb;">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <h4 class="text-white">Booking <strong class="text-warning"><?= $booking_data['0']['brand'] ?></strong> </h4>
         </div>
      </div>
   </div>
</section>
<section class="sect-search mt-5">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <?php if (isset($_SESSION['bookingError'])) { ?>
               <div class="alert alert-danger">
                  <?php echo $_SESSION['bookingError'];
                  unset($_SESSION['bookingError']);  ?>
                  <a class="strong small" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                     More info
                  </a>

                  <div class="collapse mt-2" id="collapseExample">
                     <div style="border-left:2px solid #0083cb;padding:1rem">
                        <p>
                           Booked
                           <?php
                           if ($check) { ?> since
                              <span class="text-decoration-underline"><?= $first_booking_date ?></span>
                           <?php } ?>
                           <?php
                           if ($check2) { ?> till
                              <span class="text-decoration-underline"><?= $last_booking_date ?></span>
                           <?php } ?>

                        </p>
                     </div>
                  </div>
               </div>
            <?php }  ?>

            <?php if (isset($_SESSION['bookingWithDriverError'])) { ?>
               <div class="alert alert-danger">
                  <?php echo $_SESSION['bookingWithDriverError'];
                  unset($_SESSION['bookingWithDriverError']);  ?>
                  <a class="strong small" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                     More info
                  </a>

                  <div class="collapse mt-2" id="collapseExample">
                     <div style="border-left:2px solid #0083cb;padding:1rem">
                        <p>
                           Booked
                           <?php
                           if ($check3) { ?> since
                              <span class="text-decoration-underline"><?= $min_d ?></span>
                           <?php } ?>
                           <?php
                           if ($check4) { ?> till
                              <span class="text-decoration-underline"><?= $max_d ?></span>
                           <?php } ?>

                        </p>
                     </div>
                  </div>
               </div>
            <?php }  ?>
         </div>

         <div class="col-lg-12">
            <?php foreach ($booking_data as $key => $value) : ?>
               <div class="row">
                  <div class="col-4 data-col">
                     <div class="card">
                        <div class="card-header pb-0 border-0 alert alert-info">
                           <small class="border border-secondary small p-2 w-25 rounded-pill">#<?= $category_name ?></small>
                           <h5 class="mt-2"><?= $value['brand'] ?> | <?= $value['v_no'] ?></h5>
                        </div>
                        <div class="card-body">
                           <img src="<?= file_url($value['photo']) ?>" alt="Avatar" class="img-fluid w-100">
                           <input type="hidden" id="vehicle_price" value="<?= $value['price'] ?>">
                           <h6>Price : Rs.<span id=""><?= $value['price'] ?></span> (per day)</h6>
                           <h6>Seat Capacity : <?= $value['seat'] ?></h6>
                           <hr>
                           <p><strong>Details: </strong><?= $value['description'] ?></p>
                        </div>
                     </div>
                  </div>
                  <div class="col-8">
                     <div class="form-shadow card-body bg-white shadow my-2">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="p-3">
                                 <div class="form-group">
                                    <label>
                                       <h5>Driver Options? <span class="text-danger">*</span></h5>
                                    </label>
                                 </div>
                                 <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                       <button class="nav-link  text-dark" id="with-tab" data-bs-toggle="tab" data-bs-target="#with" type="button" role="tab" aria-controls="with" aria-selected="true">With</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                       <button class="nav-link active text-dark" id="without-tab" data-bs-toggle="tab" data-bs-target="#without" type="button" role="tab" aria-controls="without" aria-selected="false">Without</button>
                                    </li>
                                 </ul>
                                 <div class="tab-content mt-3" id="myTabContent">
                                    <div class="tab-pane fade" id="with" role="tabpanel" aria-labelledby="with-tab">
                                       <form action="" method="POST" name="myForm" onsubmit="return dateValidate();" autocomplete="off">
                                          <div class="card-body py-0">
                                             <div class="row">
                                                <div class="col-lg-5">
                                                <?php
                                                      $drivers = $obj->select('drivers', '*', 'v_category', array($vehicle_category));
                                                      ?>
                                                <?php if($drivers)  { ?>
                                                   <div class="form-group mb-3">
                                                      <label class="mb-2">Choose a driver </label>
                                                      
                                                         <?php foreach ($drivers as $key => $value) : ?>
                                                            <div class="form-check">
                                                               <input class="form-check-input" type="radio" required name="driver" value="<?= $value['id'] ?>" id="flexCheckChecked<?= $value['id'] ?>" onchange="showDriver(this.value)">
                                                               <label class="form-check-label d-inline-flex" for="flexCheckChecked<?= $value['id'] ?>">
                                                                  <img src="<?= file_driver_url($value['profile']) ?>" style="width:40px;height:40px;border-radius:50%;border:2px solid #d9d9d9">
                                                                  <ul class="list-unstyled mx-2">
                                                                     <li>
                                                                        <h6><?= $value['name'] ?></h6>
                                                                     </li>
                                                                  </ul>
                                                               </label>
                                                            </div>
                                                         <?php endforeach ?>
                                                     
                                                      </select>
                                                   </div>
                                                   <div class="form-group mb-3">
                                                      <label for="from_date">From Date</label>
                                                      <input type="date" name="from_date" min="<?= date('Y-m-d'); ?>" class="form-control" id="from_date" required>
                                                   </div>
                                                   <div class="form-group mb-3">
                                                      <label for="to_date">To Date</label>
                                                      <input type="date" name="to_date" class="form-control" id="to_date" required onfocus="return validateee();">
                                                      <span id="dateError" class="text-danger"></span>
                                                   </div>

                                                   <script>
                                                      function validateee() {
                                                         var today = new Date();
                                                         var dd = today.getDate() + 1;
                                                         var mm = today.getMonth() + 1; //January is 0!
                                                         var yyyy = today.getFullYear();
                                                         if (dd < 10) {
                                                            dd = '0' + dd
                                                         }
                                                         if (mm < 10) {
                                                            mm = '0' + mm
                                                         }

                                                         today = yyyy + '-' + mm + '-' + dd;
                                                         document.getElementById("to_date").setAttribute("min", today);

                                                         today = yyyy + '-' + mm + '-' + dd;
                                                         document.getElementById("to_dateWithout").setAttribute("min", today);
                                                      }
                                                   </script>

                                                   <div id="total_price"></div>
                                                   <input type="hidden" name="cost" id="t_cost">
                                                   <input type="hidden" name="duration" id="duration">
                                                   <div name="cost" id="cost" class="alert alert-info"></div>
                                                   <button type="submit" name="submit" class="btn text-white" style="background-color: #008ecb;" value="withDriver">Submit</button>
                                                   <?php } else { ?>
                                                         <li class="list-unstyled text-danger" value="" selected>No drivers found !</li>
                                                      <?php } ?>
                                                </div>
                                                <div class="col-lg-7">
                                                   <div id="driverList"></div>
                                                </div>
                                             </div>
                                          </div>
                                       </form>
                                    </div>



                                    <!-- //witout -->
                                    <div class="tab-pane fade show active" id="without" role="tabpanel" aria-labelledby="without-tab">
                                       <form action="" method="POST" enctype="multipart/form-data" onsubmit="return dateValidateWithOut();" autocomplete="off">
                                          <span hidden id="mylccn"></span>
                                          <div class="card-body">

                                             <?php if ($lccn && $lccp) { ?>
                                                <div class="form-check d-flex justify-content-end">
                                                   <input class="form-check-input" type="checkbox" value="" id="useMy" onclick="useMyCurrent()">
                                                   <label class="form-check-label" for="flexCheckDefault">&nbsp; Use my current License
                                                   </label>
                                                <?php } ?>

                                                </div>
                                                <div class="form-group mb-3">
                                                   <label for="license_no">License No.</label>
                                                   <input class="form-control" id="license_no" name="lcs_no" required placeholder="Enter your valid license number" <?php if (isset($old['lcs_no'])) { ?> value=<?= $old['lcs_no'] ?> <?php }  ?>>
                                                </div>
                                                <div class="form-group mb-3" id="removeWhenCheck">
                                                   <label>License Photo</label>
                                                   <input type="file" name="lcs_photo" class="form-control" id="license_photo" required onchange="return fileValidation()">
                                                   <input type="hidden" name="lcs_photo_updating" id="toLccp">
                                                   <img id="mylccp" src="" width="120px" height="90px" class="img-thumbnail" style="margin-top: -1.5rem;" />
                                                </div>

                                                <div class="form-group mb-3">
                                                   <label for="from_date">From Date</label>
                                                   <input type="date" name="from_date" min="<?= date('Y-m-d'); ?>" class="form-control" id="from_dateWithout" required <?php if (isset($old['from_date'])) { ?> value=<?= $old['from_date'] ?> <?php }  ?>>
                                                </div>

                                                <div class="form-group mb-3">
                                                   <label for="to_date">To Date</label>
                                                   <input type="date" name="to_date" class="form-control" onfocus="return validateee();" id="to_dateWithout" required <?php if (isset($old['from_date'])) { ?> value=<?= $old['from_date'] ?> <?php }  ?>>
                                                   <?php if (isset($_SESSION['dateError'])) { ?>
                                                      <div class="alert alert-danger my-2">
                                                         <?php echo $_SESSION['dateError'];
                                                         unset($_SESSION['dateError']);  ?>
                                                      </div>
                                                   <?php }  ?>
                                                </div>
                                                <input type="hidden" name="cost" id="t_cost_without_value">
                                                <div id="t_cost_without" class="alert alert-info"></div>
                                                <button type="submit" name="submit" class="btn text-white" style="background-color: #008ecb;" value="withoutDriver">Submit</button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            <?php endforeach ?>
         </div>
      </div>
   </div>
</section>

<script>
   // /file validatiion 
   function fileValidation() {
      var fileInput = document.getElementById('license_photo');
      var filePath = fileInput.value;

      // Allowing file type
      var allowedExtensions =
         /(\.jpg|\.jpeg|\.png)$/i;

      if (!allowedExtensions.exec(filePath)) {
         alert('Unsupported file type. Please choose only image');
         fileInput.value = '';
         return false;
      }
   }


   var fillLccp = document.getElementById("mylccp");
   fillLccp.style.display = "none";

   function useMyCurrent() {
      var checkBox = document.getElementById("useMy");
      var fillLccn = document.getElementById("license_no");
      var inputLccp = document.getElementById("license_photo");
      var fillLccp = document.getElementById("mylccp");
      var toLccp = document.getElementById("toLccp");

      var removeWhenCheck = document.getElementById("removeWhenCheck");

      if (checkBox.checked == true) {
         inputLccp.style.visibility = "hidden";
         // fillLccn.disabled = true;
         fillLccn.readOnly = true;
         fillLccn.value = "<?= $lccn ?>";
         inputLccp.required = false;
         fillLccp.style.display = "block";
         fillLccp.src = "<?= file_url($lccp) ?>";
         // fillLccp.value = "<?= file_url($lccp) ?>";
         toLccp.value = "<?= $lccp ?>";

      } else {
         fillLccn.value = '';
         inputLccp.style.visibility = "visible";
         fillLccn.readOnly = false;
         fillLccp.style.display = "none";
         fillLccp.style.visibility = "visible";
      }
   }
</script>

<script>
   var a = document.getElementById('vehicle_price').value;
   // var b = document.getElementById('driver_rate').value;
   $(document).ready(function() {
      document.getElementById('cost').style.display = 'none';
      $('#to_date').on('mouseenter', function() {
         var vehicle_price = $('#vehicle_price').val();
         var driver_rate = $('#driver_rate').val();

         var day_start = new Date($('#from_date').val());

         var day_end = new Date($('#to_date').val());

         var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);

         var a = Math.round(total_days);

         var total_price = Number(vehicle_price) + Number(driver_rate);

         var total_price = Number(total_price * a);

         if (total_price > 0) {
            document.getElementById('cost').style.display = 'block';
            document.getElementById('cost').innerHTML = "Total Cost: Rs." + total_price;
            document.getElementById('t_cost').value = total_price;

            document.getElementById('duration').value = a;
         }
      });
   });


   //WITHOUT DRIVER

   $(document).ready(function() {
      document.getElementById('t_cost_without').style.display = 'none';

      $('#to_dateWithout').on('mouseenter', function() {
         var vehicle_price = $('#vehicle_price').val();
         // alert(vehicle_price);

         var day_start = new Date($('#from_dateWithout').val());

         var day_end = new Date($('#to_dateWithout').val());

         var total_days = (day_end - day_start) / (1000 * 60 * 60 * 24);

         var a = Math.round(total_days);

         var total_price = Number(vehicle_price);

         var total_price = Number(total_price * a);


         if (total_price > 0) {
            document.getElementById('t_cost_without').style.display = 'block';
            document.getElementById('t_cost_without').innerHTML = "Total Cost: Rs." + total_price;
            document.getElementById('t_cost_without_value').value = total_price;

         }

      });
   });
</script>
<script>
   function dateValidate() {
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();

      if (to_date <= from_date) {
         document.getElementById('dateError').innerHTML = 'Minimum booking date must be 1 day after the date of booking!';
         return false;
      } else {
         document.getElementById('dateError').innerHTML = '';

      }
   }
</script>
<script>
   function showDriver(val) {
      var a = new XMLHttpRequest();
      a.onreadystatechange = function() {
         $(document).ready(function() {
            document.getElementById('cost').style.display = 'none';
         });

         if (this.readyState == 4 && this.status == 200) {
            document.getElementById('driverList').innerHTML = this.responseText;
         }
      }
      a.open('GET', 'ajax/getDrivers.php?id=' + val, true);
      a.send();
   }
</script>
<?php
require_once('../includes/footer.php');
?>