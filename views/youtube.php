<?php namespace F13\YouTube\Views;

class Youtube
{
    public function __construct($params = array())
    {
        foreach ($params as $k => $v) {
            $this->{$k} = $v;
        }
    }

    public function shortcode()
    {
        $v = '<div class="f13-youtube-container">';
            $v .= '<iframe ';
                $v .= 'type="text/html" ';
                $v .= 'src="https://www.youtube.com/embed/'.$this->video.'?autoplay='.($this->autoplay ? '1' : '0').'"';
            $v .= '></iframe>';
        $v .= '</div>';

        return $v;
    }
}