<?php
header('Content-type: text/xml');

echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

  <?php foreach($seatizen as $row){?>
    <url>
        <loc>https://www.informasea.com/profile/<?=$row["username"]?>/resume</loc>
        <lastmod><?=date("Y-m-d",strtotime($row["last_update"]))?></lastmod>
        <changefreq>monthly</changefreq>
    </url>
  <?php } ?>

</urlset>