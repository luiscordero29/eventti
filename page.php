<?php
include(TEMPLATEPATH.'/includes/head.php');
include(TEMPLATEPATH.'/includes/header.php');
    while ( have_posts() ) : the_post();
?>
        <div class="container">
            <div id="page_content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content">
                            <?php echo the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    endwhile;
include(TEMPLATEPATH.'/includes/footer.php');
?>
