<div style="width: 730px; margin: 20px auto; font-family:sans-serif;">
	<?php
	/** Include class */
	include('GoogChart.class.php');

	/** Create chart */
	$chart = new GoogChart();


	/*

		Example 1
		Pie chart

*/

	// Set graph data
	$data = array(
		'IE7' => 22,
		'IE6' => 30.7,
		'IE5' => 1.7,
		'Firefox' => 36.5,
		'Mozilla' => 1.1,
		'Safari' => 2,
		'Opera' => 1.4,
	);

	// Set graph colors
	$color = array(
		'#99C754',
		'#54C7C5',
		'#999999',
	);

	/* # Chart 1 # */
	echo '<h2>Pie chart</h2>';
	$chart->setChartAttrs(array(
		'type' => 'pie',
		'title' => 'Browser market 2008',
		'data' => $data,
		'size' => array(400, 300),
		'color' => $color
	));
	// Print chart
	echo $chart;


	/*

		Example 2
		Bar graph
		Multiple data

*/

	// Set multiple graph data
	$dataMultiple = array(
		'February 2008' => array(
			'IE7' => 22,
			'IE6' => 30.7,
			'IE5' => 1.7,
			'Firefox' => 36.5,
			'Mozilla' => 1.1,
			'Safari' => 2,
			'Opera' => 1.4,
		),
		'January 2008' => array(
			'IE7' => 22,
			'IE6' => 30.7,
			'IE5' => 1.7,
			'Firefox' => 36.5,
			'Mozilla' => 1.1,
			'Safari' => 2,
			'Opera' => 1.4,
		),
	);

	/* # Chart 2 # */
	echo '<h2>Vertical Bar</h2>';
	$chart->setChartAttrs(array(
		'type' => 'bar-vertical',
		'title' => 'Browser market 2008',
		'data' => $dataMultiple,
		'size' => array(550, 200),
		'color' => $color,
		'labelsXY' => true,
	));
	// Print chart
	echo $chart;

	/*

		Example 3
		Timeline
		Multiple data

*/

	// Set timeline graph data
	$dataTimeline = array(
		'2007' => array(
			'January' => 31.0,
			'February' => 31.2,
			'March' => 31.8,
			'April' => 32.9,
			'May' => 33.7,
			'June' => 34.0,
			'July' => 34.5,
			'August' => 34.9,
			'September' => 35.4,
			'Oktober' => 36.0,
			'November' => 36.3,
			'December' => 36.3,
		),
		'2006' => array(
			'January' => 25.0,
			'February' => 24.5,
			'March' => 24.5,
			'April' => 22.9,
			'May' => 22.9,
			'June' => 25.5,
			'July' => 25.5,
			'August' => 24.9,
			'September' => 27.3,
			'Oktober' => 27.3,
			'November' => 29.9,
			'December' => 29.9,
		),
		'2005' => array(
			'January' => 15.0,
			'February' => 14.5,
			'March' => 14.5,
			'April' => 12.9,
			'May' => 12.9,
			'June' => 15.5,
			'July' => 15.5,
			'August' => 14.9,
			'September' => 17.3,
			'Oktober' => 17.3,
			'November' => 19.9,
			'December' => 19.9,
		),
	);

	/* # Chart 3 # */
	echo '<h2>Timeline</h2>';
	$chart->setChartAttrs(array(
		'type' => 'sparkline',
		'title' => 'Firefox market share (%) 2006-07',
		'data' => $dataTimeline,
		'size' => array(600, 200),
		'color' => $color,
		'labelsXY' => true,
		'fill' => array('#eeeeee', '#aaaaaa'),
	));
	// Print chart
	echo $chart;
	?>
</div>



<?php

// START
function gurunavi_search_restlist_v3($hit_per_page = 30, $offset_page = 1, $freeword)
{
	$ret = FALSE;

	$search_url = "https://api.gnavi.co.jp/RestSearchAPI/v3/?"
		. "keyid=" . GURUNAVIAPI_ACCESS_KEY
		. "&hit_per_page=" . $hit_per_page
		. "&offset_page=" . $offset_page
		. "&freeword=" . urlencode_rfc3986(mb_convert_encoding($freeword, "UTF-8", INTERNAL_ENC));

	$json = json_decode(mb_convert_encoding(@file_get_contents($search_url, false, ARR_CONTEXT_OPTIONS), "UTF-8", INTERNAL_ENC));

	if ($json !== FALSE) {
		$ret = array();
		$n = 0;
		foreach ($json->rest as $shop) {
			//　中略
			$ret[$n]['id'] = (string)$shop->id;
			$ret[$n]['name'] = (string)$shop->name;
			$ret[$n]['address'] = (string)$shop->address;
			//　中略
			$n++;
		}
		if (count($ret) <= 0) {
			$ret = FALSE;
		}
	}
	return ($ret);
}
// END