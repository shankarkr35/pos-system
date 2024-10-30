
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
              <li class="breadcrumb-item active">Team Members Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card card-solid">
        <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-users"></i>
              Team Members
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="btn btn-danger btn-sm" id="add-new-member"><i class="fas fa-plus-circle"></i></a>
                </li>
              </ul>
            </div>
        </div>
        <div class="card-body pb-0">
          <div class="row" id="members-contents">
          </div>
        </div>
        <div class="card-footer">
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
 
    <div class="modal fade" id="member-action-modal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Member Name :</label>
                        <input type="text" class="form-control form-control-sm" id="name">
                        <span id="name-en-err" style="color:red"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Member Designation :</label>
                        <input type="text" class="form-control form-control-sm" id="designation">
                        <span id="name-ar-err" style="color:red"></span>
                    </div>
                    <div class="form-group" id="image-slider-in">
                    <label for="exampleInputFile">Profile Image :</label>
                    <div class="white-box">
                        <input type="file" id="file" name="file" class="dropify" /> 
                    </div>
                  </div>
                </div>
              <div class="modal-footer" id="save-btn-conatiner">
                <button type="button" class="btn bg-gradient-success btn-sm custom-action-btn"></button>  
                <button type="button" class="btn bg-gradient-danger btn-sm" data-dismiss="modal" id="close-modal-btn">Close</button>
              </div>
            </div>
        </div>
    </div> 

<script>
    $(document).on('click','#add-new-member',function(){
        $('#name').removeClass('is-invalid');
        $('#designation').removeClass('is-invalid');
        $('.modal-title').text('Add New Member');
        $('#name').val('');
        $('#designation').val('');
        var file = "<?php echo base_url(); ?>"+"uploads/default-image.png";
        var html = '';
        html+='<label for="exampleInputFile">Profile Image :</label>';
        html+='<div class="white-box">';
        html+='<input type="file" id="file" name="file" class="dropify" data-default-file="'+file+'" />'; 
        html+='</div>';
        $("#image-slider-in").html(html);
        $('.dropify').dropify();
        $('.custom-action-btn').attr('id','save-details');
        $('.custom-action-btn').text('Save');
        $('#member-action-modal').modal('show');
    });
</script>  
<script>
    $(document).ready(function() 
    {
        load_all_members();    
    });
    
    function load_all_members()
    {
        var baseUrl = '<?php echo base_url(); ?>';
        $.ajax({
            url: baseUrl + "admin/admin/get_all_team_members",
            type: "GET",
            contentType: false,
            processData: false,
            dataType: "JSON",
            beforeSend: function(){
           },
            success: function(jsonStr) {
              var res_data = JSON.stringify(jsonStr);
              var response = JSON.parse(res_data);
              var responseData = response['response'];
              $('#members-contents').html(responseData);
            },complete:function(data){}
        });    
    }
</script>

<script>
    $(document).on('click','#save-details',function(){
        var name = $('#name').val();
        var designation = $('#designation').val();
        if(name=="")
        {
            $('#name').addClass('is-invalid');    
        }else{
            $('#name').removeClass('is-invalid');       
        }
        if(designation=="")
        {
            $('#designation').addClass('is-invalid');    
        }else{
            $('#designation').removeClass('is-invalid');       
        }
        if(name!=""&&designation!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            var file = $('#file')[0].files[0];
            fd.append('file',file);
            fd.append('name',name);
            fd.append('designation',designation);
            $.ajax({
                url: baseUrl + "admin/admin/add_new_member",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function(){
                $("#save-btn-conatiner").html('<div class="spinner-border text-success text-right"></div>');
               },
                success: function(jsonStr) {
                  var res_data = JSON.stringify(jsonStr);
                  var response = JSON.parse(res_data);
                  var responseData = response['responseData'];
                  if ((responseData != null) && (responseData == 'member added')) 
                  {
                    $('#member-action-modal').modal('hide');  
                    load_all_members(); 
                    swal({
                      title: "Member Added.",
                      text: " New Member Added successfully.!",
                      type: "success",
                      confirmButtonClass: 'btn-primary btn-sm',
                      confirmButtonText: 'OK'
                    });
                  } 
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn bg-gradient-success btn-sm custom-action-btn" id="save-details">Save</button><button type="button" class="btn bg-gradient-danger btn-sm" data-dismiss="modal">Close</button>');
               }
            });
        }
    });
