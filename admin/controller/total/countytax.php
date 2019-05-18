<?php 

function startsWith($haystack, $needle){
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}



class ControllerTotalCountyTax extends Controller { 
	private $error = array();
	 
	public function index() { 
		$this->load->language('total/countytax');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {

			$this->model_setting_setting->editSetting('countytax', $this->request->post);
		
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
					
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
 
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
 
   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_total'),
			'href'      => $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('total/countytax', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);


		$this->data['action'] = $this->url->link('total/countytax', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['countytax_status'])) {
			$this->data['countytax_status'] = $this->request->post['countytax_status'];
		} else {
			$this->data['countytax_status'] = $this->config->get('countytax_status');
		}

		if (isset($this->request->post['countytax_all'])) {
			$this->data['countytax_all'] = $this->request->post['countytax_all'];
		} else {
			$this->data['countytax_all'] = $this->config->get('countytax_all');
		}

		if (isset($this->request->post['countytax_shipping'])) {
			$this->data['countytax_shipping'] = $this->request->post['countytax_shipping'];
		} else {
			$this->data['countytax_shipping'] = $this->config->get('countytax_shipping');
		}

		if (isset($this->request->post['countytax_showpercent'])) {
			$this->data['countytax_showpercent'] = $this->request->post['countytax_showpercent'];
		} else {
			$this->data['countytax_showpercent'] = $this->config->get('countytax_showpercent');
		}

		if (isset($this->request->post['countytax_ac'])) {
			$this->data['countytax_ac'] = $this->request->post['countytax_ac'];
		} else {
			$this->data['countytax_ac'] = $this->config->get('countytax_ac');
		}

		if (isset($this->request->post['countytax_sort_order'])) {
			$this->data['countytax_sort_order'] = $this->request->post['countytax_sort_order'];
		} else {
			$this->data['countytax_sort_order'] = $this->config->get('countytax_sort_order');
		}

		if (isset($this->request->post['countytax_states'])) {
			$this->data['countytax_states'] = $this->request->post['countytax_states'];
		} else {
			$this->data['countytax_states'] = $this->config->get('countytax_states');
		}

		if (!is_array($this->data['countytax_states'])){
			$this->data['countytax_states'] = unserialize($this->data['countytax_states']);
		}


		//get tax classes
		$this->load->model('localisation/tax_class');
		$data = array(
			'sort'  => 'title',
			'order' => 'ASC',
			'start' => 0,
			'limit' => 25
		);
		$tax_class_total = $this->model_localisation_tax_class->getTotalTaxClasses();
		$results = $this->model_localisation_tax_class->getTaxClasses($data);
		$this->data['tax_classes'] = array();
		$founddefault = false;
		foreach ($results as $result) {
			$this->data['tax_classes'][] = array(
				'tax_class_id' => $result['tax_class_id'],
				'title'        => $result['title']				
			);
			if ( $result['tax_class_id'] == 0 ){
				$founddefault = true;
			}
		}
		if ( !$founddefault ){
			$this->data['tax_classes'][] = array(
				'tax_class_id' => 0,
				'title'        => 'default'				
			);
		}

		if (is_array($this->data['countytax_states'])){

			sort($this->data['countytax_states']);


			//if ( $this->data['countytax_shipping'] ){
			//	$this->data['tax_classes'][] = array(
			//		'tax_class_id' => 0,
			//		'title'        => 'Shipping'				
			//	);
			//}


			foreach($this->data['countytax_states'] as $state){
				$state = strtolower(trim($state));


				//for each tax class
				foreach( $this->data['tax_classes'] as $tax_class ) {


					$taxid = $tax_class['tax_class_id'];

					//get the statewide
					if (isset($this->request->post['countytax_'.$state.'_statewide'])) {
						$this->data['countytax_'.$taxid.'_'.$state.'_statewide'] = $this->request->post['countytax_'.$taxid.'_'.$state.'_statewide'];
					} else {
						$this->data['countytax_'.$taxid.'_'.$state.'_statewide'] = $this->config->get('countytax_'.$taxid.'_'.$state.'_statewide');
					}

					//get the counties
					$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "setting WHERE `key` LIKE 'countytax_".$taxid.'_'.$state."_%' AND store_id='".((int)$this->config->get('config_store_id'))."' ORDER BY `key` ASC");		
					if ( count($query->rows) < 3 ){
						$counties = '';
						if($state == 'al'){
							$counties = 'Autauga, Baldwin, Barbour, Bibb, Blount, Bullock, Butler, Calhoun, Chambers, Cherokee, Chilton, Choctaw, Clarke, Clay, Cleburne, Coffee, Colbert, Conecuh, Coosa, Covington, Crenshaw, Cullman, Dale, Dallas, DeKalb, Elmore, Escambia, Etowah, Fayette, Franklin, Geneva, Greene, Hale, Henry, Houston, Jackson, Jefferson, Lamar, Lauderdale, Lawrence, Lee, Limestone, Lowndes, Macon, Madison, Marengo, Marion, Marshall, Mobile, Monroe, Montgomery, Morgan, Perry, Pickens, Pike, Randolph, Russell, St. Clair, Shelby, Sumter, Talladega, Tallapoosa, Tuscaloosa, Walker, Washington, Wilcox, Winston';
						} else if($state == 'ak'){
							$counties = 'Aleutians East, Anchorage, Bristol Bay, Denali, Fairbanks North Star, Haines, Juneau, Kenai Peninsula, Ketchikan Gateway, Kodiak Island, Lake and Peninsula, Matanuska-Susitna, North Slope, Northwest Arctic, Sitka, Skagway, Unorganized, Wrangell, Yakutat';
						} else if($state == 'az'){
							$counties = 'Apache, Cochise, Coconino, Gila, Graham, Greenlee, La Paz, Maricopa, Mohave, Navajo, Pima, Pinal, Santa Cruz, Yavapai, Yuma';
						} else if($state == 'ar'){
							$counties = 'Arkansas, Ashley, Baxter, Benton, Boone, Bradley, Calhoun, Carroll, Chicot, Clark, Clay, Cleburne, Cleveland, Columbia, Conway, Craighead, Crawford, Crittenden, Cross, Dallas, Desha, Drew, Faulkner, Franklin, Fulton, Garland, Grant, Greene, Hempstead, Hot Spring, Howard, Independence, Izard, Jackson, Jefferson, Johnson, Lafayette, Lawrence, Lee, Lincoln, Little River, Logan, Lonoke, Madison, Marion, Miller, Mississippi, Monroe, Montgomery, Nevada, Newton, Ouachita, Perry, Phillips, Pike, Poinsett, Polk, Pope, Prairie, Pulaski, Randolph, St. Francis, Saline, Scott, Searcy, Sebastian, Sevier, Sharp, Stone, Union, Van Buren, Washington, White, Woodruff, Yell';
						} else if($state == 'ca'){
							$counties = 'Alameda, Alpine, Amador, Butte, Calaveras, Colusa, Contra Costa, Del Norte, El Dorado, Fresno, Glenn, Humboldt, Imperial, Inyo, Kern, Kings, Lake, Lassen, Los Angeles, Madera, Marin, Mariposa, Mendocino, Merced, Modoc, Mono, Monterey, Napa, Nevada, Orange, Placer, Plumas, Riverside, Sacramento, San Benito, San Bernardino, San Diego, San Francisco, San Joaquin, San Luis Obispo, San Mateo, Santa Barbara, Santa Clara, Santa Cruz, Shasta, Sierra, Siskiyou, Solano, Sonoma, Stanislaus, Sutter, Tehama, Trinity, Tulare, Tuolumne, Ventura, Yolo, Yuba';
						} else if($state == 'co'){
							$counties = 'Adams, Alamosa, Arapahoe, Archuleta, Baca, Bent, Boulder, Broomfield, Chaffee, Cheyenne, Clear Creek, Conejos, Costilla, Crowley, Custer, Delta, Denver, Dolores, Douglas, Eagle, El Paso, Elbert, Fremont, Garfield, Gilpin, Grand, Gunnison, Hinsdale, Huerfano, Jackson, Jefferson, Kiowa, Kit Carson, La Plata, Lake, Larimer, Las Animas, Lincoln, Logan, Mesa, Mineral, Moffat, Montezuma, Montrose, Morgan, Otero, Ouray, Park, Phillips, Pitkin, Prowers, Pueblo, Rio Blanco, Rio Grande, Routt, Saguache, San Juan, San Miguel, Sedgwick, Summit, Teller, Washington, Weld, Yuma';
						} else if($state == 'ct'){
							$counties = 'Fairfield, Hartford, Litchfield, Middlesex, New Haven, New London, Tolland, Windham';
						} else if($state == 'de'){
							$counties = 'Kent, New Castle, Sussex';
						} else if($state == 'fl'){
							$counties = 'Alachua, Baker, Bay, Bradford, Brevard, Broward, Calhoun, Charlotte, Citrus, Clay, Collier, Columbia, Dade, Desoto, Dixie, Duval, Escambia, Flagler, Franklin, Gadsden, Gilchrist, Glades, Gulf, Hamilton, Hardee, Hendry, Hernando, Highlands, Hillsborough, Holmes, Indian River, Jackson, Jefferson, Lafayette, Lake, Lee, Leon, Levy, Liberty, Madison, Manatee, Marion, Martin, Miami-Dade, Monroe, Nassau, Okaloosa, Okeechobee, Orange, Osceola, Palm Beach, Pasco, Pinellas, Polk, Putnam, Saint Johns, Saint Lucie, Santa Rosa, Sarasota, Seminole, Sumter, Suwannee, Taylor, Union, Volusia, Wakulla, Walton, Washington';
						} else if($state == 'ga'){
							$counties = 'Appling, Atkinson, Bacon, Baker, Baldwin, Banks, Barrow, Bartow, Ben Hill, Berrien, Bibb, Bleckley, Brantley, Brooks, Bryan, Bulloch, Burke, Butts, Calhoun, Camden, Candler, Carroll, Catoosa, Charlton, Chatham, Chattahoochee, Chattooga, Cherokee, Clarke, Clay, Clayton, Clinch, Cobb, Coffee, Colquitt, Columbia, Cook, Coweta, Crawford, Crisp, Dade, Dawson, Decatur, DeKalb, Dodge, Dooly, Dougherty, Douglas, Early, Echols, Effingham, Elbert, Emanuel, Evans, Fannin, Fayette, Floyd, Forsyth, Franklin, Fulton, Gilmer, Glascock, Glynn, Gordon, Grady, Greene, Gwinnett, Habersham, Hall, Hancock, Haralson, Harris, Hart, Heard, Henry, Houston, Irwin, Jackson, Jasper, Jeff Davis, Jefferson, Jenkins, Johnson, Jones, Lamar, Lanier, Laurens, Lee, Liberty, Lincoln, Long, Lowndes, Lumpkin, Macon, Madison, Marion, McDuffie, McIntosh, Meriwether, Miller, Mitchell, Monroe, Montgomery, Morgan, Murray, Muscogee, Newton, Oconee, Oglethorpe, Paulding, Peach, Pickens, Pierce, Pike, Polk, Pulaski, Putnam, Quitman, Rabun, Randolph, Richmond, Rockdale, Schley, Screven, Seminole, Spalding, Stephens, Stewart, Sumter, Talbot, Taliaferro, Tattnall, Taylor, Telfair, Terrell, Thomas, Tift, Toombs, Towns, Treutlen, Troup, Turner, Twiggs, Union, Upson, Walker, Walton, Ware, Warren, Washington, Wayne, Webster, Wheeler, White, Whitfield, Wilcox, Wilkes, Wilkinson, Worth';
						} else if($state == 'hi'){
							$counties = 'Hawaii, Maui, Kalawao, Honolulu, Kauai';
						} else if($state == 'id'){
							$counties = 'Ada, Adams, Bannock, Bear Lake, Benewah, Bingham, Blaine, Boise, Bonner, Bonneville, Boundary, Butte, Camas, Canyon, Caribou, Cassia, Clark, Clearwater, Custer, Elmore, Franklin, Fremont, Gem, Gooding, Idaho, Jefferson, Jerome, Kootenai, Latah, Lemhi, Lewis, Lincoln, Madison, Minidoka, Nez Perce, Oneida, Owyhee, Payette, Power, Shoshone, Teton, Twin Falls, Valley, Washington';
						} else if($state == 'il'){
							$counties = 'Adams, Alexander, Bond, Boone, Brown, Bureau, Calhoun, Carroll, Cass, Champaign, Christian, Clark, Clay, Clinton, Coles, Cook, Crawford, Cumberland, De Witt, DeKalb, Douglas, DuPage, Edgar, Edwards, Effingham, Fayette, Ford, Franklin, Fulton, Gallatin, Greene, Grundy, Hamilton, Hancock, Hardin, Henderson, Henry, Iroquois, Jackson, Jasper, Jefferson, Jersey, Jo Daviess, Johnson, Kane, Kankakee, Kendall, Knox, Lake, LaSalle, Lawrence, Lee, Livingston, Logan, Macon, Macoupin, Madison, Marion, Marshall, Mason, Massac, McDonough, McHenry, McLean, Menard, Mercer, Monroe, Montgomery, Morgan, Moultrie, Ogle, Peoria, Perry, Piatt, Pike, Pope, Pulaski, Putnam, Randolph, Richland, Rock Island, Saline, Sangamon, Schuyler, Scott, Shelby, St. Clair, Stark, Stephenson, Tazewell, Union, Vermilion, Wabash, Warren, Washington, Wayne, White, Whiteside, Will, Williamson, Winnebago, Woodford';
						} else if($state == 'in'){
							$counties = 'Adams, Allen, Bartholomew, Benton, Blackford, Boone, Brown, Carroll, Cass, Clark, Clay, Clinton, Crawford, Daviess, Dearborn, Decatur, DeKalb, Delaware, Dubois, Elkhart, Fayette, Floyd, Fountain, Franklin, Fulton, Gibson, Grant, Greene, Hamilton, Hancock, Harrison, Hendricks, Henry, Howard, Huntington, Jackson, Jasper, Jay, Jefferson, Jennings, Johnson, Knox, Kosciusko, LaGrange, Lake, LaPorte, Lawrence, Madison, Marion, Marshall, Martin, Miami, Monroe, Montgomery, Morgan, Newton, Noble, Ohio, Orange, Owen, Parke, Perry, Pike, Porter, Posey, Pulaski, Putnam, Randolph, Ripley, Rush, St. Joseph, Scott, Shelby, Spencer, Starke, Steuben, Sullivan, Switzerland, Tippecanoe, Tipton, Union, Vanderburgh, Vermillion, Vigo, Wabash, Warren, Warrick, Washington, Wayne, Wells, White, Whitley';
						} else if($state == 'ia'){
							$counties = 'Adair, Adams, Allamakee, Appanoose, Audubon, Benton, Black Hawk, Boone, Bremer, Buchanan, Buena Vista, Butler, Calhoun, Carroll, Cass, Cedar, Cerro Gordo, Cherokee, Chickasaw, Clarke, Clay, Clayton, Clinton, Crawford, Dallas, Davis, Decatur, Delaware, Des Moines, Dickinson, Dubuque, Emmet, Fayette, Floyd, Franklin, Fremont, Greene, Grundy, Guthrie, Hamilton, Hancock, Hardin, Harrison, Henry, Howard, Humboldt, Ida, Iowa, Jackson, Jasper, Jefferson, Johnson, Jones, Keokuk, Kossuth, Lee, Linn, Louisa, Lucas, Lyon, Madison, Mahaska, Marion, Marshall, Mills, Mitchell, Monona, Monroe, Montgomery, Muscatine, O\'Brien, Osceola, Page, Palo Alto, Plymouth, Pocahontas, Polk, Pottawattamie, Poweshiek, Ringgold, Sac, Scott, Shelby, Sioux, Story, Tama, Taylor, Union, Van Buren, Wapello, Warren, Washington, Wayne, Webster, Winnebago, Winneshiek, Woodbury, Worth, Wright';
						} else if($state == 'ks'){
							$counties = 'Allen, Anderson, Atchison, Barber, Barton, Bourbon, Brown, Butler, Chase, Chautauqua, Cherokee, Cheyenne, Clark, Clay, Cloud, Coffey, Comanche, Cowley, Crawford, Decatur, Dickinson, Doniphan, Douglas, Edwards, Elk, Ellis, Ellsworth, Finney, Ford, Franklin, Geary, Gove, Graham, Grant, Gray, Greeley, Greenwood, Hamilton, Harper, Harvey, Haskell, Hodgeman, Jackson, Jefferson, Jewell, Johnson, Kearny, Kingman, Kiowa, Labette, Lane, Leavenworth, Lincoln, Linn, Logan, Lyon, Marion, Marshall, McPherson, Meade, Miami, Mitchell, Montgomery, Morris, Morton, Nemaha, Neosho, Ness, Norton, Osage, Osborne, Ottawa, Pawnee, Phillips, Pottawatomie, Pratt, Rawlins, Reno, Republic, Rice, Riley, Rooks, Rush, Russell, Saline, Scott, Sedgwick, Seward, Shawnee, Sheridan, Sherman, Smith, Stafford, Stanton, Stevens, Sumner, Thomas, Trego, Wabaunsee, Wallace, Washington, Wichita, Wilson, Woodson, Wyandotte';
						} else if($state == 'ky'){
							$counties = 'Adair, Allen, Anderson, Ballard, Barren, Bath, Bell, Boone, Bourbon, Boyd, Boyle, Bracken, Breathitt, Breckinridge, Bullitt, Butler, Caldwell, Calloway, Campbell, Carlisle, Carroll, Carter, Casey, Christian, Clark, Clay, Clinton, Crittenden, Cumberland, Daviess, Edmonson, Elliott, Estill, Fayette, Fleming, Floyd, Franklin, Fulton, Gallatin, Garrard, Grant, Graves, Grayson, Green, Greenup, Hancock, Hardin, Harlan, Harrison, Hart, Henderson, Henry, Hickman, Hopkins, Jackson, Jefferson, Jessamine, Johnson, Kenton, Knott, Knox, Larue, Laurel, Lawrence, Lee, Leslie, Letcher, Lewis, Lincoln, Livingston, Logan, Lyon, McCracken, McCreary, McLean, Madison, Magoffin, Marion, Marshall, Martin, Mason, Meade, Menifee, Mercer, Metcalfe, Monroe, Montgomery, Morgan, Muhlenberg, Nelson, Nicholas, Ohio, Oldham, Owen, Owsley, Pendleton, Perry, Pike, Powell, Pulaski, Robertson, Rockcastle, Rowan, Russell, Scott, Shelby, Simpson, Spencer, Taylor, Todd, Trigg, Trimble, Union, Warren, Washington, Wayne, Webster, Whitley, Wolfe, Woodford';
						} else if($state == 'la'){
							$counties = 'Acadia, Allen, Ascension, Assumption, Avoyelles, Beauregard, Bienville, Bossier, Caddo, Calcasieu, Caldwell, Cameron, Catahoula, Claiborne, Concordia, DeSoto, East Baton, East Carroll, East Feliciana, Evangeline, Franklin, Grant, Iberia, Iberville, Jackson, Jefferson, Jefferson Davis, Lafayette, Lafourche, La Salle, Lincoln, Livingston, Madison, Morehouse, Natchitoches, Orleans, Ouachita, Plaquemines, Pointe Coupee, Rapides, Red River, Richland, Sabine, Saint Bernard, Saint Charles, Saint Helena, Saint James, Saint John the Baptist, Saint Landry, Saint Martin, Saint Mary, Saint Tammany, Tangipahoa, Tensas, Terrebonne, Union, Vermilion, Vernon, Washington, Webster, West Baton Rouge, West Carroll, West Feliciana, Winn';
						} else if($state == 'me'){
							$counties = 'Androscoggin, Aroostook, Cumberland, Franklin, Hancock, Kennebec, Knox, Lincoln, Oxford, Penobscot, Piscataquis, Sagadahoc, Somerset, Waldo, Washington, York';
						} else if($state == 'md'){
							$counties = 'Allegany, Anne Arundel, Baltimore, Baltimore, Calvert, Caroline, Carroll, Cecil, Charles, Dorchester, Frederick, Garrett, Harford, Howard, Kent, Montgomery, Prince George\'s, Queen Anne\'s, Saint Mary\'s, Somerset, Talbot, Washington, Wicomico, Worcester';
						} else if($state == 'ma'){
							$counties = 'Barnstable, Berkshire, Bristol, Dukes, Essex, Franklin, Hampden, Hampshire, Middlesex, Nantucket, Norfolk, Plymouth, Suffolk, Worcester';
						} else if($state == 'mi'){
							$counties = 'Alcona, Alger, Allegan, Alpena, Antrim, Arenac, Baraga, Barry, Bay, Benzie, Berrien, Branch, Calhoun, Cass, Charlevoix, Cheboygan, Chippewa, Clare, Clinton, Crawford, Delta, Dickinson, Eaton, Emmet, Genesee, Gladwin, Gogebic, Grand Traverse, Gratiot, Hillsdale, Houghton, Huron, Ingham, Ionia, Iosco, Iron, Isabella, Jackson, Kalamazoo, Kalkaska, Kent, Keweenaw, Lake, Lapeer, Leelanau, Lenawee, Livingston, Luce, Mackinac, Macomb, Manistee, Marquette, Mason, Mecosta, Menominee, Midland, Missaukee, Monroe, Montcalm, Montmorency, Muskegon, Newaygo, Oakland, Oceana, Ogemaw, Ontonagon, Osceola, Oscoda, Otsego, Ottawa, Presque Isle, Roscommon, Saginaw, St. Clair, St. Joseph, Sanilac, Schoolcraft, Shiawassee, Tuscola, Van Buren, Washtenaw, Wayne, Wexford';
						} else if($state == 'mn'){
							$counties = 'Aitkin, Anoka, Becker, Beltrami, Benton, Big Stone, Blue Earth, Brown, Carlton, Carver, Cass, Chippewa, Chisago, Clay, Clearwater, Cook, Cottonwood, Crow Wing, Dakota, Dodge, Douglas, Faribault, Fillmore, Freeborn, Goodhue, Grant, Hennepin, Houston, Hubbard, Isanti, Itasca, Jackson, Kanabec, Kandiyohi, Kittson, Koochiching, Lac qui Parle, Lake, Lake of the Woods, Le Sueur, Lincoln, Lyon, McLeod, Mahnomen, Marshall, Martin, Meeker, Mille Lacs, Morrison, Mower, Murray, Nicollet, Nobles, Norman, Olmsted, Otter Tail, Pennington, Pine, Pipestone, Polk, Pope, Ramsey, Red Lake, Redwood, Renville, Rice, Rock, Roseau, Scott, Sherburne, Sibley, St. Louis, Stearns, Steele, Stevens, Swift, Todd, Traverse, Wabasha, Wadena, Waseca, Washington, Watonwan, Wilkin, Winona, Wright, Yellow Medicine';
						} else if($state == 'ms'){
							$counties = 'Adams, Alcorn, Amite, Attala, Benton, Bolivar, Calhoun, Carroll, Chickasaw, Choctaw, Claiborne, Clarke, Clay, Coahoma, Copiah, Covington, DeSoto, Forrest, Franklin, George, Greene, Grenada, Hancock, Harrison, Hinds, Holmes, Humphreys, Issaquena, Itawamba, Jackson, Jasper, Jefferson, Jefferson Davis, Jones, Kemper, Lafayette, Lamar, Lauderdale, Lawrence, Leake, Lee, Leflore, Lincoln, Lowndes, Madison, Marion, Marshall, Monroe, Montgomery, Neshoba, Newton, Noxubee, Oktibbeha, Panola, Pearl River, Perry, Pike, Pontotoc, Prentiss, Quitman, Rankin, Scott, Sharkey, Simpson, Smith, Stone, Sunflower, Tallahatchie, Tate, Tippah, Tishomingo, Tunica, Union, Walthall, Warren, Washington, Wayne, Webster, Wilkinson, Winston, Yalobusha, Yazoo';
						} else if($state == 'mo'){
							$counties = 'Adair, Andrew, Atchison, Audrain, Barry, Barton, Bates, Benton, Bollinger, Boone, Buchanan, Butler, Caldwell, Callaway, Camden, Cape Girardeau County, Carroll, Carter, Cass, Cedar, Chariton, Christian, Clark, Clay, Clinton, Cole, Cooper, Crawford, Dade, Dallas, Daviess, DeKalb, Dent, Douglas, Dunklin, Franklin, Gasconade, Gentry, Greene, Grundy, Harrison, Henry, Hickory, Holt, Howard, Howell, Iron, Jackson, Jasper, Jefferson, Johnson, Knox, Laclede, Lafayette, Lawrence, Lewis, Lincoln, Linn, Livingston, Macon, Madison, Maries, Marion, McDonald, Mercer, Miller, Mississippi, Moniteau, Monroe, Montgomery, Morgan, New Madrid, Newton, Nodaway, Oregon, Osage, Ozark, Pemiscot, Perry, Pettis, Phelps, Pike, Platte, Polk, Pulaski, Putnam, Ralls, Randolph, Ray, Reynolds, Ripley, St. Charles, St. Clair, St. Francois, St. Louis, Saint Louis, Sainte Genevieve, Saline, Schuyler, Scotland, Scott, Shannon, Shelby, Stoddard, Stone, Sullivan, Taney, Texas, Vernon, Warren, Washington, Wayne, Webster, Worth, Wright';
						} else if($state == 'mt'){
							$counties = 'Beaverhead, Big Horn, Blaine, Broadwater, Carbon, Carter, Cascade, Chouteau, Custer, Daniels, Dawson, Deer Lodge, Fallon, Fergus, Flathead, Gallatin, Garfield, Glacier, Golden Valley, Granite, Hill, Jefferson, Judith Basin, Lake, Lewis and Clark, Liberty, Lincoln, McCone, Madison, Meagher, Mineral, Missoula, Musselshell, Park, Petroleum, Phillips, Pondera, Powder River, Powell, Prairie, Ravalli, Richland, Roosevelt, Rosebud, Sanders, Sheridan, Silver Bow, Stillwater, Sweet Grass, Teton, Toole, Treasure, Valley, Wheatland, Wibaux, Yellowstone';
						} else if($state == 'ne'){
							$counties = 'Adams, Antelope, Arthur, Banner, Blaine, Boone, Box Butte, Boyd, Brown, Buffalo, Burt, Butler, Cass, Cedar, Chase, Cherry, Cheyenne, Clay, Colfax, Cuming, Custer, Dakota, Dawes, Dawson, Deuel, Dixon, Dodge, Douglas, Dundy, Fillmore, Franklin, Frontier, Furnas, Gage, Garden, Garfield, Gosper, Grant, Greeley, Hall, Hamilton, Harlan, Hayes, Hitchcock, Holt, Hooker, Howard, Jefferson, Johnson, Kearney, Keith, Keya Paha, Kimball, Knox, Lancaster, Lincoln, Logan, Loup, Madison, McPherson, Merrick, Morrill, Nance, Nemaha, Nuckolls, Otoe, Pawnee, Perkins, Phelps, Pierce, Platte, Polk, Red Willow, Richardson, Rock, Saline, Sarpy, Saunders, Scotts Bluff, Seward, Sheridan, Sherman, Sioux, Stanton, Thayer, Thomas, Thurston, Valley, Washington, Wayne, Webster, Wheeler, York';
						} else if($state == 'nv'){
							$counties = 'Carson, Churchill, Clark, Douglas, Elko, Esmeralda, Eureka, Humboldt, Lander, Lincoln, Lyon,Mineral, Nye, Pershing, Storey, Washoe, White Pine';
						} else if($state == 'nh'){
							$counties = 'Belknap, Carroll, Cheshire, Coos, Grafton, Hillsborough, Merrimack, Rockingham, Strafford, Sullivan';
						} else if($state == 'nj'){
							$counties = 'Atlantic, Bergen, Burlington, Camden, Cape May, Cumberland, Essex, Gloucester, Hudson, Hunterdon, Mercer, Middlesex, Monmouth, Morris, Ocean, Passaic, Salem, Somerset, Sussex, Union, Warren';
						} else if($state == 'nm'){
							$counties = 'Bernalillo, Catron, Chaves, Cibola, Colfax, Curry, De Baca, Dona Ana, Eddy, Grant, Guadalupe, Harding, Hidalgo, Lea, Lincoln, Los Alamos, Luna, McKinley, Mora, Otero, Quay, Rio Arriba, Roosevelt, Sandoval, San Juan, San Miguel, Santa Fe, Sierra, Socorro, Taos, Torrance, Union, Valencia';
						} else if($state == 'ny'){
							$counties = 'Albany, Allegany, Bronx, Broome, Cattaraugus, Cayuga, Chautauqua, Chemung, Chenango, Clinton, Columbia, Cortland, Delaware, Dutchess, Erie, Essex, Franklin, Fulton, Genesee, Greene, Hamilton, Herkimer, Jefferson, Kings, Lewis, Livingston, Madison, Monroe, Montgomery, Nassau, New York, Niagara, Oneida, Onondaga, Ontario, Orange, Orleans, Oswego, Otsego, Putnam, Queens, Rensselaer, Richmond, Rockland, St Lawrence, Saratoga, Schenectady, Schoharie, Schuyler, Seneca, Steuben, Suffolk, Sullivan, Tioga, Tompkins, Ulster, Warren, Washington, Wayne, Westchester, Wyoming, Yates';
						} else if($state == 'nc'){
							$counties = 'Alamance, Alexander, Alleghany, Anson, Ashe, Avery, Beaufort, Bertie, Bladen, Brunswick, Buncombe, Burke, Cabarrus, Caldwell, Camden, Carteret, Caswell, Catawba, Chatham, Cherokee, Chowan, Clay, Cleveland, Columbus, Craven, Cumberland, Currituck, Dare, Davidson, Davie, Duplin, Durham, Edgecombe, Forsyth, Franklin, Gaston, Gates, Graham, Granville, Greene, Guilford, Halifax, Harnett, Haywood, Henderson, Hertford, Hoke, Hyde, Iredell, Jackson, Johnston, Jones, Lee, Lenoir, Lincoln, McDowell, Macon, Madison, Martin, Mecklenburg, Mitchell, Montgomery, Moore, Nash, New Hanover, Northampton, Onslow, Orange, Pamlico, Pasquotank, Pender, Perquimans, Person, Pitt, Polk, Randolph, Richmond, Robeson, Rockingham, Rowan, Rutherford, Sampson, Scotland, Stanly, Stokes, Surry, Swain, Transylvania, Tyrrell, Union, Vance, Wake, Warren, Washington, Watauga, Wayne, Wilkes, Wilson, Yadkin, Yancey';
						} else if($state == 'nd'){
							$counties = 'Adams, Barnes, Benson, Billings, Bottineau, Bowman, Burke, Burleigh, Cass, Cavalier, Dickey, Divide, Dunn, Eddy, Emmons, Foster, Golden Valley, Grand Forks, Grant, Griggs, Hettinger, Kidder, LaMoure, Logan, McHenry, McIntosh, McKenzie, McLean, Mercer, Morton, Mountrail, Nelson, Oliver, Pembina, Pierce, Ramsey, Ransom, Renville, Richland, Rolette, Sargent, Sheridan, Sioux, Slope, Stark, Steele, Stutsman, Towner, Traill, Walsh, Ward, Wells, Williams';
						} else if($state == 'oh'){
							$counties = 'Adams, Allen, Ashland, Ashtabula, Athens, Auglaize, Belmont, Brown, Butler, Carroll, Champaign, Clark, Clermont, Clinton, Columbiana, Coshocton, Crawford, Cuyahoga, Darke, Defiance, Delaware, Erie, Fairfield, Fayette, Franklin, Fulton, Gallia, Geauga, Greene, Guernsey, Hamilton, Hancock, Hardin, Harrison, Henry, Highland, Hocking, Holmes, Huron, Jackson, Jefferson, Knox, Lake, Lawrence, Licking, Logan, Lorain, Lucas, Madison, Mahoning, Marion, Medina, Meigs, Mercer, Miami, Monroe, Montgomery, Morgan, Morrow, Muskingum, Noble, Ottawa, Paulding, Perry, Pickaway, Pike, Portage, Preble, Putnam, Richland, Ross, Sandusky, Scioto, Seneca, Shelby, Stark, Summit, Trumbull, Tuscarawas, Union, Van Wert, Vinton, Warren, Washington, Wayne, Williams, Wood, Wyandot';
						} else if($state == 'ok'){
							$counties = 'Adair, Alfalfa, Atoka, Beaver, Beckham, Blaine, Bryan, Caddo, Canadian, Carter, Cherokee, Choctaw, Cimarron, Cleveland, Coal, Comanche, Cotton, Craig, Creek, Custer, Delaware, Dewey, Ellis, Garfield, Garvin, Grady, Grant, Greer, Harmon, Harper, Haskell, Hughes, Jackson, Jefferson, Johnston, Kay, Kingfisher, Kiowa, Latimer, Le Flore, Lincoln, Logan, Love, Major, Marshall, Mayes, McClain, McCurtain, McIntosh, Murray, Muskogee, Noble, Nowata, Okfuskee, Oklahoma, Okmulgee, Osage, Ottawa, Pawnee, Payne, Pittsburg, Pontotoc, Pottawatomie, Pushmataha, Roger Mills, Rogers, Seminole, Sequoyah, Stephens, Texas, Tillman, Tulsa, Wagoner, Washington, Washita, Woods, Woodward';
						} else if($state == 'or'){
							$counties = 'Baker, Benton, Clackamas, Clatsop, Columbia, Coos, Crook, Curry, Deschutes, Douglas, Gilliam, Grant, Harney, Hood River, Jackson, Jefferson, Josephine, Klamath, Lake, Lane, Lincoln, Linn, Malheur, Marion, Morrow, Multnomah, Polk, Sherman, Tillamook, Umatilla, Union, Wallowa, Wasco, Washington, Wheeler, Yamhill';
						} else if($state == 'pa'){
							$counties = 'Adams, Allegheny, Armstrong, Beaver, Bedford, Berks, Blair, Bradford, Bucks, Butler, Cambria, Cameron, Carbon, Centre, Chester, Clarion, Clearfield, Clinton, Columbia, Crawford, Cumberland, Dauphin, Delaware, Elk, Erie, Fayette, Forest, Franklin, Fulton, Greene, Huntingdon, Indiana, Jefferson, Juniata, Lackawanna, Lancaster, Lawrence, Lebanon, Lehigh, Luzerne, Lycoming, McKean, Mercer, Mifflin, Monroe, Montgomery, Montour, Northampton, Northumberland, Perry, Philadelphia, Pike, Potter, Schuylkill, Snyder, Somerset, Sullivan, Susquehanna, Tioga, Union, Venango, Warren, Washington, Wayne, Westmoreland, Wyoming, York';
						} else if($state == 'ri'){
							$counties = 'Bristol, Kent, Newport, Providence, Washington';
						} else if($state == 'sc'){
							$counties = 'Abbeville, Aiken, Allendale, Anderson, Bamberg, Barnwell, Beaufort, Berkeley, Calhoun, Charleston, Cherokee, Chester, Chesterfield, Clarendon, Colleton, Darlington, Dillon, Dorchester, Edgefield, Fairfield, Florence, Georgetown, Greenville, Greenwood, Hampton, Horry, Jasper, Kershaw, Lancaster, Lancaster, Lee, Lexington, Marion, Marlboro, McCormick, Newberry, Oconee, Orangeburg, Pickens, Richland, Saluda, Spartanburg, Sumter, Union, Williamsburg, York';
						} else if($state == 'sd'){
							$counties = 'Aurora, Beadle, Bennett, Bon Homme, Brookings, Brown, Brule, Buffalo, Butte, Campbell, Charles Mix, Clark, Clay, Codington, Corson, Custer, Davison, Day, Deuel, Dewey, Douglas, Edmunds, Fall River, Faulk, Grant, Gregory, Haakon, Hamlin, Hand, Hanson, Harding, Hughes, Hutchinson, Hyde, Jackson, Jerauld, Jones, Kingsbury, Lake, Lawrence, Lincoln, Lyman, Marshall, McCook, McPherson, Meade, Mellette, Miner, Minnehaha, Moody, Pennington, Perkins, Potter, Roberts, Sanborn, Shannon, Spink, Stanley, Sully, Todd, Tripp, Turner, Union, Walworth, Yankton, Ziebach';
						} else if($state == 'tn'){
							$counties = 'Anderson, Bedford, Benton, Bledsoe, Blount, Bradley, Campbell, Cannon, Carroll, Carter, Cheatham, Chester, Claiborne, Clay, Cocke, Coffee, Crockett, Cumberland, Davidson, Decatur, DeKalb, Dickson, Dyer, Fayette, Fentress, Franklin, Gibson, Giles, Grainger, Greene, Grundy, Hamblen, Hamilton, Hancock, Hardeman, Hardin, Hawkins, Haywood, Henderson, Henry, Hickman, Houston, Humphreys, Jackson, Jefferson, Johnson, Knox, Lake, Lauderdale, Lawrence, Lewis, Lincoln, Loudon, Macon, Madison, Marion, Marshall, Maury, McMinn, McNairy, Meigs, Monroe, Montgomery, Moore, Morgan, Obion, Overton, Perry, Pickett, Polk, Putnam, Rhea, Roane, Robertson, Rutherford, Scott, Sequatchie, Sevier, Shelby, Smith, Stewart, Sullivan, Sumner, Tipton, Trousdale, Unicoi, Union, Van Buren, Warren, Washington, Wayne, Weakley, White, Williamson, Wilson';
						} else if($state == 'tx'){
							$counties = 'Anderson, Andrews, Angelina, Aransas, Archer, Armstrong, Atascosa, Austin, Bailey, Bandera, Bastrop, Baylor, Bee, Bell, Bexar, Blanco, Borden, Bosque, Bowie, Brazoria, Brazos, Brewster, Briscoe, Brooks, Brown, Burleson, Burnet, Caldwell, Calhoun, Callahan, Cameron, Camp, Carson, Cass, Castro, Chambers, Cherokee, Childress, Clay, Cochran, Coke, Coleman, Collin, Collingsworth, Colorado, Comal, Comanche, Concho, Cooke, Coryell, Cottle, Crane, Crockett, Crosby, Culberson, Dallam, Dallas, Dawson, Deaf Smith, Delta, Denton, DeWitt, Dickens, Dimmit, Donley, Duval, Eastland, Ector, Edwards, Ellis, El Paso, Erath, Falls, Fannin, Fayette, Fisher, Floyd, Foard, Fort Bend, Franklin, Freestone, Frio, Gaines, Galveston, Garza, Gillespie, Glasscock, Goliad, Gonzales, Gray, Grayson, Gregg, Grimes, Guadalupe, Hale, Hall, Hamilton, Hansford, Hardeman, Hardin, Harris, Harrison, Hartley, Haskell, Hays, Hemphill, Henderson, Hidalgo, Hill, Hockley, Hood, Hopkins, Houston, Howard, Hudspeth, Hunt, Hutchinson, Irion, Jack, Jackson, Jasper, Jeff Davis, Jefferson, Jim Hogg, Jim Wells, Johnson, Jones, Karnes, Kaufman, Kendall, Kenedy, Kent, Kerr, Kimble, King, Kinney, Kleberg, Knox, Lamar, Lamb, Lampasas, La Salle, Lavaca, Lee, Leon, Liberty, Limestone, Lipscomb, Live Oak, Llano, Loving, Lubbock, Lynn, McCulloch, McLennan, McMullen, Madison, Marion, Martin, Mason, Matagorda, Maverick, Medina, Menard, Midland, Milam, Mills, Mitchell, Montague, Montgomery, Moore, Morris, Motley, Nacogdoches, Navarro, Newton, Nolan, Nueces, Ochiltree, Oldham, Orange, Palo Pinto, Panola, Parker, Parmer, Pecos, Polk, Potter, Presidio, Rains, Randall, Reagan, Real, Red River, Reeves, Refugio, Roberts, Robertson, Rockwall, Runnels, Rusk, Sabine, San Augustine, San Jacinto, San Patricio, San Saba, Schleicher, Scurry, Shackelford, Shelby, Sherman, Smith, Somervell, Starr, Stephens, Sterling, Stonewall, Sutton, Swisher, Tarrant, Taylor, Terrell, Terry, Throckmorton, Titus, Tom Green, Travis, Trinity, Tyler, Upshur, Upton, Uvalde, Val Verde, Van Zandt, Victoria, Walker, Waller, Ward, Washington, Webb, Wharton, Wheeler, Wichita, Wilbarger, Willacy, Williamson, Wilson, Winkler, Wise, Wood, Yoakum, Young, Zapata, Zavala';
						} else if($state == 'ut'){
							$counties = 'Beaver, Box Elder, Cache, Carbon, Daggett, Davis, Duchesne, Emery, Garfield, Grand, Iron, Juab, Kane, Millard, Morgan, Piute, Rich, Salt Lake, San Juan, Sanpete, Sevier, Summit, Tooele, Uintah, Utah, Wasatch, Washington, Wayne, Weber';
						} else if($state == 'vt'){
							$counties = 'Addison, Bennington, Caledonia, Chittenden, Essex, Franklin, Grand Isle, Lamoille, Orange, Orleans, Rutland, Washington, Windham, Windsor';
						} else if($state == 'va'){
							$counties = 'Accomack, Albemarle, Alleghany, Amelia, Amherst, Appomattox, Arlington, Augusta, Bath, Bedford, Bland, Botetourt, Brunswick, Buchanan, Buckingham, Campbell, Caroline, Carroll, Charles City, Charlotte, Chesterfield, Clarke, Craig, Culpeper, Cumberland, Dickenson, Dinwiddie, Essex, Fairfax, Fauquier, Floyd, Fluvanna, Franklin, Frederick, Giles, Gloucester, Goochland, Grayson, Greene, Greensville, Halifax, Hanover, Henrico, Henry, Highland, Isle of Wight, James City, King and Queen, King George, King William, Lancaster, Lee, Loudoun, Louisa, Lunenburg, Madison, Mathews, Mecklenburg, Middlesex, Montgomery, Nelson, New Kent, Northampton, Northumberland, Nottoway, Orange, Page, Patrick, Pittsylvania, Powhatan, Prince Edward, Prince George, Prince William, Pulaski, Rappahannock, Richmond, Roanoke, Rockbridge, Rockingham, Russell, Scott, Shenandoah, Smyth, Southampton, Spotsylvania, Stafford, Surry, Sussex, Tazewell, Warren, Washington, Westmoreland, Wise, Wythe, York';
						} else if($state == 'wa'){
							$counties = 'Adams, Asotin, Benton, Chelan, Clallam, Clark, Columbia, Cowlitz, Douglas, Ferry, Franklin, Garfield, Grant, Grays Harbor, Island, Jefferson, King, Kitsap, Kittitas, Klickitat, Lewis, Lincoln, Mason, Okanogan, Pacific, Pend Oreille, Pierce, San Juan, Skagit, Skamania, Snohomish, Spokane, Stevens, Thurston, Wahkiakum, Walla Walla, Whatcom, Whitman, Yakima';
						} else if($state == 'wv'){
							$counties = 'Barbour, Berkeley, Boone, Braxton, Brooke, Cabell, Calhoun, Clay, Doddridge, Fayette, Gilmer, Grant, Greenbrier, Hampshire, Hancock, Hardy, Harrison, Jackson, Jefferson, Kanawha, Lewis, Lincoln, Logan, Marion, Marshall, Mason, McDowell, Mercer, Mineral, Mingo, Monongalia, Monroe, Morgan, Nicholas, Ohio, Pendleton, Pleasants, Pocahontas, Preston, Putnam, Raleigh, Randolph, Ritchie, Roane, Summers, Taylor, Tucker, Tyler, Upshur, Wayne, Webster, Wetzel, Wirt, Wood, Wyoming';
						} else if($state == 'wi'){
							$counties = 'Adams, Ashland, Barron, Bayfield, Brown, Buffalo, Burnett, Calumet, Chippewa, Clark, Columbia, Crawford, Dane, Dodge, Door, Douglas, Dunn, Eau Claire, Florence, Fond du Lac, Forest, Grant, Green, Green Lake, Iowa, Iron, Jackson, Jefferson, Juneau, Kenosha, Kewaunee, La Crosse, Lafayette, Langlade, Lincoln, Manitowoc, Marathon, Marinette, Marquette, Menominee, Milwaukee, Monroe, Oconto, Oneida, Outagamie, Ozaukee, Pepin, Pierce, Polk, Portage, Price, Racine, Richland, Rock, Rusk, Sauk, Sawyer, Shawano, Sheboygan, Saint Croix, Taylor, Trempealeau, Vernon, Vilas, Walworth, Washburn, Washington, Waukesha, Waupaca, Waushara, Winnebago, Wood';
						} else if($state == 'wy'){
							$counties = 'Albany, Big Horn, Campbell, Carbon, Converse, Crook, Fremont, Goshen, Hot Springs, Johnson, Laramie, Lincoln, Natrona, Niobrara, Park, Platte, Sheridan, Sublette, Sweetwater, Teton, Uinta, Washakie, Weston';
						}
						if ($counties != ''){
							$counties = explode(',', $counties);
							foreach( $counties as $county ){
								$county = str_replace(' ', '-', trim($county));
								$dbname = 'countytax_'.$taxid.'_'.$state.'_'.strtolower(trim($county));
								$query = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE `key`='".$dbname."' AND store_id='".((int)$this->config->get('config_store_id'))."' LIMIT 1");
								if( !$row = $query->row ){
									$this->db->query("INSERT INTO " . DB_PREFIX . "setting SET `key`='".$dbname."', `value`=-1, `group`='countytax', store_id='".((int)$this->config->get('config_store_id'))."'");	
								}
							}
							//refresh the data
							$query = $this->db->query("SELECT `key`, `value` FROM " . DB_PREFIX . "setting WHERE `key` LIKE 'countytax_".$taxid.'_'.$state."_%' AND store_id='".((int)$this->config->get('config_store_id'))."' ORDER BY `key` ASC");
						}
					}


				

					foreach ($query->rows as $row) {
						if (isset($this->request->post[$row['key']])) {
							//if ($row['key'] != 'statewide'){
								$value = $this->request->post[$row['key']];
								if ( !is_numeric($value) ){
									$value = -1;
								} else {
									if ( $value > 99 || $value < 0 ){
										$value = -1;
									}
								}
								$this->db->query("UPDATE " . DB_PREFIX . "setting SET `value`='".$value."' WHERE `key`='".$dbname."', store_id='".((int)$this->config->get('config_store_id'))."' LIMIT 1");	
								$this->data[$row['key']] = $value;
							//}
						} else {
							$this->data[$row['key']] = $row['value'];
						}
						$county = $row['key'];
						$i = strrpos($county, '_');
						if ( $i > 0){
							$county = trim(substr($county, $i+1));
							if ( $county != 'statewide' ){
								if ( !isset($this->data['countytax_'.$state.'_counties'][$county]) ){
									$this->data['countytax_'.$state.'_counties'][$county] = $county;
								}
							}
						}
					}
				} //end of for each tax class
			}
		}

