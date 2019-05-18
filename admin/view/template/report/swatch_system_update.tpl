
<?php echo $header; ?>
<div id="content">

  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  
    <div class="heading">
      <h1><?php echo $heading_title; ?></h1>
    </div>
   


    <style type="text/css">
    <!--
            .inner { float:left;}
            #d1 {background-color:#FFFFFF;width:96px; height:130px; }
            #d2 {background-color:#FFFFFF;width:96px; height:130px; margin-left:11px; }
            #d3 {background-color:#FFFFFF;width:96px; height:130px; margin-left:11px; }
            #d4 {background-color:#FFFFFF;width:96px; height:130px; margin-left:11px; }
            #d5 {background-color:#FFFFFF;width:96px; height:130px; margin-left:11px; }
            #d6 {background-color:#FFFFFF;width:96px; height:130px; margin-left:11px; }
    -->
    </style>
    <style type="text/css">
    <!--
            body 
            {
                    margin-left: 0px;
                    margin-top: 0px;
                    margin-right: 0px;
                    margin-bottom: 0px;
            }
            input, select, textarea 
            {
                    font-family: century gothic, Georgia, "Times New Roman", Times, serif;
                    font-size: 9pt;
                    color: #675341;
                    line-height: 18px;
                    border:#675341 1px solid;
                    list-style-type: disc;
                    text-decoration: none;
            }
            .error
            {
                    font-family: century gothic, Georgia, "Times New Roman", Times, serif;
                    size:11pt;
                    color:#CC0000;
                    font-weight:bold;
            }

.option-image img {
height: 75px;
width: 75px;
}
    -->
    </style>
    <link href="text.css" rel="stylesheet" type="text/css">
    <script language="javascript" type="text/javascript">
            function checkemail(email) 
            {
                    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
                    {return (true)}
                    alert("Invalid E-mail Address! Please re-enter.")
                    return (false)
            }
            function validate(form)
            {

                    // BEGIN CHECK FOR AT LEAST 1 COLOR CHECKBOX CHECKED --- IMPERIAL WEB SOLUTIONS AUGUST 8, 2011
                    if(!checkbox_checked(form)) {
                            alert('Please choose at least 1 color');
                            return false;
                    }
                    function checkbox_checked(the_form) {
                            var inputTags = the_form.getElementsByTagName('input');
                            var inputTagsLen = inputTags.length;
                            for (var i = 0; i < inputTagsLen; i++) {
                                    if (inputTags[i].type == 'checkbox' && inputTags[i].name == 'Color[]') {
                                            if (inputTags[i].checked) {
                                                    return true;
                                            } // END IF INPUT TAGS CHECKED
                                    } // END IF COLOR INPUT TAGS
                            } // END FOR
                            return false;
                    } // END checkbox_checked()
                    // END CHECK FOR AT LEAST 1 COLOR CHECKBOX CHECKED



                    if(form.First_Name.value =='' || form.First_Name.value.length < 2)
                    {
                            alert('Please Enter your First Name');
                            form.First_Name.focus();
                            return false
                    }
                    if(form.Last_Name.value =='' || form.Last_Name.value.length < 2)
                    {
                            alert('Please Enter your Last Name');
                            form.Last_Name.focus();
                            return false
                    }
                    if(form.Address1.value =='' || form.Address1.value.length < 5)
                    {
                            alert('Please Enter your Address');
                            form.Address1.focus();
                            return false
                    }
                    if(form.City.value =='' || form.City.value.length < 3)
                    {
                            alert('Please Enter your City');
                            form.City.focus();
                            return false
                    }
                    if(form.State.value =='blank')
                    {
                            alert('Please Select a State');
                            form.State.focus();
                            return false
                    }
                    if(form.Zip.value =='' || form.Zip.value.length < 5)
                    {
                            alert('Please Enter your Zip Code');
                            form.Zip.focus();
                            return false
                    }
                    if(form.Collection.value == '')
                    {
                            alert('Please Enter a Collection');
                            form.Collection.focus();
                            return false
                    }
                    if ( checkemail(form.Email.value) ) {
                            // GOOGLE ANALYTICS EVENT TRACKING
                            _gaq.push(['_trackEvent', 'Swatch Request', 'Submit', 'Swatch Request Form Submission - Leather Furniture Expo']);
                            return true;
                    }
                    else {
                            return false;
                    }
            }
    </script>
    <style type="text/css">
    <!--
            *
            {
                    font-family: century gothic, Verdana, Arial, Helvetica, sans-serif;
                    font-size:11px;
            }
