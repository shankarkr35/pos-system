    <?php 
        $totalproduct = $records['totalproduct'];
        $totalprice = $records['totalprice'];
        $list = $records['list'];
     // echo"<pre>";print_r($data);die;;
    ?>
    <div class="d-flex flex-row" style="max-height: 300px; overflow-y: scroll;">
        <table class="table table-bordered">
            <thead class="text-muted">
                <tr>
                    <th scope="col">Item</th>
                    <th scope="col" class="text-center">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($list)){
                foreach($list as $key=>$item) { ?>
                    <tr>
                        <td class="media align-items-center">
                            <img class="avatar avatar-sm mr-1" src="<?php echo $item['product_image'] ?>"
                                    onerror="this.src='<?php echo $item['product_image'] ?>'" alt=" image">
                            <div class="media-body">
                                <h5 class="text-hover-primary mb-0"><?php echo $item['product_name'] ?></h5>
                                <small></small>
                                <small style="display: block">
                                </small>
                            </div>
                        </td>
                        <td class="align-items-center text-center">
                            <input type="number"  data-key="0" style="width:50px;text-align: center;" value="<?php echo $item['quantity'] ?>" min="1" onkeyup="updateQuantity(event)">
                        </td>
                        <td class="text-center px-0 py-1">
                            <div class="btn">
                                <?php echo $item['product_price'] ?>$
                            </div> <!-- price-wrap .// -->
                        </td>
                        <td class="align-items-center text-center">
                            <a href="javascript:removeFromCart(<?php echo $item['cart_id'] ?>)" class="btn btn-sm btn-outline-danger"> <i class="tio-delete-outlined"></i></a>
                        </td>
                    </tr>
                    <?php }} ?>
               
            </tbody>
        </table>
    </div>
 <?php $discountAmt = 0; if($this->session->userdata('discount_session')){$discount_session = $this->session->userdata('discount_session'); $discountAmt = $discount_session['discountAmt']; }  ?>
    <div class="box p-3">
        <dl class="row text-sm-right">

            <dt  class="col-sm-6">Sub total : </dt>
            <dd class="col-sm-6 text-right"><?php echo $totalprice ?>$</dd>

            <dt  class="col-sm-6">Extra Discount :</dt>
            <dd class="col-sm-6 text-right"><button class="btn btn-sm" type="button" data-toggle="modal" data-target="#add-discount"><i class="tio-edit"></i></button>- <?php echo $discountAmt; ?>$</dd>

            <dt  class="col-sm-6">Total : </dt>
            <dd class="col-sm-6 text-right h4 b"><?php echo number_format((floatval(str_replace(',', '', $totalprice)) - $discountAmt),2)?>$</dd>
        </dl>
        <div class="row">
            <div class="col-md-6 pb-1 pb-md-0">
                <a href="#" class="btn btn-danger btn-sm btn-block" onclick="emptyCart()"><i
                        class="fa fa-times-circle "></i> Cancel </a>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn  btn-success btn-sm btn-block" data-toggle="modal" data-target="#paymentModal"><i class="fa fa-shopping-bag"></i>
                    Order</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-discount" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Discount</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('update-discount') ?>" method="post" class="row">
                        <?php $discount = ''; $type = ''; if($this->session->userdata('discount_session')){$discount_session = $this->session->userdata('discount_session'); $discount = $discount_session['discount'];$type = $discount_session['type']; } ?>
                        <input type="hidden" class="form-control" name="amount" value="<?php echo $totalprice ?>">
                        <div class="form-group col-sm-6">
                            <label for="">Discount</label>
                            <input type="number" class="form-control" name="discount" value="<?php echo ($discount !=''?$discount:0) ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Type</label>
                            <select name="type" class="form-control">
                                <option value="amount" <?php echo (($type=='amount')?'selected':'')?>>Amount</option>
                                <option value="percent" <?php echo (($type=='percent')?'selected':'')?>>Percent (%)</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-12">
                            <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-tax" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Tax</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="row">
                       
                        <div class="form-group col-12">
                            <label for="">Tax (%)</label>
                            <input type="number" class="form-control" name="tax" min="0">
                        </div>

                        <div class="form-group col-sm-12">
                            <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="paymentModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php  $customer_id = ''; if($this->session->userdata('cust_id_session')){$cust_id_session = $this->session->userdata('cust_id_session'); $customer_id = $cust_id_session['customer_id']; } ?>
                    <!--<form action="<?php echo base_url() ?>placeorder" id='order_place' method="post" class="row">-->
                    <form action="javascript:void(0)" id='order_place' method="post" class="row">
                        <div class="form-group col-12">
                            <label class="input-label" for="">Amount</label>
                            <input type="hidden" class="form-control" name="amount" value="<?php echo $totalprice ?>">
                            <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $customer_id ?>">
                            <input type="hidden" class="form-control" id="discount" name="discount" value="<?php echo $discountAmt ?>">
                            <input type="text" class="form-control" id="amount" name="amount" min="0" step="0.01" value="<?php echo number_format((floatval(str_replace(',', '', $totalprice)) - $discountAmt),2)?>" disabled>
                            <span class="text-danger font-weight-bold" id="amount-err"></span>
                        </div>
                        <div class="form-group col-12">
                            <label class="input-label" for="">Type</label>
                            <select id="type" name="type" class="form-control">
                                <option value="cash">Cash</option>
                                <option value="card">Card</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <button class="btn btn-sm btn-primary" type="submit" id="confirm-order-user-direct">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

