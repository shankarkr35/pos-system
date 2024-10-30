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
              <li class="breadcrumb-item active">Edit Homepage Slider</li>
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
                <h3 class="card-title">Edit Homepage Slider</h3>
              </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Event :</label>
                                <div class="select2-danger">
                                    <select id="events" class="select2 form-control-sm" data-placeholder="Events." data-dropdown-css-class="select2-danger" style="width: 100%;">
                                      <?php foreach($events as $row):?>
                                      <option value="<?php echo $row->event_id?>" <?php echo (($row->id==$slider->event_id)?'selected':'');?>><?php echo $row->en_event_title?></option>
                                      <?php endforeach?>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="events-err"></span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Slider Image :</label>
                                <div class="white-box">
                                    <input type="file" id="file" name="file" class="dropify" data-default-file="<?php echo base_url('uploads/homesliders/medium/').$slider->image?>" accept="image/png, image/gif, image/jpeg"/> 
                                </div>
                                <span class="mt-2" id="image-err" style="color:red;font-style:italic"></span>
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
        $('.select2').select2()
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });
    });
</script>   
<script>
    $(document).ready(function() 
    {
        $('.dropify').dropify();
    });
    $(document).on('change','#file',function(){
        $('#image-err').text('');    
    });
</script>

<script>
    $(document).on('click','#save-btn-custom',function(){
        var baseUrl = '<?php echo base_url(); ?>';
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('image',files);
        fd.append('event_id',$('#events').val());
        fd.append('id',<?php echo $slider->id?>);
        fd.append('current_image','<?php echo $slider->image?>');
        
        $.ajax({
            url: baseUrl + "update-home-slider",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            dataType: "JSON",
            beforeSend: function(){
            $("#save-btn-conatiner").html('<div class="spinner-border text-danger text-right"></div>');
           },
            success: function(jsonStr) {
              var res_data = JSON.stringify(jsonStr);
              var response = JSON.parse(res_data);
              var res = response['response'];
              if(res=="slider updated")
              {
                sessionStorage.setItem('updated',true);
                window.location.href = baseUrl+'homepage-sliders';   
              }else if(res=="Event already Exists on Slider"){
                    $('#image-err').text(res);    
                  }else{
                    $('#image-err').text(res);  
                  }
            },complete:function(data){
             $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Update</button>');
           }
        });
        
    });
</script>
  
  
  