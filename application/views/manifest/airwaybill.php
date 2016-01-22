<!DOCTYPE html>
<html lang="en">
<head>
<title>Airway Bill</title>
<link rel="stylesheet" href="<?php echo base_url() ?>style/css/airwaybill.css">
</head>
<body>
<div class="paper">
    <div class="contaier" style="height:30mm; background-color:#fff; overflow:hidden;">
        <div class="header">
            <img src="<?=base_url()?>asset/barcode/QR_<?php echo $data->hawb_no;?>.png" class="barcode" style="float:left; height:60px; width:60px; margin-right:20px;">
            <img src="<?=base_url()?>asset/images/tata-logo.png" class="logo" style="float:left; height:55px; margin-top:5px;">
            <img src="<?=base_url()?>asset/barcode/1D_<?php echo $data->hawb_no;?>.png" class="barcode" style="float:right; margin-top:5px; height:50px;">
        </div>
        <div class="info">
            <table style="width:100%:"><tr>
            <td style="width:25%;">Airwaybill #<?php echo $data->hawb_no?></td>
            <td style="width:25%; text-align:center;">Destination <?php echo ucwords($consignee->city)?></td>
            <td style="width:25%; text-align:center;"><?php echo  ($data->collect) ? 'Collect [CC]' : 'Prepaid [PP]'?></td>
            <td style="text-align:right;">Lembar THS</td>
            </tr></table>
        </div>
        <div class="content" style="height:20px;">
            <div class="shipment">
                <div style="border-bottom:1px dotted #000;">
                Sender: <?php echo '<em><strong>'.$shipper->name.'</strong></em><br>'.$shipper->address.'<br>'.$shipper->attn;?>
                </div>
                <div style="border-bottom:1px dotted #000; margin-top:3px;">
                Consignee: <?php echo '<em><strong>'.$consignee->name.'</strong></em><br>'.$consignee->address.'<br>'.$consignee->attn;?>
                </div>
                <div style="margin-top:3px;">
                Description: <?php echo $data->description; ?><br/>
                <strong>Terbilang</strong>: <?php echo '<em>'.ucfirst($this->tool_model->terbilang($this->manifest_model->subtotal($data->hawb_no,'all'))).'</em>'; ?>
                </div>
            </div>

            <div class="details">
                <div class="item-field">                   
                    <div class="item" style="width:150px;">No. of pieces</div>
                    <div class="item" style="width:30px;">PKG</div>
                    <div class="value"><?php echo $data->pkg?></div>
                    
                    <div class="item" style="width:150px;">Chargeable weight</div>
                    <div class="item" style="width:30px;">KGS</div>
                    <div class="value"><?php echo $data->kg?></div>

                    <?php if($data->collect) { ?>
                    <div class="item" style="width:150px;">Rate/kg
                        <?php
                        $discount_rate = $this->manifest_model->discount($data->hawb_no,'rate');
                        $rate = $data->rate;
                        if($discount_rate) {
                            echo '(-'.number_format($discount_rate->value).')';
                            $rate -= $discount_rate->value;
                        }
                        ?>
                    </div>
                    <div class="item" style="width:30px;"><?php echo $data->currency ?></div>
                    <div class="value"><?php echo $rate?></div>

                    <div class="item" style="width:150px;">Exchange Rate
                        <?php
                        $discount_kurs = $this->manifest_model->discount($data->hawb_no,'kurs');
                        $kurs = $data->exchange_rate;
                        if($discount_kurs) {
                            echo '(-'.number_format($discount_kurs->value).')';
                            $kurs -= $discount_kurs->value;
                        }
                        ?>
                    </div>
                    <div class="item" style="width:30px;">RP</div>
                    <div class="value"><?php echo $kurs?></div>

                    <?php 
                        if($extra_charge) {
                            foreach($extra_charge as $row) {
                                echo '
                                <div class="item" style="width:150px;">'.$row->type.' ['.$row->description.']</div>
                                <div class="item" style="width:30px;">'.$row->currency.'</div>
                                <div class="value">'.number_format($row->value).'</div>
                                ';
                            }
                        }
                    ?>

                    <div class="item" style="width:150px;">Total
                        <?php
                        $discount_total = $this->manifest_model->discount($data->hawb_no,'total');
                        if($discount_total) {
                            echo '(-'.number_format($discount_total->value).')';
                        }
                        ?>
                    </div>
                    <div class="item" style="width:30px;">RP</div>
                    <div class="value"><?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'all'))?></div>
                    <?php } ?>
                </div>
                <div class="item" style="width:120px; text-align:center;">Jakarta, <?php echo date('dS m, Y')?></div><div class="value" style="width:180px; text-align:center;">Date & Time - Shipper/Consignee</div>
                <div class="item" style="margin-top:25px; width:120px; text-align:center;">Authorized</div><div class="value" style="margin-top:25px; width:180px; text-align:center;">Name</div>
            </div>
        </div>
    </div>

