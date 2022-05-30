<?php
/**
 * Zubin Pro Import Files include for CTDI/OCDI
 * 
 * @package Zubin
 */

 /**
  * Scan import directory and set its contents for CTDI and OCDI to import
  */
function chique_set_import_files() {
    $scan = scandir( get_template_directory() . '/imports' );
    $import_array = array();
    $current_theme = wp_get_theme();

    foreach( $scan as $file ) {
       if ( is_dir( get_template_directory() . '/imports/' . $file ) && '.' != $file && '..' != $file ) {
            $import_array[ $file ] = array(
                'import_file_name'           => str_replace( ' Pro', '', $current_theme->get( 'Name' ) ) . '&nbsp;' . ucfirst( $file ),
                'import_file_url'            => esc_url( get_template_directory_uri() . "/imports/{$file}/demo-content.xml" ),
                'import_widget_file_url'     => esc_url( get_template_directory_uri() . "/imports/{$file}/widgets.wie" ),
                'import_customizer_file_url' => esc_url( get_template_directory_uri() . "/imports/{$file}/customizer.dat" ),
                'import_preview_image_url'   => esc_url( get_template_directory_uri() . "/imports/{$file}/preview-image.jpg" ),
                'preview_url'                => esc_url( "https://catchthemes.com/demo/{$current_theme->get( 'TextDomain' )}" ),
            );
        }
    }

    return $import_array;
}
add_filter( 'cp-ctdi/import_files', 'chique_set_import_files' );
