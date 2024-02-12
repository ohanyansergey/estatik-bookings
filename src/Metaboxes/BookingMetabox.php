<?php

namespace Estatik\Metaboxes;

use Estatik\Interfaces\MetaboxInterface;

class BookingMetabox implements MetaboxInterface
{
    /**
     * BookingMetabox Constructor
     */
    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_metabox']);
        add_action('save_post', [$this, 'save_metabox']);
    }

    /**
     * Add booking metabox.
     * @return void
     */
    public function add_metabox(): void
    {
        add_meta_box(
            'estatik_booking_metabox',
            __('Booking Options'),
            [$this, 'metabox_callback'],
            'booking',
            'normal',
            'high'
        );
    }

    /**
     * Rendering booking metabox.
     * @param $post
     * @return void
     */
    public function metabox_callback($post): void
    {
        wp_nonce_field( 'estatik_booking_save_metabox_nonce', 'estatik_booking_save_metabox_nonce_field' );

        $start_date = get_post_meta($post->ID, 'estatik_booking_start_date', true);
        $end_date = get_post_meta($post->ID, 'estatik_booking_end_date', true);
        $address = get_post_meta($post->ID, 'estatik_booking_address', true);
        ?>
        <div class="estatik-metabox-wrap">
            <div>
                <label for="start_date">Start Date</label>
                <input type="text" id="start_date" name="start_date" value="<?= esc_attr(timestamp_to_date($start_date)) ?>" class="datepicker">
            </div>
            <div>
                <label for="end_date">End Date</label>
                <input type="text" id="end_date" name="end_date" value="<?= esc_attr(timestamp_to_date($end_date)) ?>" class="datepicker">
            </div>
            <div>
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?= esc_attr($address) ?>">
            </div>
        </div>
        <?php
    }

    /**
     * Save data from booking metabox.
     * @param $post_id
     * @return void
     */
    public function save_metabox($post_id): void
    {
        if (!isset($_POST['estatik_booking_save_metabox_nonce_field'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['estatik_booking_save_metabox_nonce_field'], 'estatik_booking_save_metabox_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (isset($_POST['start_date'])) {
            update_post_meta($post_id, 'estatik_booking_start_date', sanitize_text_field(to_timestamp($_POST['start_date'])));
        }

        if (isset($_POST['end_date'])) {
            update_post_meta($post_id, 'estatik_booking_end_date', sanitize_text_field(to_timestamp($_POST['end_date'])));
        }

        if (isset($_POST['address'])) {
            update_post_meta($post_id, 'estatik_booking_address', sanitize_text_field($_POST['address']));
        }
    }
}