<div class="paper">
    <div class="contaier" style="height:30mm; background-color:#fff; overflow:hidden;">
        <div class="header">
            <img src="<?=base_url()?>asset/barcode/QR_<?php echo $data->hawb_no;?>.png" class="barcode" style="float:left; height:60px; width:60px; margin-right:20px;">
            <img src="<?=base_url()?>asset/images/tata-logo.png" class="logo" style="float:left; height:55px; margin-top:5px;">
            <img src="<?=base_url()?>asset/barcode/1D_<?php echo $data->hawb_no;?>.png" class="barcode" style="float:right; margin-top:5px; height:50px;">
        </div>
        <div class="info">
            <table style="width:100%:"><tr>
            <td style="width:25%;">Airwaybill #<?php echo $data->hawb_no?></td>
            <td style="width:25%; text-align:center;">Destination <?php echo ucwords($consignee->city)?></td>
            <td style="width:25%; text-align:center;"><?php echo  ($data->collect) ? 'Collect [CC]' : 'Prepaid [PP]'?></td>
            <td style="text-align:right;">Lembar Arsip</td>
            </tr></table>
        </div>
        <div class="content" style="height:20px;">
            <div class="shipment">
                <div style="border-bottom:1px dotted #000;">
                Sender: <?php echo '<em><strong>'.$shipper->name.'</strong></em><br>'.$shipper->address.'<br>'.$shipper->attn;?>
                </div>
                <div style="border-bottom:1px dotted #000; margin-top:3px;">
                Consignee: <?php echo '<em><strong>'.$consignee->name.'</strong></em><br>'.$consignee->address.'<br>'.$consignee->attn;?>
                </div>
                <div style="margin-top:3px;">
                Description: <?php echo $data->description; ?><br/>
                <strong>Terbilang</strong>: <?php echo '<em>'.ucfirst($this->tool_model->terbilang($this->manifest_model->subtotal($data->hawb_no,'all'))).'</em>'; ?>
                </div>
            </div>

            <div class="details">
                <div class="item-field">                   
                    <div class="item" style="width:150px;">No. of pieces</div>
                    <div class="item" style="width:30px;">PKG</div>
                    <div class="value"><?php echo $data->pkg?></div>
                    
                    <div class="item" style="width:150px;">Chargeable weight</div>
                    <div class="item" style="width:30px;">KGS</div>
                    <div class="value"><?php echo $data->kg?></div>

                    <?php if($data->collect) { ?>
                    <div class="item" style="width:150px;">Rate/kg
                        <?php
                        $discount_rate = $this->manifest_model->discount($data->hawb_no,'rate');
                        $rate = $data->rate;
                        if($discount_rate) {
                            echo '(-'.number_format($discount_rate->value).')';
                            $rate -= $discount_rate->value;
                        }
                        ?>
                    </div>
                    <div class="item" style="width:30px;"><?php echo $data->currency ?></div>
                    <div class="value"><?php echo $rate?></div>

                    <div class="item" style="width:150px;">Exchange Rate
                        <?php
                        $discount_kurs = $this->manifest_model->discount($data->hawb_no,'kurs');
                        $kurs = $data->exchange_rate;
                        if($discount_kurs) {
                            echo '(-'.number_format($discount_kurs->value).')';
                            $kurs -= $discount_kurs->value;
                        }
                        ?>
                    </div>
                    <div class="item" style="width:30px;">RP</div>
                    <div class="value"><?php echo $kurs?></div>

                    <?php 
                        if($extra_charge) {
                            foreach($extra_charge as $row) {
                                echo '
                                <div class="item" style="width:150px;">'.$row->type.' ['.$row->description.']</div>
                                <div class="item" style="width:30px;">'.$row->currency.'</div>
                                <div class="value">'.number_format($row->value).'</div>
                                ';
                            }
                        }
                    ?>

                    <div class="item" style="width:150px;">Total
                        <?php
                        $discount_total = $this->manifest_model->discount($data->hawb_no,'total');
                        if($discount_total) {
                            echo '(-'.number_format($discount_total->value).')';
                        }
                        ?>
                    </div>
                    <div class="item" style="width:30px;">RP</div>
                    <div class="value"><?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'all'))?></div>
                    <?php } ?>
                </div>
                <div class="item" style="width:120px; text-align:center;">Jakarta, <?php echo date('dS m, Y')?></div><div class="value" style="width:180px; text-align:center;">Date & Time - Shipper/Consignee</div>
                <div class="item" style="margin-top:25px; width:120px; text-align:center;">Authorized</div><div class="value" style="margin-top:25px; width:180px; text-align:center;">Name</div>
            </div>
        </div>
    </div>

