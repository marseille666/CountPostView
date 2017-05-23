<?php

/*
Plugin Name: ZCount Post Views
Description: calculating the number of posts read
Author: zTeam (o.sukhovetskyi@zteam.org)
Version: 1.0
*/

//name of directory (wp-includes)
if (!defined('WPINC')) {
    die;
}

const ZCOUNT_POST_VIEWS = 'zcount-post-views';


function activate_plugin_name()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-zcount-activator.php';
    zCountActivator::activate();
}

//function which is start when activate plugin
register_activation_hook(__FILE__, 'activate_plugin_name');


require plugin_dir_path(__FILE__) . 'includes/class-zcount-post.php';


function run_zcount_post()
{
    $plugin = new zCountPost();
}

run_zcount_post();

//ADMIN PANEL

//(Настройки - ZcountPost) (not work)
function admin_count()
{
    include 'settings.php';
}

//added new options in settings Wordpress
function zpost_add_options()
{
    add_options_page('Count Post Views', 'ZCount Post Views', 8, ZCOUNT_POST_VIEWS, 'admin_count');
}

add_action('admin_menu', 'zpost_add_options');
