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
              <li class="breadcrumb-item active">Add New Brand</li>
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
                <h3 class="card-title">New Brand</h3>
              </div>
                <div class="card-body">
                  <div class="col-md-12" id="importFrm">
                    <form action="<?php echo base_url('admin/admin/import_csv'); ?>" method="post" enctype="multipart/form-data">
                        <input type="file" name="file" />
                        <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
                    </form>
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
        $('.select2').select2()
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });
    });
</script>

<script>
    $(document).on('click','#save-btn-custom',function(){
        var name = $('#name-en').val();
        var ar_name = $('#name-ar').val();
        var categories = $('#categories').val();
        if(categories=="")
        {
            $('#categories').addClass('is-invalid');
            $('#categories-err').text('select brand catecories.*');
        }else{
            $('#categories').removeClass('is-invalid');
            $('#categories-err').text('');
        }
        
        if(name=="")
        {
            $('#name-en').addClass('is-invalid');
            $('#name-err').text('Enter Brand english Name.*');
        }else{
            $('#name-en').removeClass('is-invalid');
            $('#name-err').text('');
        }
        
        if(ar_name=="")
        {
            $('#name-ar').addClass('is-invalid');
            $('#ar_name-err').text('Enter Brand Arabic Name.*');
        }else{
            $('#name-ar').removeClass('is-invalid');
            $('#ar_name-err').text('');
        }
        
        if(name!=""&&ar_name!=""&&categories!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            var files = $('#file')[0].files[0];
            fd.append('file',files);
            fd.append('name',name);
            fd.append('ar_name',ar_name);
            fd.append('categories',categories);
            $.ajax({
                url: baseUrl + "create-new-brand",
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
                    window.location.href = baseUrl+'brands-list';
                  } else if((responseData != null) && (responseData == 'already exist')) {
                    $('#name-en').addClass('is-invalid');
                    $('#name-err').text('Brand Name already Exist.*');
                  }
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>');
               }
            });
        }
        
    });
</script>
  
  
  