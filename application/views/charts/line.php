<?php
	$data = "";
	foreach($chart->result() as $row) {
		$data .= "['".strtolower(strip_tags($row->name))."',".$row->total_kg."],";
	}
	$data = substr($data,0,-1);
?>
<meta charset="UTF-8">
<div id="container"></div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="<?php echo base_url()?>style/lib/highcharts/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>style/lib/highcharts/exporting.js" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Tata Harmoni Sarana'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'KG'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Total: <b>{point.y:.1f} kg</b>'
        },
        series: [{
            name: 'Population',
            data: [<?php echo $data ?>],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>