<div class="paper">
    <div class="contaier" style="height:30mm; background-color:#fff; overflow:hidden;">
        <div class="header">
            <img src="<?=base_url()?>asset/barcode/QR_<?php echo $data->hawb_no;?>.png" class="barcode" style="float:left; height:60px; width:60px; margin-right:20px;">
            <img src="<?=base_url()?>asset/images/tata-logo.png" class="logo" style="float:left; height:55px; margin-top:5px;">
            <img src="<?=base_url()?>asset/barcode/1D_<?php echo $data->hawb_no;?>.png" class="barcode" style="float:right; margin-top:5px; height:50px;">
        </div>
        <div class="info">
            <table style="width:100%:"><tr>
            <td style="width:25%;">Airwaybill #<?php echo $data->hawb_no?></td>
            <td style="width:25%; text-align:center;">Destination <?php echo ucwords($consignee->city)?></td>
            <td style="width:25%; text-align:center;"><?php echo  ($data->collect) ? 'Collect [CC]' : 'Prepaid [PP]'?></td>
            <td style="text-align:right;">Lembar Customer</td>
            </tr></table>
        </div>
        <div class="content" style="height:20px;">
            <div class="shipment">
                <div style="border-bottom:1px dotted #000;">
                Sender: <?php echo '<em><strong>'.$shipper->name.'</strong></em><br>'.$shipper->address.'<br>'.$shipper->attn;?>
                </div>
                <div style="border-bottom:1px dotted #000; margin-top:3px;">
                Consignee: <?php echo '<em><strong>'.$consignee->name.'</strong></em><br>'.$consignee->address.'<br>'.$consignee->attn;?>
                </div>
                <div style="margin-top:3px;">
                Description: <?php echo $data->description; ?><br/>
                <strong>Terbilang</strong>: <?php echo '<em>'.ucfirst($this->tool_model->terbilang($this->manifest_model->subtotal($data->hawb_no,'all'))).'</em>'; ?>
                </div>
            </div>

            <div class="details">
                <div class="item-field">                   
                    <div class="item" style="width:150px;">No. of pieces</div>
                    <div class="item" style="width:30px;">PKG</div>
                    <div class="value"><?php echo $data->pkg?></div>
                    
                    <div class="item" style="width:150px;">Chargeable weight</div>
                    <div class="item" style="width:30px;">KGS</div>
                    <div class="value"><?php echo $data->kg?></div>

                    <?php if($data->collect) { ?>
                    <div class="item" style="width:150px;">Rate/kg
                        <?php
                        $discount_rate = $this->manifest_model->discount($data->hawb_no,'rate');
                        $rate = $data->rate;
                        if($discount_rate) {
                            echo '(-'.number_format($discount_rate->value).')';
                            $rate -= $discount_rate->value;
                        }
                        ?>
                    </div>
                    <div class="item" style="width:30px;"><?php echo $data->currency ?></div>
                    <div class="value"><?php echo $rate?></div>

                    <div class="item" style="width:150px;">Exchange Rate
                        <?php
                        $discount_kurs = $this->manifest_model->discount($data->hawb_no,'kurs');
                        $kurs = $data->exchange_rate;
                        if($discount_kurs) {
                            echo '(-'.number_format($discount_kurs->value).')';
                            $kurs -= $discount_kurs->value;
                        }
                        ?>
                    </div>
                    <div class="item" style="width:30px;">RP</div>
                    <div class="value"><?php echo $kurs?></div>

                    <?php 
                        if($extra_charge) {
                            foreach($extra_charge as $row) {
                                echo '
                                <div class="item" style="width:150px;">'.$row->type.' ['.$row->description.']</div>
                                <div class="item" style="width:30px;">'.$row->currency.'</div>
                                <div class="value">'.number_format($row->value).'</div>
                                ';
                            }
                        }
                    ?>

                    <div class="item" style="width:150px;">Total
                        <?php
                        $discount_total = $this->manifest_model->discount($data->hawb_no,'total');
                        if($discount_total) {
                            echo '(-'.number_format($discount_total->value).')';
                        }
                        ?>
                    </div>
                    <div class="item" style="width:30px;">RP</div>
                    <div class="value"><?php echo number_format($this->manifest_model->subtotal($data->hawb_no,'all'))?></div>
                    <?php } ?>
                </div>
                <div class="item" style="width:120px; text-align:center;">Jakarta, <?php echo date('dS m, Y')?></div><div class="value" style="width:180px; text-align:center;">Date & Time - Shipper/Consignee</div>
                <div class="item" style="margin-top:25px; width:120px; text-align:center;">Authorized</div><div class="value" style="margin-top:25px; width:180px; text-align:center;">Name</div>
            </div>
        </div>
    </div>
</div>
</body>
<html>