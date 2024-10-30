<style>
.ic-sing-file img{
    width:100px;
    height:100px;
}
</style>
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
              <li class="breadcrumb-item active">Edit Product Variation</li>
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
                <h3 class="card-title">Edit Product Variation</h3>
              </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            
                            <div class="form-group">
                                <label>Size :</label>
                                <select id="productSize" class="form-control form-control-sm select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                    <option value="">select Size</option>
                                    <?php
                                    foreach($sizes as $row):
                                    ?>
                                    <option value="<?php echo $row->id?>" <?php echo (($variation->size==$row->id)?'selected':'')?>><?php echo $row->name?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                              <label for="productPrice">MRP Price</label>
                              <input type="text" id="productPrice" name="productPrice" class="form-control-sm form-control" value="<?php echo $variation->mrp_price?>">
                              <span class="error-text" id="productPriceError"></span>
                            </div>
                            <div class="form-group">
                              <label for="productSalePrice">Sale Price</label>
                              <input type="text" id="productSalePrice" name="productSalePrice" class="form-control-sm form-control" value="<?php echo $variation->sale_price?>">
                              <span class="error-text" id="productSalePriceError"></span>
                            </div>
                            <div style="display:none;" class="form-group">
                              <label for="productQuantity">Quantity</label>
                              <input type="text" id="productQuantity" name="productQuantity" class="form-control-sm form-control" value="<?php echo $variation->quantity?>">
                              <span class="error-text" id="productQuantityError"></span>
                            </div>
                            
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                              <label for="postImage">Image </label><span style="color: red"> ( Recommended image size <b>width : 500px</b> and <b>height : 500px</b> )</span>
                              <div class="white-box">
                                <input type="file" id="featuredImage" name="file" class="dropify" data-default-file="<?php echo base_url(); ?>uploads/products/medium/<?php echo $variation->image; ?>" onchange="checkFile()" /> 
                                <input type="hidden" class="form-control" name="filecheck" id="filecheck" value="">
                                <div id="fileInfo1" style="color: red;"></div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="postImage">Image Gallery </label><span style="color: red"> ( Recommended image size <b>width : 500px</b> and <b>height : 500px</b> )</span>
                              <div class="white-box"> 
                                <input type="file" id="files" name="files[]" class="dropify" multiple data-default-file="<?php echo base_url(); ?>uploads/products/medium/<?php echo 'default-image.png'; ?>" onchange="checkFileDetails()" /> 
                                <input type="hidden" class="form-control" name="filescheck" id="filescheck" value="">
                                <div id="fileInfo" style="color: red;"></div>
                              </div>
                              <div class="col-lg-12 text-center" id="preview_file_div"><ul style="list-style: none;"></ul></div>
                            </div>
                            <?php if(!empty($variation->gallery)){
                            $gallery = json_decode($variation->gallery); 
                            ?>
                            <div class="form-group">
                              <div class="row preview">
                              <?php foreach($gallery as $key => $gimage){ ?>
                                  <div class="col-md-3" id="image_div<?php echo $variation->id.$key; ?>">
                                    <a href="javascript:void(0)" class='text-danger closeImage' data-id='<?php echo $variation->id; ?>'  data-key='<?php echo $key; ?>'  data-val='<?php echo $gimage; ?>' style='position: absolute;color:red;font-size:20px'>
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                    <img src="<?php echo base_url(); ?>uploads/products/<?php echo $gimage; ?>" alt="product gallery" style="max-width: 100%;" />
                                  </div>
                              <?php } ?>
                              </div>
                            </div>
                            <?php } ?> 
                        </div>
                    </div>  
                </div>
                <div class="card-footer" id="save-btn-conatiner">
                  <button type="button" class="btn btn-danger" id="save-btn-custom">Update variation</button>
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
        $('.dropify').dropify();
    });
    $("#productPrice, #productSalePrice, #productQuantity").on("keypress keyup blur",function (event) {    
        $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) 
            {
              event.preventDefault();
            }
    });
</script>


