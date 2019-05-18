<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <div class="box">
        <div class="heading">
            <h1><img alt="" src="view/image/order.png">Order Info :: <?php echo $order_id;?></h1>

        </div>
        <div class="content">

            <div class="vtabs">
                <a href="#tab-customer">Customer</a>
                <a href="#tab-payment">Billing Address</a>
                <a href="#tab-shipping">Shipping Address</a>
                <a href="#tab-product">Prodcuts</a>

            </div>
            <div id="tab-customer" class="vtabs-content">
                <table class="form">
                    <tr>
                        <td>Order ID:</td>
                        <td><?php echo $info['orders_id']; ?></td>
                    </tr>
                    <tr>
                        <td>Company:</td>
                        <td><?php echo $info['customers_company']; ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo $info['customers_email_address']; ?></td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td><?php echo $info['customers_name']; ?></td>
                    </tr>

                    <tr>
                        <td>Phone:</td>
                        <td><?php echo $info['customers_telephone']; ?></td>
                    </tr>
                    <tr>
                        <td>Address1:</td>
                        <td><?php echo $info['customers_street_address']; ?></td>
                    </tr>
                    <tr>
                        <td>Address2:</td>
                        <td><?php echo $info['customers_suburb']; ?></td>
                    </tr>
                    <tr>
                        <td>City:</td>
                        <td><?php echo $info['customers_city']; ?></td>
                    </tr>
                    <tr>
                        <td>State:</td>
                        <td><?php echo $info['customers_state']; ?></td>
                    </tr>
                    <tr>
                        <td>Zip:</td>
                        <td><?php echo $info['customers_postcode']; ?></td>
                    </tr>

                    <tr>
                        <td>Country:</td>
                        <td><?php echo $info['customers_country']; ?></td>
                    </tr>
                </table>

            </div>
            <div id="tab-payment" class="vtabs-content">
                <table class="form">

                    <tr>
                        <td>Company:</td>
                        <td><?php echo $info['billing_company']; ?></td>
                    </tr>

                    <tr>
                        <td>Name:</td>
                        <td><?php echo $info['billing_name']; ?></td>
                    </tr>

                    <tr>
                        <td>Address1:</td>
                        <td><?php echo $info['billing_street_address']; ?></td>
                    </tr>
                    <tr>
                        <td>Address2:</td>
                        <td><?php echo $info['billing_suburb']; ?></td>
                    </tr>
                    <tr>
                        <td>City:</td>
                        <td><?php echo $info['billing_city']; ?></td>
                    </tr>
                    <tr>
                        <td>State:</td>
                        <td><?php echo $info['billing_state']; ?></td>
                    </tr>
                    <tr>
                        <td>Zip:</td>
                        <td><?php echo $info['billing_postcode']; ?></td>
                    </tr>

                    <tr>
                        <td>Country:</td>
                        <td><?php echo $info['billing_country']; ?></td>
                    </tr>
                    <tr>
                        <td>Payment Method:</td>
                        <td><?php echo $info['payment_method']; ?></td>
                    </tr>
                </table>

            </div>
            <div id="tab-shipping" class="vtabs-content">
                <table class="form">

                    <tr>
                        <td>Company:</td>
                        <td><?php echo $info['delivery_company']; ?></td>
                    </tr>

                    <tr>
                        <td>Name:</td>
                        <td><?php echo $info['delivery_name']; ?></td>
                    </tr>

                    <tr>
                        <td>Address1:</td>
                        <td><?php echo $info['delivery_street_address']; ?></td>
                    </tr>
                    <tr>
                        <td>Address2:</td>
                        <td><?php echo $info['delivery_suburb']; ?></td>
                    </tr>
                    <tr>
                        <td>City:</td>
                        <td><?php echo $info['delivery_city']; ?></td>
                    </tr>
                    <tr>
                        <td>State:</td>
                        <td><?php echo $info['delivery_state']; ?></td>
                    </tr>
                    <tr>
                        <td>Zip:</td>
                        <td><?php echo $info['delivery_postcode']; ?></td>
                    </tr>

                    <tr>
                        <td>Country:</td>
                        <td><?php echo $info['delivery_country']; ?></td>
                    </tr>
                    <tr>
                        <td>Shipping Method:</td>
                        <td><?php echo $info['shipping_method']; ?></td>
                    </tr>
                </table>

            </div>
            <div id="tab-product" class="vtabs-content">
                <table class="list">
                    <thead>
                        <tr>
                            <td class="left"><?php echo $column_product; ?></td>
                            <td class="left">Description</td>
                            <td class="right"><?php echo $column_quantity; ?></td>
                            <td class="right"><?php echo $column_price; ?></td>
                            <td class="right"><?php echo $column_total; ?></td>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 

                        foreach ($products as $product) { ?>
                        <tr>
                            <td class="left"><b><?php echo $product['products_name']; ?></b><br/>
                                <?php if(!empty($product['color'])){ ?>
                                Color :  <?php echo $product['color']; ?><br>
                                <?php } ?>
                                <?php if(!empty($product['seat_depth_id'])){ ?>
                                Seat Depth :  <?php echo $product['seat_depth_id']; ?><br/>
                                <?php } ?>
                                <?php if(!empty($product['grade'])){ ?>
                                Grade :  <?php echo $product['grade']; ?><br/>
                                <?php } ?>
                                <?php if(!empty($product['size'])){ ?>
                                Size :  <?php echo $product['size']; ?><br/>
                                <?php } ?>
                                <?php if(!empty($product['nailheads'])){ ?>
                                Nail Heads :  <?php echo $product['nailheads']; ?><br/>
                                <?php } ?>
                                <?php if(!empty($product['legs'])){ ?>
                                Legs :  <?php echo $product['legs']; ?><br/>
                                <?php } ?>
                                <?php if(!empty($product['finishes'])){ ?>
                                finishes :  <?php echo $product['finishes']; ?><br/>
                                <?php } ?>
                                <?php if(!empty($product['trim'])){ ?>
                                trim :  <?php echo $product['trim']; ?><br/>
                                <?php } ?>
                                <?php if(!empty($product['pillows'])){ ?>
                                pillows :  <?php echo $product['pillows']; ?><br/>
                                <?php } ?>
                                <?php if(!empty($product['cupholders'])){ ?>
                                cupholders :  <?php echo $product['cupholders']; ?><br/>
                                <?php } ?>
                                <?php if(!empty($product['frame_finishes'])){ ?>
                                Frame finishes :  <?php echo $product['frame_finishes']; ?><br/>
                                <?php } ?>
                            </td>



                            <?php   
                            $qty_pieces =  explode("^", $product['pieces']); 
                          
                            $qty_array =  explode(",",$product['qtys']); 
                            
                            $qty_prices =  explode(",",$product['prices']);
                             
                           $count = count($qty_array);
                            ?>
                             <td class="left"><?php foreach($qty_pieces as $pieces){ echo $pieces."<br/>"; } ?></td>
                            <td class="right"><?php foreach($qty_array as $qty){ echo $qty."<br/>"; } ?></td>
                            <td class="right"><?php foreach($qty_prices as $prices){ echo $prices."<br/>"; } ?></td>
                            <?php
                            if($count > 1){

                            for($i=0 ; $i < $count; $i++){
                            $total_array[] = $qty_array[$i] * $qty_prices[$i];
                            }

                            $sum = array_sum($total_array);

                            ?>
                           
                            <td class="right">$<?php echo sprintf("%01.2f", $sum); ?></td>
                            <?php } else{ ?>
                            <td class="right">$<?php echo sprintf("%01.2f", $product['qtys']* $product['prices']); ?></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>

                    </tbody>

                    <tbody id="totals">
                        <?php  if(!empty($totals['gift_card_name'])|| $totals['discount_total']>0){ ?>

                        <tr>
                            <td colspan="4" class="right">Discount:&nbsp;<?php if(!empty($totals['gift_card_name'])){echo '('.$totals['gift_card_name'].' - '.$totals['coupon_code'].')';} ?></td>
                            <td class="right">-$<?php echo sprintf("%01.2f", $totals['discount_total']); ?></td>
                        </tr>
                        <?php } ?>
                        <?php
                        if ( $totals['customers_state'] == 'FL' || strtoupper($totals['delivery_state']) == 'FL') {
                        ?>
                        <tr>
                            <td colspan="4" class="right">Florida sales tax (6%)</td>
                            <td class="right">$<?php echo sprintf("%01.2f", $totals['order_tax']); ?></td>
                        </tr>
                        <?php } ?>
                        <?php if ($totals['delivery_country'] == 'Canada') {
                        ?>
                        <tr>
                            <td colspan="4" class="right">GST (13%)</td>
                            <td class="right">$<?php echo sprintf("%01.2f", $totals['order_tax']); ?></td>
                        </tr>
                        <?php } ?>

                        <tr>
                            <td colspan="4" class="right">Total:</td>
                            <td class="right">$<?php echo sprintf("%01.2f", $totals['order_total']); ?></td>
                        </tr>
                    </tbody>

                </table>
                <?php if ($downloads) { ?>
                <h3><?php echo $text_download; ?></h3>
                <table class="list">
                    <thead>
                        <tr>
                            <td class="left"><b><?php echo $column_download; ?></b></td>
                            <td class="left"><b><?php echo $column_filename; ?></b></td>
                            <td class="right"><b><?php echo $column_remaining; ?></b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($downloads as $download) { ?>
                        <tr>
                            <td class="left"><?php echo $download['name']; ?></td>
                            <td class="left"><?php echo $download['filename']; ?></td>
                            <td class="right"><?php echo $download['remaining']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } ?>
            </div>
        </div>


    </div></div>
<script type="text/javascript"><!--
$('.vtabs a').tabs();
    //--></script>
<?php echo $footer; ?>