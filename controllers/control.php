<?php namespace F13\YouTube\Controllers;

class Control
{
    public function __construct()
    {
        add_shortcode('youtube', array($this, 'shortcode'));
    }

    public function shortcode($atts = array())
    {
        extract(shortcode_atts(array('video' => '', 'autoplay' => false), $atts));

        if (empty($video)) {
            return '<div class="f13-youtube-error">'.__('The "video" attribute is required.').'</div>';
        }

        $v = new \F13\YouTube\Views\Youtube(array(
            'autoplay' => $autoplay,
            'video' => $video,
        ));

        return $v->shortcode();
    }
}