<?php

class ModelTotalWeekSpecial extends Model {
//Function to Add the Week Special Price into Total 
    public function getTotal(&$total_data, &$total, &$taxes) {
        //Check either session is set or not for week special 
        if (isset($this->session->data['week_special'])) {
            $total_data[] = array(
                'code' => 'week_special',
                'title' => $this->config->get('week_special_title'),
                'text' => $this->currency->format($this->config->get('week_special_price')),
                'value' => $this->config->get('week_special_price'),
                'sort_order' => $this->config->get('week_special_sort_order')
            );

            $total += $this->config->get('week_special_price');
        }
    }

}

?>