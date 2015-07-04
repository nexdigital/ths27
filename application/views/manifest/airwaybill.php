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
                <strong>Terbilang</strong>: <?php echo '<em>'.ucfirst(terbilang($this->manifest_model->subtotal($data->hawb_no,'all'))).'</em>'; ?>
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
                <strong>Terbilang</strong>: <?php echo '<em>'.ucfirst(terbilang($this->manifest_model->subtotal($data->hawb_no,'all'))).'</em>'; ?>
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
                <strong>Terbilang</strong>: <?php echo '<em>'.ucfirst(terbilang($this->manifest_model->subtotal($data->hawb_no,'all'))).'</em>'; ?>
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


<?php

function satuan($inp)
{
    if ($inp == 1)
    {
        return "satu ";
    }
    else if ($inp == 2)
    {
        return "dua ";
    }
    else if ($inp == 3)
    {
        return "tiga ";
    }
    else if ($inp == 4)
    {
        return "empat ";
    }
    else if ($inp == 5)
    {
        return "lima ";
    }
    else if ($inp == 6)
    {
        return "enam ";
    }
    else if ($inp == 7)
    {
        return "tujuh ";
    }
    else if ($inp == 8)
    {
        return "delapan ";
    }
    else if ($inp == 9)
    {
        return "sembilan ";
    }
    else
    {
        return "";
    }
}

function belasan($inp)
{
    $proses = $inp; //substr($inp, -1);
    if ($proses == '11')
    {
        return "sebelas ";
    }
    else
    {
        $proses = substr($proses,1,1);
        return satuan($proses)."belas ";
    }
}

function puluhan($inp)
{
    $proses = $inp; //substr($inp, 0, -1);
    if ($proses == 1)
    {
        return "sepuluh ";
    }
    else if ($proses == 0)
    {
        return '';
    }
    else
    {
        return satuan($proses)."puluh ";
    }
}

function ratusan($inp)
{
    $proses = $inp; //substr($inp, 0, -2);
    if ($proses == 1)
    {
        return "seratus ";
    }
    else if ($proses == 0)
    {
        return '';
    }
    else
    {
        return satuan($proses)."ratus ";
    }
}

function ribuan($inp)
{
    $proses = $inp; //substr($inp, 0, -3);
    if ($proses == 1)
    {
        return "seribu ";
    }
    else if ($proses == 0)
    {
        return '';
    }
    else
    {
        return satuan($proses)."ribu ";
    }
}

function jutaan($inp)
{
    $proses = $inp; //substr($inp, 0, -6);
    if ($proses == 0)
    {
        return '';
    }
    else
    {
        return satuan($proses)."juta ";
    }
}

function milyaran($inp)
{
    $proses = $inp; //substr($inp, 0, -9);
    if ($proses == 0)
    {
        return '';
    }
    else
    {
        return satuan($proses)."milyar ";
    }
}

function terbilang($rp)
{
    $kata = "";
    $rp = trim($rp);
    if (strlen($rp) >= 10)
    {
        $angka = substr($rp, strlen($rp)-10, -9);
        $kata = $kata.milyaran($angka);
    }
    $tambahan = "";
    if (strlen($rp) >= 9)
    {
        $angka = substr($rp, strlen($rp)-9, -8);
        $kata = $kata.ratusan($angka);
        if ($angka > 0) { $tambahan = "juta "; }
    }
    if (strlen($rp) >= 8)
    {
        $angka = substr($rp, strlen($rp)-8, -7);
        $angka1 = substr($rp, strlen($rp)-7, -6);
        if (($angka == 1) && ($angka1 > 0))
        {
            $angka = substr($rp, strlen($rp)-8, -6);
            //echo " belasan".($angka)." ";
            $kata = $kata.belasan($angka)."juta ";
        }
        else
        {
            $angka = substr($rp, strlen($rp)-8, -7);
            //echo " puluhan".($angka)." ";
            $kata = $kata.puluhan($angka);
            if ($angka > 0) { $tambahan = "juta "; }
            
            $angka = substr($rp, strlen($rp)-7, -6);
            //echo " ribuan".($angka)." ";
            $kata = $kata.ribuan($angka);
            if ($angka == 0) { $kata = $kata.$tambahan; }
        }   
    }
    if (strlen($rp) == 7)
    {
        $angka = substr($rp, strlen($rp)-7, -6);
        $kata = $kata.jutaan($angka);
        if ($angka == 0) { $kata = $kata.$tambahan; }
    }
    $tambahan = "";
    if (strlen($rp) >= 6)
    {
        $angka = substr($rp, strlen($rp)-6, -5);
        $kata = $kata.ratusan($angka);
        if ($angka > 0) { $tambahan = "ribu "; }
    }
    if (strlen($rp) >= 5)
    {
        $angka = substr($rp, strlen($rp)-5, -4);
        $angka1 = substr($rp, strlen($rp)-4, -3);
        if (($angka == 1) && ($angka1 > 0))
        {
            $angka = substr($rp, strlen($rp)-5, -3);
            //echo " belasan".($angka)." ";
            $kata = $kata.belasan($angka)."ribu ";
        }
        else
        {
            $angka = substr($rp, strlen($rp)-5, -4);
            //echo " puluhan".($angka)." ";
            $kata = $kata.puluhan($angka);
            if ($angka > 0) { $tambahan = "ribu "; }
            
            $angka = substr($rp, strlen($rp)-4, -3);
            //echo " ribuan".($angka)." ";
            $kata = $kata.ribuan($angka);
            if ($angka == 0) { $kata = $kata.$tambahan; }
        }
    }
    if (strlen($rp) == 4)
    {
        $angka = substr($rp, strlen($rp)-4, -3);
        //echo " ribuan".($angka)." ";
        $kata = $kata.ribuan($angka);
        if ($angka == 0) { $kata = $kata.$tambahan; }
    }
    if (strlen($rp) >= 3)
    {
        $angka = substr($rp, strlen($rp)-3, -2);
        //echo " ratusan".($angka)." ";
        $kata = $kata.ratusan($angka);
    }
    if (strlen($rp) >= 2)
    {
        $angka = substr($rp, strlen($rp)-2, -1);
        $angka1 = substr($rp, strlen($rp)-1);
        if (($angka == 1) && ($angka1 > 0))
        {
            $angka = substr($rp, strlen($rp)-2);
            //echo " belasan".($angka)." ";
            $kata = $kata.belasan($angka);
        }
        else
        {
            //echo " puluhan".($angka)." ";
            $kata = $kata.puluhan($angka);
            
            $angka = substr($rp, strlen($rp)-1);
            //echo " satuan".($angka)." ";
            $kata = $kata.satuan($angka);
        }
    }
    if (strlen($rp) == 1)
    {
        $angka = substr($rp, strlen($rp)-1);
        //echo " satuan".($angka)." ";
        $kata = $kata.satuan($angka);
    }
    return $kata . ' Rupiah';
}

?>