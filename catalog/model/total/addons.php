<?php
class ModelTotalAddons extends Model {
    //Function to add the Addons price into total if addons selected by user
	public function getTotal(&$total_data, &$total, &$taxes) {
            //Check the session is set or not for addons
		if (isset($this->session->data['addons'])) {
			$total_data[] = array( 
				'code'       => 'addons',
				'title'      => $this->config->get('addons_model_name'),
				'text'       => $this->currency->format($this->config->get('addons_price')),
				'value'      => $this->config->get('addons_price'),
				'sort_order' => $this->config->get('addons_sort_order')
			);

			$total += $this->config->get('addons_price');			
	}
        }
}
?>