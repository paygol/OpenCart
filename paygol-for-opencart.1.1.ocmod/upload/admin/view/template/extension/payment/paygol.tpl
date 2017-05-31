<?php echo $header; ?><?php echo $column_left; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-paygol" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-paygol" class="form-horizontal">
			  	  <div class="form-group required">
					<label class="col-sm-2 control-label" for="input-email"><?php echo $entry_merchant_id; ?></label>
						<div class="col-sm-10">
						  <input type="text" style="width:100%;" name="paygol_merchant_id" value="<?php echo $paygol_merchant_id; ?>" placeholder="<?php echo $entry_merchant_id; ?>" id="input-email" class="form-control" />
						  <?php if ($error_receiver_id) { ?>
								<div class="text-danger"><?php echo $error_receiver_id; ?></div>
							<?php } ?>
						</div>
				  </div>
				  
				  
				  <div class="form-group required">
					<label class="col-sm-2 control-label" for="input-email"><?php echo $entry_merchant_key; ?></label>
						<div class="col-sm-10">
						  <input type="text" style="width:100%;" name="paygol_merchant_key" value="<?php echo $paygol_merchant_key; ?>" placeholder="<?php echo $entry_merchant_key; ?>" id="input-email" class="form-control" />
						  <?php if ($error_receiver_key) { ?>
								<div class="text-danger"><?php echo $error_receiver_key; ?></div>
							<?php } ?>
						</div>
				  </div>
				  
				  
				  
				  
			   <div class="form-group">
					<label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
					<div class="col-sm-10">
						<select name="paygol_status" id="input-status" class="form-control">
							<?php if ($paygol_status) { ?>
							<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
							<option value="0"><?php echo $text_disabled; ?></option>
							<?php } else { ?>
							<option value="1"><?php echo $text_enabled; ?></option>
							<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
							<?php } ?>
						</select>
					</div>
			  </div>
          
			<div class="form-group">
				<label class="col-sm-2 control-label" for="input-callback"><?php echo $entry_callback; ?></label>
				<div class="col-sm-10">
					<textarea rows="2" readonly id="input-callback" class="form-control"><?php echo $callback; ?></textarea>
				</div>
			</div>
    
         <div class="form-group">
            <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
            <div class="col-sm-10">
              <select name="paygol_geo_zone_id" id="input-geo-zone" class="form-control">
                <option value="0"><?php echo $text_all_zones; ?></option>
				<?php foreach ($geo_zones as $geo_zone) { ?>
				<?php if ($geo_zone['geo_zone_id'] == $paygol_geo_zone_id) { ?>
				<option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
				<?php } else { ?>
				<option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
				<?php } ?>
				<?php } ?>
              </select>
            </div>
        </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="paygol_sort_order" value="<?php echo $paygol_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            <!-- order status default -->
			<select style="display:none;" name="paygol_order_status_id" id="input-order-status" class="form-control">
				<?php foreach ($order_statuses as $order_status) { ?>
				<?php if ($order_status['name'] == "Pending") { ?>
				<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
				<?php } ?>
				<?php } ?>
			</select>
			<!-- order status default -->			
			</div>
          </div>
        </form>
      </div>
    </div>
	
  </div>
</div>
<?php echo $footer; ?> 