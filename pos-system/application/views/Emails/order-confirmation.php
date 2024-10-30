<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> Order Invoice - Trails Sports Events</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style type="text/css">
         tbody {
         display: inline-table;
         width: 100%;
         }
         @media (max-width: 480px) {
         {
         width: 100%!important;
         }
         }
      </style>
   </head>
   <body style="margin: 0; padding: 0; box-sizing: border-box;    font-family: Poppins;" marginheight="0" topmargin="0" marginwidth="0">
      <div class="trails-email" style="width: 50%; magin:0 auto 0 auto;display: initial;">
         <div class="container" style="width: 550px;margin:auto; margin-top: 50px;border-radius: 8px;border:1px solid #DDDDDD;">
            <div class="" style=" padding: 20px 30px;">
               <div class="email-header" style="display: flex; justify-content: space-between; ">
                  <table style="width:100%">
                      <tr>
                        <th style="text-align: inherit;">
                            <div class="">
                             <p style="margin: 0">  <a style=" color: #000; font-weight: bold; text-decoration: none;font-size: 14px"><?php echo $order->user_name;?></a></p>
                             <p style="margin: 0;"><a style="color: #000; font-weight: bold; text-decoration: none;font-size: 14px"><?php echo $order->phone?></a></p>
                             <p style="margin-top: 0;"><a style="color: #000; font-weight: bold; text-decoration: none;font-size: 14px"><?php echo $order->email?></a></p>
                            </div>
                        </th>
                        <th style="text-align: end;">
                            <div class="img">
                                <img style="width: 200px;" src="<?php echo base_url('assets/front-end/images/logo.png')?>" alt="logo image">
                            </div>
                        </th>
                      </tr>
                    </table>
                </div>
               <div class="" style="text-align:center;margin-top: 15px">
                  <img src="<?php echo base_url('assets/front-end/icons/check-1.png')?>" style="font-size: 30px; width: 80px; height: 80px; text-align: center; line-height: 80px; border-radius: 50%;display: inline-block; margin-bottom: 15px;">
                  <p style="color: #1D194C; font-size: 24px; font-weight: bold; margin: 0; padding: 0;">Congratulations</p>
                  <p style="font-size: 14px;margin: 0;margin-top: 10px;">your products are on there way to you.! </p>
               </div>
               <div class="trails-table" style="background: #F5F5F5; border: 1px solid #DDDDDD; border-radius: 8px; padding: 25px 22px; margin-top: 30px;">
                  <table style="width:100%">
                      <tr>
                        <td><p style="margin-bottom:12px;margin-top: 0;color: #000; font-weight: bold; font-size: 16px;">Purchase date</p></td>
                        <td><p style="text-align: end;margin-top:0px;margin-bottom: 11px"><a style="color: #000; font-weight: Regular; font-size: 14px; text-decoration: none;"><?php echo date('j M  Y', strtotime($order->create_date))?></a></p></td>
                      </tr>
                      <tr>
                        <td><p style="margin-bottom:12px;margin-top: 0; color: #000; font-weight: bold; font-size: 16px;">Order Status</p></td>
                        <td><p style="text-align: end;margin-top:0px;margin-bottom: 11px"> <a style="color: #009B05; font-weight: Regular; font-size: 14px; text-decoration: none;">Success</a></p></td>
                      </tr>
                      <tr>
                        <td><p style="margin-bottom:12px;margin-top: 0;color: #000; font-weight: bold; font-size: 16px;">Reference</p></td>
                        <td><p style="text-align: end;margin-top:0px;margin-bottom: 11px"><a style="color: #000; font-weight: Regular; font-size: 14px; text-decoration: none;"><?php echo $order->order_unique_id;?></a></p></td>
                      </tr>
                      <tr>
                        <td><p style="margin-bottom:0px;margin-top: 0;color: #000; font-weight: bold; font-size: 16px;">Order Amount</p></td>
                        <td><p style="text-align: end;margin-top:0px;margin-bottom: 0px"><a style="color: #1D194C; font-weight: bold; font-size: 18px; text-decoration: none;"><?php echo $order->total_amount." KD";?></a></p> </td>
                      </tr>
                    </table>
               </div>
               
               <div class="" style="margin-top: 20px;margin-bottom:0px;">
                  <h3 style="font-size: 18px; color: #000; font-weight: bold; text-transform: capitalize;margin-bottom: 10px;margin-top: 0px">invoice</h3>
                  <table style="width: 100%; border-collapse: collapse; border: 1px solid #DDDDDD; border-radius: 8px; display: block;">
                     <tr style="text-align: left;border-bottom: 1px solid #DDDDDD;">
                        <th style="padding: 8px 20px; text-align: inherit;font-size: 14px;font-weight: inherit">Product</th>
                        <th style="padding: 8px 0px; text-align: inherit;font-size: 14px;font-weight: inherit">Unit Price</th>
                        <th style="padding: 8px 0px; text-align: inherit;font-size: 14px;font-weight: inherit">Sub - Total</th>
                     </tr>
                    <?php foreach($products as $row):?> 
                     <tr style="border-bottom: 1px solid #DDDDDD;">
                        <td style="display: flex;padding:10.5px 20px">
                           <div class="">
                              <img style="width: 61.74px; height: 61px; border-radius: 5px;" src="<?php echo base_url('uploads/products/medium/').$row['image']?>">
                           </div>
                           <div style="padding-left: 15.3px">
                              <p style="margin-bottom: 5px; margin-top: 0;font-size: 12px;"> <?php echo text_limit($row['name'],8);?></p>
                              <?php if($row['size_name']!=""):?>
                              <p style="margin-bottom: 5px;margin-top: 0px;font-size: 12px;"> Size :<a style="font-size: 12px;text-decoration: none; color:#000;"> <?php echo $row['size_name'];?></a></p>
                              <?php endif?>
                              <?php if($row['color']!=""):?>
                              <p style="margin-bottom: 0px; margin-top: 0px;;font-size: 12px;">Color :<a style="font-size: 12px;text-decoration: none;color:#000;"> <span style="display: inline-block;width:30px;height:10px;background:<?php echo $row['color'];?>"></span></a></p>
                              <?php endif?>
                              <?php if(!empty($row['product_arch'])):?>
                              <p style="margin-bottom: 0px; margin-top: 0px;;font-size: 12px;">Arch :<a style="font-size: 12px;text-decoration: none;color:#000;"> <?php echo $row['product_arch'];?></a></p>
                              <?php endif?>
                              <p style="margin-bottom: 0px; margin-top: 0px;;font-size: 12px;">Qty :<a style="font-size: 12px;text-decoration: none;color:#000;"> <?php echo $row['quantity']?></a></p>
                           </div>
                        </td>
                        <td style="font-size: 12px"><?php echo $row['price']." KD";?></td>
                        <td><a href="#" style="font-weight: bold;font-size: 12px; color: #000;text-decoration: none;"><?php echo number_format($row['quantity']*$row['price'],2)." KD";?></a></td>
                     </tr>
                    <?php endforeach?>
                    
                     <tr style="border-bottom: 1px solid #DDDDDD;">
                        <td></td>
                        <td>
                           <p style="margin-top: 0px; font-size: 12px; color: #000; text-transform: capitalize;">sub total</p>
                           <?php if($order->coupon_amt!="0.00"):?>
                           <p style="margin-bottom: 0px; font-size: 12px; color: #000; text-transform: capitalize;">coupon discount</p>
                           <?php endif?>
                        </td>
                        <td>
                           <p style="position: relative;top: 3px;margin-bottom: 0px">
                              <a style="font-size: 12px; color: #1D194C;font-weight: bold;text-decoration: none;"><?php echo $order_s_total." KD";?></a>
                           </p>
                           <?php if($order->coupon_amt!="0.00"):?>
                           <p style="position: relative;top: -6px"><a style="font-size: 12px;color: #1D194C;font-weight: bold;text-decoration: none;">- <?php echo $order->coupon_amt." KD";?></a></p>
                           <?php endif?>
                        </td>
                     </tr>
                     
                     <tr style="border-bottom: 1px solid #DDDDDD;">
                        <td></td>
                        <td>
                           <p style="margin-top: 10px;margin-bottom: 10px; font-size: 18px; font-weight: bold; color: #1D194C; text-transform: capitalize; font-weight: bold;">Total</p>
                        </td>
                        <td style=" color: #1D194C; text-transform: capitalize; font-weight: bold;">
                           <p style="margin-top: 10px;margin-bottom: 10px;"><a style="color: #1D194C;text-decoration: none;font-size: 18px;font-weight: bold;"><?php echo $order->total_amount." KD";?></a></p>
                        </td>
                     </tr>
                     
                  </table>
               </div>
            </div>
            <div class="footer">
               <div style="height: 72px; text-align: center; background: #1D194C; color: #fff; padding: 5px 0;border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                  <p style="font-size: 12px">Phone : <a href="#" style="color: #fff;text-decoration: none;">123-567-890</a>       Email : <a style="text-decoration: none; color: #fff" href="#">trailssupport@gmail.com</a></p>
                  <p style="font-size: 12px">Copyright © <?php echo date('Y')?> Trails Sports Events </p>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>