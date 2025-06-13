<?php include_once("header.php"); ?>
<link rel="stylesheet" type="text/css" href="../assets/css/vendors/flatpickr/flatpickr.min.css">
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-6">
          <h3>Add Customer</h3>
        </div>
        <div class="col-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="home.php">
                <svg class="stroke-icon">
                  <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                </svg>
              </a>
            </li>
            <!-- <li class="breadcrumb-item">Home</li> -->
            <li class="breadcrumb-item active">Add Customer</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <form id="addCustomerForm" class="form theme-form" method="post" action="" enctype="multipart/form-data" autocomplete="off">
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label>Customer Number</label>
                    <input class="form-control" type="text" name="customer_number" placeholder="Customer Number" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label>Customer name</label>
                    <input class="form-control" type="text" name="customer_name" placeholder="Customer name" required>
                  </div>
                </div>
              </div>
              <div class="row">                
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label>Date of Birth</label>                    
                    <div class="input-group flatpicker-calender">
                      <input class="form-control" id="datetime-local" type="date" name="dob" value="2023-05-03" required>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label>Mobile Number</label>
                    <input class="form-control digits" type="number" name="mobile_number" placeholder="Number" required>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label>Aadhar Number</label>
                    <input class="form-control digits" type="number" name="aadhar_number" placeholder="Number" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label>City / Town / Village</label>
                    <input class="form-control" type="text" name="city" data-language="en" required>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label>Street / Road Name / Local Landmark</label>
                    <input class="form-control" type="text" name="street" data-language="en" required>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="mb-3">
                    <label>Pincode</label>
                    <input class="form-control digits" type="number" name="pincode" placeholder="Number" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <div class="mb-3">
                    <label>Full Address</label>
                    <textarea class="form-control" id="exampleFormControlTextarea4" name="full_address" rows="2" required></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label>Customer Photo</label>
                    <div class="capture-photo triggerModal webCamSet_1" data-set="1">
                      <div class="capture-photo-wrapper">                            
                        <div class="cp-message needsclick">
                          <div class="cp-message-content">
                            <i class="icon-cloud-up"></i>
                            <h6>Click to capture photo.</h6>
                          </div>
                          <div class="cp-message-image">
                            <canvas id="canvas1" width="500" height="500"></canvas><br>
                            <span class="note needsclick">(Click to capture again)</span>
                            <input type="hidden" name="customer_photo" id="photo_1" value="" required>
                          </div>
                        </div>
                      </div>
                    </div>                      
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="mb-3">
                    <label>Aadhar Photo</label>
                    <div class="capture-photo capture-photo-secondary triggerModal webCamSet_2" data-set="2">
                      <div class="capture-photo-wrapper">                            
                        <div class="cp-message needsclick">
                          <div class="cp-message-content">
                            <i class="icon-cloud-up"></i>
                            <h6>Click to capture photo.</h6>
                          </div>
                          <div class="cp-message-image">
                            <canvas id="canvas2" width="500" height="500"></canvas><br> 
                            <span class="note needsclick">(Click to capture again)</span>
                            <input type="hidden" name="aadhar_photo" id="photo_2" value="" required>
                          </div>
                        </div>
                      </div>
                    </div>                    
                  </div>
                </div>                
              </div>
              <div class="row">
                <div class="col">
                  <div class="text-end">
                    <button class="btn btn-success me-3" type="submit" name="add_customer">Add</button>
                    <a class="btn btn-danger" href="#">Cancel</a>
                  </div>
                </div>
              </div>
            </form>
            <div id="formResult" class="mt-3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myFullLargeModalLabel">Extra large modal</h4>
          <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"> 
          <div class="modal-toggle-wrapper">  
            <video id="video" width="100%" height="100%" autoplay></video>                    
            <button class="btn btn-outline-primary cap-btn w-100" type="button" title="btn btn-outline-primary">Capture Photo</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div>

<?php include_once("footer.php"); ?>
<script src="../assets/js/flat-pickr/flatpickr.js"></script>
<script>
  $(document).ready(function () {
    let stream = null;
    const modalElement = document.getElementById('exampleModalCenter1');
    const videoElement = document.getElementById('video');
    const myModal = new bootstrap.Modal(modalElement);
    let webCamSet = 1;
    $(".cp-message-image").hide();  

    $('.triggerModal').click(async function () {
      try {
        webCamSet = $(this).data("set");
        // Pre-initialize the camera stream before showing the modal
        stream = await navigator.mediaDevices.getUserMedia({ video: true });
        videoElement.srcObject = stream;

        // Only show modal once stream is ready
        myModal.show();
      } catch (err) {
        console.error("Error accessing webcam:", err);
        alert("Cannot access webcam.");
      }
    });

    $(".cap-btn").click(function () {
      const canvas = document.getElementById(`canvas${webCamSet}`);
      const context = canvas.getContext('2d');
      context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
      const imageData = canvas.toDataURL('image/png')
      $(`#photo_${webCamSet}`).val(imageData);
      $(`.webCamSet_${webCamSet} .cp-message-content`).hide();
      $(`.webCamSet_${webCamSet} .cp-message-image`).show();
      myModal.hide();
    });

    // When modal is hidden, stop the webcam
    modalElement.addEventListener('hidden.bs.modal', function () {
      if (stream) {
        stream.getTracks().forEach(track => track.stop());
        videoElement.srcObject = null;
        stream = null;
      }
    });

    // AJAX form submit with validation
    $('#addCustomerForm').on('submit', function (e) {
      e.preventDefault();

      // Simple client-side validation for required fields
      let valid = true;
      $('#addCustomerForm [required]').each(function () {
        if (!$(this).val()) {
          $(this).addClass('is-invalid');
          valid = false;
        } else {
          $(this).removeClass('is-invalid');
        }
      });

      if (!valid) {
        $('#formResult').html('<div class="alert alert-danger">Please fill all required fields.</div>');
        return false;
      }

      var formData = $(this).serialize();
    //   console.log(formData);
      
      $.ajax({
        url: '/goldbook/controller/create_ccustomer.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function (response) {
            console.log(response);
            
          if (response.success) {
            $('#formResult').html('<div class="alert alert-success">' + response.message + '</div>');
            $('#addCustomerForm')[0].reset();
            $(".cp-message-image").hide();
            $(".cp-message-content").show();
          } else {
            $('#formResult').html('<div class="alert alert-danger">' + response.message + '</div>');
          }
        },
        error: function () {
          $('#formResult').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
        }
      });
    });

    // Remove validation error on input
    $('#addCustomerForm [required]').on('input change', function () {
      if ($(this).val()) {
        $(this).removeClass('is-invalid');
      }
    });
  });
</script>