<script>
  $(function () {
    $('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>

<script>
    
    $(document).on('click','a.closeImage', function() {
            var variationId = $(this).attr('data-id');
            var imageName = $(this).attr('data-val');
            var key = $(this).attr('data-key');
            var baseUrl = "<?php echo base_url()?>";
            var fd = new FormData();
            fd.append('image',imageName);
            fd.append('variationId',variationId);
            $.ajax({
                url: baseUrl + "admin/Variations/imageGallery",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(jsonStr) {
                  var res_data = JSON.stringify(jsonStr);
                  var response = JSON.parse(res_data);
                  var responseData = response['responseData'];
                  if ((responseData != null) && (responseData == 'variation image gallery')) {
                      $(this).parent().remove();
                      $("#image_div"+variationId+key).remove();
                      //console.log(responseData);
                  } else {
                      //console.log(responseData);
                  }
                }
            });
            //console.log(variationId+' '+imageName);
        });

        //===============Upload Multiple Images================
        var input_file = document.getElementById('files');
        var deleted_file_ids = [];
        var dynm_id = 0;
        $("#files").change(function (event) {
            var len = input_file.files.length;
            $('#preview_file_div ul').html("");
            for(var j=0; j<len; j++) {
                var src = "";
                var name = event.target.files[j].name;
                var mime_type = event.target.files[j].type.split("/");
                if(mime_type[0] == "image") {
                  src = URL.createObjectURL(event.target.files[j]);
                } 
                $('#preview_file_div ul').append("<li id='" + dynm_id + "' style='width: 100px;display: inline-block;'><div class='ic-sing-file'><a href='javascript:void(0)' class='close' id='" + dynm_id + "' style='position: absolute;color:red;font-size:20px'><i class='fas fa-times-circle'></i></a><img id='" + dynm_id + "' src='"+src+"' title='"+name+"'></div></li>");
                dynm_id++;
            }
        });
        $(document).on('click','a.close', function() {
            var id = $(this).attr('id');
            deleted_file_ids.push(id);
            $('li#'+id).remove();
            if(("li").length == 0) document.getElementById('files').value="";
        });

    $('#save-btn-custom').on('click', function(event) {
        
            event.preventDefault();
            var productId = <?php echo $variation->product_id?>;
            var productColor = $('#productColor').val();  
            var productSize = $('#productSize').val(); 
            var productPrice = $('#productPrice').val(); 
            var productSalePrice = $('#productSalePrice').val(); 
            var productQuantity = $('#productQuantity').val(); 
            
            
            if ((productSalePrice == '') || (productSalePrice == '0')) {
                $('#productSalePrice').addClass('is-invalid');
                $('#productSalePriceError').show().text('Please enter product sale price').css('color','red');
            }else{
                $('#productSalePrice').removeClass('is-invalid');
                $('#productSalePriceError').hide().text('');
            }
            
            if ((productId != '') && (productSalePrice != '') && (productSalePrice != '0')  && (files != '')) 
            {
                var baseUrl = '<?php echo base_url(); ?>';
                var fd = new FormData();
                var image = $('#featuredImage')[0].files[0];
                var ins = document.getElementById('files').files.length;
                for (var x = 0; x < ins; x++) {
                  fd.append("files[]", document.getElementById('files').files[x]);
                }
                fd.append('file',image);
                fd.append('variationId',<?php echo $variation->id?>);
                fd.append('productId',productId);
                fd.append('productColor',productColor);
                fd.append('productSize',productSize);
                fd.append('productPrice',productPrice);
                fd.append('productSalePrice',productSalePrice);
                fd.append('productQuantity',productQuantity);
                fd.append('deleted_file_ids',deleted_file_ids);
                $.ajax({
                    url: baseUrl + "admin/Variations/update",
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
                      var responseData = response['responseData'];
                      if ((responseData != null) && (responseData == 'variation update successfully')) {
                          sessionStorage.setItem('updated',true);
                          window.location.href = baseUrl+'product-variations/'+productId;
                      } else {
                          console.log(responseData);
                      }
                    },complete:function(data){
                     $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Update variation</button>');
                   }
                });
              }
    });
</script>

<script>
    function checkFile() {
      var fi = document.getElementById('featuredImage');
      if (fi.files.length > 0) {    
          for (var i = 0; i <= fi.files.length - 1; i++) {
              var fileName, fileExtension, fileSize, fileType, dateModified;
              fileName = fi.files.item(i).name;
              fileExtension = fileName.replace(/^.*\./, '');
              if (fileExtension == 'png' || fileExtension == 'jpg' || fileExtension == 'jpeg') {
                  $('#fileInfo1').html('');
                  readImageFile(fi.files.item(i));   
              }
              else {
                  $('#featuredImage').addClass('error');
                  $('#addPost').prop('disabled', true);
              }
          }

          function readImageFile(file) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  var img = new Image();      
                  img.src = e.target.result;
                  img.onload = function () {
                      var w = this.width;
                      var h = this.height;
                      var getfileSize = Math.round((file.size / 1024));
                      if(getfileSize >= 300){
                          document.getElementById('fileInfo1').innerHTML =
                          document.getElementById('fileInfo1').innerHTML +
                          'Name: <b>' + fileName + '</b> <br />' +
                          'Size: <b>' + Math.round((file.size / 1024)) + '</b> KB Greater than 300 KB<br />';
                          $('#featuredImage').addClass('error');
                          $('#addPost').prop('disabled', true);
                      }else{
                          $('#fileInfo').html('');
                          $('#featuredImage').removeClass('error');
                          $('#addPost').prop('disabled', false);    
                      }
                  }
              };
              reader.readAsDataURL(file);
          }
      }
  }

  function checkFileDetails() {
      var fi = document.getElementById('files');
      if (fi.files.length > 0) {    
          for (var i = 0; i <= fi.files.length - 1; i++) {
              var fileName, fileExtension, fileSize, fileType, dateModified;
              fileName = fi.files.item(i).name;
              fileExtension = fileName.replace(/^.*\./, '');
              if (fileExtension == 'png' || fileExtension == 'jpg' || fileExtension == 'jpeg') {
                  $('#fileInfo').html('');
                  readImageFile(fi.files.item(i));   
              }
              else {
                  $('#files').addClass('error');
                  $('#addPost').prop('disabled', true);
              }
          }

          function readImageFile(file) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  var img = new Image();      
                  img.src = e.target.result;
                  img.onload = function () {
                      var w = this.width;
                      var h = this.height;
                      var getfileSize = Math.round((file.size / 1024));
                      if(getfileSize >= 300){
                          console.log(file);
                          document.getElementById('fileInfo').innerHTML =
                          document.getElementById('fileInfo').innerHTML +
                          'Name: <b>' + file.name + '</b> <br />' +
                          'Size: <b>' + Math.round((file.size / 1024)) + '</b> KB Greater than 300 KB<br />';
                          $('#files').addClass('error');
                          $('#addPost').prop('disabled', true);
                      }else{
                          $('#fileInfo').html('');
                          $('#files').removeClass('error');
                          $('#addPost').prop('disabled', false);    
                      }
                  }
              };
              reader.readAsDataURL(file);
          }
      }
  }
