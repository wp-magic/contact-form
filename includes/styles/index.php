<?php
function magic_cf_enqueue_styles() {
  wp_enqueue_style( 'magic_cf', plugin_dir_url(__FILE__ ) . 'magic_cf.less', -1 );
}
