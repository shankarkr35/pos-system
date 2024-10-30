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
              <li class="breadcrumb-item active">Edit Size</li>
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
                <h3 class="card-title">Edit Size</h3>
              </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Raw Title :</label>
                    <input type="text" class="form-control" id="name-en" value="<?php echo $raw->name?>">
                    <span class="text-danger font-weight-bold" id="name-err"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Raw Quantity/Weight :</label>
                    <input type="text" class="form-control" id="quantity" value="<?php echo $raw->quantity?>">
                    <span class="text-danger font-weight-bold" id="quantity-err"></span>
                  </div>
                  <div class="form-group">
                      <!--multiple="multiple"-->
                    <label>Measurement Units :</label>
                    <div class="select2-danger">
                        <?php
                          $categs = $raw->measure_unit;
                          $categs_arr = explode(',',$categs);
                        ?>
                        <select id="units" class="select2 form-control-sm" data-placeholder="Select Unit." data-dropdown-css-class="select2-danger" style="width: 100%;">
                          <option  value="">Select Unit</option>
                          <?php foreach($units as $row):?>
                          <option value="<?php echo $row->id?>" <?=((in_array($row->id,$categs_arr))?'selected':'')?> ><?php echo $row->name?></option>
                          <?php endforeach?>
                        </select>
                    </div>
                    <span class="text-danger font-weight-bold" id="units-err"></span>
                  </div> 
                  <div style="display:none;" class="form-group">
                    <label for="exampleInputEmail1">Weight(Unit) :</label>
                    <input type="text" class="form-control" id="unit" value="<?php echo $raw->unit?>">
                    <span class="text-danger font-weight-bold" id="unit-err"></span>
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
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })
        $('.select2').select2()
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });
    });
</script>

<script>
    $(document).on('click','#save-btn-custom',function(){
        var name = $('#name-en').val();
        var quantity = $('#quantity').val();
        var units = $('#units').val();
        
        if(name=="")
        {
            $('#name-en').addClass('is-invalid');
            $('#name-err').text('Enter raw title.*');
        }else{
            $('#name-en').removeClass('is-invalid');
            $('#name-err').text('');
        }
        if(units=="")
        {
            $('#units').addClass('is-invalid');
            $('#units-err').text('select measurement units.*');
        }else{
            $('#units').removeClass('is-invalid');
            $('#units-err').text('');
        }
        if(quantity=="")
        {
            $('#quantity').addClass('is-invalid');
            $('#quantity-err').text('Enter weight or quantity.*');
        }else{
            $('#quantity').removeClass('is-invalid');
            $('#quantity-err').text('');
        }
        
        if(name!="" && units!="" && quantity!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            fd.append('id',<?php echo $raw->id?>);
            fd.append('name',name);
            fd.append('quantity',quantity);
            fd.append('units',units);
            $.ajax({
                url: baseUrl + "update-raw",
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
                    window.location.href = baseUrl+'raw-management';
                  } else if((responseData != null) && (responseData == 'already exist')) {
                    $('#name-en').addClass('is-invalid');
                    $('#name-err').text('Raw Title already Exist.*');
                  }
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>');
               }
            });
        }
        
    });
</script>
  
  
  