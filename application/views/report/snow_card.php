<div class="col-lg-12">
    <div class="form-group">
        <label>Select Date</label>
        <input type="text" class="form-control datepicker" name="date" required>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Snow Type</label>
        <select class="form-control" name="from" required>
            <option value="taiwan">Taiwan</option>
            <option value="vietnam">Vietnam</option>
            <option value="jakarta">Jakarta</option>
        </select>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
        <label>Snow Type</label>
        <select class="form-control" name="to" required>
            <option value="jakarta">Jakarta</option>
            <option value="vietnam">Vietnam</option>
            <option value="taiwan">Taiwan</option>
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