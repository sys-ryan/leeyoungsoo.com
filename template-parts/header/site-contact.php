<?php
/**
 * Site Contact
 *
 * @package Chique
 */

$phone       = get_theme_mod( 'chique_phone_number' );
$email       = get_theme_mod( 'chique_email_address' );
$hours       = get_theme_mod( 'chique_working_hours' );
$address     = get_theme_mod( 'chique_address' );
$button_text = get_theme_mod( 'chique_header_button_text' );
if ( $phone || $email || $hours || $address || $button_text ) :
	?>
		<div class="site-header-right">
			<div class="site-contact">
				<ul>
					<?php if ( $phone ) :
						$phone_label = get_theme_mod( 'chique_phone_label' );
					?>
					<li class="contact-phone">
						<div class="contact-options">
							<?php echo $phone_label ? '<span>' .  esc_html( $phone_label ) . '</span>' : ''; ?>
							<strong>
								<a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $phone ) ); ?>">
										<?php echo esc_html( $phone ); ?>
								</a>
							</strong>
						</div>
					</li>
					<?php endif; ?>

					<?php if ( $address ) :
						$address_label = get_theme_mod( 'chique_address_label' );
					?>
					<li class="contact-address">
						<div class="contact-options">
							<?php echo $address_label ? '<span>' .  esc_html( $address_label ) . '</span>' : ''; ?>
							<strong>
								<?php echo esc_html( $address ); ?>
							</strong>
						</div>
					</li>
					<?php endif; ?>

					<?php if ( $email ) :
						$email_label = get_theme_mod( 'chique_email_label' );
					?>
					<li class="contact-email">
						<div class="contact-options">
							<?php echo $email_label ? '<span>' .  esc_html( $email_label ) . '</span>' : ''; ?>
							<strong>
								<a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>">
										<?php echo esc_html( antispambot( $email ) ); ?>
								</a>
							</strong>
						</div>
					</li>
					<?php endif; ?>

					<?php if ( $hours ) :
						$hours_label = get_theme_mod( 'chique_working_hours_label' );
					?>
					<li class="contact-hours">
						<div class="contact-options">
							<?php echo $hours_label ? '<span>' .  esc_html( $hours_label ) . '</span>' : ''; ?>
							<strong>
								<?php echo esc_html( $hours ); ?>
							</strong>
						</div>
					</li>
					<?php endif; ?>

					<?php if ( $button_text ) :
						$button_link = get_theme_mod( 'chique_header_button_link' );
						$target = get_theme_mod( 'chique_header_button_target' ) ? '_blank' : '_self';
					?>
					<li class="contact-button">
						<div class="contact-options">
							<a target="<?php echo esc_html( $target ); ?>" href="<?php echo esc_url( $button_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
						</div>
					</li>
					<?php endif; ?>
				</ul>
			</div> <!-- .site-contact -->
		</div>
<?php endif;
