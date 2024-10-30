<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>A5 Sweets</title>
</head>
<body style="background: #f5f5f5">
<div style="width:800px; margin:auto; background-color:#fff; min-height:500px; border:2px groove #ccc;border-radius: 5px;">
  <table style="color: #333;font-family: sans-serif;font-size: 15px;font-weight: 300;text-align: center;border-collapse: separate;border-spacing: 0;width: 99%;margin: 6px auto; color: #333;
  font-family: sans-serif;font-size: 15px;font-weight: 300;text-align: center;border-collapse: separate;border-spacing: 0;width: 99%;margin: 20px auto 0; ">
    <tbody>
      <tr>
        <td style="text-align:left; padding:10px;" width="70%"><img style="height: 60px;width: auto;" src="<?php echo base_url('assets/admin/')?>images/logo.png" width="200"></td>
        <td style="text-align:left; padding:10px;">
          <span style="margin: 5px 0;display: block;">
          <?php $getDate =  date('h:i A', strtotime($order->create_date)).' '.date('d/m/Y', strtotime($order->create_date));?>
          <strong style="font-weight: bold;">Date: &nbsp;</strong> <?php echo $getDate; ?></span> 
        </td>
      </tr>
    </tbody>
  </table>
  <div style="font-family: sans-serif;padding: 0 15px;margin-top: 30px; ">
    <p><strong>Dear <?php echo $order->user_name;?></strong></p>
  </div>
  <table style="margin-top:14px;color: #333;font-family: sans-serif;font-size: 15px;font-weight: 300;text-align: center;border-collapse: separate;border-spacing: 0;width: 99%;margin: 6px auto; 
  font-family: sans-serif;font-size: 15px;font-weight: 300;text-align: center;border-collapse: separate;border-spacing: 0;width: 99%;margin: 50px auto; ">
    <tbody>
      <tr>
        <td style="text-align:left; padding:10px;" width="48%"><div style="background: #f1f1f1;padding: 7px 10px;margin-bottom: 10px"><strong style="font-weight:bold;">Customer Information :</strong><br>
          </div>
          <div style="padding-left: 10px;"> <strong><?php echo $order->user_name;?></strong><br>
            <span><?php echo $order->address; ?></span><br>
            <span><strong>Email : </strong><?php echo $order->email; ?></span><br>
            <span><strong>Phone : </strong><?php echo $order->phone; ?></span> 
          </div>
         </td>
          <!--<td style="text-align:left; padding:10px;" width="48%"><div style="background: #f1f1f1;padding: 7px 10px;margin-bottom: 10px"><strong style="font-weight:bold;">Customer Information</strong><br>-->
          <!--</div>-->
          <!--<div style="padding-left: 10px;"> <strong><?php echo $order->user_name;?></strong><br>-->
          <!--  <span><?php echo $order->address; ?></span><br>-->
          <!--  <span><strong>Email : </strong><?php echo $order->email; ?></span><br>-->
          <!--  <span><strong>Phone : </strong><?php echo $order->phone; ?></span> </div></td>-->
      </tr>
      <tr>
        <td style="text-align:left; padding:10px;" width="48%"><div style="background: #f1f1f1;padding: 7px 10px;margin-bottom: 10px"><strong style="font-weight:bold;">Payment Information :</strong><br>
          </div>
            <div style="padding-left: 10px;">
                <?php if($order->payment_method=='cash'){ ?>
                <b>Payment Mode:- </b> <?php echo 'Cash' ?> <br />
                <?php }else{ ?>
                <b>Payment Mode - </b> &nbsp; <?php echo "Card"; ?> <br /><br>
                <?php } ?>
                
                <?php if($order->payment_status==1){ ?>
                <b>Payment Status - </b> &nbsp; <?php echo "Paid"; ?> <br />
                <?php }else{ ?>
                <b>Payment Status - </b> &nbsp; <?php echo "Pending"; ?> <br /><br>
                <?php } ?>
          </div></td>
      </tr>
    </tbody>
  </table>
  <table style="color: #333;font-family: sans-serif;font-size: 15px;font-weight: 300;text-align: center;border-collapse: separate;border-spacing: 0;width: 97%;margin: 50px auto 0px; ">
    <thead>
      <tr>
        <th style="font-weight: bold; padding:10px;border: 2px solid #fff; border-bottom:1px solid #ddd;background: #f1f1f1">Item Image</th>
        <th style="font-weight: bold; padding:10px;border: 2px solid #fff; border-bottom:1px solid #ddd;background: #f1f1f1">Item Name</th>
        <th style="font-weight: bold; padding:10px;border: 2px solid #fff; border-bottom:1px solid #ddd;background: #f1f1f1">Quantity</th>
        <th style="font-weight: bold; padding:10px;border: 2px solid #fff; border-bottom:1px solid #ddd;background: #f1f1f1">Price</th>
        <th style="font-weight: bold; padding:10px;border: 2px solid #fff; border-bottom:1px solid #ddd;background: #f1f1f1">Total</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($products)){ 
      foreach($products as $row){ ?>  
      <tr>
        <td style="border-bottom: 1px solid #ddd; padding:10px;"><img src="<?php echo base_url('uploads/products/medium/').$row['image']?>" width="70" height="70"></td>
        <td style="border-bottom: 1px solid #ddd; padding:10px;"><div style="width: 300px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"><?php echo text_limit($row['name'],8);?><br /><?php echo $order->order_unique_id; ?></div></td>
        <td style="border-bottom: 1px solid #ddd; padding:10px;"><?php echo $row['quantity']?></td>
        <td style="border-bottom: 1px solid #ddd; padding:10px;"><?php echo number_format($row['price'],2)." KD" ?></td>
        <td style="border-bottom: 1px solid #ddd; padding:10px;"><?php echo number_format($row['price'] * $row['quantity'], 2)." KD"; ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td colspan="5" style="text-align:right; padding:10px;border-bottom: 1px solid #ddd; padding:10px;">
          <div style="margin-bottom: 5px"><strong style="font-weight:bold;">Sub Total : </strong><?php echo $order_s_total." KD";?></div>
          <div style="margin-bottom: 10px;display:none;"><strong style="font-weight:bold;">Shipping : </strong><?php echo $order->shipping_charges." KD";?></div>
          <?php if($order->coupon_amt!="0.00"):?>
          <div style="margin-bottom: 10px"><strong style="font-weight:bold;"> Discount : </strong><?php echo $order->coupon_amt." KD";?></div>
          <?php endif?>
          <?php } ?>
          <div style="width: 160px;float: right;border-top: 1px solid #ccc;padding-top: 8px;"><strong style="font-weight:bold;">Total : </strong><?php echo $order->total_amount." KD";?></div>
        </td>
      </tr>
     
    </tbody>
  </table>
  <table style="font-size:15px;font-weight:400;font-family:PT Sans Narrow,Tahoma,Arial,sans-serif;line-height:22px;padding:15px 25px" width="630" cellspacing="0" cellpadding="0" border="0" align="center">
    <tbody>
      <tr>
        <td style="padding:10px 25px;max-width: 250px;;" valign="middle" align="center"><p style="margin:0px"> 
        <strong style="font-weight:bold">A5 Sweets<!-- <br>+965 9874 654--></strong> </p>
      </td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>