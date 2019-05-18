<!DOCTYPE html>
<html>
    <head>
        <style>

            .call-for-price {
                /*background-color: red; */
                box-sizing: border-box;
                height: 190px;
                left: 50%;
                margin: -95px 0 0 -350px;
                padding: 20px 0;
                position: absolute;
                top: 50%;
                width: 700px;
            }
            .callforpriceheader h3{
                    font-size: 18px;  
                    text-align: center; 
                    text-transform: uppercase; 
                    color:#666666; 
                    font-family: century gothic, helvetica, verdana, arial; 
                    margin:0;
            }
            .pricetext{
                    font-size: 18px; 
                    text-align: center;
                    text-transform: uppercase;
                    color:#666666;
                    font-family: century gothic, helvetica, verdana, arial;
                    width:100%;
            }
            .call{
                    clear:both;
                    font-size: 35px; 
                    text-align: center;
                    text-transform: uppercase;
                    color:#4F83AC;
                    font-family: century gothic, helvetica, verdana, arial;
            }

            @media ( max-width:767px ){
                    .call-for-price {
                            height: 240px;
                            margin: -120px 0 0 -150px;
                            width: 300px;
                    }
            }
        </style>
        
    </head>
    <body>    
        <div class="call-for-price">	
<div class="callforpriceheader">
	<h3><?php echo $groupedname; ?></h3>
</div>
<?php if($callforprice){  ?>
<div class="pricetext">
	<h3><?php echo $callprice['leval'];?></h3> </div>
<div class="call">
	<h3><?php echo $callprice['phone_number'];?></h3> </div>
	<?php } else { ?>
	<div class="call">
	<h3><?php echo "Number Not present";?></h3> </div>

	<?php } ?>
</div>
    </body>
</html>


	

