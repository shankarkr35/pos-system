<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin-dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Contact Us Contents Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Contact Us Contents Management</h3>
              </div>
                <div class="card-body">  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Contact Number :</label>
                    <input type="text" class="form-control" id="mobile" placeholder="Contact Number" value="<?php echo $data->contact_number?>">
                    <span class="text-danger font-weight-bold" id="name-err"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email Address :</label>
                    <input type="text" class="form-control" id="email" placeholder="Email" value="<?php echo $data->email?>">
                    <span class="text-danger font-weight-bold" id="ar_name-err"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Location :</label>
                    <input type="text" class="form-control" id="location" placeholder="Location" value="<?php echo $data->location?>">
                    <span class="text-danger font-weight-bold" id="ar_name-err"></span>
                  </div>
                  <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                              <label>Working From:</label>
                                <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3" id="start-time" value="<?php echo $data->working_from?>"/>
                                    <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                </div>
                                <span class="text-danger font-weight-bold" id="event-start-time-err"></span>
                            </div>    
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                              <label>Working To:</label>
                                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" id="end-time" value="<?php echo $data->working_to?>"/>
                                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                </div>
                                <span class="text-danger font-weight-bold" id="event-end-time-err"></span>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="card-footer" id="save-btn-conatiner">
                  <button type="button" class="btn btn-danger" id="save-btn-custom">Update</button>
                </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
   
<script>
    $(document).ready(function() 
    {
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
        $('#datetimepicker4').datetimepicker({
            format: 'LT'
        });
        
    });
</script>

<script>
    $(document).on('click','#save-btn-custom',function(){
        var mobile = $('#mobile').val();
        var email = $('#email').val();
        var location = $('#location').val();
        var stime = $('#start-time').val();
        var etime = $('#end-time').val();
        
        var baseUrl = '<?php echo base_url(); ?>';
        var fd = new FormData();
        fd.append('mobile',mobile);
        fd.append('email',email);
        fd.append('location',location);
        fd.append('stime',stime);
        fd.append('etime',etime);
        $.ajax({
            url: baseUrl + "admin/admin/update_contact_us_cms",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            dataType: "JSON",
            beforeSend: function(){
            $('#name-en').removeClass('is-invalid');
            $('#name-err').text('');
            
            $("#save-btn-conatiner").html('<div class="spinner-border text-danger text-right"></div>');
           },
            success: function(jsonStr) {
              var res_data = JSON.stringify(jsonStr);
              var response = JSON.parse(res_data);
              var responseData = response['responseData'];
              if ((responseData != null) && (responseData == 'record updated')) 
              {
                sessionStorage.setItem('updated',true);
                document.location.reload(true);
              } 
            },complete:function(data){
             $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Update</button>');
           }
        });
        
    });
</script>

<script>
    $(function(){
        
        if ( sessionStorage.getItem('updated') ) {
           swal({
              title: "Data Updated.",
              text: " Details updated successfully.!",
              type: "success",
              confirmButtonClass: 'btn-primary btn-sm',
              confirmButtonText: 'OK'
            });
            sessionStorage.removeItem('updated');
        }
    });
</script>
  
  
  