</script>

<script>
    $(function(){
        
        if ( sessionStorage.getItem('added') ) {
           swal({
              title: "Member Added.",
              text: " New Member Added successfully.!",
              type: "success",
              confirmButtonClass: 'btn-primary btn-sm',
              confirmButtonText: 'OK'
            });
            sessionStorage.removeItem('added');
        }
    });
</script>

<script>
    function checkdelete(id)
   {
       swal({
          title: "Are you sure.?",
          text: "You want to delete this record.",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger btn-sm',
          cancelButtonClass: 'btn-dark btn-sm',
          confirmButtonText: 'Yes, delete it!',
          closeOnConfirm: false
        },
        function(){
              $.post("<?=base_url('admin/admin/delete_members_data')?>",
              {
                id:id,
                db_table:'team_members',
                folder_name:'members'
              },
              function(data, status){
                  //alert(data);return;
                 if(data=="deleted")
                 {  
                     load_all_members();
                     swal({
                      title: "Deleted.",
                      text: "Record has been deleted successfully.!",
                      type: "success",
                      confirmButtonClass: 'btn-primary btn-sm',
                      confirmButtonText: 'OK'
                    });
                 }
              });
        });
   }
</script>

<script>
    $(document).on('click','.edit-member-cust',function(){
        $('#name').removeClass('is-invalid');
        $('#designation').removeClass('is-invalid');
        var id = $(this).attr('id');
        var baseUrl = '<?php echo base_url(); ?>';
        var fd = new FormData();
        fd.append('id',id);
        $.ajax({
                url: baseUrl + "admin/admin/get_member_data",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function(){},
                success: function(jsonStr){
                    var res_data = JSON.stringify(jsonStr);
                    var response = JSON.parse(res_data);
                    var res = response['response'];
                    $('.modal-title').text('Edit Member Details');
                    $('#name').val(res.member_name);
                    $('#designation').val(res.member_position);
                    var file = "<?php echo base_url(); ?>"+"uploads/members/medium/"+res.image;
                    var html = '';
                    html+='<label for="exampleInputFile">Profile Image :</label>';
                    html+='<div class="white-box">';
                    html+='<input type="file" id="file" name="file" class="dropify" data-default-file="'+file+'" />'; 
                    html+='</div>';
                    $("#image-slider-in").html(html);
                    $('.dropify').dropify();
                    $('.custom-action-btn').attr('id','edit-details');
                    $('.custom-action-btn').attr('data-key',id);
                    $('.custom-action-btn').text('Update');
                    $('#member-action-modal').modal('show');
                },complete:function(data){}
            });
    });
</script>

<script>
    $(document).on('click','#edit-details',function(){
        var name = $('#name').val();
        var id = $(this).attr('data-key');
        var designation = $('#designation').val();
        if(name=="")
        {
            $('#name').addClass('is-invalid');    
        }else{
            $('#name').removeClass('is-invalid');       
        }
        if(designation=="")
        {
            $('#designation').addClass('is-invalid');    
        }else{
            $('#designation').removeClass('is-invalid');       
        }
        if(name!=""&&designation!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            var file = $('#file')[0].files[0];
            fd.append('file',file);
            fd.append('id',id);
            fd.append('name',name);
            fd.append('designation',designation);
            $.ajax({
                url: baseUrl + "admin/admin/update_member_details",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function(){
                $("#save-btn-conatiner").html('<div class="spinner-border text-success text-right"></div>');
               },
                success: function(jsonStr) {
                  var res_data = JSON.stringify(jsonStr);
                  var response = JSON.parse(res_data);
                  var responseData = response['responseData'];
                  if ((responseData != null) && (responseData == 'member updated')) 
                  {
                    $('#member-action-modal').modal('hide');  
                    load_all_members(); 
                    swal({
                      title: "Details Updated.",
                      text: " Member Details Updated successfully.!",
                      type: "success",
                      confirmButtonClass: 'btn-primary btn-sm',
                      confirmButtonText: 'OK'
                    });
                  } 
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" data-key="'+id+'" class="btn bg-gradient-success btn-sm custom-action-btn" id="save-details">Update</button><button type="button" class="btn bg-gradient-danger btn-sm" data-dismiss="modal">Close</button>');
               }
            });
        }
    });
</script>
  
  
  