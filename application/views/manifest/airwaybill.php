<!DOCTYPE html>
<html lang="en">
<head>
<title>Airway Bill</title>
<link rel="stylesheet" href="<?php echo base_url() ?>style/css/airwaybill.css">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('style/js/airwaybill.js') ?>"></script>
<script src="<?php echo base_url('style/js/jquery.form.js') ?>" type="text/javascript"></script>
</head>
<body>
<div id="header-bar">
	<ul>
		<li><a href="javascript:void(0);" class="btn-back"><- Back</a></li>
		<li><a href="javascript:void(0);" class="btn-print">Print</a></li>
	</ul>
</div>
	
<input type="hidden" name="item_hawb_no" value="<?php echo $data->hawb_no ?>">
<?php for($i=1;$i<=1;$i++){?>
<div class="paper">
    <div class="contaier">
        <div class="header">
            <img src="<?=base_url()?>asset/images/tata-logo.png" class="logo" style="float:left; height:70px; margin-top:5px;">
            <img src="<?=base_url()?>asset/barcode/QR_<?php echo $data->hawb_no;?>.png" class="barcode" style="float:right; height:70px; width:70px;">
        </div>
        <div class="info">
            <table style="width:100%;"><tr>
            <td style="width:25%;">Airwaybill: <?php echo $data->hawb_no?></td>
            <td style="width:30%; text-align:center;">Destination: <?php echo ucwords($consignee->city)?></td>
            <td style="width:35%; text-align:center;"><?php echo ucfirst($data->manifest_type); ?> / <?php echo ($data->collect) ? 'Collect [CC]' : 'Prepaid [PP]'?></td>
            <td style="width:10%; text-align:right;">Lembar THS</td>
            </tr></table>
        </div>
        <div class="content">
			<table style="width:100%;">
				<tr>
					<td>
						<div style="border-bottom:1px dotted #000;">
						Sender: <?php echo $shipper->name.'<br>'.$shipper->address.'<br>'.$shipper->attn.'<br> Phone: '.$shipper->phone.' / '.$shipper->mobile;?>
						</div>
						<div style="border-bottom:1px dotted #000; margin-top:3px;">
						Consignee: <?php echo $consignee->name.'<br>'.$consignee->address.'<br>'.$consignee->attn.'<br> Phone: '.$consignee->phone.' / '.$consignee->mobile;?>
						</div>
						<div style="margin-top:3px;">
						Description: <br/>
						<?php echo $data->description; ?><br/>
						NT 1 = <?php echo $data->exchange_rate; ?><br/>
						</div>
					</td>
					<td>
						<?php if(($data->manifest_type === 'import' && $data->collect) || ($data->manifest_type === 'export' && $data->prepaid)): ?>
						<div class="item-field">
							<div class="item" style="width:100%;"><strong>REIMBUSEMENT</strong></div>
							<div class="reimbursement">
								<!-- Reimbursement -->
								<div class="item" style="width:160px;">Freight</div>
								<div class="item" style="width:100px;">RP</div>
								<div class="value"><?php echo number_format($freight) ?></div>
								<?php
									foreach($reimbursement as $key => $row){
										echo '
										<div class="item-'.$row->id.'">
											<div class="item" style="width:160px;">'.$row->name.'  <a href="javascript:void(0);" class="remove-item" data-id="'.$row->id.'">X</a></div>
											<div class="item" style="width:100px;">RP</div>
											<div class="value">'.number_format($row->value).'</div>
										</div>';
									}
								?>
								<div class="item" style="width:160px;">Materai</div>
								<div class="item" style="width:100px;">RP</div>
								<div class="value"><?php echo number_format($materai) ?></div>
							</div>	                    
							<div class="item" style="width:100%;"><a href="javascript:void(0);" class="add-item" data-type="reimbursement">Add item</a></div>
		
							<div class="item" style="width:100%; margin-top:100px;"><strong>NON REIMBUSEMENT</strong></div>
							<div class="non_reimbursement">
								<!-- Non Reimbursement -->
								<div class="item" style="width:160px;">Handling Jakarta</div>
								<div class="item" style="width:100px;">RP</div>
								<div class="value"><?php echo number_format($handling_jakarta) ?></div>
								<?php
									foreach($non_reimbursement as $key => $row){
										echo '
										<div class="item-'.$row->id.'">
											<div class="item" style="width:160px;">'.$row->name.'  <a href="javascript:void(0);" class="remove-item" data-id="'.$row->id.'">X</a></div>
											<div class="item" style="width:100px;">RP</div>
											<div class="value">'.number_format($row->value).'</div>
										</div>';
									}
								?>
							</div>
							
							<div class="item" style="width:100%;"><a href="javascript:void(0);" class="add-item" data-type="non_reimbursement">Add item</a></div>
							
							<div class="item" style="width:160px;"><input type="checkbox" class="item-tax" <?php echo ($is_tax) ? 'checked="checked"' : '' ?>>tax</div>
							<div class="item" style="width:100px;">RP</div>
							<div class="value invoice_tax"><?php echo number_format($total_tax) ?></div>
		
							<div class="item" style="width:100%; margin-top:10px;">&nbsp;</div>
							<div class="item" style="width:160px;">TOTAL</div>
							<div class="item" style="width:100px;">RP</div>
							<div class="value invoice_total"><?php echo number_format($total_invoice) ?></div>
						</div>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<div class="item" style="width:140px; text-align:center;">Jakarta, <?php echo date('d/m/Y')?></div><div class="value" style="width:160px; text-align:center;">Shipper/Consignee</div>
						<div class="item" style="margin-top:50px; width:140px; text-align:center;">Authorized</div><div class="value" style="margin-top:50px; width:160px; text-align:center;">Name</div>						
					</td>
				</tr>
			</table>
        </div>
    </div>
</div>
<?php } ?>
</body>
<html>