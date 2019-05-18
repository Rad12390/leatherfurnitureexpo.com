<div class="payment-error-div" style="margin-top: 5px; margin-bottom: 5px; position: relative;">
     <?php if ($this->config->get('stripe_test') == 1) { ?>
      <div class="success">
     The payment method is in Sandbox mode
      </div>
     <?php } ?>
     </div>

         <form>
                	<p>
                    	<label>Credit Card Type <strong> * </strong> :</label>
                        <select class="credit" name="card_type">
                            <option value="visa">Visa</option>
                        </select>
                    </p>
                    <p>
                    	<label>Credit Card Number <strong> * </strong> : </label>
                        <input type="text" name="card_no"/>
                    </p>
                    <p>
                    	<label>Card Verification Value (CVV) <strong> * </strong> : </label>
                        <input type="text" name="cvv" maxlength="4"/>
                    </p>
                    <p>
                    	<label>Expires <strong> * </strong> : </label>
                        <select name="month">
                        	<option value="2015">January</option>
                        </select>
                        <select name="year">
                            <option value="2015">2015</option>
                        </select>
                    </p>
                </form>
   

