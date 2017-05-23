<?php

/**
 * Class zCountPost
 * Author: zTeam (o.sukhovetskyi@zteam.org)
 * Text Domain: wp-plugin-zcount-post
 */
class zCountPost
{
    function __construct()
    {
        add_filter('the_content', array($this, 'post_views_count'));
        add_action('wp', array($this, 'post_insert_db'));
    }

    public function post_check_id($id)
    {
        global $wpdb;
        $tb_name = "count_views_db";
        $table_name = $wpdb->prefix . $tb_name;
        $row = $wpdb->get_row($wpdb->prepare('SELECT id FROM ' . $table_name . ' WHERE item = %d', $id));
        if ($row->id != "")
            return true;
        else return false;
    }

    public function post_insert_db()
    {
        global $wpdb, $post;
        if (!is_single()) return;
        $id = $post->ID;
        $tb_name = "count_views_db";
        $table_name = $wpdb->prefix . $tb_name;

        if ($this->post_check_id($id)) {
            $views = $wpdb->get_row($wpdb->prepare('SELECT value FROM ' . $table_name . ' WHERE item = ' . $id, null));
            $view = $views->value;
            $wpdb->update($table_name, array('value' => $view + 1), array('item' => $id));
        } else {
            $wpdb->insert(
                $table_name,
                array(
                    'item' => $id,
                    'value' => '1'
                ),
                array(
                    '%d',
                    '%d'
                )
            );
        }
    }

    public function post_views_count($content)
    {
        if (!is_single()) return $content;
        global $wpdb;
        $tb_name = "count_views_db";
        $table_name = $wpdb->prefix . $tb_name;
        global $wp_query;
        $postid = $wp_query->post->ID;

        $row = $wpdb->get_row($wpdb->prepare('SELECT value FROM ' . $table_name . ' WHERE item = ' . $postid, null));

        return '<h3><b>  Количество просмотров этой страницы ' . $row->value . '</b></h3>  <p>' . $content . '</p>';
    }
}