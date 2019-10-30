              </div>
            </div>
          </div>
        </div>
      </div>
            <div class="footer">
              <div class="footer-inner">
                <div class="footer-content">
                  <span class="bigger-120">
                    Copyright &copy; <span class="info">2017 - <?php echo $versi->row()->tahun; ?></span> | Pengelola : <span class="info"><?php echo $identitas->row()->title; ?></span> 
                    <span> <p class="muted pull-right">Versi : <span class="info"><?php echo $versi->row()->title; ?></span> || Page rendered in <strong>{elapsed_time}</strong> seconds.</p></span>
                  </span>
                </div>
              </div>
            </div>

        </div><!-- /#wrapper -->
       <div id='ScrollToTop'> <i style="color:#438eb9;" class="fa fa-arrow-up fa-3x flat"></i><p> Top</p></div>

  </body>  
      
      <script src="<?php echo base_url('assets/backend/js/bootbox.min.js'); ?>"/></script>
      <script src="<?php echo base_url('assets/backend/js/scripts.js'); ?>"></script>
      <script type='text/javascript'>
        $(function() { $(window).scroll(function() { if($(this).scrollTop()>100) { $('#ScrollToTop').fadeIn()} else { $('#ScrollToTop').fadeOut();}});
        $('#ScrollToTop').click(function(){$('html,body').animate({scrollTop:0},300);return false})});
      </script>
</html>