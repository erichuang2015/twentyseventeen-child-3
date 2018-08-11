<?php
/*
Template Name: iTunes
*/

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<h1>2.请选择要下载的版本</h1>
		<?php
$platform = $_GET['platform'];
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.ipsw.me/v4/itunes/{$platform}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Accept: application/json"
));

$response = curl_exec($ch);
curl_close($ch);

$versions = json_decode($response,true);
?>

<?php
if ($platform == 'windows'){
    echo '
    <table>
        <tr>
            <th>版本</th>
            <th>发布日期</th>
            <th>32 Bit</th>
            <th>64 Bit</th>
        </tr>';

    foreach ($versions as $version){
        $date = substr($version['releasedate'], 0, 10);
        echo '<tr><td>'.$version['version'].'</td>
              <td>'.$date.'</td>
              <td><a href="'.$version['url'].'">下载</a></td>
              <td><a href="'.$version['64biturl'].'">下载</a></td>
          </tr>';
    }
    echo '</table>';
}else{
    echo '
    <table>
        <tr>
            <th>版本</th>
            <th>发布日期</th>
            <th>下载</th>
        </tr>';

    foreach ($versions as $version){
        $date = substr($version['releasedate'], 0, 10);
        echo '<tr><td>'.$version['version'].'</td>
              <td>'.$date.'</td> 
              <td><a href="'.$version['url'].'">下载</a></td>
          </tr><br>';
}
    echo '</table>';
}

?>
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
