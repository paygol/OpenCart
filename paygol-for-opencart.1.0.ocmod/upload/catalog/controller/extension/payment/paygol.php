<?php 
class ControllerExtensionPaymentPaygol extends Controller 
{
	public function index() 
	{
		$data['button_confirm'] = $this->language->get('button_confirm');
		$data['button_back'] = $this->language->get('button_back');
		$this->load->model('checkout/order');
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		$data['action'] = 'https://www.paygol.com/pay';
		$data['customer_id']=$order_info['customer_id'];
		$data['merchant_id'] = $this->config->get('paygol_merchant_id');
		$data['platform'] = 'opencart';
		$data['description'] = $this->config->get('config_name');
		$data['transaction_id'] = $this->session->data['order_id'];
		$data['return_url'] = $this->url->link('checkout/success');
		$data['cancel_url'] = $this->url->link('extension/payment/paygol/cancel', '', true); // cancel order
		$data['status_url'] = $this->url->link('payment/paygol/callback');
		$data['language'] = $this->session->data['language'];
		$data['logo'] = $this->config->get('config_url') . 'image/' . $this->config->get('config_logo');
		$data['email'] = $order_info['email'];
		$data['firstname'] = $order_info['payment_firstname'];
		$data['lastname'] = $order_info['payment_lastname'];
        
		if ($order_info['payment_address_2']) {
            $data['address'] = $order_info['payment_address_1'] . ", " . $order_info['payment_address_2'];
        }
        else {
            $data['address'] = $order_info['payment_address_1'];
        }
		
		$data['address1'] = $order_info['payment_address_1'];
		$data['address2'] = $order_info['payment_address_2'];
		$data['phone_number'] = $order_info['telephone'];
		$data['postal_code'] = $order_info['payment_postcode'];
		$data['city'] = $order_info['payment_city'];
		$data['state'] = $order_info['payment_zone'];
		$data['country'] = $order_info['payment_iso_code_3'];
		$data['amount'] = ($this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false));
		$data['currency'] = $order_info['currency_code'];

		$products = array();
		foreach ($this->cart->getProducts() as $product) {
			$products[] = $product['name'];
		}
		$data['items_text'] = implode( ', ', $products);;
		$data['order_id'] = $this->session->data['order_id'];
        
