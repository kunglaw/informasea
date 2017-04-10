<?php
	$xml= simplexml_load_file("http://magz.informasea.com/category/article/feed/rss2") or die("Error: Cannot create object");
	// http://www.example.com/category/categoryname/feed

$channel = $xml->channel;

$item = $channel->item;
?>
<div class="list-group">
  <a href="#" class="list-group-item active">
    <h4> Informasea Magz </h4>
  </a>
  <?php
  foreach($item as $row)
  {
  ?>
  	 <a href="<?=$row->link?>" target="_blank" class="list-group-item"> <?=$row->title?> </a> 
  <?php
  }
  ?>
</div>