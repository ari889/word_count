<?php

/**
 * Plugin Name: Word Count
 * Plugin URI: http://google.com
 * Description: This is a demo plugin
 * Version: 1.0
 * Author: Arijit
 * Licence: GPLv2 or latest
 * Text Domain: word-count
 * Domain Path: /Languages/
 */

//function wordcount_activation_hook(){
//
//}
//
//register_activation_hook(__FILE__, 'wordcount_activation_hook');
//
//function wordcount_deactivation_hook(){
//
//}
//
//register_deactivation_hook(__FILE__, 'wordcount_deactivation_hook');

function wordcount_load_textdomain(){
    load_plugin_textdomain('word-count', false, dirname(__FILE__).'/languages');
}

add_action('plugin_loaded', 'wordcount_load_textdomain');

function wordcount_count_words($content){
    $stripped_content = strip_tags($content);
    $wordn = str_word_count($stripped_content);
    $label = __('Total number of words', 'word-count');
    $label = apply_filters("wordcount_heading", $label);
    $tag = apply_filters("wordcount_tag", 'h2');
    return $content;
}

add_filter('the_content', 'wordcount_count_words');

function wordcount_reading_time($content){
    $stripped_content = strip_tags($content);
    $wordn = str_word_count($stripped_content);
    $reading_munite = floor($wordn/200);
    $reading_second= ceil($wordn % 200 / (200/60));
    $is_visit = apply_filters('wordcount_display_reading', 1);
    if($is_visit){
        $label = __('Total number of words', 'word-count');
        $label = apply_filters("wordcount_readingtimeheading", $label);
        $tag = apply_filters("wordcount_reading_tag", 'h4');
        $content .= sprintf('<%s>%s: %s minutes %s seconds</%s>', $tag, $label, $reading_munite, $reading_second, $wordn, $tag);
    }
    return $content;
}


add_filter('the_content', 'wordcount_reading_time');