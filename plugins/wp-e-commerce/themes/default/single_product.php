<?php
  global $wpsc_query, $wpdb;
  $image_width = get_option('single_view_image_width');
  $image_height = get_option('single_view_image_height');
?>

<div id='products_page_container' class="wrap wpsc_container">		
	<?php do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search ?>
	
	<div class="productdisplay">
	  <?php /** start the product loop here, this is single products view, so there should be only one */?>
		  <?php while (wpsc_have_products()) :  wpsc_the_product(); ?>
			  <div class="single_product_display product_view_<?php echo wpsc_the_product_id(); ?>">
				  <div class="textcol">
					<?php if(get_option('show_thumbnails')) :?>
					<div class="imagecol">
						<?php if(wpsc_the_product_thumbnail()) :?>
								<a rel="<?php echo str_replace(array(" ", '"',"'", '&quot;','&#039;'), array("_", "", "", "",''), wpsc_the_product_title()); ?>" class="thickbox preview_link" href="<?php echo wpsc_the_product_image(); ?>">
									<img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_image($image_width, $image_height); ?>" />
								</a>
						<?php else: ?> 
							<div class="item_no_image">
								<a href="<?php echo wpsc_the_product_permalink(); ?>">
								<span><?php echo t('Nu avem imagini') ?></span>
								</a>
							</div>
						<?php endif; ?> 
					</div>
					<?php endif; ?> 
					
					<?php echo product_thumbs(post_id(wpsc_the_product_id())); ?>
		
					<div class="producttext">						  
					    <form class='product_form' enctype="multipart/form-data" action="<?php echo curPageURL(); ?>" method="post" name="1" id="product_<?php echo wpsc_the_product_id(); ?>">
					     <table> 
					     
					      <tr class="sku">
					        <td><label><?php echo t('Cod produs:'); ?></label></td>
					        <td class="right"><?php echo wpsc_product_sku(wpsc_the_product_id()); ?></td>
					      </tr>					     
					     
					      <?php /** the variation group HTML and loop */?>
					      <div class="wpsc_variation_forms">
						      <?php while (wpsc_have_variation_groups()) : wpsc_the_variation_group(); ?>
							      <tr class='variation'>
							        <td>
								        <label for="<?php echo wpsc_vargrp_form_id(); ?>"><?php echo wpsc_the_vargrp_name(); ?>:</label>
								      </td>
								      <td class='right'>
								        <?php /** the variation HTML and loop */?>
								        <select class='wpsc_select_variation' name="variation[<?php echo wpsc_vargrp_id(); ?>]" id="<?php echo wpsc_vargrp_form_id(); ?>">
								        <?php while (wpsc_have_variations()) : wpsc_the_variation(); ?>
									        <option value="<?php echo wpsc_the_variation_id(); ?>" <?php echo wpsc_the_variation_out_of_stock(); ?>><?php echo wpsc_the_variation_name(); ?></option>
								        <?php endwhile; ?>
								        </select> 
							        </td>
							        </tr>
						      <?php endwhile; ?>
					      </div>
					      <?php /** the variation group HTML and loop ends here */?>
								
			          <!-- THIS IS THE QUANTITY OPTION MUST BE ENABLED FROM ADMIN SETTINGS -->
			          <?php if(wpsc_has_multi_adding()): ?>
				          <tr class='quantity'><td>
				            <label class='wpsc_quantity_update' for='wpsc_quantity_update[<?php echo wpsc_the_product_id(); ?>]'>
				              <?php echo t('Cantitate:'); ?>
				            </label>
				          </td><td class='right'>
				            <input type="text" id='wpsc_quantity_update' name="wpsc_quantity_update[<?php echo wpsc_the_product_id(); ?>]" size="2" value="1"/>
				            <input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
				            <input type="hidden" name="wpsc_update_quantity" value="true"/>
				          </td></tr>
			          <?php endif ;?>
					
						    <div class="wpsc_product_price">
							    <?php if(wpsc_product_is_donation()) : ?>
								    <label for='donation_price_<?php echo wpsc_the_product_id(); ?>'><?php echo __('Donation', 'wpsc'); ?>:</label>
								    <input type='text' id='donation_price_<?php echo wpsc_the_product_id(); ?>' name='donation_price' value='<?php echo $wpsc_query->product['price']; ?>' size='6' />
								    <br />													
							    <?php else : ?>
								    <?php if(wpsc_product_on_special()) : ?>
								      <tr class='oldprice'><td>
									      <label><span class='oldprice'><?php echo t('Pret vechi:') ?></span></label> 
									    </td><td class='right'>
									      <span class='oldprice'><?php echo wpsc_product_normal_price(); ?></span>
									    </td></tr>
								    <?php endif; ?>
								      <tr class='price'><td>
								        <label><?php echo t('Pret:') ?></label>
								      </td><td class='right'>
								        <span id="product_price_<?php echo wpsc_the_product_id(); ?>" class="pricedisplay"><?php echo wpsc_the_product_price(); ?></span>
								      </td></tr>  
								      <!-- multi currency code -->
								      <?php if(wpsc_product_has_multicurrency()) : ?>
								      <?php echo wpsc_display_product_multicurrency(); ?>
								      <?php endif; ?>
								      <!-- end multi currency code -->
								      <?php if(get_option('display_pnp') == 1) : ?>
									      <span class="pricedisplay"><?php echo wpsc_product_postage_and_packaging(); ?></span><?php echo __('P&amp;P', 'wpsc'); ?>:  <br />
								      <?php endif; ?>							
							      <?php endif; ?>
						    </div>
					      
					      <?php if(function_exists('wpsc_akst_share_link') && (get_option('wpsc_share_this') == 1)) {
						      echo wpsc_akst_share_link('return');
					      } ?>
					      
						
					      <input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
					      <input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>
							
					      <?php if(wpsc_product_is_customisable()) : ?>				
						      <input type="hidden" value="true" name="is_customisable"/>
					      <?php endif; ?>
										
					      <!-- END OF QUANTITY OPTION -->
					      
					      <?php if((get_option('hide_addtocart_button') == 0) && (get_option('addtocart_or_buynow') !='1')) : ?>
						      <?php if(wpsc_product_has_stock()) : ?>
							      <?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
								      <?php	$action =  wpsc_product_external_link(wpsc_the_product_id()); ?>
								      <input class="wpsc_buy_button" type='button' value='<?php echo __('Buy Now', 'wpsc'); ?>' onclick='gotoexternallink("<?php echo $action; ?>")'>
							      <?php else: ?>
							        <tr class='submit'><td colspan=2>
								      <input type="submit" value="<?php echo t('Adauga la cos') ?>" name="Buy" class="wpsc_buy_button" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
							      <?php endif; ?>							  		
							      </td><tr>
							      <tr class='checkout'><td colspan=2>
							        <FORM>
                        <INPUT TYPE="BUTTON" class='checkout-button' VALUE="<?php echo t('Cos cumparaturi') ?>" ONCLICK='gotoexternallink("<?php echo bloginfo(home) ?>/cos-cumparaturi")'>
                      </FORM>							        
							      </td></tr> 
							      <tr class='animation'><td colspan=2>
							        <div class='wpsc_loading_animation'>
								        <img title="Loading" alt="Loading" src="<?php echo WPSC_URL ;?>/images/indicator.gif" class="noborder loadingimage" />
								          <?php echo t('Actualizare cos...') ?>
							        </div>
							        
							       </td></tr>							      
							      							
						      <?php else : ?>
							      <p class='soldout'><?php echo t('Momentan nu este disponibil.') ?></p>
						      <?php endif ; ?>
					      <?php endif ; ?>
					  </table>
					</form>
					
					
					<?php if((get_option('hide_addtocart_button') == 0) && (get_option('addtocart_or_buynow')=='1')) : ?>
						<?php echo wpsc_buy_now_button(wpsc_the_product_id()); ?>
					<?php endif ; ?>
					
					<?php echo wpsc_product_rater(); ?>
						
						
					<?php
						if(function_exists('gold_shpcrt_display_gallery')) :					
							echo gold_shpcrt_display_gallery(wpsc_the_product_id());
						endif;

						echo wpsc_also_bought(wpsc_the_product_id());
					?>					
					</div>
		
					<form onsubmit="submitform(this);return false;" action="<?php echo wpsc_this_page_url(); ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_extra_<?php echo wpsc_the_product_id(); ?>">
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="prodid"/>
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="item"/>
					</form>
				</div>
			</div>
		</div>
		
		<?php echo wpsc_product_comments(); ?>
<?php endwhile; ?>
<?php /** end the product loop here */?>

		<?php
		if(function_exists('fancy_notifications')) {
			echo fancy_notifications();
		}
		?>
	

</div>
