<?php
    $year = substr($details->row()->created_modified,0,4);
    $month = substr($details->row()->created_modified,5,2);
                    
    if ($details->row()->gambar!=NULL)
    {
        $post_images=base_url().'images/'.$year.'/'.$month.'/'.$details->row()->gambar;
    }
    else
    {
        $post_images =cek_img_tag($details->row()->isi);
    }
    
    
    if ($post_images=="")
        $post_images =base_url('logo.png');
?>
<article>
    <h2><?php echo $details->row()->title; ?></h2>
 
    <div class="row">
        <div class="group1 col-sm-6 col-md-6">
             <span class="glyphicon glyphicon-bookmark"></span> <a href="<?php echo site_url('home/category/'.$details->row()->id_category); ?>"><?php echo $details->row()->title_category; ?></a>
        </div>
        <div class="group2 col-sm-6 col-md-6">
                  <span class="glyphicon glyphicon-time"></span> <?php echo tulis_waktu($details->row()->created_date); ?> 
        </div>
    </div>
 
    <hr>
    <?php if ($details->row()->gambar!="") { ?>
    <center><img src="<?php echo $post_images; ?>" class="img-responsive"></center>
    <?php } ?>
 
    <br />
 
    <p><?php echo $details->row()->isi; ?></p>
 
    <p class="text-right">
        <i class="fa fa-search"></i> <?php echo number_format($details->row()->hits,0); ?> kali dibaca
    </p>
 
    <hr>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         style="display:block; text-align:center;"
         data-ad-layout="in-article"
         data-ad-format="fluid"
         data-ad-client="ca-pub-1103260674484637"
         data-ad-slot="4009244966"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</article>