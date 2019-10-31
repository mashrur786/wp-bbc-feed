<?php


class WP_BBC_Feed extends WP_Widget{


	function __construct() {

		// Instantiate the parent object.
        parent::__construct( false, __( 'WP BBC Feed', 'wpBBCFeed' ) );
	}

	/**
     * The widget's HTML output.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Display arguments including before_title, after_title,
     *                        before_widget, and after_widget.
     * @param array $instance The settings for the particular instance of the widget.
     */
    function widget( $args, $instance ) {

    	$html =  get_transient('bbc_rss_feed');

    	//die(var_dump($html));
    	if ( !$html ){

	            if(function_exists('fetch_feed')){
	            include_once(ABSPATH.WPINC.'/feed.php');
	            $feed = fetch_feed('http://feeds.bbci.co.uk/news/rss.xml');
	            $limit = $feed->get_item_quantity(10); // specify number of items
	            $items = $feed->get_items(0, $limit); // create an array of items

			     if ($limit == 0) {
			     	echo '<div>The feed is either empty or unavailable.</div>';
			     } else {

			     	$html .= '<h2> BBC News Feed </h2>';
			        $html .= '<ul>';
			        foreach ($items as $item){

			            $html .= '<li>';
			            $html .=  '<a href="' . $item->get_permalink() . '"';
			            $html .=  'title="' . $item->get_date('j F Y @ g:i a') . '">';
	                    $html .=  $item->get_title();
	                    $html .=  ' ( ' . $item->get_date('j F Y at g:i a') . ' ) ' ;
	                    $html .= '</a>';
	                    $html .=  '<br><small>';
	                    $html .=  substr($item->get_description(), 0, 200);
	                    $html .=  '</small>';
			            $html .=  '</li><br>';

			        }
			        $html .=  '</ul>';

			        echo $html;
			        set_transient( 'bbc_rss_feed', $html , 60 * 1 );
			     }
			}
	    } else {

    		   echo $html;
	    }


    }


    /**
     * The widget update handler.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance The new instance of the widget.
     * @param array $old_instance The old instance of the widget.
     * @return array The updated instance of the widget.
     */
    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

	/**
     * Output the admin widget options form HTML.
     *
     * @param array $instance The current widget settings.
     * @return string The HTML markup for the form.
     */
    function form( $instance ) {
        return '';
    }


}
