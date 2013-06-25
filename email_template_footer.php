										</td>
									</tr>
								</table>	
							</td>
						</tr>
						<tr>	
							<td width="600" valign="top" align="left" class="content">
							</td>
						</tr>
					</table>
					<hr />
					<!-- social & contact -->
					<table class="social" width="100%">
						<tr>
							<td>
								<!-- column 1 -->
								<table align="left" class="column">
									<tr>
										<td>				
											<h5 class=""><?php _e('Connect with Us','fids');?>:</h5>
											<p class=""><a href="<?php echo stripslashes(of_get_option('facebook', '')); ?>" class="soc-btn fb" target="_blank"><?php _e('Facebook','fids');?></a><a href="https://twitter.com/<?php echo stripslashes(of_get_option('twitter', '')); ?>" class="soc-btn tw" target="_blank"><?php _e('Twitter','fids');?></a><?php /* <a href="#" class="soc-btn gp"><?php _e('LinkedIN','fids');?></a>*/?></p>
										</td>
									</tr>
								</table><!-- /column 1 -->	
								<!-- column 2 -->
								<table align="left" class="column" style="float:right;">
									<tr>
										<td>				
											<h5 class=""><?php _e('Contact Info','fids');?>:</h5>												
											<p><?php _e('Phone','fids');?> <strong><?php echo stripslashes(of_get_option('site_contact_no', '')); ?></strong><br/>
                <?php _e('Email','fids');?>: <strong><a href="emailto:services@courtwell.com"><?php echo stripslashes(of_get_option('site_email', '')); ?></a></strong><br />
											<?php _e('Telefax','fids');?>: <strong><?php echo stripslashes(of_get_option('fax_no', '')); ?></strong><br/>
											<?php _e('Web','fids');?>: <strong><a href="http://www.courtwell.com" target="_blank">www.courtwell.com</a></strong></p>
										</td>
									</tr>
								</table><!-- /column 2 -->
								<span class="clear"></span>	
							</td>
						</tr>
					</table><!-- /social & contact -->
					<!-- FOOTER -->
					<table class="footer-wrap">
						<tr>
							<td></td>
							<td class="container">
								<!-- content -->
								<div class="content">
									<table>
										<tr>
											<td align="center">
												<p><strong><?php _e('THE CONTENTS OF THIS MESSAGE ARE CONFIDENTIAL AND INTENDED FOR THE ADDRESSEE ONLY','fids');?></strong></p>
												<?php /*
												<p>
													<a href="#"><?php _e('Terms','fids');?></a> |
													<a href="#"><?php _e('Privacy','fids');?></a>
												</p>
												*/?>
											</td>
										</tr>
									</table>
									<span class="clear"></span>
								</div><!-- /content -->
							</td>
							<td></td>
						</tr>
					</table><!-- /FOOTER -->
		  		</td>
			</tr>
		</table>
	</body>
</html>