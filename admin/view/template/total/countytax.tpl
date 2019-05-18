<?php

if ( !function_exists('getStateNameByAbbreviation') ){
	function getStateNameByAbbreviation($state){
		$state = trim($state);
		$state = strtoupper($state);
		if ($state=="AK"){ return "Alaska"; }  
		if ($state=="AL"){ return "Alabama"; }  
		if ($state=="AR"){ return "Arkansas"; }  
		if ($state=="AZ"){ return "Arizona"; }  
		if ($state=="CA"){ return "California"; }  
		if ($state=="CO"){ return "Colorado"; }  
		if ($state=="CT"){ return "Connecticut"; }  
		if ($state=="DC"){ return "District of Columbia"; }  
		if ($state=="DE"){ return "Delaware"; }  
		if ($state=="FL"){ return "Florida"; }  
		if ($state=="GA"){ return "Georgia"; }  
		if ($state=="HI"){ return "Hawaii"; }  
		if ($state=="IA"){ return "Iowa"; }  
		if ($state=="ID"){ return "Idaho"; }  
		if ($state=="IL"){ return "Illinois"; }  
		if ($state=="IN"){ return "Indiana"; }  
		if ($state=="KS"){ return "Kansas"; }  
		if ($state=="KY"){ return "Kentucky"; }  
		if ($state=="LA"){ return "Louisiana"; }  
		if ($state=="MA"){ return "Massachusetts"; }  
		if ($state=="MD"){ return "Maryland"; }  
		if ($state=="ME"){ return "Maine"; }  
		if ($state=="MI"){ return "Michigan"; }  
		if ($state=="MN"){ return "Minnesota"; }  
		if ($state=="MO"){ return "Missouri"; }  
		if ($state=="MS"){ return "Mississippi"; }  
		if ($state=="MT"){ return "Montana"; }  
		if ($state=="NC"){ return "North Carolina"; }  
		if ($state=="ND"){ return "North Dakota"; }  
		if ($state=="NE"){ return "Nebraska"; }  
		if ($state=="NH"){ return "New Hampshire"; }  
		if ($state=="NJ"){ return "New Jersey"; }  
		if ($state=="NM"){ return "New Mexico"; }  
		if ($state=="NV"){ return "Nevada"; }  
		if ($state=="NY"){ return "New York"; }  
		if ($state=="OH"){ return "Ohio"; }  
		if ($state=="OK"){ return "Oklahoma"; }  
		if ($state=="OR"){ return "Oregon"; }  
		if ($state=="PA"){ return "Pennsylvania"; }  
		if ($state=="RI"){ return "Rhode Island"; }  
		if ($state=="SC"){ return "South Carolina"; }  
		if ($state=="SD"){ return "South Dakota"; }  
		if ($state=="TN"){ return "Tennessee"; }  
		if ($state=="TX"){ return "Texas"; }  
		if ($state=="UT"){ return "Utah"; }  
		if ($state=="VA"){ return "Virginia"; }  
		if ($state=="VT"){ return "Vermont"; }  
		if ($state=="WA"){ return "Washington"; }  
		if ($state=="WI"){ return "Wisconsin"; }  
		if ($state=="WV"){ return "West Virginia"; }  
		if ($state=="WY"){ return "Wyoming"; }
		return $state;
	}
}
?>
<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/total.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="countytax_status">
                <?php if ($countytax_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>

	<tr>
	<td valign="top">Processing</td>
	<td>
		<input type="radio" name="countytax_all" value="0"<?php if(!$countytax_all){ echo ' checked'; } ?>> Use most relavant tax one of (city, county, state) highest priority is first
		<br>
		<input type="radio" name="countytax_all" value="1"<?php if($countytax_all){ echo ' checked'; } ?>> Use all zones all of (city, county, state)
	</td>
	</tr>

	<tr>
	<td valign="top">Tax Shipping</td>
	<td>
		<input type="radio" name="countytax_shipping" value="0"<?php if($countytax_shipping==0){ echo ' checked'; } ?>> No
		<br>
		<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>carts with taxable items shipping are taxed, if the cart doesnt have taxable items shipping it is not taxed</small>
		<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>note: sort order must be after shipping</small>
		<br>
		<input type="radio" name="countytax_shipping" value="1"<?php if($countytax_shipping==1){ echo ' checked'; } ?>> Yes - use highest tax rate in cart
		<br>
		<input type="radio" name="countytax_shipping" value="2"<?php if($countytax_shipping==2){ echo ' checked'; } ?>> Yes - use lowest tax rate in cart
	</td>
	</tr>

	<tr>
	<td valign="top">Show Tax Rate<br><small>Only works when processing is set to "Use most relavant tax"</small></td>
	<td>
		<input type="radio" name="countytax_showpercent" value="0"<?php if($countytax_showpercent==0){ echo ' checked'; } ?>> No
		<br>
		<input type="radio" name="countytax_showpercent" value="1"<?php if($countytax_showpercent==1){ echo ' checked'; } ?>> No - with explanation
		<br>
		<input type="radio" name="countytax_showpercent" value="2"<?php if($countytax_showpercent==2){ echo ' checked'; } ?>> Yes
		<br>
		<input type="radio" name="countytax_showpercent" value="3"<?php if($countytax_showpercent==3){ echo ' checked'; } ?>> Yes - with explanation
	</td>
	</tr>

	<tr>
	<td valign="top">Append County To Address<br><small>Usefull for knowing which county tax was charged</small></td>
	<td valign="top">
		<input type="radio" name="countytax_ac" value="0"<?php if(!$countytax_ac){ echo ' checked'; } ?>> No
		&nbsp;&nbsp;&nbsp;
		<input type="radio" name="countytax_ac" value="1"<?php if($countytax_ac){ echo ' checked'; } ?>> Yes
	</td>
	</tr>

         <tr>
          <td>States:</td>
          <td><input type="text" name="statesearch" value="" /> - save after adding then edit again</td>
        </tr>
	<tr>
              <td></td>
              <td>
                <div class="scrollbox" id="countytax_states">
                  <?php $class = 'odd';
			if (is_array($countytax_states)){
				foreach($countytax_states as $state){
					$class = ($class == 'even' ? 'odd' : 'even');
					$state = strtolower(trim($state));
					$statename = getStateNameByAbbreviation( $state );
					echo '<div id="countytax_states_' .$state. '" style="line-height:16px">';
					echo $statename;
					echo '<img src="view/image/delete.png" />';
					echo '<input type="hidden" name="countytax_states[]" value="' .$state. '" />';
					echo '</div>';
				}
			}
		?>
                </div>
              </td>
        </tr>

	<?php
	if (is_array($countytax_states)){
		foreach($countytax_states as $state){
			$state = trim($state);
			$statename = getStateNameByAbbreviation( $state );


			echo '<tr>';
			echo '<td valign="top">'.$statename.': </td>';
			echo '<td>';

			echo '<table><tr>';

			foreach( $tax_classes as $tax_class ) {

				$taxid = $tax_class['tax_class_id'];

				echo '<td valign="top">';
				echo '<table>';
				echo '<tr><td colspan="2">'.$tax_class['title'].'</td></tr>';
				echo '<tr><td>Statewide: </td><td><input type="text" name="countytax_'.$taxid.'_'.$state.'_statewide" value="'.$this->data['countytax_'.$taxid.'_'.$state.'_statewide'].'"></td></tr>';

				if (is_array($this->data['countytax_'.strtolower($state).'_counties'])){
					foreach($this->data['countytax_'.strtolower($state).'_counties'] as $county){
						$countyname = ucwords(str_replace('-', ' ', $county));
						echo '<tr><td>'.$countyname.': </td><td><input type="text" name="countytax_'.$taxid.'_'.$state.'_'.$county.'" value="'.$this->data['countytax_'.$taxid.'_'.$state.'_'.$county].'"></td></tr>';
					}
				}
				echo '</table>';
				echo '</td>';

			}

			echo '</tr></table>';
			
			echo '</td>';
			echo '</tr>';
		}
	}
	?>

        <tr>
          <td valign="top">City Override: <br><small>Make sure to spell check and test</small></td>
          <td>
<?php

		echo 'County: <select name="ignore_county" id="ignore_county">';
			if (is_array($countytax_states)){
				foreach($countytax_states as $state){
					$state = strtolower(trim($state));
					$statename = getStateNameByAbbreviation( $state );

					if (is_array($this->data['countytax_'.$state.'_counties'])){
						echo '<option value="'.$state.'_statewide">'.$statename.' State Wide</option>';
						foreach($this->data['countytax_'.$state.'_counties'] as $county){
								$countyname = ucwords(str_replace('-', ' ', $county));
								if ( $county != 'statewide' ){
									echo '<option value="'.$state.'_'.$county.'">'.$statename.' '.$countyname.'</option>';
								}
						}
					}
				}
			}
		echo '</select> ';
		echo 'Tax Class: ';
		echo '<select name="ignore_tax" id="ignore_tax">';
		echo '<option value="0">Other/None</option>';
		foreach( $tax_classes as $tax_class ) {
			echo '<option value="'.$tax_class['tax_class_id'].'">'.$tax_class['title'].'</option>';
		}
		echo '</select> ';
		echo 'City: ';
		echo '<input type="text" name="ignore_city" id="ignore_city" value=""> ';
		echo '<input type="button" name="ignore_go" value="add" onclick="countyadd()"> ';
		echo '<br>';

		echo '<div class="scrollbox" id="countytax_cities" style="width:600px;height:300px">';
			if (is_array($countytax_cities)){
				foreach($countytax_cities as $city){
					echo '<div id="'.$city.'" style="line-height:16px;text-align:right"><span style="float:left">';
					$hold = substr($city, 5);
					$i = strpos($hold, '_');
					$taxid = substr($hold, 0, $i);
					$taxname = 'Other/None';
					foreach( $tax_classes as $tax_class ) {
						if ( $tax_class['tax_class_id'] == $taxid ){
							$taxname = $tax_class['title'];
							break;
						}
					}
					$hold = substr($hold, $i+1);
					$state = substr($hold, 0, 2);
					$statename = getStateNameByAbbreviation( strtolower($state) );
					$hold = substr($hold, 3);
					$i = strpos($hold, '_');
					$countyname = ucwords(substr($hold, 0, $i));
					$cityname = ucwords(str_replace('-', ' ', substr($hold, $i+1)));
					$city = str_replace(' ', '-', $city);
					echo $taxname.' '.$statename.' '.str_replace('_', ' ', $countyname).' '.$cityname;
					echo '</span>';
					echo '<input type="text" name="'.$city.'" value="'.$this->data[$city].'" size="5">';
					echo '<img src="view/image/delete.png" />';
					echo '<input type="hidden" name="countytax_cities[]" value="'.$city.'" />';
					echo '</div>';
				}
			}
		echo '</div>';
?>
          </td>
        </tr>

          <tr>
            <td><?php echo $entry_sort_order; ?> <br><small>Use 999 to merge all taxes</small></td>
            <td><input type="text" name="countytax_sort_order" value="<?php echo $countytax_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>



<script type="text/javascript"><!--
$('input[name=\'statesearch\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=total/countytax/autocomplete&token=<?php echo $this->session->data["token"]; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.abr
					}
				}));
			}
		});
		
	}, 
	select: function(event, ui) {
		$('#countytax_states_' + ui.item.value).remove();
		
		$('#countytax_states').append('<div id="countytax_states_' + ui.item.value + '" style="line-height:16px">' + ui.item.label + '<img src="view/image/delete.png" /><input type="hidden" name="countytax_states[]" value="' + ui.item.value + '" /></div>');

		$('#product-related div:odd').attr('class', 'odd');
		$('#product-related div:even').attr('class', 'even');
				
		return false;
	}
});