        if ($order_info) {
			$data['item_name'] = html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');
			$data['products'] = array();
			foreach ($this->cart->getProducts() as $product) {
				$option_data = array();
				foreach ($product['option'] as $option) {
					if ($option['type'] != 'file') {
						$value = $option['value'];
					} else {
						$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);		
						if ($upload_info) {
							$value = $upload_info['name'];
						} else {
							$value = '';
						}
					}
					$option_data[] = array(
						'name'  => $option['name'],
						'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value)
					);
				}
				$data['products'][] = array(
					'name'     => htmlspecialchars($product['name']),
					'model'    => htmlspecialchars($product['model']),
					'price'    => ($this->currency->format($product['price'], $order_info['currency_code'], false, false)),
					'quantity' => $product['quantity'],
					'option'   => $option_data,
					'weight'   => $product['weight']
				);
			}
			$data['discount_amount_cart'] = 0;
			$total = $this->currency->format($order_info['total'] - $this->cart->getSubTotal(), $order_info['currency_code'], false, false);
			if ($total > 0) {
				$data['products'][] = array(
					'name'     => $this->language->get('text_total'),
					'model'    => '',
					'price'    => $total,
					'quantity' => 1,
					'option'   => array(),
					'weight'   => 0
				);
			} else {
				$data['discount_amount_cart'] -= $total;
			}
		}
		$data['continue'] = $this->url->link('checkout/success');
		return $this->load->view('extension/payment/paygol', $data);
		
	}
	
	public function confirm()
	{  
		if ($this->session->data['payment_method']['code'] == 'paygol') {
			$this->load->language('extension/payment/paygol');
			$this->load->model('checkout/order');
			
			$comment .="PayGol pending ";
			$comment .= $text_pending;
			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('paygol_order_status_id'), $comment, true);
		}
	}
  	 ////////////////////////////////////////////////////////////////
	  //   						IPN   	                         //
	////////////////////////////////////////////////////////////////
	public function callback() 
	{
		
			 ini_set('error_reporting', 0);
			 $service_id        =    $_GET['service_id'];
			 $country        	=    $_GET['country'];
			 $price        		=    $_GET['price'];
			 $custom         	=    $_GET['custom'];
			 $currency        	=    $_GET['currency'];
			 $frmprice        	=    $_GET['frmprice'];
			 $frmcurrency       =    $_GET['frmcurrency'];
			 $transaction_id    =    $_GET['transaction_id'];
			 $arrayCustom       =    explode(";", $custom);
			 $order_id_form     =    $arrayCustom[0];
			 $amount        	=    $arrayCustom[1];
			 $amount 			= 	 $amount.".0000";
			 $customer_id       =    $arrayCustom[2];
			 
			if ((isset($_GET['service_id']) && !empty($_GET['service_id'])) && 
				(isset($_GET['country']) && !empty($_GET['country'])) &&
				(isset($_GET['price']) && !empty($_GET['price'])) &&
				(isset($_GET['custom']) && !empty($_GET['custom'])) &&
				(isset($_GET['currency']) && !empty($_GET['currency'])) &&
				(isset($_GET['frmprice']) && !empty($_GET['frmprice'])) &&
				(isset($_GET['frmcurrency']) && !empty($_GET['frmcurrency'])) &&
				(isset($_GET['transaction_id']) && !empty($_GET['transaction_id'])))
				{
					echo "Callback Ok";
					
					 // order_status_id = completed
					 $query_status_complete = $this->db->query("SELECT order_status_id AS id_order_complete, name FROM " . DB_PREFIX . "order_status WHERE name = 'Complete' limit 1");
					 $completed = $query_status_complete->row['id_order_complete'];
					 ////////////////////////////////////////////////////////////////////	 
					
					//order_status_id = pending
					 $query_status_pending = $this->db->query("SELECT order_status_id AS id_order_pending, name FROM " . DB_PREFIX . "order_status WHERE name = 'Pending' limit 1");
					 $pending = $query_status_pending->row['id_order_pending'];
					 $query_status_order = $this->db->query("SELECT order_id,customer_id,total,payment_method,payment_code,currency_code FROM " . DB_PREFIX . "order WHERE order_id='".$order_id_form."' AND customer_id='".$customer_id."' AND total ='".$amount."' AND currency_code='".$frmcurrency."' AND payment_method='PayGol' AND payment_code ='paygol' ");
					 $order_id_result = $query_status_order->row['order_id'];
					 ///////////////////////////////////////////////////////////////////
					 
					 // UPDATE //
					 $query_update = $this->db->query("UPDATE " . DB_PREFIX . "order SET order_status_id='".$completed."' WHERE order_id='".$order_id_form."' ");
					 if (isset($order_id_form)) 
						{
						$order_id = $order_id_form;
						} else 
							{
							$order_id = 0;
						}
					 $this->load->model('checkout/order');
					 $order_info = $this->model_checkout_order->getOrder($order_id);
					 
					 $comment_paygol .="PayGol completed ";
					 $comment_paygol .=$text_complete;
					 $this->model_checkout_order->addOrderHistory($order_id, $completed,$comment_paygol,true);
					 //echo "Callback End";
				} else 
				{
					echo "<br>Error:_:";
				}
	}
	public function cancel() 
	{
		
		$custom            =    $_GET['custom'];
		$arrayCustom       =    explode(";", $custom);
		$order_id_form     =    $arrayCustom[0];
		$customer_id       =    $arrayCustom[1];
		$query_delete_order = $this->db->query("DELETE FROM " . DB_PREFIX . "order WHERE order_id = '".$order_id_form."' ");
		$query_delete_order_history = $this->db->query("DELETE FROM " . DB_PREFIX . "order_history WHERE order_id = '".$order_id_form."'");
		$this->response->redirect($this->url->link('checkout/cart'));
	}
//////////////////////////	
}