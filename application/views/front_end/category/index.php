<article>
    <h3><i class="fa fa-tags"></i> Category : <span class="label label-danger arrowed"><?php echo $details->row()->title; ?></span></h3>

    <?php
    foreach ($data->result() as $row) :

    $year = substr($row->created_modified,0,4);
    $month = substr($row->created_modified,5,2);
    
    if ($row->gambar!=NULL)
    {
        $post_images=base_url().'images/'.$year.'/'.$month.'/thumbnails/'.$row->gambar;
    }
    else
    {
        $post_images =cek_img_tag($row->isi);
    }
    
    
    if ($post_images=="")
        $post_images =base_url('logo.png');

    ?>
    <div class="col-sm-12 contpost">
        <div class="row">
          <div class="col PostTitle">
            <h4><a href="<?php echo site_url('home/read/'.$row->id_content.'-'.create_url($row->title)); ?>"><?php echo $row->title; ?></a></h4>
            
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <a href="<?php echo site_url('home/read/'.$row->id_content.'-'.create_url($row->title)); ?>" class="thumbnail">
                <img src="<?php echo $post_images; ?>" alt="<?php echo $row->title; ?>">
            </a>
          </div>
          <div class="col-sm-6">  <p><b><i class="fa fa-calendar"></i> <?php echo time_post($row->created_date); ?></b></p>
            <p><?php echo strip_tags(addslashes(trim(substr($row->isi,0,150)))); ?></p>
            <p><a class="btn btn-sm btn-success" href="<?php echo site_url('home/read/'.$row->id_content.'-'.create_url($row->title)); ?>">Baca selengkapnya</a></p>
          </div>
        </div>
        <div class="row">
          <div class="col text-center small p-2">
            <p>
              <i class="fa fa-user-circle"></i> by <a href="#"><?php echo $row->full_name; ?></a>
              | <i class="fa fa-search"></i> <a href="#"><?php echo number_format($row->hits,0); ?> view</a>
              | <i class="fa fa-tags"></i> Tags : <a href="<?php echo site_url('home/category/'.$row->id_category); ?>"><span class="badge badge-info"><?php echo $row->title_category; ?></span></a>
            </p>
          </div>
        </div>
      </div>
                 
    <?php
    $data->free_result(); endforeach;
    
    ?>
    <hr/>
    <?php 
        if ($data->row()==NULL)
    {
        echo "<p>Pencarian berdasaran keyword <span class=\"label label-primary arrowed\">$search</span> tidak ditemukan, silahkan ganti keyword pencarian data anda</p>";
    }
    
    echo $pagination; 
    
    ?>
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