		if (isset($this->request->post['countytax_cities'])) {
			$this->data['countytax_cities'] = $this->request->post['countytax_cities'];
		} else {
			$this->data['countytax_cities'] = $this->config->get('countytax_cities');
			if (!is_array($this->data['countytax_cities'])){
				if ( strlen($this->data['countytax_cities']) > 0 ){
					$this->data['countytax_cities'] = unserialize($this->data['countytax_cities']);
				} else {
					$this->data['countytax_cities'] = array();
				}
			}
		}
		foreach($this->data['countytax_cities'] as $city){
			$city = str_replace(' ', '-', $city);
			$this->data[$city] = $this->config->get($city);
		}
		
																				
		$this->template = 'total/countytax.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'total/countytax')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}

	public function autocomplete() {
		$json = array();
		
		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model']) || isset($this->request->get['filter_category_id'])) {
			$this->load->model('catalog/product');
			
			if (isset($this->request->get['filter_name'])) {
				$filter_name = strtolower($this->request->get['filter_name']);
			} else {
				$filter_name = '';
			}

			$state_list = array('AL'=>"Alabama",  'AK'=>"Alaska",  'AZ'=>"Arizona",  'AR'=>"Arkansas", 'CA'=>"California",  'CO'=>"Colorado",  'CT'=>"Connecticut",  'DE'=>"Delaware",'DC'=>"District Of Columbia",  'FL'=>"Florida",  'GA'=>"Georgia",  'HI'=>"Hawaii", 'ID'=>"Idaho",  'IL'=>"Illinois",  'IN'=>"Indiana",  'IA'=>"Iowa",  'KS'=>"Kansas", 'KY'=>"Kentucky",  'LA'=>"Louisiana",  'ME'=>"Maine",  'MD'=>"Maryland", 'MA'=>"Massachusetts",  'MI'=>"Michigan",  'MN'=>"Minnesota",  'MS'=>"Mississippi", 'MO'=>"Missouri",  'MT'=>"Montana", 'NE'=>"Nebraska", 'NV'=>"Nevada", 'NH'=>"New Hampshire", 'NJ'=>"New Jersey", 'NM'=>"New Mexico", 'NY'=>"New York", 'NC'=>"North Carolina", 'ND'=>"North Dakota", 'OH'=>"Ohio",  'OK'=>"Oklahoma",  'OR'=>"Oregon",'PA'=>"Pennsylvania",  'RI'=>"Rhode Island",  'SC'=>"South Carolina",  'SD'=>"South Dakota", 'TN'=>"Tennessee",  'TX'=>"Texas",  'UT'=>"Utah",  'VT'=>"Vermont",  'VA'=>"Virginia", 'WA'=>"Washington",  'WV'=>"West Virginia",  'WI'=>"Wisconsin",  'WY'=>"Wyoming");  

			$hold = array();

			foreach($state_list as $k=>$v){
				$name = strtolower($v);
				if ( startsWith($name, $filter_name) ){
					$hold[$k] = $v;
				}
			}

			foreach ($hold as $k=>$v){
				$json[] = array(
					'name'     => $v,	
					'abr'      => strtolower($k)
				); 
			}
		}

		$this->response->setOutput(json_encode($json));
	}
}
?>