;
            .headerTitleBar
            {
                    display:block;
                    float:left;
                    width:806px;
                    height:39px;
                    border:1px solid #C2AB95;
                    background:#E5DFC5;
                    text-align:center;
            }
            .headerTitleBar h3
            {
                    font-family: century gothic, Georgia, "Times New Roman", Times, serif;
                    text-align:center;
                    width:806px;
                    padding-top:7px;
                    height:30px;
                    color:#392923;
                    font-size:20px;
                    font-weight:normal;
            }
    -->
    </style>
		
	

<span style="font-family: century gothic, helvetica, verdana, arial; font-color: #6e6e6e;">




<script type="text/javascript" src="js/wz_tooltip.js"></script>
	

<div id="content_jc">	

<table width="750"  border="0" align="center" cellpadding="0" cellspacing="0">
			
	<tr>
				
		

<td style="background-color:#6e6e6e;">

<h3 style="font-size: 18px; color: #ffffff; text-align: center; text-transform: uppercase;"><?php echo $swatchsystemupdate[0]['collection_value']; ?></h3></td>

			
	</tr>
			
	
				<tr>
				
		
	<td valign="top">
					
			
		<table width="91%"  border="0" align="center" cellpadding="5" cellspacing="0">
						
				<tr>
							
					<td valign="top">
						
							
									
						<p align="center" class="error">
											
										
						</p>

										
						<p>
											Leather Furniture Expo 
											is dedicated to providing you with the highest quality Leather Furniture at the lowest possible prices. 
											To request a swatch, please complete the form below and click the submit button. 
											Your request will be shipped the next business day.
										
						</p>
										
						<p align="center">
											We are pleased to offer our customers up to ten complimentary  leather samples.<br>
										
						</p>
                                                                       
						
<p align="center" style="text-transform: uppercase; font-size: 16px; font-weight: bold; color: #6e6e6e;">Your Samples Will Arrive in 3-4 Business Days!</p>


                                                                        
						
<p align="center">Mailed the next business day!</p>


                                                                       
						
<p align="center" style="text-transform: uppercase; font-size: 16px; font-weight: bold; color: #6e6e6e;">Pick Our Your Colors of Interest<br>Then Scroll Down to Fill in Mailing Address</p>

                                                                       
						
<p align="center">
    <a style="text-transform: uppercase; color: #6e6e6e;" href="<?php echo HTTP_CATALOG; ?>grade_info.html" onClick="window.open('<?php echo HTTP_CATALOG; ?>grade_info.html','popup','width=550,height=300,scrollbars=no,resizable=no,toolbar=no,directories=no,location=no,menubar=no,status=no,left=240,top=0'); return false">
What does leather grading mean?</a></p>

<span style="text-transform: uppercase;">
  
										
						
<form name="swatchreq" method="post" action="" onSubmit="return validate(this)">
											
				

<table width="75%" border="1" class="texthome" align="center" cellpadding="4" cellspacing="0">
												
					<tr>
													
						<td colspan="2" height="100%" align="center">
						
															
															
						

<div align="center" style="padding:10px; width:526px; height:auto; border:#ffffff solid 1px;">
																

<strong>
																	
This collection comes in 134 Colors.<br />
You may select a maximum of 10 swatches
</strong>


																
						<br/><br />
						
<?php  $collection=$swatchsystemupdate[0]['collection'];

 ?>
						
						 <?php  if ($options) { ?>
        <div class="options">
          <?php foreach ($options as $option) { ?>
          <?php if ($option['type'] == 'image' && $option['name'] == "Color Options"){ ?>
          <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
            <?php //echo $product_id; ?>
            <b><div id="imageName"></div></b>
            <div class="option-image">

              <?php $i=1; ?>
              <?php foreach ($option['option_value'] as $option_value) { ?>
              <div class="option-color-value" style="float:left; width:90px;  margin: 0 3px 12px 0;">
              <span id = "colorImage-<?php echo $i; ?>" style="float=left;">

                <a onclick="return false;" onmouseover="imageName('<?php echo $option_value['name']; ?>');"><img onmouseover="Tip('\&lt;img src=/image/<?php echo $option_value['image']; ?> width=150 /\&gt;')" onmouseout="UnTip()" src="/image/<?php echo $option_value['image']; ?>" width ="75px"; alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></a>
<?php $value= (explode(",",$collection)); ?>
              </span>
             <p style="clear:both; width:90px;"> <?php echo $option_value['name']; ?></p>
             <span><input name="Color[]" id="color" type="checkbox" <?php if(in_array($option_value['name'], $value))  {echo "checked";}  ?> value="<?php echo $option_value['name']; ?>"></span>
			          </div>  
              <?php $i++; } ?>
            </div>
          </div>
          <br />
          <?php } ?>
          <?php } ?>
        </div>
        <?php } ?>
													</td>
												</tr> 
											</table>                  
											<br>
											


