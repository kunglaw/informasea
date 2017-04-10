<?php
header('Content-type: text/xml');

echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

  <?php foreach($vacantsea as $row){?>
    <url>
        <loc>https://www.informasea.com/vacantsea/detail/<?=$row["vacantsea_id"]?>/<?=url_title($row["vacantsea"])?></loc>
        <lastmod><?=date("Y-m-d",strtotime($row["create_date"]))?></lastmod>
        <changefreq>monthly</changefreq>
    </url>
  <?php } ?>

</urlset>