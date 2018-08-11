<?php
/*
Template Name: Platform
*/

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<h1>2.请选择要下载的型号</h1>
		<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.ipsw.me/v4/devices");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Accept: application/json"
));

$response = curl_exec($ch);
curl_close($ch);

$devices = json_decode($response, true);





$product = $_GET["product"];

foreach (array_reverse($devices) as $device){
    if(strpos($device['name'],$product) !== false){
        echo '<a href="version?identifier='.$device['identifier'].'">'.$device['name'].'</a></br>';
    }
}

?>
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
