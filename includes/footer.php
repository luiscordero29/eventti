<div id="seccion_8">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="row">
                    <div class="col-xs-3">
                      <?php if ( is_active_sidebar( 'footer_1' ) ) : ?>
                          <?php dynamic_sidebar( 'footer_1' ); ?>
                      <?php endif; ?>
                    </div>
                    <div class="col-xs-3">
                      <?php if ( is_active_sidebar( 'footer_2' ) ) : ?>
                          <?php dynamic_sidebar( 'footer_2' ); ?>
                      <?php endif; ?>
                    </div>
                    <div class="col-xs-3">
                      <?php if ( is_active_sidebar( 'footer_3' ) ) : ?>
                          <?php dynamic_sidebar( 'footer_3' ); ?>
                      <?php endif; ?>
                    </div>
                    <div class="col-xs-3">
                      <?php if ( is_active_sidebar( 'footer_4' ) ) : ?>
                          <?php dynamic_sidebar( 'footer_4' ); ?>
                      <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="copy">
                    todos los derechos reservados eventti online
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Log In -->
<div class="modal fade" id="ModalLogIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-close.gif" alt="Close" /></span></button>
                <h4 class="modal-title" id="myModalLabel">Log In / Register</h4>
            </div>
            <div class="modal-body">
                <div class="btn-facebook">
                  <div class="row">
                    <div class="col-xs-12">
                      <div class="modal-line">
                      </div>
                    </div>
                  </div>
                </div>
                <?php echo do_shortcode('[woocommerce_my_account]'); ?>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/jquery/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Include js plugin -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/owl-carousel/owl.carousel.js"></script>
<!-- Script -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/script.js"></script>
<?php wp_footer(); ?>
<!-- end mobile -->
</div>
</body>
</html>
