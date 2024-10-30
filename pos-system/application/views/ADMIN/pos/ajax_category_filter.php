<div class="d-flex flex-wrap mt-2 mb-3" style="justify-content: space-around;">
    <?php foreach($products as $key=>$product){ $data['product'] = $product;  ?>
    <div class="item-box">
        <?php $this->load->view('ADMIN/pos/single_product',$data) ?>
    </div>
    <?php } ?>
</div>
                        
