<div class="container-fluid">
    <div id="page_header">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="logo_page">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo('name'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/eventti-by-eleganza.png" class="img-responsive" alt="<?php bloginfo('name'); ?>">
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-4 col-xs-offset-4">
                        <div class="row">
                            <?php if (is_user_logged_in()): ?>
                            <div class="col-xs-12">
                                <div class="social">
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
</div>
<div class="container">
    <div id="page_header">
        <div class="row">
            <div class="col-xs-12">
                <ol class="breadcrumb">
                    <?php
                    if(function_exists('bcn_display')){
                        bcn_display();
                    }
                    ?>
                </ol>
            </div>
        </div>
    </div>
</div>