$('#countytax_states div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-related div:odd').attr('class', 'odd');
	$('#product-related div:even').attr('class', 'even');	
});

$('#countytax_cities div img').live('click', function() {
	$(this).parent().remove();	
});

function capitaliseFirstLetter(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
}


function countyadd(){
	var county = document.getElementById("ignore_county");
	var city = document.getElementById("ignore_city");
	var tax = document.getElementById("ignore_tax");

	county = county.options[county.selectedIndex].value;
	city = city.value;
	var cityname = city;
	city = city.trim();
	city = city.toLowerCase();
	city = city.replace("  ", " ");
	city = city.replace("  ", " ");
	city = city.replace(" ", "-");
	city = city.replace("\n", "");
	city = city.replace("\r", "");
	city = city.replace("\t", "");

	tax = tax.options[tax.selectedIndex].value;
	if ( city == "" || city == 'undefined' || city == null ){
		alert("Please enter a city name");
	}

	county = county.split("_", 2);
	var state;
	switch( county[0] ){

<?php
$state_list = array('AL'=>"Alabama",  'AK'=>"Alaska",  'AZ'=>"Arizona",  'AR'=>"Arkansas", 'CA'=>"California",  'CO'=>"Colorado",  'CT'=>"Connecticut",  'DE'=>"Delaware",'DC'=>"District Of Columbia",  'FL'=>"Florida",  'GA'=>"Georgia",  'HI'=>"Hawaii", 'ID'=>"Idaho",  'IL'=>"Illinois",  'IN'=>"Indiana",  'IA'=>"Iowa",  'KS'=>"Kansas", 'KY'=>"Kentucky",  'LA'=>"Louisiana",  'ME'=>"Maine",  'MD'=>"Maryland", 'MA'=>"Massachusetts",  'MI'=>"Michigan",  'MN'=>"Minnesota",  'MS'=>"Mississippi", 'MO'=>"Missouri",  'MT'=>"Montana", 'NE'=>"Nebraska", 'NV'=>"Nevada", 'NH'=>"New Hampshire", 'NJ'=>"New Jersey", 'NM'=>"New Mexico", 'NY'=>"New York", 'NC'=>"North Carolina", 'ND'=>"North Dakota", 'OH'=>"Ohio",  'OK'=>"Oklahoma",  'OR'=>"Oregon",'PA'=>"Pennsylvania",  'RI'=>"Rhode Island",  'SC'=>"South Carolina",  'SD'=>"South Dakota", 'TN'=>"Tennessee",  'TX'=>"Texas",  'UT'=>"Utah",  'VT'=>"Vermont",  'VA'=>"Virginia", 'WA'=>"Washington",  'WV'=>"West Virginia",  'WI'=>"Wisconsin",  'WY'=>"Wyoming");  
      
foreach ($state_list as $k=>$v){ 
	echo 'case "'.strtolower($k).'": state = "'.$v.'"; break;'."\r\n";
}
?>

		default:
			alert(county);
			break;
	}

	var taxname;
	switch( tax ){
<?php
foreach( $tax_classes as $tax_class ) {
	echo 'case "'.$tax_class['tax_class_id'].'": taxname = "'.$tax_class['title'].'"; break;'."\r\n";
}
?>
case "0": taxname="Other/None"; break;
default:
	taxname = tax;
	break;
	}

	var cid = 'city_'+tax+'_'+county[0].toLowerCase()+'_'+county[1].toLowerCase()+'_'+city;
	cid = cid.toLowerCase();
	var hold = document.getElementById(cid);
	if ( hold ){
		alert("city already overridden");
	} else {
		document.getElementById("countytax_cities").innerHTML += '<div id="'+cid+'" style="line-height:16px;text-align:right"><span style="float:left">'+taxname+' '+state+' '+capitaliseFirstLetter(county[1])+' '+cityname+'</span><input type="text" name="'+cid+'" value="" size="5"><img src="view/image/delete.png" /><input type="hidden" name="countytax_cities[]" value="'+cid+'" /></div>';
	}
}
//--></script> 

<?php echo $footer; ?>
