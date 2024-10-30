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
              <li class="breadcrumb-item active">Edit Category</li>
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
                <h3 class="card-title">Edit Category</h3>
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name :</label>
                    <input type="text" class="form-control" id="name-en" placeholder="Name English.*" value="<?php echo $subcategory->name?>">
                    <span class="text-danger font-weight-bold" id="name-err"></span>
                  </div>
                 
                   <div class="form-group">
                      <label for="exampleInputPassword1">Category :</label>
                      <select class="form-control" id="category">
                          <option value="">select category</option>
                        <?php
                        foreach($categories as $row):
                        ?>  
                        <option value="<?php echo $row->id;?>" <?php echo (($row->id==$subcategory->category_id)?'selected':'')?>><?php echo $row->name;?></option>  
                        <?php endforeach?>  
                      </select>
                      <span class="text-danger font-weight-bold" id="category-err"></span>
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
        $('.dropify').dropify();
    });
</script>

<script>
    $(document).on('click','#save-btn-custom',function(){
        var name = $('#name-en').val();
     
        var category = $('#category').val();
        
        if(category=="")
        {
            $('#category').addClass('is-invalid');
            $('#category-err').text('Select Category.*');
        }else{
            $('#category').removeClass('is-invalid');
            $('#category-err').text('');
        }
        
        if(name=="")
        {
            $('#name-en').addClass('is-invalid');
            $('#name-err').text('Enter Category english Name.*');
        }else{
            $('#name-en').removeClass('is-invalid');
            $('#name-err').text('');
        }
        
        
        if(name!=""&&category!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            fd.append('name',name);
            fd.append('category',category);
            fd.append('id',"<?php echo $subcategory->id?>");
            $.ajax({
                url: baseUrl + "update-sub-category",
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
                  if ((responseData != null) && (responseData == 'record updated successfully')) 
                  {
                    sessionStorage.setItem('updated',true);
                    window.location.href = baseUrl+'sub-categories-list';
                  } else if((responseData != null) && (responseData == 'already exist')) {
                    $('#name-en').addClass('is-invalid');
                    $('#name-err').text('Name already Exist.*');
                  }
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Update</button>');
               }
            });
        }
        
    });
</script>
  
  
  