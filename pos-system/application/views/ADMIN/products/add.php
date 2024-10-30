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
              <li class="breadcrumb-item active">Add New Product</li>
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
                <h3 class="card-title">New Product</h3>
              </div>
                <div class="card-body">
                    <form id="submit_form" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Categories :</label>
                                <div class="select2-danger">
                                    <select id="categories" name="categories" class="select2 form-control-sm" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="">Select category</option>
                                      <?php foreach($categories as $sh):?>
                                        <option value="<?php echo $sh->id;?>"><?php echo $sh->name;?></option>
                                      <?php endforeach ;?>  
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold" id="categories-err"></span>
                            </div> 
                            
                            <div class="form-group">
                                <label>Sub Categories :</label>
                                <div style="dislay:none;"  class="select2-danger">
                                    <select id="sub-categories" name="sub-categories" class="select2 form-control-sm" multiple="multiple" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    </select>
                                 </div>
                                 <span class="text-danger font-weight-bold" id="subcategory-err"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Name :</label>
                                <input type="text" class="form-control form-control-sm" name="name" id="name-en">
                                <span class="text-danger font-weight-bold" id="name-err"></span>
                            </div>
                            <div class="form-group">
                              <label for="productQuantity">Quantity</label>
                              <input type="text" id="productQuantity" name="productQuantity" class="form-control-sm form-control">
                              <span class="error-text" id="productQuantityError"></span>
                            </div>
                            <div style="display:none;" class="form-group">
                            <label>Measurement Units :</label>
                            <div class="select2-danger">
                                <select id="units" name="units" class="select2 form-control-sm"  data-placeholder="Select Units." data-dropdown-css-class="select2-danger" style="width: 100%;">
                                  <option  value="">Select Unit</option>
                                  <?php foreach($units as $row):?>
                                  <option value="<?php echo $row->id?>"><?php echo $row->name?></option>
                                  <?php endforeach?>
                                </select>
                            </div>
                            <span class="text-danger font-weight-bold" id="units-err"></span>
                          </div>
                           
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                              <label for="sortDescription">Short Description</label>
                              <textarea id="sortDescription" name="sortDescription" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>  
                    <?php $i = 0; ?>
                    <h3 style="font-family:comic sans">Raw Materials</h3>
                    <p class="font-weight-bold quantity-err" id="quantity-err"></p>
                    <div id="mainItem">
                        <div id="show_item" class="item_option" data-id="<?php echo $i; ?>">
                            <div class="row">
                                 <div class="col-md-3 mb-3">
                                    <select id="raw-type" name="raw_name[<?php echo $i; ?>]" class="form-control getoption" placeholder="Select Raw Material">
                                        <option value="">Raw Material</option>
                                        <?php foreach($raw as $sh):?>
                                            <option class="abs" data-cat="<?php echo $sh->id; ?>" value="<?php echo $sh->id;?>"><?php echo $sh->name;?></option>
                                        <?php endforeach ;?>  
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <input id="txt_Search" onchange="Call()" Type="text" name="quantity[<?php echo $i; ?>]" class="form-control txt_Search" placeholder="Raw quantity">
                                </div>
                               
                                <div class="col-md-2 mb-2 d-grid">
                                    <button class="btn btn-success add_item_btn">Add More</button>
                                </div>
                            </div>
                    
                        </div>
                        <!-- <div class="newRow"></div> -->
                    </div>
                    </form>
                </div>
                <div class="card-footer" id="save-btn-conatiner">
                  <button type="button" class="btn btn-danger" id="submit">Save</button>
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
 $(document).ready(function(){  
     let raw_id;
     $(document).on("change", ".getoption", function (e) {
         raw_id = $(this).val();

     });
    $(document).on("keyup change", ".txt_Search", function (e) {
        var quantity = $(this).val();
        var fd = new FormData();
        fd.append('quantity',quantity);
        fd.append('raw_id',raw_id);
        fd.append('action',"add");
        $.ajax({
            url:"<?php echo base_url()?>check-quantity",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            dataType: "JSON",
                       
            success:function(jsonStr,status){  
                var res_data = JSON.stringify(jsonStr);
                var response = JSON.parse(res_data);
                var responseData = response['responseData'];
                if ((responseData != null) && (responseData == 'available')) 
                {
                    $('#quantity-err').text('');
                } else if((responseData != null) && (responseData == 'not available')) {
                        //$('#txt_Search').addClass('is-invalid');
                        $('#quantity-err').text('Quantity is not much please update your raw materials.*').css({'font-style':'italic','color':'red'});
                    }  
                }  
            });
    });
    
    
      $('#submit').click(function(){  
           var name = $('#name-en').val(); 
           var category = $('#categories').val();
           var subcategory = $('#sub-categories').val();
           var baseUrl = '<?php echo base_url(); ?>';
           var productQuantity = $('#productQuantity').val(); 
            
            if ((productQuantity == '') || (productQuantity == '0')) {
                $('#productQuantity').addClass('is-invalid');
                $('#productQuantityError').text('Please enter product quantity.*').css('color','red');
                // $('#productQuantityError').show().text('Please enter product quantity.').css('color','red');
            }else{
                $('#productQuantity').removeClass('is-invalid');
                $('#productQuantityError').hide().text('');
            }

           if(name=="")
            {
                $('#name-en').addClass('is-invalid');
                $('#name-err').text('Enter Product Name.*');
            }else{
                $('#name-en').removeClass('is-invalid');
                $('#name-err').text('');
            }
            if(category=="")
            {
                $('#categories').addClass('is-invalid');
                $('#categories-err').text('Enter Category.*');
            }else{
                $('#categories').removeClass('is-invalid');
                $('#categories-err').text('');
            }
            if(subcategory=="")
            {
                $('#sub-categories').addClass('is-invalid');
                $('#subcategory-err').text('Enter Sub Category.*');
            }else{
                $('#sub-categories').removeClass('is-invalid');
                $('#subcategory-err').text('');
            }
           if(name !='' && subcategory !='' && category !=''&& productQuantity !='') { 
                $.ajax({  
                     url: baseUrl + "create-new-product",  
                     method:"POST",  
                     data:$('#submit_form').serialize(), 
                    beforeSend: function(){
                        $('#name-en').removeClass('is-invalid');
                        $('#name-err').text('');
                        $("#save-btn-conatiner").html('<div class="spinner-border text-danger text-right"></div>');
                     },
                       
                     success:function(jsonStr){  
                          var res_data = JSON.stringify(jsonStr);
                          var response = JSON.parse(res_data);
                          var resp = JSON.parse(response);
                          var responseData = resp['responseData'];
                          var name = resp['name'];
    
                          if ((responseData != null) && (responseData == 'new record inserted successfully')) 
                          {
                            sessionStorage.setItem('saved',true);
                            window.location.href = baseUrl+'products-management';
                          } else if((responseData != null) && (responseData == 'already exist')) {
                            $('#name-en').addClass('is-invalid');
                            $('#name-err').text('Name already Exist.*');
                          }else if((responseData != null) && (responseData == 'quantity is less')) {
                              console.log(name)
                            $('#quantity-err').text(`Quantity is not much please update your raw materials of ${name}*`).css({'font-style':'italic','color':'red'});
                          }    
                     }  
                });  
           }  
      });  
 });  
 </script> 

