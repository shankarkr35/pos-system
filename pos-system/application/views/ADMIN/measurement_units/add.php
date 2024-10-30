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
              <li class="breadcrumb-item active">Add New Measurement Unit</li>
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
                <h3 class="card-title">New Measurement Units</h3>
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Unit Name :</label>
                    <input type="text" class="form-control" id="name-en">
                    <span class="text-danger font-weight-bold" id="name-err"></span>
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
        $('.select2').select2()
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });
    });
</script>  
<script>
    $(document).on('click','#save-btn-custom',function(){
        var name = $('#name-en').val();
       
        if(name=="")
        {
            $('#name-en').addClass('is-invalid');
            $('#name-err').text('Enter unit name.*');
        }else{
            $('#name-en').removeClass('is-invalid');
            $('#name-err').text('');
        }
        
        
        if(name!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            fd.append('name',name);

            $.ajax({
                url: baseUrl + "create-new-unit",
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
                  if ((responseData != null) && (responseData == 'new record inserted successfully')) 
                  {
                    sessionStorage.setItem('saved',true);
                    window.location.href = baseUrl+'unit-list';
                  } else if((responseData != null) && (responseData == 'already exist')) {
                    $('#name-en').addClass('is-invalid');
                    $('#name-err').text('Unit Name already Exist.*');
                  }
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>');
               }
            });
        }
        
    });
</script>
  
  
  