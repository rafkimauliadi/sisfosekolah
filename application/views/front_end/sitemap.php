<?php 
header('Content-type: application/xml; charset="UTF-8"',true);  
?>

<content xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <?php foreach ($recent->result() as $row) : ?>
  <post>
     <id><?php echo $row->id_content; ?></id>
     <judul><?php echo filter_var($row->title, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); ?></judul>
     <kategori><?php echo $row->title_category; ?></kategori>
     <publish_by><?php echo $row->full_name; ?></publish_by>
  </post>
  <?php  $recent->free_result(); endforeach; ?>
</content>