<script>
    $(document).on('click','#save-btn-custom',function(){
        var name = $('#name-en').val();
        var brand = $('#brand').val();
        var category = $('#categories').val();
        var scategory = $('#sub-categories').val();
        //var type = $('#product-type').val();
        var desc_short_en = $('#sortDescription').val();
        var desc_en = $('#postDescription').val();
        var units = $('#units').val();
       
        if(name=="")
        {
            $('#name-en').addClass('is-invalid');
            $('#name-err').text('Enter Product Name.*');
        }else{
            $('#name-en').removeClass('is-invalid');
            $('#name-err').text('');
        }
        
        
        if(name!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            
            $.ajax({
                url: baseUrl + "create-new-product",
                type: 'POST',
                data:$('#add_form').serialize(),
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
                    window.location.href = baseUrl+'products-management';
                  } else if((responseData != null) && (responseData == 'already exist')) {
                    $('#name-en').addClass('is-invalid');
                    $('#name-err').text('Color Name already Exist.*');
                  }
                },complete:function(data){
                 $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Save</button>');
               }
            });
        }
        
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#shop').trigger('change'); 
  })
</script>
<script>

    $(document).on('change','#categories',function(){
        var cat_id = $(this).val();
        var fd = new FormData();
        fd.append('category',cat_id);
        $.ajax({
            url:"<?php echo base_url()?>admin/admin/get_subcategories",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            dataType: "JSON",
            beforeSend: function(){
                //console.log('before send');
           },
           error: function (err) {
            //console.log(err);
          },
            success: function(jsonStr,status) {      
              var res_data = JSON.stringify(jsonStr);
              var response = JSON.parse(res_data);
              var brands = response['brands'];
              var categ = response['response'];
              //console.log(categ);return;
              $('#sub-categories').html(categ);
              $('#brand').html(brands);
            },complete:function(data){
                //console.log('after complete');
           }
        });
    });
</script>

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
  $(function () {
    $('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $('#sortDescription').summernote({
      height: 100,
    });
    
    $('#arsortDescription').summernote({
      height: 100,
    });
    
    $('#arsortDescription').summernote('justifyRight');
        
    $('#postDescription').summernote({
      height: 100,
    });
    
      $('#arpostDescription').summernote({
      height: 100
    });
    
    $('#arpostDescription').summernote('justifyRight');
  })
</script>


<script>
    $(document).ready(function () {
    //  ----------------------- END Document type option ----------------------
    $(document).on("click", ".add_item_btn", function (e) {
        var index = parseInt(
            $(this)
                .parents("#mainItem")
                .find(".item_option")
                .last()
                .attr("data-id")
        );
        index++;
        console.log(index);
        //$(".add_item_btn").click(function(e){
        e.preventDefault();

        var html = "";
        html +=
            '<div id="show_item" class="item_option" data-id="' + index + '">';
        html += '<div class="row">';
         html += '<div class="col-md-3 mb-3">';
        html += '<select id="raw-type" name="raw_name[' + index + ']" class="form-control getoption" placeholder="Select Raw Material " data-dropdown-css-class="select2-danger" style="width: 100%;">';
        html += '<option value="">Raw Material</option>';
        html += '<?php foreach($raw as $sh){ ?>';
        html += '<option value="<?php echo $sh->id;?>"><?php echo $sh->name;?></option>';
        html += '<?php } ;?>';
        html += "</select>";
        html += "</div>";
        
        html += '<div class="col-md-3 mb-3">';
        html += '<input id="txt_Search" onchange="Call()" Type="text" name="quantity[' + index + ']" class="form-control txt_Search" placeholder="Raw material quantity">';
        html += '<span class="text-danger font-weight-bold quantity-err" id="quantity-err"></span>';
        html += "</div>";
        
        html += '<div class="col-md-2 mb-2 d-grid">';
        html +=
            '<button class="btn btn-danger remove_item_btn">Remove</button>';
        html += "</div>";
        html += "</div>";
        html += "</div>";

        $("#mainItem").append(html);
    });

    $(document).on("click", ".remove_item_btn", function (e) {
        e.preventDefault();

        let row_item = $(this).parent().parent();
        $(row_item).remove();
    });

});

</script>

