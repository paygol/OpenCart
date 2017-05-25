<?php
class ControllerExtensionPaymentPaygol extends Controller 
{
	private $error = array();
	public function index() 
	{
		$this->load->language('extension/payment/paygol');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) 
		{
			$this->model_setting_setting->editSetting('paygol', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'], true));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_pending'] = $this->language->get('text_pending');
		$data['text_complete'] = $this->language->get('text_complete');
		$data['entry_merchant_id'] = $this->language->get('entry_merchant_id');
		$data['entry_merchant_key'] = $this->language->get('entry_merchant_key');
    	$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_callback'] = $this->language->get('entry_callback');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_paygol_id'] = $this->language->get('entry_paygol_id');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['receiver'])) {
			$data['error_receiver'] = $this->error['receiver'];
		} else {
			$data['error_receiver'] = '';
		}
		
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/paygol', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/paygol', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);
		$data['callback'] = HTTP_CATALOG . 'index.php?route=extension/payment/paygol/callback'; // IPN URL
		
		if (isset($this->request->post['paygol_merchant_id'])) {
			$data['paygol_merchant_id'] = $this->request->post['paygol_merchant_id'];
		} else {
			$data['paygol_merchant_id'] = $this->config->get('paygol_merchant_id');
		}
		
		
		

		 
		if (isset($this->request->post['paygol_merchant_key'])) {
			$data['paygol_merchant_key'] = $this->request->post['paygol_merchant_key'];
		} else {
			$data['paygol_merchant_key'] = $this->config->get('paygol_merchant_key');
		}
		
        if (isset($this->request->post['paygol_status'])) {
			$data['paygol_status'] = $this->request->post['paygol_status'];
		} else {
			$data['paygol_status'] = $this->config->get('paygol_status');
		}
	
		if (isset($this->request->post['paygol_order_status_id'])) {
			$data['paygol_order_status_id'] = $this->request->post['paygol_order_status_id'];
		} else {
			$data['paygol_order_status_id'] = $this->config->get('paygol_order_status_id');
		}
		
		$this->load->model('localisation/order_status');
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['paygol_geo_zone_id'])) {
			$data['paygol_geo_zone_id'] = $this->request->post['paygol_geo_zone_id'];
		} else {
			$data['paygol_geo_zone_id'] = $this->config->get('paygol_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['paygol_sort_order'])) {
			$data['paygol_sort_order'] = $this->request->post['paygol_sort_order'];
		} else {
			$data['paygol_sort_order'] = $this->config->get('paygol_sort_order');
		}

		if (isset($this->request->post['paygol_rid'])) {
			$data['paygol_rid'] = $this->request->post['paygol_rid'];
		} else {
			$data['paygol_rid'] = $this->config->get('paygol_rid');
		}

		if (isset($this->request->post['paygol_custnote'])) {
			$data['paygol_custnote'] = $this->request->post['paygol_custnote'];
		} else {
			$data['paygol_custnote'] = $this->config->get('paygol_custnote');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('extension/payment/paygol.tpl', $data));
	}
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/paygol')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->request->post['paygol_merchant_id']) {
			$this->error['receiver'] = $this->language->get('error_receiver');
		}
		
		if (!$this->request->post['paygol_merchant_key']) {
			$this->error['receiver'] = $this->language->get('error_receiver');
		}
		return !$this->error;
	}
}