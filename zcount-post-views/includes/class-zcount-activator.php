<?php

class zCountActivator
{
    public static function activate()
    {
        global $wpdb;
        $tb_name = "count_views_db";
        $table_name = $wpdb->prefix . $tb_name;
        $sql = "CREATE TABLE $table_name (
         id int(11) NOT NULL AUTO_INCREMENT,
         item int(11) DEFAULT NULL,
         value int(11) NOT NULL DEFAULT 0,
        UNIQUE KEY id (id)
    );";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}