<table width="75%" border="1" align="center" cellpadding="5" cellspacing="0">
												<tr>
													<td>
														<table width="98%" border="0" class="texthome" align="center" cellpadding="4" cellspacing="0">
															<tr>
																<td colspan="2" align="right">
																	<div align="center">Please complete all the fields below then click submit swatch request</div>																</td>
															</tr>
															<tr>
																<td width="47%" align="right"><div align="right"><strong>First Name :.</strong></div></td>
																<td width="53%" align="left"><input name="First_Name" type="text" id="First_Name" value="<?php echo $swatchsystemupdate[0]['firstname']?>"></td>
															</tr>
															<tr>
																<td align="right"><div align="right"><strong>Last Name :.</strong></div></td>
																<td align="left"><input name="Last_Name" type="text" id="Last_Name" value="<?php echo $swatchsystemupdate[0]['lastname']; ?>"></td>
															</tr>
															<tr>
																<td align="right"><div align="right"><strong>Address1 :.</strong></div></td>
																<td align="left"><input name="Address1" type="text" id="Address1" value="<?php echo $swatchsystemupdate[0]['address1']; ?>" size="30" ></td>
															</tr>
															<tr>
																<td align="right"><div align="right"><strong>Address2 :.</strong></div></td>
																<td align="left"><input name="Address2" type="text" id="Address2" value="<?php echo $swatchsystemupdate[0]['address']; ?>" size="30" ></td>
															</tr>
															<tr>
																<td align="right"><div align="right"><strong>City :.</strong></div></td>
																<td align="left"><input type="text" name="City" id="City" value="<?php echo $swatchsystemupdate[0]['city']; ?>" ></td>
															</tr>
															<tr>
																<td align="right"><div align="right"><strong>State or Province :.</strong></div></td>
																<td align="left">
																	<select name="State" id="State">
																			<OPTION VALUE="blank" selected>Select State or Province</OPTION>
																		<optgroup label="U.S. States">
																			<option value="AK" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'AK')  echo 'selected = "selected"'; ?>>Alaska</option>
																			<option value="AL" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'AL')  echo 'selected = "selected"'; ?>>Alabama</option>
																			<option value="AR" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'AR')  echo 'selected = "selected"'; ?>>Arkansas</option>
																			<option value="AZ" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'AZ')  echo 'selected = "selected"'; ?>>Arizona</option>
																			<option value="CA" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'CA')  echo 'selected = "selected"'; ?>>California</option>
																			<option value="CO" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'CO')  echo 'selected = "selected"'; ?>>Colorado</option>
																			<option value="CT" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'CT')  echo 'selected = "selected"'; ?>>Connecticut</option>
																			<option value="DC" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'DC')  echo 'selected = "selected"'; ?>>District of Columbia</option>
																			<option value="DE" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'DE')  echo 'selected = "selected"'; ?>>Delaware</option>
																			<option value="FL" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'FL')  echo 'selected = "selected"'; ?>>Florida</option>
																			<option value="GA" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'GA')  echo 'selected = "selected"'; ?>>Georgia</option>
																			<option value="HI" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'HI')  echo 'selected = "selected"'; ?>>Hawaii</option>
																			<option value="IA" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'IA')  echo 'selected = "selected"'; ?>>Iowa</option>
																			<option value="ID" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'ID')  echo 'selected = "selected"'; ?>>Idaho</option>
																			<option value="IL" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'IL')  echo 'selected = "selected"'; ?>>Illinois</option>
																			<option value="IN" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'IN')  echo 'selected = "selected"'; ?>>Indiana</option>
																			<option value="KS" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'KS')  echo 'selected = "selected"'; ?>>Kansas</option>
																			<option value="KY" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'KY')  echo 'selected = "selected"'; ?>>Kentucky</option>
																			<option value="LA" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'LA')  echo 'selected = "selected"'; ?>>Louisiana</option>
																			<option value="MA" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'MA')  echo 'selected = "selected"'; ?>>Massachusetts</option>
																			<option value="MD" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'MD')  echo 'selected = "selected"'; ?>>Maryland</option>
																			<option value="ME" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'ME')  echo 'selected = "selected"'; ?>>Maine</option>
																			<option value="MI" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'MI')  echo 'selected = "selected"'; ?>>Michigan</option>
																			<option value="MN" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'MN')  echo 'selected = "selected"'; ?>>Minnesota</option>
																			<option value="MO" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'MO')  echo 'selected = "selected"'; ?>>Missouri</option>
																			<option value="MS" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'MS')  echo 'selected = "selected"'; ?>>Mississippi</option>
																			<option value="MT" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'MT')  echo 'selected = "selected"'; ?>>Montana</option>
																			<option value="NC" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'NC')  echo 'selected = "selected"'; ?>>North Carolina</option>
																			<option value="ND" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'ND')  echo 'selected = "selected"'; ?>>North Dakota</option>
																			<option value="NE" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'NE')  echo 'selected = "selected"'; ?>>Nebraska</option>
																			<option value="NH" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'NH')  echo 'selected = "selected"'; ?>>New Hampshire</option>
																			<option value="NJ" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'NJ')  echo 'selected = "selected"'; ?>>New Jersey</option>
																			<option value="NM" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'NM')  echo 'selected = "selected"'; ?>>New Mexico</option>
																			<option value="NV" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'NC')  echo 'selected = "selected"'; ?>>Nevada</option>
																			<option value="NY" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'NY')  echo 'selected = "selected"'; ?>>New York</option>
																			<option value="OH" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'OH')  echo 'selected = "selected"'; ?>>Ohio</option>
																			<option value="OK" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'OK')  echo 'selected = "selected"'; ?>>Oklahoma</option>
																			<option value="OR" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'OR')  echo 'selected = "selected"'; ?>>Oregon</option>
																			<option value="PA" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'PA')  echo 'selected = "selected"'; ?>>Pennsylvania</option>
																			<option value="PR" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'PR')  echo 'selected = "selected"'; ?>>Puerto Rico</option>
																			<option value="RI" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'RI')  echo 'selected = "selected"'; ?>>Rhode Island</option>
																			<option value="SC" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'SC')  echo 'selected = "selected"'; ?>>South Carolina</option>
																			<option value="SD" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'SD')  echo 'selected = "selected"'; ?>>South Dakota</option>
																			<option value="TN" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'TN')  echo 'selected = "selected"'; ?>>Tennessee</option>
																			<option value="TX" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'TX')  echo 'selected = "selected"'; ?>>Texas</option>
																			<option value="UT" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'UT')  echo 'selected = "selected"'; ?>>Utah</option>
																			<option value="VA" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'VA')  echo 'selected = "selected"'; ?>>Virginia</option>
																			<option value="VT" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'VT')  echo 'selected = "selected"'; ?>>Vermont</option>
																			<option value="WA" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'WA')  echo 'selected = "selected"'; ?>>Washington</option>
																			<option value="WI" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'WI')  echo 'selected = "selected"'; ?>>Wisconsin</option>
																			<option value="WV" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'WV')  echo 'selected = "selected"'; ?>>West Virginia</option>
																			<option value="WY" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'WY')  echo 'selected = "selected"'; ?>>Wyoming</option>
																		</optgroup>
																		<optgroup label="Canadian Provinces">
																			<option value="AB" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'AB')  echo 'selected = "selected"'; ?>>Alberta</option>
																			<option value="BC" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'BC')  echo 'selected = "selected"'; ?>>British Columbia</option>
																			<option value="MB" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'MB')  echo 'selected = "selected"'; ?>>Manitoba</option>
																			<option value="NB" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'NB')  echo 'selected = "selected"'; ?>>New Brunswick</option>
																			<option value="NF" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'NF')  echo 'selected = "selected"'; ?>>Newfoundland</option>
																			<option value="NT" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'NT')  echo 'selected = "selected"'; ?>>Northwest Territories</option>
																			<option value="NS" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'NS')  echo 'selected = "selected"'; ?>>Nova Scotia</option>
																			<option value="NU" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'NU')  echo 'selected = "selected"'; ?>>Nunavut</option>
																			<option value="ON" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'ON')  echo 'selected = "selected"'; ?>>Ontario</option>
																			<option value="PE" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'PE')  echo 'selected = "selected"'; ?>>Prince Edward Island</option>
																			<option value="QC" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'QC')  echo 'selected = "selected"'; ?>>Quebec</option>
																			<option value="SK" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'SK')  echo 'selected = "selected"'; ?>>Saskatchewan</option>
																			<option value="YT" <?php if (!empty($swatchsystemupdate[0]['state']) && $swatchsystemupdate[0]['state'] == 'YT')  echo 'selected = "selected"'; ?>>Yukon Territory</option>
																		</optgroup>
																	</select>																</td>
															</tr>
															<tr>
																<td align="right"><div align="right"><strong>Post/Zip Code :.</strong></div></td>
																<td align="left"><input type="text" name="Zip" id="Zip" value="<?php echo $swatchsystemupdate[0]['zipcode']; ?>"></td>
															</tr>
															<tr>
																<td align="right"><div align="right"><strong>Country :.</strong></div></td>
																<td align="left">
																	<select name="country" id="country">
																		<option value="USA" <?php if (!empty($swatchsystemupdate[0]['country']) && $swatchsystemupdate[0]['country'] == 'USA')  echo 'selected = "selected"'; ?>>United States</option>
																		<option value="Canada" <?php if (!empty($swatchsystemupdate[0]['country']) && $swatchsystemupdate[0]['country'] == 'Canada')  echo 'selected = "selected"'; ?> >Canada</option>
																	</select>																</td>
															</tr>
															<tr style="display:none;">
                                                              <td align="right"><div align="right"><strong>Phone Number :.</strong></div></td>
															  <td align="left"><input name="Phone" type="text" id="Phone" value="" size="30" > 
															    <em>Optional</em></td>
														  </tr>
															<tr>
																<td align="right"><div align="right"><strong>Collection :.</strong></div></td>
																<td align="left">
																	<input name="Collection" type="text" id="Collection" value="<?php echo $swatchsystemupdate[0][collection_value]; ?>" size="40">
																	<!--<input name="Collection" type="hidden" id="Collection" value="<?php echo $swatchsystemupdate[0][collection_value]; ?>">-->
																	<input name="products_id" type="hidden" id="products_id" value="<?php echo $swatchsystemupdate[0][collection_value]; ?>">																</td>
															</tr>
															<tr>
																<td align="right"><div align="right"><strong>Email :.</strong></div></td>
																<td align="left"><input name="Email" type="text" id="Email" value="<?php echo $swatchsystemupdate[0]['email']; ?>" size="40"></td>
															</tr>
															<tr>
																<td align="right"><div align="right"><strong>&nbsp;</strong></div></td>
																<td align="left">
																	<table width="100%" cellpadding="0" cellspacing="0" border="0">
																		<tr>
																			<td width="30" valign="middle" align="left">
																				<input name="user_send_promos" type="checkbox" value="1" checked>																			</td>
																			<td align="left" valign="top">
																				Sign up for Special Information, Specials and Products																			</td>
																		</tr>
																	</table>																</td>
															</tr>
															<tr align="right">
																<td colspan="2">
																	<div align="center">
																		<strong> Privacy Policy:</strong> 
																		We will never sell or share your information with anyone. Ever																	</div>																</td>
															</tr>
															<tr>
																<td align="right"><div align="right"><strong>Questions or Comments :.</strong></div></td>
																<td align="left">
																	<label>
																		<textarea name="Question_Comments" cols="45" rows="5" id="Question_Comments"><?php echo $swatchsystemupdate[0]['comment'];?></textarea>
																	</label>																</td>
															</tr>
														</table>
												  </td>
												</tr>
											</table>
										


<p align="center">
												<input type="submit" name="submit" id="button" value="Submit Swatch Request">
											</p>
										
</form>


							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	


</div>
<!-- Google Code for Remarketing tag -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 992202035;
var google_conversion_label = "KsDqCM2arggQs5qP2QM";
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/992202035/?value=0&amp;label=KsDqCM2arggQs5qP2QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</span>
</div>
<?php echo $footer; ?>
