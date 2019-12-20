
<div class="row">
  
  <?php 
    $color = array("blightblue","bblue","bgreen","borange","bred","bviolet");

    foreach ($show_dashboard->result() as $row) : 
    if ($row->type_menu=="1")
    $link=site_url($row->link);
    else
    $link=$row->link;
  ?>
  
    <div class="col-lg-2 col-md-2 col-xlg-2 col-xs-2">
      <div class="card">
        <a target="<?php echo $row->target_menu; ?>" href="<?php echo $link; ?>">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="d-flex no-block align-items-center">
                <div>
                  <h3><i class="fa <?php echo $row->icon_menu; ?>"></i></h3>
                  <p class="text-muted" style="text-align: center;"><?php echo $row->menu_name; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </a>
      </div>
    </div>

  <?php  $show_dashboard->free_result(); endforeach; ?>
</div>
