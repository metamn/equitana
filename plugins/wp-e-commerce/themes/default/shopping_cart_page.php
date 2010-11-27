<?php
  global $wpsc_cart, $wpdb, $wpsc_checkout, $wpsc_gateway, $wpsc_coupons;
  $wpsc_checkout = new wpsc_checkout();
  $wpsc_gateway = new wpsc_gateways();
  $wpsc_coupons = new wpsc_coupons($_SESSION['coupon_numbers']);
  if(wpsc_cart_item_count() > 0) :
?>



<?php
    // Error messages for checkout
    if(count($_SESSION['wpsc_checkout_misc_error_messages']) > 0) {
	    echo "<div class='login_error'>\n\r";
	    foreach((array)$_SESSION['wpsc_checkout_misc_error_messages'] as $user_error ) {
		    echo $user_error."<br />\n";
	    }
	    echo "</div>\n\r";
    }
    $_SESSION['wpsc_checkout_misc_error_messages'] =array();
    
    // Error messages for invalid form fields
    while (wpsc_have_checkout_items()) : wpsc_the_checkout_item(); 
      if(wpsc_the_checkout_item_error() != ''): 
		    echo "<div class='login_error'>\n\r";
		    echo wpsc_the_checkout_item_error();
		    echo "</div>\n\r";
			endif;
    endwhile;
?>