</script>

<script>
    /*$(document).on('click','#save-btn-custom',function(){
        var name = $('#name-en').val();
        var ar_name = $('#name-ar').val();
        var brand = $('#brand').val();
        var category = $('#category').val();
        var scategory = $('#sub-category').val();
        var type = $('#product-type').val();
        var desc_short_en = $('#sortDescription').val();
        var desc_short_ar = $('#arsortDescription').val();
        var desc_en = $('#postDescription').val();
        var desc_ar = $('#arpostDescription').val();
        
        if(name=="")
        {
            $('#name-en').addClass('is-invalid');
            $('#name-err').text('Enter english Name.*');
        }else{
            $('#name-en').removeClass('is-invalid');
            $('#name-err').text('');
        }
        
        if(ar_name=="")
        {
            $('#name-ar').addClass('is-invalid');
            $('#ar_name-err').text('Enter Arabic Name.*');
        }else{
            $('#name-ar').removeClass('is-invalid');
            $('#ar_name-err').text('');
        }
        
        if(name!=""&&ar_name!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            fd.append('name',name);
            fd.append('ar_name',ar_name);
            fd.append('brand',brand);
            fd.append('category',category);
            fd.append('scategory',scategory);
            fd.append('type',type);
            fd.append('desc_short_en',desc_short_en);
            fd.append('desc_short_ar',desc_short_ar);
            fd.append('desc_en',desc_en);
            fd.append('desc_ar',desc_ar);
            $.ajax({
                url: baseUrl + "create-new-product",
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
        
    });*/
</script>
  
  
  