<?php

namespace Estatik\Filters;

class SingleBooking
{
    /**
     * SingleBooking Constructor
     */
    public function __construct()
    {
        add_filter('the_content', [$this, 'add_booking_options_after_content']);
    }

    /**
     * Add booking options after content on singular.
     * @param $content
     * @return string
     */
    public function add_booking_options_after_content($content): string
    {
        if (is_singular('booking')) {
            $start_date = get_post_meta(get_the_ID(), 'estatik_booking_start_date', true);
            $end_date = get_post_meta(get_the_ID(), 'estatik_booking_end_date', true);
            $address = get_post_meta(get_the_ID(), 'estatik_booking_address', true);

            $content .= '
                <div><b>Start date:</b> ' .
                timestamp_to_viewable_date($start_date) .
                '</div><div><b>End date:</b> ' .
                timestamp_to_viewable_date($end_date) .
                '</div><div>' . $this->get_map($address) . '</div>'
            ;
        }

        return $content;
    }

    /**
     * Get selected address on the map.
     * @param $address
     * @return string
     */
    private function get_map($address): string
    {
        if (!empty($address)) {
            return '
                <iframe                 
                    width="100%"  
                    height="450"  
                    frameborder="0" 
                    scrolling="no"                 
                    src="https://maps.google.com/maps?width=100%&amp;height=100%&amp;hl=en&amp;q=' . $address . '&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                    ></iframe>
            ';
        }

        return 'Map not available, address not exists.';
    }
}

