<?php
global $wpdb, $post;
echo '<h3>';

esc_html_e('Zcount Post Views', 'zcountpost');
echo '</h3>';
echo '<form name="zcount" method="POST" action="">';
echo '<table class="form-table">';
echo '<th scope="row">';
esc_html_e('Выберите страницу на котрой будет отображаться число просмотров:', 'zcountpost');
echo '</th>';
$args = array(
    'public' => true,
    '_builtin' => false
);
$output = 'names';

$post_types = get_post_types($args, $output);
foreach ($post_types as $post_type) {
    //    $aDoor1 = get_option('check');
    //    if (checked($aDoor1))
    //    {
    //
    //    }
    echo '<tr>';
    echo '<td><label><input type="checkbox" name="check[]">' . $post_type . '</input></label></td>';
    echo '</tr>';
}
echo '</table>';
echo '<input name="submit" type="submit" value="Сохранить">';
echo '</form>';

$aDoor = $_POST['check'];
if (empty($aDoor)) {
    esc_html_e("Вы ничего не выбрали.", "zcountpost");
} else {
    $N = count($aDoor);
    esc_html_e("Вы выбрали $N страницу(ы): ", "zcountpost");
    for ($i = 0; $i < $N; $i++) {
        echo($aDoor[$i] . " ");
    }
}