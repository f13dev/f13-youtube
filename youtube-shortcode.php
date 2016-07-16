<?php
/*
Plugin Name: F13 Youtube Shortcode
Plugin URI: http://f13dev.com/wordpress-plugin-youtube-shortcode/
Description: Embed a Youtube video into your blog with shortcode
Version: 1.0
Author: Jim Valentine - f13dev
Author URI: http://f13dev.com
Text Domain: f13-youtube-shortcode
License: GPLv3
*/

/*
Copyright 2016 James Valentine - f13dev (jv@f13dev.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/
add_shortcode( 'youtube', 'f13_youtube_shortcode');

/**
* Function to handle the shortcode
* @param  Array  $atts    The attributes set in the shortcode
* @param  [type] $content [description]
* @return String          The response of the shortcode
*/
function f13_youtube_shortcode( $atts, $content = null )
{
        // Get the attributes
        extract( shortcode_atts ( array (
        'video' => '', // Default video_id of null
        'autoplay' => '' // Default autoplay of 0
    ), $atts ));

    // Check if a youtube video id has been entered
    if ($video == '')
    {
        // If no postcode has been entered, allert the user
        $string = 'The \'video\' attribute is required.';
    }
    else
    {
        // Check if autoplay is 'true' or '1', if not set it to 0.
        if ($autoplay == 'true')
        {
            $autoplay = '1';
        }
        // If autoplay is 'true', set it to '1'.
        else
        {
            $autoplay = '0';
        }
        // Create the video iframe
        $string = '
        <iframe id="ytplayer" type="text/html" width="640" height="390"
        src="https://www.youtube.com/embed/' . $video . '?autoplay=' . $autoplay . '"
        frameborder="0">
        </iframe>';
    }
    // Return the newly created string
    return $string;
}
