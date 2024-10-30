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
              <li class="breadcrumb-item active">Add New Customer</li>
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
                <h3 class="card-title">New Customer</h3>
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name :</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name.*">
                    <span class="text-danger font-weight-bold" id="name-err"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email :</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter email.*">
                    <span class="text-danger font-weight-bold" id="email-err"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mobile :</label>
                    <input type="number" class="form-control" id="mobile" placeholder="Enter mobile.*">
                    <span class="text-danger font-weight-bold" id="mobile-err"></span>
                  </div>
                  <div style="display:none;" class="form-group">
                    <label for="exampleInputEmail1">Password :</label>
                    <input type="text" class="form-control" id="password" placeholder="Enter password.*">
                    <span class="text-danger font-weight-bold" id="password-err"></span>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Address :</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter address.*">
                    <span class="text-danger font-weight-bold" id="address-err"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Image :</label>
                    <div class="white-box">
                        <input type="file" id="file" name="file" class="dropify" data-default-file="<?php echo base_url(); ?>uploads/<?php echo 'default-image.png'; ?>" /> 
                    </div>
                  </div>
                </div>
                <div class="card-footer" id="save-btn-conatiner">
                  <button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>
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
        $('.dropify').dropify();
    });
</script>

<script>
    $(document).on('click','#save-btn-custom',function(){
         function isEmail(emailid) {
          var pattern = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
          return pattern.test(emailid);
        }
        var name = $('#name').val();
        var email = $('#email').val();
        var mobile = $('#mobile').val();
        var password = $('#password').val();
        var address = $('#address').val();
        
        if(name=="")
        {
            $('#name').addClass('is-invalid');
            $('#name-err').text('Enter Name.*');
        }else{
            $('#name').removeClass('is-invalid');
            $('#name-err').text('');
        }
        if(mobile=="")
        {
            $('#mobile').addClass('is-invalid');
            $('#mobile-err').text('Enter Mobile.*');
        }else{
            $('#mobile').removeClass('is-invalid');
            $('#mobile-err').text('');
        }
    
        if((email == '') || (!isEmail($('#email').val()))) {
            $('#email').addClass('is-invalid');
            $('#email-err').text('Enter Valid Email.*');
            
            }else{
             $('#email').removeClass('is-invalid');
            $('#email-err').text('');
            
            } 
        
       
        
        if(name!="" && email!="" && mobile!="" && (isEmail($('#email').val())))
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            var files = $('#file')[0].files[0];
            fd.append('file',files);
            fd.append('name',name);
            fd.append('email',email);
            fd.append('mobile',mobile);
            fd.append('password',password);
            fd.append('address',address);
            $.ajax({
                url: baseUrl + "create-new-customer",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function(){
                $('#name').removeClass('is-invalid');
                $('#name-err').text('');
                
                $("#save-btn-conatiner").html('<div class="spinner-border text-danger text-right"></div>');
               },
                success: function(jsonStr) {
                  var res_data = JSON.stringify(jsonStr);
                  var response = JSON.parse(res_data);
                  var responseData = response['responseData'];
                  if ((responseData != null) && (responseData == 'new record inserted successfully')) 
                  {
                    sessionStorage.setItem('saved',true);
                    window.location.href = baseUrl+'customers-list';
                  } else if((responseData != null) && (responseData == 'already exist')) {
                    $('#email').addClass('is-invalid');
                    $('#email-err').text('Customer Email already Exist.*');
                  }
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>');
               }
            });
        }
        
    });
</script>
  
  
  