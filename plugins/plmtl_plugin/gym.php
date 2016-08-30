
<?php 
/**
* Registers project post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function plmtl_register_gyms() {

  $labels = array(
    'name'                => __( 'Gyms', 'plmtl' ),
    'singular_name'       => __( 'Gym', 'plmtl' ),
    'add_new'             => _x( 'Add New Gym', 'plmtl', 'plmtl' ),
    'add_new_item'        => __( 'Add New Gym', 'plmtl' ),
    'edit_item'           => __( 'Edit Gym', 'plmtl' ),
    'new_item'            => __( 'New Gym', 'plmtl' ),
    'view_item'           => __( 'View Gym', 'plmtl' ),
    'search_items'        => __( 'Search Gyms', 'plmtl' ),
    'not_found'           => __( 'No Gyms found', 'plmtl' ),
    'not_found_in_trash'  => __( 'No Gyms found in Trash', 'plmtl' ),
    'parent_item_colon'   => __( 'Parent Gym:', 'plmtl' ),
    'menu_name'           => __( 'Gyms', 'plmtl' ),
  );
  $rewrite = array(
    'slug'                => 'gyms',
    'with_front'          => true,
    'pages'               => false,
    'feeds'               => false
    );
  $args = array(
    'labels'              => $labels,
    'hierarchical'        => false,
    'description'         => 'description',
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => null,
    'menu_icon'           => null,
    'show_in_nav_menus'   => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'has_archive'         => true,
    'query_var'           => true,
    'can_export'          => true,
    'rewrite'             => $rewrite,
    'capability_type'     => 'post',
    'supports'            => array( 'title','editor','custom-fields' )
  );

  register_post_type( 'gyms', $args );
}

add_action( 'init', 'plmtl_register_rules', 0 );

/** 
/ Register the form
/
*/

add_action( 'cmb2_init', 'plmtl_meta_rules');
function plmtl_meta_rules() {
 
    $cmb = new_cmb2_box( array(
    'id'           => 'gym',
    'title'        => __('Rules', 'plmtl'),
    'object_types' => array( 'gyms' ),
    'context'      => 'normal',
    'priority'     => 'high',
  ) );

    $cmb->add_field( array(
    'name' => __( 'Leader', 'plmtl' ),
    'id' => 'plmtl_gyms_leader',
    'type' => 'text'
  ) );
    $cmb->add_field( array(
    'name' => __( 'Game Name', 'plmtl' ),
    'id' => 'plmtl_gyms_ot',
    'type' => 'text',
  ) );
    $cmb->add_field( array(
    'name' => __( 'Format', 'plmtl' ),
    'id' => 'plmtl_gyms_type',
     'type'             => 'select',
    'show_option_none' => true,
    'default'          => 'single',
    'options'          => array(
        'single'     => __( 'Single', 'plmtl' ),
        'double'     => __( 'Doubles', 'plmtl' ),
        'triple'     => __( 'Triple', 'plmtl' ),
        'rotation'   => __( 'Rotation', 'plmtl' )
        ),
   ) );
    $cmb->add_field( array(
    'name' => __( 'Battle Style', 'plmtl' ),
    'id' => 'plmtl_gyms_style',
    'type' => 'text',
  ) );
    $cmb->add_field( array(
    'name'    => 'Old Badges',
    'desc'    => 'Upload an old badge the new one needs to be a featured image.',
    'id'      => 'plmtl_gyms_obadge',
    'type'    => 'file',
    // Optional:
    'options' => array(
        'url' => false, // Hide the text input for the url
    ),
    'text'    => array(
        'add_upload_file_text' => 'Add a badge' // Change upload button text. Default: "Add or Upload File"
    ),
) );

}