<table class="productcart">
	<tr class="firstrow">
		<td class='firstcol'></td>
		<td class='productname'><?php echo __('Produs'); ?></td>
		<td><?php echo __('Cantitate'); ?></td>
		<!--
		<?php if(wpsc_uses_shipping()): ?>
			<td><?php echo __('Livrare'); ?></td>
		<?php endif; ?>
		-->
		<td>Pret</td>
		<td></td>
	</tr>
	
	<?php while (wpsc_have_cart_items()) : wpsc_the_cart_item(); ?>	
	  <?php 
	    // Getting the original post item for the product
	    $product_id = wpsc_cart_item_product_id();
	    $post_id = post_id($product_id);
	    
	    $link = get_permalink($post_id);   
	  ?>		
		<tr class="product_row">
			<td class="firstcol">
			  <a href="<?php echo $link ?>">
			    <img src='<?php echo wpsc_cart_item_image(48,48); ?>' alt='<?php echo wpsc_cart_item_name(); ?>' title='<?php echo wpsc_cart_item_name(); ?>' />
        </a>			   
			</td>
			<td class="productname firstcol">
			  <a href="<?php echo $link ?>"><?php echo wpsc_cart_item_name(); ?></a>
			</td>
			<td>
				<form action="<?php echo get_option('shopping_cart_url'); ?>" method="post" class="adjustform">
					<input type="text" name="quantity" size="2" value="<?php echo wpsc_cart_item_quantity(); ?>" />
					<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
					<input type="hidden" name="wpsc_update_quantity" value="true" />
					<input type="submit" value="<?php echo __('Actualizare', 'wpsc'); ?>" name="submit" />
				</form>
			</td>
			<!-->
			<?php if(wpsc_uses_shipping()): ?>
			<td><span class="pricedisplay" id='shipping_<?php echo wpsc_the_cart_item_key(); ?>'><?php echo wpsc_cart_item_shipping(); ?></span></td>
			<?php endif; ?>
			-->
			<td><span class="pricedisplay"><?php echo wpsc_cart_item_price(); ?></span></td>
			
			<td>
				<form action="<?php echo get_option('shopping_cart_url'); ?>" method="post" class="adjustform">
					<input type="hidden" name="quantity" value="0" />
					<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
					<input type="hidden" name="wpsc_update_quantity" value="true" />
					<button class='remove_button' type="submit"><span><?php echo __('Renunta'); ?></span></button>
				</form>
			</td>
		</tr>
	<?php endwhile; ?>
	
	<?php if(wpsc_uses_coupons()): ?>		
		<?php if(wpsc_coupons_error()): ?>
			<tr>
			  <td>&nbsp;</td>
			  <td colspan=4><div class="login_error"><?php echo __('Cuponul nu este valid'); ?></div></td>
			</tr>
		<?php endif; ?>
		<tr class="coupon">
			<td>&nbsp;</td>
			<td><?php _e('Introduceti codul cuponului'); ?></td>
			<td  colspan="2" align='left'>
				<form  method='post' action="<?php echo get_option('shopping_cart_url'); ?>">				
					<input class="coupon" type='text' name='coupon_num' id='coupon_num' value='<?php echo $wpsc_cart->coupons_name; ?>' />
			</td>
			<td>
			  <input type='submit' value="<?php echo __('Actualizare') ?>" />		
				</form>
			</td>
		</tr>
	<?php endif; ?>	
	
	<!-- cant get cart total ...
	<tr class="subtotal">
	<td></td>
	<td>Subtotal</td>
	<td></td>
	<td>12 RON</td>
	<td></td>
	</tr>
	-->	
	</table>
	
	
	<?php if(isset($_SESSION['nocamsg']) && isset($_GET['noca']) && $_GET['noca'] == 'confirm'): ?>
		<p class='validation-error'><?php echo $_SESSION['nocamsg']; ?></p>
	<?php endif; ?>
	<?php if($_SESSION['categoryAndShippingCountryConflict'] != '') : ?>
		<p class='validation-error'><?php echo $_SESSION['categoryAndShippingCountryConflict']; ?></p>
	<?php
		$_SESSION['categoryAndShippingCountryConflict'] = '';
	endif;
	
	if($_SESSION['WpscGatewayErrorMessage'] != '') :
	?>
		<p class='validation-error'><?php echo $_SESSION['WpscGatewayErrorMessage']; ?></p>
	<?php
	endif;
	?>
	
		
		
	<?php 
	// Shipping module
	  do_action('wpsc_before_shipping_of_shopping_cart'); ?>
	
	<div id='wpsc_shopping_cart_container'>
	<?php if(wpsc_uses_shipping()) : ?>		
		<table class="shipping">						
			<?php if (wpsc_have_morethanone_shipping_quote()) :?>
				<?php while (wpsc_have_shipping_methods()) : wpsc_the_shipping_method(); ?>
						<?php if (!wpsc_have_shipping_quotes()) { continue; } // Don't display shipping method if it doesn't have at least one quote ?>						
						<?php $cnt = 0; ?>
						<?php while (wpsc_have_shipping_quotes()) : wpsc_the_shipping_quote();	?>
						  <tr><td class="c1"></td>
						  <?php if ($cnt == 0) { 
						    $cnt += 1;
						    echo '<td class="c2"><strong>Metoda de livrare</strong></td>';
						  } else { 
						    echo '<td class="c2"></td>';
						  } ?>							  
							<td class="c3"><?php echo wpsc_shipping_quote_name(); ?></td>
							<td class="c4"><?php echo wpsc_shipping_quote_value(); ?></td>
							<td class="c5">
								<?php if(wpsc_have_morethanone_shipping_methods_and_quotes()): ?>
									<input type='radio' id='<?php echo wpsc_shipping_quote_html_id(); ?>' <?php echo wpsc_shipping_quote_selected_state(); ?>  onclick='switchmethod("<?php echo wpsc_shipping_quote_name(); ?>", "<?php echo wpsc_shipping_method_internal_name(); ?>")' value='<?php echo wpsc_shipping_quote_value(true); ?>' name='shipping_method' />
								<?php else: ?>
									<input <?php echo wpsc_shipping_quote_selected_state(); ?> disabled='disabled' type='radio' id='<?php echo wpsc_shipping_quote_html_id(); ?>'  value='<?php echo wpsc_shipping_quote_value(true); ?>' name='shipping_method' />
										<?php wpsc_update_shipping_single_method(); ?>
								<?php endif; ?>
							</td>
							</tr>
						<?php endwhile; ?>
				<?php endwhile; ?>
			<?php endif; ?>
			
			<?php wpsc_update_shipping_multiple_methods(); ?>			
			<?php if (!wpsc_have_shipping_quote()) : // No valid shipping quotes ?>
				</table>
				</div>
				<?php return; ?>
			<?php endif; ?>
		</table>
	<?php endif;  ?>
	
	<table class="total">
	<?php if(wpsc_cart_tax(false) > 0) : ?>
		<tr>
			<td class="c1"></td>
			<td class="c2">
				<?php echo wpsc_display_tax_label(true); ?>
			</td>
			<td class="c3">
				<span id="checkout_tax" class="pricedisplay checkout-tax"><?php echo wpsc_cart_tax(); ?></span>
			</td>
		</tr>
	<?php endif; ?>
	
	<!--
	<?php if(wpsc_uses_shipping()) : ?>
		<tr class="total_price total_shipping">
			<td colspan="3">
				<?php echo __('Total Shipping', 'wpsc'); ?>
			</td>
			<td colspan="2">
				<span id="checkout_shipping" class="pricedisplay checkout-shipping"><?php echo wpsc_cart_shipping(); ?></span>
				</td>
		</tr>
	<?php endif; ?>
  -->
  
	  <?php if(wpsc_uses_coupons() && (wpsc_coupon_amount(false) > 0)): ?>
	  <tr class="discount">
		  <td>&nbsp;</td>
		  <td>
			  <?php echo __('Discount', 'wpsc'); ?>
		  </td>
		  <td>
			  <span id="coupons_amount" class="pricedisplay"><?php echo wpsc_coupon_amount(); ?></span>
	    </td>
   	</tr>
	  <?php endif ?>

		
	
	<tr>
		<td class="c1"></td>
		<td class="c2">
		  <h4><strong>Total</strong></h4>
		</td>
		<td class="c3">
			<h4><strong><span id='checkout_total' class="pricedisplay checkout-total"><?php echo wpsc_cart_total(); ?></span></strong></h4>
		</td>
	</tr>	
	</table>
	
	


  <?php do_action('wpsc_before_form_of_shopping_cart'); ?>	
	<form name='wpsc_checkout_forms' class='wpsc_checkout_forms' action='' method='post' enctype="multipart/form-data">	
	   <?php 
	   /**  
	    * Both the registration forms and the checkout details forms must be in the same form element as they are submitted together, you cannot have two form elements submit together without the use of JavaScript.
	   */
	   ?>	   
	
	
	   
  <div id="checkout" class="block">
    <div id="form" class="column span-10 append-1 last">	    
	    <h3 class="checkout">Shopping rapid</h3>
	    <table class='wpsc_checkout_table'>
		    <?php while (wpsc_have_checkout_items()) : wpsc_the_checkout_item(); ?>
			    <?php if(wpsc_is_shipping_details()) : ?>
					 
			    <?php endif; ?>        
		      <?php if(wpsc_checkout_form_is_header() == true) : ?>
		      	
		      <?php else: ?>
		        <?php if((!wpsc_uses_shipping()) && $wpsc_checkout->checkout_item->unique_name == 'shippingstate'): ?>
		        <?php else : ?>
		        		<tr <?php echo wpsc_the_checkout_item_error_class();?>>
			          <td colspan=2>
				          <label for='<?php echo wpsc_checkout_form_element_id(); ?>'>
				          <?php echo wpsc_checkout_form_name();?>
				          </label>
			            <br/>
			            <?php echo wpsc_checkout_form_field();?>				
		              <?php if(wpsc_the_checkout_item_error() != ''): ?>
		                <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>		    
			            <?php endif; ?>
			            
		            </td>
		            </tr>
			      <?php endif; ?>		
			    <?php endif; ?>		
		    <?php endwhile; ?>		    
		
		    <?php if (get_option('display_find_us') == '1') : ?>
		    <tr>
			    <td>How did you find us:</td>
			    <td>
				    <select name='how_find_us'>
					    <option value='Word of Mouth'>Word of mouth</option>
					    <option value='Advertisement'>Advertising</option>
					    <option value='Internet'>Internet</option>
					    <option value='Customer'>Existing Customer</option>
				    </select>
			    </td>
		    </tr>
		    <?php endif; ?>		
		    <tr>
			    <td colspan='2' class='wpsc_gateway_container'>
			
			    <?php  //this HTML displays activated payment gateways?>
			      
				    <?php if(wpsc_gateway_count() > 1): // if we have more than one gateway enabled, offer the user a choice ?>
					    <h3><?php echo __('Select a payment gateway', 'wpsc');?></h3>
					    <?php while (wpsc_have_gateways()) : wpsc_the_gateway(); ?>
						    <div class="custom_gateway">
							    <?php if(wpsc_gateway_internal_name() == 'noca'){ ?>
								    <label><input type="radio" id='noca_gateway' value="<?php echo wpsc_gateway_internal_name();?>" <?php echo wpsc_gateway_is_checked(); ?> name="custom_gateway" class="custom_gateway"/><?php echo wpsc_gateway_name();?></label>
							    <?php }else{ ?>
								    <label><input type="radio" value="<?php echo wpsc_gateway_internal_name();?>" <?php echo wpsc_gateway_is_checked(); ?> name="custom_gateway" class="custom_gateway"/><?php echo wpsc_gateway_name();?></label>
							    <?php } ?>

							
							    <?php if(wpsc_gateway_form_fields()): ?> 
								    <table class='<?php echo wpsc_gateway_form_field_style();?>'>
									    <?php echo wpsc_gateway_form_fields();?> 
								    </table>		
							    <?php endif; ?>			
						    </div>
					    <?php endwhile; ?>
				    <?php else: // otherwise, there is no choice, stick in a hidden form ?>
					    <?php while (wpsc_have_gateways()) : wpsc_the_gateway(); ?>
						    <input name='custom_gateway' value='<?php echo wpsc_gateway_internal_name();?>' type='hidden' />
						
							    <?php if(wpsc_gateway_form_fields()): ?> 
								    <table>
									    <?php echo wpsc_gateway_form_fields();?> 
								    </table>		
							    <?php endif; ?>	
					    <?php endwhile; ?>				
				    <?php endif; ?>				
				
			    </td>
		    </tr>
		    <tr>
			    <td colspan='2'>         		
         		<p class="termeni">
         		Prin trimiterea comenzii va exprimati acordul cu 
            <a class='thickbox' target='_blank' href='<?php echo site_url('?termsandconds=true&amp;width=360&amp;height=400'); ?>' class='termsandconds'>Termenii si conditiile magazinului Equitana.</a>
            </p>
       		</td>
     	   </tr>
		    
		    <tr>
		      
			    <td>
				    <!--
				    <?php if(get_option('terms_and_conditions') == '') : ?>
					    <input type='hidden' value='yes' name='agree' />
				    <?php endif; ?>
				    -->
				    <input type='hidden' value='yes' name='agree' />	
				    <?php //exit('<pre>'.print_r($wpsc_gateway->wpsc_gateways[0]['name'], true).'</pre>');
				     if(count($wpsc_gateway->wpsc_gateways) == 1 && $wpsc_gateway->wpsc_gateways[0]['name'] == 'Noca'){}else{?>
					    <input type='hidden' value='submit_checkout' name='wpsc_action' />
					    <input type='submit' value='Trimitere comanda' name='submit' class='make_purchase' />
				    <?php }/* else: ?>
				
				    <br /><strong><?php echo __('Please login or signup above to make your purchase', 'wpsc');?></strong><br />
				    <?php echo __('If you have just registered, please check your email and login before you make your purchase', 'wpsc');?>
				    </td>
				    <?php endif;  */?>				
			    </td>
		    </tr>
	    </table>
	  </div>
	  
	  <div id="login" class="column span-10 prepend-1 last">
	    <?php if(!is_user_logged_in()) {
        global $current_user;
        get_currentuserinfo(); ?>
        <h4>Doriti cont Equitana?</h4>
        <p>
          A crea cont pe Equitana nu este obligatoriu, se poate cumpara si fara cont prin Shopping Rapid.  
        </p>
        <p>
          Procedura de inregistrare este foarte simpla, aveti nevoie numai de o adresa e-mail sau cont Facebook.
          <ul class="loginlist">
            <li><?php do_action('fbc_display_login_button') ?></li>
            <li><a href="<?php echo wp_login_url(get_option('shopping_cart_url'))?>" alt="Intrare / inregistrare cont" title="Intrare / inregistrare cont">Intrare in cont / Inregistrare cont Equitana</a></li>
        </p>
          
      <?php } else { 
        if (is_user_logged_in()) {

          $current_user = wp_get_current_user();
          if ( !($current_user instanceof WP_User) ) return; ?>
          
          <?php if (check_profile_info($current_user->ID)) { ?>
            <p class="termeni">
            Prin trimiterea comenzii va exprimati acordul cu 
              <a class='thickbox' target='_blank' href='<?php echo site_url('?termsandconds=true&amp;width=360&amp;height=400'); ?>' class='termsandconds'>Termenii si conditiile magazinului Equitana.</a>
            </p>
            <p>
               <button type='submit' name='submit' class='make_purchase'>Datele sunt ok. Trimit comanda</button>
            </p>
          <?php } else { ?>
            <p class="termeni">
              Datele de livrare/facturare nu sunt complete. Trebuie sa le completati o singura data <a href="http://www.equitana.ro/cont-cumparaturi/?edit_profile=true">aici.</a> 
            </p>
          <?php } ?>
          
          <div id="account" class="box">
            <h4>Contul Dumneavoastra</h4>
            <ul class="info">
              <li>Nume utilizator: <?php echo $current_user->display_name ?></li>              
            </ul>
            <ul class="links">
              <li><a href="<?php bloginfo('home') ?>/cont-cumparaturi/">Istoric comenzi</a></li>
              <li><a href="<?php bloginfo('home') ?>/cont-cumparaturi/?edit_profile=true">Detalii facturare/livrare</a></li>
              <li><a href="<?php echo wp_logout_url(get_bloginfo('url')); ?>">Iesire din cont</a></li>
              <li><a href="<?php bloginfo('home') ?>/wp-admin/profile.php">Modificare cont utilizator</a></li>
            </ul>
          </div>          
        <?php } 
      } ?>   
	  </div>
	</div>  
</form>
</div>
<?php else: ?>  
  <h4>Cosul Dvs. este gol. Va rugam <a href="<?php bloginfo('home') ?>">vizitati magazinul nostru.</a></h4>	
<?php endif;
do_action('wpsc_bottom_of_shopping_cart');
?>
