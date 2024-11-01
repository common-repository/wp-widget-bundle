<?php
/**
 * Class responsible for set and remove featured link image backend.
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/class-featured-image
 * @author     Devnath verma <devnathverma@gmail.com>
 */
if ( ! class_exists( 'WB4WP_Featured_Link_Image' ) ) {
	
	/**
	 * Featured image class.
	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	class WB4WP_Featured_Link_Image {
		
		/**
		 * Sets up the Featured Image
		 */
		public function __construct() {
			
			add_action( 'add_meta_boxes', array( $this, 'widget_bundle_link_image_metabox' ) );
			add_action( 'add_link', array( $this, 'widget_bundle_link_image_save' ), 10, 1 );
			add_action( 'edit_link', array( $this, 'widget_bundle_link_image_edit' ), 10, 1 );
			add_action( 'admin_print_scripts', array( $this, 'widget_bunlde_links_scripts' ) );
		}
	
		/**
		 * Adds the Featured Image meta box container in links manager
		 *
		 * @package widget-bundle
		 *
		 * @since   1.0.0
		 */
		public function widget_bundle_link_image_metabox() {
			
			add_meta_box( 
				'widget_bundle_display_link_image', 
				__( 'Featured Image', 'widget-bundle' ), 
				array( $this, 'widget_bundle_display_link_image' ), 
				'link', 
				'side', 
				'default'
			);
		}
		
		/**
		 * Set and Remove featured link image meta box container in links manager
		 *
		 * @package widget-bundle
		 *
		 * @since   1.0.0
		 */
		public function widget_bundle_display_link_image ( $post ) {
			
			global $content_width, $_wp_additional_image_sizes;
			
			$image_id = get_post_meta( $post->link_id, 'widget_bundle_link_image_id', true );
			$old_content_width = $content_width;
			$content_width = 254;
		
			if ( isset( $image_id ) && ! empty( $image_id ) ) {
		
				if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
					$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ), '', array( 'id' => 'widget_bundle_link_image_url' ) );
				} else {
					$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail', '', array( 'id' => 'widget_bundle_link_image_url' ) );
				}
		
				if ( ! empty( $thumbnail_html ) ) {
					$content = $thumbnail_html;
					$content .= '<p class="hide-if-no-js"><a href="javascript:void(0);" id="widget_bundle_remove_link_image">' . esc_html__( 'Remove featured image', 'widget-bundle' ) . '</a></p>';
					$content .= '<input type="hidden" id="widget_bundle_link_image_id" name="widget_bundle_link_imgid" value="' . esc_attr( $image_id ) . '" />';
				}
		
				$content_width = $old_content_width;
			
			} else {
		
				$content = '<img src="" id="widget_bundle_link_image_url" style="width:' . esc_attr( $content_width ) . 'px; height:auto; border:0;" />';
				$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set featured image', 'widget-bundle' ) . '" href="javascript:void(0);" id="widget_bundle_link_image_upload">' . esc_html__( 'Set featured image', 'widget-bundle' ) . '</a></p>';
				$content .= '<input type="hidden" id="widget_bundle_link_image_id" name="widget_bundle_link_imgid" value="" />';
		
			}
		
			echo $content;
		}
		
		/**
		 * Save featured link image ID in post meta 
		 *
		 * @package widget-bundle
		 *
		 * @since   1.0.0
		 */
		public function widget_bundle_link_image_save ( $post_id ) {
			
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;
			
			if ( ! isset( $_POST['widget_bundle_link_imgid'] ) )
			return;
			
			add_post_meta( $post_id, 'widget_bundle_link_image_id', $_POST['widget_bundle_link_imgid'] );
		}
		
		/**
		 * Update featured link image ID in post meta
		 *
		 * @package widget-bundle
		 *
		 * @since   1.0.0
		 */
		public function widget_bundle_link_image_edit ( $post_id ) {
			
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;
			
			if ( ! isset( $_POST['widget_bundle_link_imgid'] ) )
			return;
			
			update_post_meta( $post_id, 'widget_bundle_link_image_id', $_POST['widget_bundle_link_imgid'] );
		}
		
		/**
		 * Register the scripts for the admin facing side of the site.
		 *
		 * @package widget-bundle
		 *
		 * @since   1.0.0
		 */
		public function widget_bunlde_links_scripts() {
			
			wp_enqueue_media();	
			wp_enqueue_script( 'widget-bundle-links-image', WB4WP_PLUGIN_JS . 'widget-bundle-links-image.js', array('jquery') );
		}
	}
}