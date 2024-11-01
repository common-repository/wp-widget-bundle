<?php
/**
 * This class Prints Admin Wizard HTML of Widget Bundle Plugin in admin Section.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/admin/view/class-admin-wizard
 * @author     Devnath verma <devnathverma@gmail.com>
 */
class WB4WP_Admin_Wizard {
		
	/**
	 * This class Prints Admin Wizard HTML of Widget Bundle Plugin in admin Section.
	 *
	 * @since      1.0.0
	 *
	 * @package    widget-bundle
	 * @subpackage widget-bundle/admin/view/class-admin-wizard
	 * @author     Devnath verma <devnathverma@gmail.com>
	 */
	public static function wb4wp_wizard( $widget_options, $widget_messages ) { ?>

		<div class="wb4wp-container-fluid">
			<div class="pt-4 col-md-11">
				<form id="wb4wp-wizard-form" class="wb4wp-wizard-form" action="<?php echo admin_url( 'admin.php' ); ?>?page=widget-bundle" method="post">		
					<div class="row">
						<ul class="wb4wp-nav-tabs">
							<li>
								<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>widget-bundle-logo.JPG" alt="branding" class="label-icon-default">
							</li>
						</ul>
					</div>
					<?php if( ! empty( $widget_messages ) ) : ?>
						<div class="wb4wp-update"><?php echo $widget_messages; ?></div>	
					<?php endif; ?>
					<?php include WB4WP_PLUGIN_ADMIN . 'view/widget-types.php'; ?> 
				</form>
			</div>		
		</div>
		
	<?php } } ?>