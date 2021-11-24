<?php
/**
 * Action to send an email to provided email address.
 *
 * @since       4.5.3
 * @version     1.0
 * @package     Email Subscribers
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to handle send email action
 * 
 * @class ES_Action_Send_Email
 * 
 * @since 4.5.3
 */
class ES_Action_Send_Email extends ES_Action_Send_Email_Abstract {

	/**
	 * Load action admin details.
	 *
	 * @since 4.5.3
	 */
	public function load_admin_details() {
		$this->group = __( 'Email', 'email-subscribers' );
		$this->title = __( 'Send Email', 'email-subscribers' );
	}

	/**
	 * Load action fields
	 *
	 * @since 4.5.3
	 */
	public function load_fields() {
		parent::load_fields();

		$email_content = new ES_WP_Editor();
		$email_content->set_name( 'ig-es-email-content' );
		$email_content->set_title( __( 'Email Content', 'email-subscribers' ) );
		$email_content->set_required();

		$this->add_field( $email_content );
	}

	/**
	 * Called when an action should be run
	 *
	 * @since 4.5.3
	 */
	public function run() {

		$recipients    = $this->get_option( 'ig-es-send-to', true );
		$email_content = $this->get_option( 'ig-es-email-content', true, true );
		$subject       = $this->get_option( 'ig-es-email-subject', true );

		$recipients = explode(',', $recipients );
		$recipients = array_map( 'trim', $recipients );
		
		// Check if we have all required data to send the email.
		if ( empty( $recipients ) || empty( $email_content ) || empty( $subject ) ) {
			return;
		}
		
		// Replace line breaks with paragraphs in email body.
		$email_content = wpautop( $email_content );
		
		$raw_data     = $this->workflow->data_layer()->get_raw_data();
		$trigger_name = $this->workflow->get_trigger_name();
		if ( ! empty( $raw_data ) ) {
			foreach ( $raw_data as $data_type_id => $data_item ) {
				$data_type = ES_Workflow_Data_Types::get( $data_type_id );
				if ( ! $data_type || ! $data_type->validate( $data_item ) ) {
					continue;
				}

				$data = array();
				if ( method_exists( $data_type, 'get_data' ) ) {
					$data = $data_type->get_data( $data_item );
					
					if ( ! empty( $data['email'] ) ) {
						foreach ( $recipients as $index => $recipient_email ) {
							// Replace placeholder tags with the got data from the triggerred event.
							$recipients[$index] = str_replace( '{{EMAIL}}', $data['email'], $recipient_email );
						}
						
						if ( 'ig_es_user_subscribed' === $trigger_name ) {
							$email_content = str_replace( '{{EMAIL}}', $data['email'], $email_content );
							$email_content = str_replace( '{{NAME}}', $data['name'], $email_content );
						}
					}

					if ( 'campaign' === $data_type_id && ! empty( $data['notification_guid'] ) ) {
						$notification     = ES_DB_Mailing_Queue::get_notification_by_hash( $data['notification_guid'] );
						$subject          = str_replace( '{{SUBJECT}}', $notification['subject'], $subject );
						$email_count      = $notification['count'];
						$campaign_subject = $notification['subject'];
						$cron_date        = gmdate( 'Y-m-d H:i:s' );
						$cron_local_date  = get_date_from_gmt( $cron_date ); // Convert from GMT to local date/time based on WordPress time zone setting.
						$cron_date        = ES_Common::convert_date_to_wp_date( $cron_local_date ); // Get formatted date from WordPress date/time settings.
		
						$email_content = str_replace( '{{DATE}}', $cron_date, $email_content );
						$email_content = str_replace( '{{COUNT}}', $email_count, $email_content );
						$email_content = str_replace( '{{SUBJECT}}', $campaign_subject, $email_content );
					}
				}
				
			}

			

			$es_mailer = ES()->mailer;
			
			$es_mailer->add_unsubscribe_link = false;
			$es_mailer->add_tracking_pixel   = false;
			
			$es_mailer->send( $subject, $email_content, $recipients, $data );
		}
	}	
}
