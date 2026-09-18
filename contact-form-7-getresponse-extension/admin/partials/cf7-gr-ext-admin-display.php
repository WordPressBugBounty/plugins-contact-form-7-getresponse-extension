<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://wensolutions.com/
 * @since      1.0.0
 *
 * @package    Cf7_Gr_Ext
 * @subpackage Cf7_Gr_Ext/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="metabox-holder cf7-gs-ext-admin-form">
  <h3><?php esc_html_e( 'GetResponse Settings', 'cf7-gr-ext'); ?></h3>
  <fieldset>

    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="cf7-gs-name"><?php esc_html_e( 'Subscriber Name', 'cf7-gr-ext'); ?></label>
            <a href="#" class="cf7-help-icon"><span class="dashicons dashicons-info"></span></a>
          </th>
          <td>
            <select class="field-names large-select" id="cf7-gs-name" name="cf7-gs[name]" data-value="<?php echo (isset ($cf7_gr['name'] ) ) ? esc_attr( $cf7_gr['name'] ) : ''; ?>">
              
            </select>
            <span class="cf7-gs-red-text">*</span>
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="cf7-gs-email"><?php esc_html_e( 'Subscriber Email', 'cf7-gr-ext'); ?></label>
            <a href="#" class="cf7-help-icon"><span class="dashicons dashicons-info"></span></a>
          </th>
          <td>            
            <select class="field-names large-select" id="cf7-gs-email" name="cf7-gs[email]" data-value="<?php echo (isset ($cf7_gr['email'] ) ) ? esc_attr( $cf7_gr['email'] ) : ''; ?>">
              
            </select>

            <span class="cf7-gs-red-text">*</span>
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="cf7-gs-accept"><?php esc_html_e( 'Required Acceptance Field', 'cf7-gr-ext'); ?></label>
            <a href="#" class="cf7-help-icon"><span class="dashicons dashicons-info"></span></a>
          </th>
          <td>
            <select class="field-names large-select"  id="cf7-gs-accept" name="cf7-gs[accept]" data-value="<?php echo (isset ($cf7_gr['accept'] ) ) ? esc_attr( $cf7_gr['accept'] ) : ''; ?>">
              
            </select>

          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="cf7-gs-list"><?php esc_html_e( 'GetResponse Campaign', 'cf7-gr-ext'); ?></label>
            <a href="#" class="cf7-help-icon"><span class="dashicons dashicons-info"></span></a>
          </th>
          <td>
            <?php
            $cf7_gr_ext_basics_options = get_option( 'cf7_gs_ext_basics_options' );
            if( isset( $cf7_gr_ext_basics_options['gs_con'] ) && false !== $cf7_gr_ext_basics_options['gs_con'] ){
              if( !empty( $cf7_gr_ext_basics_options['gs_camp'] ) ){
            ?>
            <select id="cf7-gs-list" name="cf7-gs[list]" class="large-select">
              <option value=""><?php esc_html_e( 'Select Campaign', 'cf7-gr-ext' ); ?></option>
              <?php
              $gs_camp = (array) $cf7_gr_ext_basics_options['gs_camp'];
              $list = isset( $cf7_gr['list'] ) ? $cf7_gr['list'] : '';
              foreach ($cf7_gr_ext_basics_options['gs_camp'] as $key => $camp ) {
                $camp_id = isset( $camp->campaignId ) ? $camp->campaignId : $key;
                echo sprintf( '<option value="%s" %s>%s</option>', esc_html( $camp_id ), selected( $list, $camp_id, false ), esc_html( $camp->name ) );
              }
              ?>
            </select> <span class="cf7-gs-red-text">*</span> <a href="javascript:void(0);" id="cf7-gs-ext-update-select-camp"><span class="dashicons dashicons-update"></span></a>
            <?php
            }
            else{
              ?>
              <?php esc_html_e( 'No Campaign found.', 'cf7-gr-ext' );?>
              <?php
            }
          }
          else{
            ?>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page='.CF7_GS_EXT_SETTING_SLUG ) ); ?>"><?php esc_html_e( 'GetResponse API key is not set or invalid. Click here to change.', 'cf7-gr-ext' ); ?></a>
            <?php
          } ?>
          </td>
        </tr>

        <tr>
          <th scope="row">
            <label for="cf7-gs-custom-fields"><?php esc_html_e( 'Custom Fields', 'cf7-gr-ext'); ?></label>
            <a href="#" class="cf7-help-icon"><span class="dashicons dashicons-info"></span></a>
          </th>
          <td>
            <table class="form-table cf7-gs-custom-fields-tbl">
              <tbody>
                  <?php
                  $count = ( isset($cf7_gr['custom_value'])?count($cf7_gr['custom_value']):1);

                  for($i=1;$i<=$count;$i++){
                    ?>
                <tr data-cfid='<?php echo absint( $i ); ?>' class="custom-field-single">

                  <td class="">
                    <label for="cf7-gs-custom-value<?php echo absint( $i ); ?>"><?php echo esc_html__( 'Contact Form Value', 'cf7-gr-ext' ); ?></label>

                    <select class="field-names large-select"  id="cf7-gs-custom-value<?php echo absint( $i ); ?>" name="cf7-gs[custom_value][<?php echo absint( $i ); ?>]" data-value="<?php echo (isset( $cf7_gr['custom_value'][$i]) ) ?  esc_attr( $cf7_gr['custom_value'][$i] ) : '' ;  ?>">
              
                    </select>

                  </td>


                  <td>
                    <label for="cf7-gs-custom-key<?php echo absint( $i ); ?>"><?php echo esc_html__( 'GetResponse Custom Field Name', 'cf7-gr-ext' ); ?></label>
                    <?php
                    if( isset( $options['gs_custom_fields'] ) ){
                      ?>
                      <select class="gr-field-names large-select" id="cf7-gs-custom-key<?php echo absint( $i ); ?>" name="cf7-gs[custom_key][<?php echo absint( $i ); ?>]">
                      <option value=""><?php esc_html_e( 'Select custom field', 'cf7-gr-ext' ); ?></option>
                      <?php
                      foreach( $options['gs_custom_fields'] as $fields ){
                        $selected = ( isset( $cf7_gr['custom_key'][$i] ) && $cf7_gr['custom_key'][$i] == $fields->customFieldId ) ? $cf7_gr['custom_key'][$i] : '';
                      ?>
                      <option value="<?php echo esc_attr( $fields->customFieldId ); ?>" <?php selected( $selected, $fields->customFieldId ); ?>><?php echo esc_html( $fields->name ); ?></option>
                      <?php
                      }
                      ?>
                      </select>
                      <?php
                    }
                    ?>
                  </td>

                  <td class="cf7-gr-ext-cf-tools"><br />
                  <a href="javascript:void(0);" data-cfid="<?php echo absint( $i ); ?>"  class="cf7-gs-ext-update-custom-fields"><span class="dashicons dashicons-update"></span></a>
                    <?php
                    if( 2 <= $i ){
                      ?>
                      <a  data-cfid="<?php echo absint( $i ); ?>" class="dashicons dashicons-dismiss  delete remove-custom-field" style="
    color: red;
"  id="delete-custom-field" href="javascript:void(0);"></a>
                      <?php
                    }
                    ?>
                  </td>

                </tr>
                  <?php
                } # END for($i=1;$i<=$count;$i++) ?>

                  <tr data-cfid='{{ID}}' class="custom-field-template" style="display:none">

                    <td class="">
                      <label for="{{CFV_FIELD_ID}}"><?php echo esc_html( __( 'Contact Form Value', 'cf7-gr-ext' ) ); ?></label>
                      <select class="field-names large-select"  id="{{CFV_FIELD_ID}}" name="{{CFV_FIELD_NAME}}" data-value="">
              
                    </select>
                    </td>


                    <td>
                      <label for="{{CFK_FIELD_ID}}"><?php echo esc_html( __( 'GetResponse Custom Field Name', 'cf7-gr-ext' ) ); ?></label>
                      <select class="gr-field-names large-select" id="cf7-gs-custom-key{{ID}}" name="cf7-gs[custom_key][{{ID}}]">
                      </select>
                    </td>

                    <td class="cf7-gr-ext-cf-tools"><br />
                    <a href="javascript:void(0);" data-cfid="{{ID}}"  class="cf7-gs-ext-update-custom-fields"><span class="dashicons dashicons-update"></span></a>
                    <a  data-cfid="{{ID}}" class="dashicons dashicons-dismiss delete remove-custom-field" style="
    color: red;
"  id="delete-custom-field" href="javascript:void(0);"></a>
                    </td>

                  </tr>
              </tbody>
            </table>
            <table class="form-table cf7-gs-custom-fields-tbl">
              <tbody>
                  <tr>
                    <td class=""></td>
                    <td></td>
                    <td><br />
                      <?php submit_button( __( '+ Custom Field', 'cf7-gr-ext' ), 'primary', 'cf7-gs-add-custom-field'); ?>
                    </td>
                  </tr>
              </tbody>
            </table>

          </td>
        </tr>

      </tbody>
    </table>

  </fieldset>
  <hr/>
  <p> <?php printf( esc_html__( 'If you like this addon then please leave some positive feedback %s here %s. Also checkout our other WordPress plugins on our %s website %s.', 'cf7-gr-ext' ), '<a href="https://wordpress.org/support/view/plugin-reviews/contact-form-7-getresponse-extension" target="_blank">', "</a>", '<a href="http://wensolutions.com/plugins/" target="_blank">', "</a>" );?> </p>
</div>
