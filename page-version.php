<?php
/*
Template Name: Version
*/

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<h1>3.请选择要下载的版本</h1>
		<?php
$identifier = $_GET["identifier"];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.ipsw.me/v4/device/{$identifier}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Accept: application/json"
));

$response = curl_exec($ch);
curl_close($ch);

$versions = json_decode($response,true);
$firmwares = $versions['firmwares'];
?>
<table>
    <tr>
        <th>版本</th>
        <th>签名状态</th>
        <th>发布日期</th>
        <th>MD5</th>
        <th>SHA1</th>
        <th>下载链接</th>
    </tr>
    <?php
    foreach ($firmwares as $firmware){
        $status = $firmware['signed'] == true ? 'Signed' : 'Unsigned';
        $date = substr($firmware['releasedate'], 0, 10);
        echo '<tr><td>'.$firmware['version'].'('.$firmware['buildid'].')</td>
                  <td>'.$status.'</td>
                  <td>'.$date.'</td>
                  <td>'.$firmware['md5sum'].'</td>
                  <td>'.$firmware['sha1sum'].'</td>
                  <td><a href="'.$firmware['url'].'}">下载</a></td>
              </tr>';
        
    }
    ?>
</table>
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
