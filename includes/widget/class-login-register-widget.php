<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-login-register-widget
 */

/**
 * The main widget class.
 *
 *
 * @since      1.0.0
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-login-register-widget
 * @author     Devnath verma <devnathverma@gmail.com>
 */
ob_start();
if ( ! class_exists( 'WB4WP_Login_Register_Widgets' ) ) {
	
	/**
	 * Login & Register widget class.
	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	class WB4WP_Login_Register_Widgets extends WP_Widget {
	
		/**
		 * Setup widget options.
		 *
		 * Child classes may override the defaults.
		 *
		 * @since 1.0.0
		 * @see   WP_Widget::construct()
		 *
		 * @param string $id_base Optional Base ID for the widget, lower case, if
		 *     left empty a portion of the widget's class name will be used. Must be unique.
		 * @param string $name Name for the widget displayed on the configuration page.
		 * @param array  $widget_options {
		 *     Widget options. Passed to wp_register_sidebar_widget(). Optional.
		 *
		 *	   @type string $description Widget description. Shown on the configuration page.
		 *	   @type string $classname   HTML class.
		 * }
		 * @param array $control_options {
		 *     Passed to wp_register_widget_control(). Optional.
		 *
		 *	   @type int $width  Width of the widget edit form.
		 * )
		 */
		public function __construct() {
			
			// Set up the widget options.
			$widget_options = array(
				'classname'   => 'wb-login-register-widget',
				'description' => __( 'A widget that display the login and register form.', 'widget-bundle' ),
				'customize_selective_refresh' => true
			);
			
			// Control the width and height
			$control_options = array(
				'id_base' => 'wb-login-register-widget'
			);
			
			// Create the widget
			parent::__construct( 'wb-login-register-widget', 'WB Login & Register', $widget_options, $control_options );
		}
		
		/**
		 * Method is used to add setting fields to the widget which will be 
	 	 * displayed in the WordPress admin area
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance The widget settings.
		 */
		public function form( $instance ) {
		
			// Merge the user selected arguments with the defaults.
			$instance = wp_parse_args( (array) $instance, $this->widget_default_args() );
	
			// Extract the array to allow easy use of variables.
			extract( $instance ); 
			
			include WB4WP_PLUGIN_INCLUDES . 'widget-form/widget-login-register-form.php';
		}
		
		/**
		 * Method to define the widget output that will be displayed on the site front end.
		 *
		 * Filters the instance data, fetches the output, displays it.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Registered sidebar arguments including before_title, after_title, before_widget, and after_widget.
		 * @param array $instance The widget instance settings.
		 */
		public function widget( $args, $instance ) { 
			
			extract( $args );
			$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'] );
			
			// Output the theme's $before_widget wrapper.
			echo $args['before_widget'];
			
			// If the title not empty, display it.
			if ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) {
					
				echo $args['before_title'] . $instance['title'] . $args['after_title'];
			}
			
			if ( empty( $instance['logout_redirect_url'] ) ) { 
			
				$logout_redirect_url = get_bloginfo('url');
			
			} else {
			
				$logout_redirect_url = $instance['logout_redirect_url'];
			}
			
			if( is_user_logged_in() ) {
				
				$user_data = get_user_by( 'id', get_current_user_id() );
				
				if( $instance['login_show_widget'] ) {
					
					echo '<div class="wb4wp-container">';
						echo '<div class="wb4wp-container-inner wb4wp-avatar-align-'.$instance['login_avatar_align'].' wb4wp-avatar-shape-'.$instance['login_avatar_shape'].'">';
							
							if( $instance['login_user_avatar'] ) :
								echo get_avatar( get_current_user_id(), $instance['login_avatar_size'] );
							endif;
							
							if ( isset( $instance['login_title'] ) && ! empty( $instance['login_title'] ) ) :
								echo '<'.$instance['login_title_tag'].' class="widget-bundle-title">';
									$ph_variables = array(
										'username'  => stripcslashes( $user_data->user_login )
									);
									if( $ph_variables ) :  
										foreach($ph_variables as $phk => $ph_variable) :
											echo str_replace('%'.strtolower($phk).'%', $ph_variable, $instance['login_title']);
										endforeach;
									endif;
								echo '</'.$instance['login_title_tag'].'>';
							endif;
							
							echo '<p class="description">';
							echo '<a href="'.admin_url().'">'.__( 'Dashboard', 'widget-bundle' ).'</a></br>';
							echo '<a href="'.admin_url().'profile.php">'.__( 'Profile', 'widget-bundle' ).'</a></br>';
							echo '<a href="'.wp_logout_url( $logout_redirect_url ).'">'.__( 'Logout', 'widget-bundle' ).'</a>';						echo '</p>';			echo '</div>';	
					echo '</div>';
				}
			
			} else {
				
				echo '<div class="wb4wp-container">';
					
					if( ( isset( $_GET['widget-action'] ) && $_GET['widget-action'] == 'login' ) || empty( $_GET['widget-action'] ) ) { 					
						$wb4wp_login_selected = 'selected';
						$wb4wp_register_selected = '';
					
					} else if( isset( $_GET['widget-action'] ) && $_GET['widget-action'] == 'register') { 
						
						$wb4wp_register_selected = 'selected';
						$wb4wp_login_selected = '';
					} 
					
					echo '<ul class="wb4wp-navigation">';
						echo '<li class="active-tab-login '.$wb4wp_login_selected.'">';
						echo '<a href="'.get_bloginfo("url").'?widget-action=login" >';
						_e( 'Login', 'widget-bundle' );
						echo '</a>';
						echo '</li>';
					
						if( isset( $instance['register_link'] ) && $instance['register_link'] ) {
							echo '<li class="active-tab-register '.$wb4wp_register_selected.'">';
							echo '<a href="'.get_bloginfo("url").'?widget-action=register" >';
							_e( 'Register', 'widget-bundle' );
							echo '</a>';
							echo '</li>';
						}
					echo '</ul>';
						
					if( ( isset( $_GET['widget-action'] ) && $_GET['widget-action'] == 'login' ) || empty( $_GET['widget-action'] ) ) { 					
						self::widget_login_form( $instance );
					}
						
					if( isset( $instance['register_link'] ) && $instance['register_link'] ) {
						
						if( isset( $_GET['widget-action'] ) && $_GET['widget-action'] == 'register') { 
							
							self::widget_registration_form( $instance );
						}
					}
					
				echo '</div>';
			}
			
			// Close the theme's widget wrapper.
			echo $args['after_widget'];
		}
		
		/**
		 * Returns the input fields for the login form in frontend side.
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @param array $instance The widget instance settings.
		 */
		static function widget_login_form( $instance ) {
			
			if ( empty( $instance['login_redirect_url'] ) ) {
			 
				$login_redirect_url = get_bloginfo('url');
			
			} else {
			
				$login_redirect_url = $instance['login_redirect_url'];
			}
			
			if ( isset( $_POST['widget_login_submit'] ) && $_POST['widget_login_submit'] ) {
				
				if ( empty( $_POST['login_username'] ) ) {
					
					$error[] = __('Please enter username.', 'widget-bundle');
				}
				
				if ( empty( $_POST['login_password'] ) ) {
					
					$error[] = __('Please enter password.', 'widget-bundle');
				}
				
				$creds = array();
				$creds['user_login']    = esc_attr( $_POST['login_username'] );
				$creds['user_password'] = esc_attr( $_POST['login_password'] );
				$creds['remember']      = isset( $_POST['login_remember'] ) ? (bool) $_POST['login_remember'] : false;
	
				$login_user = wp_signon( $creds, false );
				
				if ( ! empty( $error ) ) {
				
					echo '<div class="wb4wp-error">';
					
					foreach( $error as $err ) {
						
						echo $err.'<br />';
					}
					
					echo '</div>';
					
				} else {
					
					if ( ! is_wp_error( $login_user ) ) {
						
						wp_redirect( trim( $login_redirect_url ) );
					
					} else {
						
						echo '<div class="wb4wp-error">';
						echo $login_user->get_error_message();
						echo '</div>';
					}
				}
			} ?>
			
			<div class="wb4wp-container-inner">
				<form method="post" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>">
					<div class="wb4wp-form-group">
						<input name="login_username" type="text" class="wb4wp-form-control"
									   value="<?php echo(isset($_POST['login_username']) ? $_POST['login_username'] : null); ?>"
									   placeholder="Username" id="reg-lname"/>
						<label class="wb4wp-login-register-icon wb4wp-user" for="reg-lname"></label>
					</div>
					<div class="wb4wp-form-group">
						<input name="login_password" type="password" class="wb4wp-form-control"
									   value="<?php echo(isset($_POST['login_password']) ? $_POST['login_password'] : null); ?>"
									   placeholder="Password" id="reg-pass"/>
						<label class="wb4wp-login-register-icon wb4wp-lock" for="reg-pass"></label>
					</div>
					<p class="description">
						<?php if( isset( $instance['remember_me'] ) && $instance['remember_me'] ) { ?>
						<input type="checkbox" name="login_remember" value="1"<?php if( isset( $instance['login_remember'] ) ) { checked( $_POST['login_remember'], true ); } ?>/> 
						<?php _e( 'Remember me', 'widget-bundle' ); ?>
						<?php } if( isset( $instance['forgot_password_link'] ) && $instance['forgot_password_link'] ) { ?>
							<a href="<?php echo wp_lostpassword_url(); ?>" class="wb4wp-forgot-password">
								<?php _e( 'Forgot Password', 'widget-bundle' ); ?>
							</a>
						<?php } ?>
					</p>
					<input type="submit" name="widget_login_submit" class="wb4wp-action-button" value="Login" />
				</form>
			</div>
		<?php }
		
		/**
		 * Returns the input fields for the registration form in frontend side.
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @param array $instance The widget instance settings.
		 */
		static function widget_registration_form( $instance ) { 
			
			if ( isset( $_POST['widget_register_submit'] ) && $_POST['widget_register_submit'] ) {
				
				if( ! isset( $_POST['register_username'] ) || empty( $_POST['register_username'] ) ) {
					
					$widget_errors[] = __( 'Please enter username.', 'widget-bundle' );
				}
				
				if( ! isset( $_POST['register_email'] ) || empty( $_POST['register_email'] ) ) {
					
					$widget_errors[] = __( 'Please enter email address.', 'widget-bundle' );
				
				} else if( ! is_email( $_POST['register_email'] ) ) {
					
					$widget_errors[] = __( 'Email address is not valid.', 'widget-bundle' );
				
				} else if( email_exists( $_POST['register_email'] ) ) {
					
					$widget_errors[] = __( 'Email address Already in use.', 'widget-bundle' );
				}
				
				if( ! isset( $_POST['register_password'] ) || empty( $_POST['register_password'] ) ) {
					
					$widget_errors[] = __( 'Please enter password.', 'widget-bundle' );
				}
				
				if( ! isset( $_POST['register_confirm_password'] ) || empty( $_POST['register_confirm_password'] ) ) {
					
					$widget_errors[] = __( 'Please enter confirm password.', 'widget-bundle' );
				
				} else if( $_POST['register_password'] != $_POST['register_confirm_password'] ) {
					
					$widget_errors[] = __( 'Password and Confirm password do not match.', 'widget-bundle' );
				}
		 
				if( isset( $_POST['register_website'] ) && ! empty( $_POST['register_website'] ) ) {
					
					if ( ! filter_var( $_POST['register_website'], FILTER_VALIDATE_URL ) ) {
						
						$widget_errors[] = __( 'Website is not a valid URL.', 'widget-bundle' );
					}
				}
				
				$userdata = array(
					'user_login' 	=> esc_attr( $_POST['register_username'] ),
					'user_email' 	=> esc_attr( $_POST['register_email'] ),
					'user_pass' 	=> esc_attr( $_POST['register_password'] ),
					'user_url' 		=> esc_attr( $_POST['register_website'] ),
					'first_name' 	=> esc_attr( $_POST['register_first_name'] ),
					'last_name' 	=> esc_attr( $_POST['register_last_name'] ),
					'nickname' 		=> esc_attr( $_POST['register_nick_name'] ),
					'description' 	=> esc_attr( $_POST['register_about_bio'] )
				);
				
				if ( ! empty( $widget_errors ) ) {
					
					echo '<div class="wb4wp-error">';
					
					foreach( $widget_errors as $widget_error ) {
						
						echo $widget_error.'<br />';
					}
					
					echo '</div>';
				
				} else {
					
					$register_user = wp_insert_user( $userdata );
					
					if ( ! is_wp_error( $register_user ) ) {
			 
						echo '<div class="wb4wp-message">';
						echo 'Registration successfully completed.';
						echo '</div>';
					
					} else {
						
						echo '<div class="wb4wp-error">';
						echo $register_user->get_error_message();
						echo '</div>';
					}
					
					$_POST = ''; 
				}
			} ?>
			
			<div class="wb4wp-container-inner">
				<form method="post" action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>">
					<?php if ( $instance['first_name'] ) : ?>
						<div class="wb4wp-form-group">
							<input name="register_first_name" type="text" class="wb4wp-form-control"
								   value="<?php echo(isset($_POST['register_first_name']) ? $_POST['register_first_name'] : null); ?>"
								   placeholder="First Name" id="reg-fname"/>
							<label class="wb4wp-login-register-icon" for="reg-fname"></label>
						</div>
					<?php endif; if ( $instance['last_name'] ) : ?>
						<div class="wb4wp-form-group">
							<input name="register_last_name" type="text" class="wb4wp-form-control"
								   value="<?php echo(isset($_POST['register_last_name']) ? $_POST['register_last_name'] : null); ?>"
								   placeholder="Last Name" id="reg-lname"/>
							<label class="wb4wp-login-register-icon" for="reg-lname"></label>
						</div>
					<?php endif; ?>
						<div class="wb4wp-form-group">
							<input name="register_username" type="text" class="wb4wp-form-control"
								   value="<?php echo(isset($_POST['register_username']) ? $_POST['register_username'] : null); ?>"
								   placeholder="Username" id="reg-name"/>
							<label class="wb4wp-login-register-icon wb4wp-user" for="reg-name"></label>
						</div>
						<div class="wb4wp-form-group">
							<input name="register_email" type="text" class="wb4wp-form-control"
								   value="<?php echo(isset($_POST['register_email']) ? $_POST['register_email'] : null); ?>"
								   placeholder="Email Address" id="reg-email"/>
							<label class="wb4wp-login-register-icon wb4wp-email" for="reg-email"></label>
						</div>
						<div class="wb4wp-form-group">
							<input name="register_password" type="password" class="wb4wp-form-control"
								   value="<?php echo(isset($_POST['register_password']) ? $_POST['register_password'] : null); ?>"
								   placeholder="Password" id="reg-pass"/>
							<label class="wb4wp-login-register-icon wb4wp-lock" for="reg-pass"></label>
						</div>
						<div class="wb4wp-form-group">
							<input name="register_confirm_password" type="password" class="wb4wp-form-control"
								   value="<?php echo(isset($_POST['register_confirm_password']) ? $_POST['register_confirm_password'] : null); ?>"
								   placeholder="Confirm Password" id="reg-pass"/>
							<label class="wb4wp-login-register-icon wb4wp-lock" for="confirm-reg-pass"></label>
						</div>
					<?php if ( $instance['nick_name'] ) : ?>
						<div class="wb4wp-form-group">
							<input name="register_nick_name" type="text" class="wb4wp-form-control"
								   value="<?php echo(isset($_POST['register_nick_name']) ? $_POST['register_nick_name'] : null); ?>"
								   placeholder="Nickname" id="reg-nickname"/>
							<label class="wb4wp-login-register-icon" for="reg-nickname"></label>
						</div>
					<?php endif; if ( $instance['website'] ) : ?>
						<div class="wb4wp-form-group">
							<input name="register_website" type="text" class="wb4wp-form-control"
								   value="<?php echo(isset($_POST['register_website']) ? $_POST['register_website'] : null); ?>"
								   placeholder="Website" id="reg-website"/>
							<label class="wb4wp-login-register-icon" for="reg-website"></label>
						</div>
					<?php endif; if ( $instance['about_bio'] ) : ?>
						<div class="wb4wp-form-group">
							<input name="register_about_bio" type="text" class="wb4wp-form-control"
								   value="<?php echo(isset($_POST['register_about_bio']) ? $_POST['register_about_bio'] : null); ?>"
								   placeholder="About / Bio" id="reg-bio"/>
							<label class="wb4wp-login-register-icon" for="reg-bio"></label>
						</div>
					<?php endif; ?>
					<input type="submit" name="widget_register_submit" class="wb4wp-action-button" value="Register"/>
				</form>
			</div>
			
		<?php }
		
		/**
		 * Method is used to update the widget settings in the WordPress database
		 *
		 * @since 1.0.0
		 *
		 * @param array  $new_instance New widget settings.
		 * @param array  $old_instance Previous widget settings.
		 * @return array Sanitized settings.
		 */
		public function update( $new_instance, $old_instance ) {
			
			$instance = $old_instance;
			$instance['title'] 		= isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['first_name'] = isset( $new_instance['first_name'] ) ? (bool) $new_instance['first_name'] : false;
			$instance['last_name'] 	= isset( $new_instance['last_name'] ) ? (bool) $new_instance['last_name'] : false;
			$instance['nick_name'] 	= isset( $new_instance['nick_name'] ) ? (bool) $new_instance['nick_name'] : false;
			$instance['website'] 	= isset( $new_instance['website'] ) ? (bool) $new_instance['website'] : false;
			$instance['about_bio'] 	= isset( $new_instance['about_bio'] ) ? (bool) $new_instance['about_bio'] : false;
			$instance['forgot_password_link'] = isset( $new_instance['forgot_password_link'] ) ? (bool) $new_instance['forgot_password_link'] : false;
			$instance['register_link'] 	= isset( $new_instance['register_link'] ) ? (bool) $new_instance['register_link'] : false;
			$instance['remember_me'] 	= isset( $new_instance['remember_me'] ) ? (bool) $new_instance['remember_me'] : false;
			$instance['login_show_widget'] 	= isset( $new_instance['login_show_widget'] ) ? (bool) $new_instance['login_show_widget'] :false;		$instance['login_title'] 		= isset( $new_instance['login_title'] ) ? strip_tags( $new_instance['login_title'] ) : '';
			$instance['login_title_tag'] 	= isset( $new_instance['login_title_tag'] ) ? strip_tags( $new_instance['login_title_tag'] ) : '';		$instance['login_user_avatar'] 	= isset( $new_instance['login_user_avatar'] ) ? (bool) $new_instance['login_user_avatar'] :false;		$instance['login_avatar_size'] 	= (int)( $new_instance['login_avatar_size'] );
			$instance['login_avatar_align'] = strip_tags( $new_instance['login_avatar_align'] );
			$instance['login_avatar_shape'] = strip_tags( $new_instance['login_avatar_shape'] );
			$instance['login_redirect_url'] = isset( $new_instance['login_redirect_url'] ) ? strip_tags( $new_instance['login_redirect_url'] ) : '';
			$instance['logout_redirect_url'] = isset( $new_instance['logout_redirect_url'] ) ? strip_tags( $new_instance['logout_redirect_url'] ) : '';
			return $instance;
		}
		
		/**
		 * @return array default values
		 *
		 * @since 1.0.0
		 */	
		public function widget_default_args() {
			
			$widget_defaults['title'] 					= esc_attr__( 'Login & Register', 'widget-bundle' );
			$widget_defaults['first_name'] 				= false;
			$widget_defaults['last_name'] 				= false;
			$widget_defaults['nick_name'] 				= false;
			$widget_defaults['website'] 				= false;
			$widget_defaults['about_bio'] 				= false;
			$widget_defaults['forgot_password_link'] 	= false;
			$widget_defaults['register_link'] 			= true;
			$widget_defaults['remember_me'] 			= false;
			$widget_defaults['login_show_widget'] 		= true;
			$widget_defaults['login_title'] 			= 'Welcome %username%';
			$widget_defaults['login_title_tag']		  	= 'h6';
			$widget_defaults['login_user_avatar'] 		= true;
			$widget_defaults['login_avatar_size']   	= 90;
			$widget_defaults['login_avatar_align']   	= 'left';
			$widget_defaults['login_avatar_shape']   	= 'square';
			$widget_defaults['login_redirect_url'] 		= '';
			$widget_defaults['logout_redirect_url'] 	= '';
			return $widget_defaults;
		}
	}
}	