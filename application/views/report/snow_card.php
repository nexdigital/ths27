<?php
$getcountry = $this->db->query("select country from customer_table group by country");
?>
<div class="col-lg-12">
    <div class="form-group">
        <label>Select Date</label>
        <input type="text" class="form-control datepicker" name="date" required>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>From</label>
        <select class="form-control" name="from" required>
            <?php
            foreach($getcountry->result() as $row){
                echo '<option value="'.$row->country.'">'.$row->country.'</option>';
            }
            ?>
        </select>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>To</label>
        <select class="form-control" name="to" required>
            <?php
            foreach($getcountry->result() as $row){
                echo '<option value="'.$row->country.'">'.$row->country.'</option>';
            }
            ?>
        </select>
    </div>
</div>
<div class="col-lg-12">
    <button type="submit" class="btn btn-primary submit-snow">Submit</button>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('select.form-control').select2();
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd"
    })

    $('.submit-snow').click(function(){
        $(this).addClass('disabled').html('Submitting...');
        var date = $('input[name=date]').val();
        var from = $('select[name=from]').val();
        var to = $('select[name=to]').val();

        setPage('<?php echo base_url('report/snow')?>?date='+date+'&from='+from+'&to='+to);
    })
})
</script>