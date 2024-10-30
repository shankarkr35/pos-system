<style>
.card-body.inline_product.text-center.p-1.clickable .product-title1.text-dark.font-weight-bold {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.product-card.card {
    height: 215px;
}
</style>

<div class="product-card card" onclick="quickView('<?php echo $product['product_id'] ?>','<?php echo $product['variation_id'] ?>')" style="cursor: pointer;">
    <div class="card-header inline_product clickable p-0" style="height:134px;width:100%;overflow:hidden;">
        <div class="d-flex align-items-center justify-content-center d-block">
            <img src="<?php echo $product['image'] ?>"
                 onerror="this.src='<?php echo $product['image'] ?>'"
                 style="width: 100%; border-radius: 5%;">
        </div>
    </div>

    <div class="card-body inline_product text-center p-1 clickable"
         style="height:3.5rem; max-height: 3.5rem">
        <div style="position: relative;" class="product-title1 text-dark font-weight-bold">
            <?php echo $product['name'] ?>
        </div>
        <div class="justify-content-between text-center">
            <div class="product-price text-center" style="font-size: 12px;">
                <?php echo $product['sale_price'] ?>$
                <strike style="font-size: 8px!important;color: grey!important;">
                    <?php echo $product['mrp_price'] ?>$
                </strike><br>
            </div>
        </div>
    </div>
</div>