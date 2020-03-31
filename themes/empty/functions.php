<?php

function mt_array_rand($array, $num = 1) {
    $count = count($array);

    if ($num > $count) {
        return null;
    }

    $result = '';
    for ($i = 0; $i < $num; $i++) {
        $rand = mt_rand(0, $count - 1);
        $result .= $array[$rand];
    }

    return $result;
}

function make_rand_str() {
    $str = array_merge(range(0, 9), range('a','f'), range('A', 'F'));
    $digit = 5;

    return mt_array_rand($str, $digit);
}

function auto_post_slug($override_slug, $slug, $post_ID, $post_status, $post_type) {
    if ($post_type !== 'post')
        return $override_slug;

    $post = get_post($post_ID);
    if (is_null($post) || $slug !== $post->post_name) {
        $override_slug = make_rand_str();
    }

    return $override_slug;
}

add_filter('pre_wp_unique_post_slug', 'auto_post_slug', 10, 5);

?>