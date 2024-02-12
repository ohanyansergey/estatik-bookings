<?php

// Register custom post type Booking
add_action('init', 'estatik_register_booking_post_type', 1);
function estatik_register_booking_post_type() {
    $labels = [
        'name'                  => __('Bookings'),
        'singular_name'         => __('Booking'),
        'menu_name'             => __('Bookings'),
        'name_admin_bar'        => __('Booking'),
        'archives'              => __('Booking Archives'),
        'attributes'            => __('Booking Attributes'),
        'parent_item_colon'     => __('Parent Booking:'),
        'all_items'             => __('All Bookings'),
        'add_new_item'          => __('Add New Booking'),
        'add_new'               => __('Add New'),
        'new_item'              => __('New Booking'),
        'edit_item'             => __('Edit Booking'),
        'update_item'           => __('Update Booking'),
        'view_item'             => __('View Booking'),
        'view_items'            => __('View Bookings'),
        'search_items'          => __('Search Booking'),
        'not_found'             => __('Booking not found'),
    ];

    $args = [
        'label'                 => __('Booking'),
        'description'           => __('Booking information'),
        'labels'                => $labels,
        'supports'              => ['title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'],
        'taxonomies'            => ['category', 'post_tag'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'menu_icon'             => 'dashicons-list-view',
    ];

    register_post_type('booking', $args);
}