

    <footer id="footer" class="navbar-default navbar-fixed-bottom">
        <div class="container">
            <div class="col-md-12">
           Copyright &copy; <span class="info">2010 - <?php echo $versi->row()->tahun; ?></span>. | <span class="info"><?php echo $identitas->row()->title_footer; ?></span> |

            Versi : <span class="info"><?php echo $versi->row()->title; ?></span> || Page rendered in <strong>{elapsed_time}</strong> seconds.
            </div>
        </div>
    </footer>
    
    <script src="<?php echo base_url('assets/homepage/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/homepage/js/scripts.js'); ?>"></script>
    <script>
        $(document).ready(function()
        {
            $(".preloader").fadeOut();
        })
    </script>
</body>

</html>