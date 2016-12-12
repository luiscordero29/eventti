<?php
include(TEMPLATEPATH.'/includes/head.php');
while ( have_posts() ) : the_post();
?>
        <div class="container-fluid">
            <div id="seccion_1">
                <div class="slider">
                    <?php echo the_content(); ?>
                </div>
                <div class="row">
                    <div class="col-xs-12 header">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="logo">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo('name'); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" class="img-responsive" alt="<?php bloginfo('name'); ?>">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xs-4 col-xs-offset-5">
                                <div class="row">
                                  <?php if (is_user_logged_in()): ?>
                                    <div class="col-xs-12">
                                        <div class="social-login">
                                            <?php
                                                global $current_user;
                                                unset($menu_list);
                                                $menu_name = 'social';
                                                if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) )
                                                {
                                                    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
                                                    $menu_items = wp_get_nav_menu_items($menu->term_id);
                                                    $menu_list = '<ul class="nav nav-pills">';
                                                    foreach ( (array) $menu_items as $key => $menu_item )
                                                    {
                                                        $class = '';
                                                        foreach ($menu_item->classes  as $c) {
                                                          $class = $class.' '.$c;
                                                        }
                                                        $menu_list .= '<li>';
                                                        $menu_list .= '<a href="' . $menu_item->url . '" target="' . $menu_item->target . '">';
                                                        $menu_list .= '<span class="fa-stack fa-lg">';
                                                          $menu_list .= '<i class="fa fa-circle fa-stack-2x"></i>';
                                                          $menu_list .= '<i class="' . $class . ' fa-stack-1x fa-inverse"></i>';
                                                        $menu_list .= '</span>';
                                                        $menu_list .= '</a>';
                                                        $menu_list .= '</li>';
                                                    }

                                                    $menu_list .= '<li class="user"><a href="/mi-cuenta/"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-user fa-stack-1x fa-inverse"></i></span> '. $current_user->user_login .'</a></li>';
                                                    $menu_list .= '<li><a id="mobile_open" href="#mobile"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i></span> ' . car_product() . '</a></li>';
                                                    $menu_list .= '</ul>';
                                                }
                                                echo $menu_list;
                                            ?>
                                        </div>
                                    </div>
                                  <?php else:  ?>
                                    <div class="col-xs-6">
                                        <div class="social">
                                            <?php
                                                unset($menu_list);
                                                $menu_name = 'social';
                                                if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) )
                                                {
                                                    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
                                                    $menu_items = wp_get_nav_menu_items($menu->term_id);
                                                    $menu_list = '<ul class="nav nav-pills">';
                                                    foreach ( (array) $menu_items as $key => $menu_item )
                                                    {
                                                        $class = '';
                                                        foreach ($menu_item->classes  as $c) {
                                                          $class = $class.' '.$c;
                                                        }
                                                        $menu_list .= '<li>';
                                                        $menu_list .= '<a href="' . $menu_item->url . '" target="' . $menu_item->target . '">';
                                                        $menu_list .= '<span class="fa-stack fa-lg">';
                                                          $menu_list .= '<i class="fa fa-circle fa-stack-2x"></i>';
                                                          $menu_list .= '<i class="' . $class . ' fa-stack-1x fa-inverse"></i>';
                                                        $menu_list .= '</span>';
                                                        $menu_list .= '</a>';
                                                        $menu_list .= '</li>';
                                                    }
                                                    $menu_list .= '</ul>';
                                                }
                                                echo $menu_list;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="login">
                                            <?php
                                              unset($menu_list);
                                              $menu_name = 'login';
                                              if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) )
                                              {
                                                  $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
                                                  $menu_items = wp_get_nav_menu_items($menu->term_id);
                                                  $menu_list = '<ol class="breadcrumb">';
                                                  foreach ( (array) $menu_items as $key => $menu_item )
                                                  {
                                                      $class = '';
                                                      foreach ($menu_item->classes  as $c) {
                                                        $class = $class.' '.$c;
                                                      }
                                                      $menu_list .= '<li><a href="' . $menu_item->url . '" data-toggle="modal" data-target="' . $menu_item->url . '" target="' . $menu_item->target . '" class="' . $class . '">' . $menu_item->title . '</a></li>';
                                                  }
                                                  $menu_list .= '</ol>';
                                              }
                                              echo $menu_list;
                                          ?>
                                        </div>
                                    </div>
                                  <?php endif;  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="seccion_2">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="image">
                            <?php $seccion_2_imagen = get_field('seccion_2_imagen'); ?>
							              <img class="img-responsive" src="<?php echo $seccion_2_imagen['url']; ?>">
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="titulo">
                            <?php the_field('seccion_2_titulo'); ?>
                        </div>
                        <div class="contenido">
                            <?php the_field('seccion_2_contenido'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="seccion_3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="titulo">
                            <?php the_field('seccion_3_titulo'); ?>
                        </div>
                        <div id="owl-seccion_3" class="contenido">
                            <?php
                      					$args = array(
                      						      'post_type' => 'testimonios',
                                        'posts_per_page' => -1,
                      					);
                      					$query = new WP_Query( $args );
                      					if ( $query->have_posts() ) {
                        					   while ( $query->have_posts() ) : $query->the_post();
                    				?>
                    				<div>
                    					     <?php the_content(); ?>
                    				</div>
                    				<?php
                      				        endwhile;
                    					  }
                    					  wp_reset_postdata();
                    				?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="seccion_4">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="titulo">
                            <?php the_field('seccion_4_titulo'); ?>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="subimage">
                            <?php $seccion_4_subimage_1 = get_field('seccion_4_subimage_1'); ?>
                            <img src="<?php echo $seccion_4_subimage_1['url']; ?>">
                        </div>
                        <div class="subtitulo">
                            <?php the_field('seccion_4_subtitulo_1'); ?>
                        </div>
                        <div class="subcontenido">
                            <?php the_field('seccion_4_subcontenido_1'); ?>
                        </div>
                    </div>
                    <div class="col-xs-4 box">
                          <div class="subimage">
                              <?php $seccion_4_subimage_2 = get_field('seccion_4_subimage_2'); ?>
                              <img src="<?php echo $seccion_4_subimage_2['url']; ?>">
                          </div>
                          <div class="subtitulo">
                              <?php the_field('seccion_4_subtitulo_2'); ?>
                          </div>
                          <div class="subcontenido">
                              <?php the_field('seccion_4_subcontenido_2'); ?>
                          </div>
                    </div>
                    <div class="col-xs-4 box">
                        <div class="subimage">
                            <?php $seccion_4_subimage_3 = get_field('seccion_4_subimage_3'); ?>
                            <img src="<?php echo $seccion_4_subimage_3['url']; ?>">
                        </div>
                        <div class="subtitulo">
                            <?php the_field('seccion_4_subtitulo_3'); ?>
                        </div>
                        <div class="subcontenido">
                            <?php the_field('seccion_4_subcontenido_3'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="seccion_5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <?php the_field('seccion_5_parallax'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="seccion_6">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div id="owl-seccion_6">
                            <div>
                                <div class="row">
                                <?php
                                    $args = array(
                                            'post_type' => 'galeria',
                                            'posts_per_page' => -1,
                                    );
                                    $query = new WP_Query( $args );
                                    if ( $query->have_posts() ) {
                                         $item = 0;
                                         while ( $query->have_posts() ) : $query->the_post();
                                            $item++;
                                            $seccion_6_image = get_field('seccion_6_image'); ?>
                                            <div class="col-xs-4">
                                                <div class="image">
                                                    <img class="img-responsive" src="<?php echo $seccion_6_image['url']; ?>">
                                                </div>
                                            </div>
                                            <?php

                                            if ($item==3) {
                                              $item++;
                                              echo '</div><div class="row">';
                                            }
                                            if ($item>6) {
                                              $item = 0;
                                              echo '</div></div><div><div class="row">';
                                            }
                                          endwhile;
                                    }
                                    wp_reset_postdata();
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="seccion_7">
            <div class="container">
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        <div class="titulo">
                            <?php the_field('seccion_7_titulo'); ?>
                        </div>
                    </div>
                    <div class="col-xs-8 col-xs-offset-2">
                        <div class="row">
                            <div class="col-xs-4">
                                <table>
                                  <tr>
                                    <td width="25px" valign="top"><i class="fa fa-map-marker" aria-hidden="true"></i></td>
                                    <td><?php the_field('seccion_7_direccion'); ?></td>
                                  </tr>
                                  <tr>
                                    <td width="25px" valign="top"><i class="fa fa-phone" aria-hidden="true"></i></td>
                                    <td><?php the_field('seccion_7_telefono'); ?></td>
                                  </tr>
                                  <tr>
                                    <td width="25px" valign="top"><i class="fa fa-envelope" aria-hidden="true"></i></td>
                                    <td><?php the_field('seccion_7_correo'); ?></td>
                                  </tr>
                                </table>
                            </div>
                            <div class="col-xs-8">
                                <?php the_field('seccion_7_formulario'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
      endwhile;
include(TEMPLATEPATH.'/includes/footer.php');
?>
