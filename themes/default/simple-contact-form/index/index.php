<?php
echo head(array('bodyclass' => 'contact'));
?>

	<div class="content-wrapper simple-page-section ">
	  <div class="container simple-page-container">
	    <!-- Content -->
      <div class="row">
				<div class="col-sm-9 col-xs-12 page">
					<div class='row breadcrumbs'>
						<div class="col-sm-12 col-xs-12">
							<p id="simple-pages-breadcrumbs">
								<span>
									<a href="http://libis.be/">Startpagina</a>
									> Contact
									</p>
								</span></p>
						</div>
					</div>
					<div class='row content'>
						<div class="col-sm-12 col-xs-12">
										<div id="form-instructions">
											<?php echo get_option('simple_contact_form_contact_page_instructions'); // HTML ?>
										</div>
										<?php echo flash(); ?>
										<form name="contact_form" id="contact-form"  method="post" enctype="multipart/form-data" accept-charset="utf-8">
												<fieldset>
									        <div class="field">
														<h3><?php echo $this->formLabel('name', 'Naam: ');?></h3>
														<?php echo $this->formText('name', $name, array('class'=>'textinput')); ?>
													</div>

									        <div class="field">
									            <h3><?php echo $this->formLabel('email', 'E-mail: ');?></h3>
											    		<?php echo $this->formText('email', $email, array('class'=>'textinput'));  ?>
									        </div>

													<div class="field">
													  	<h3><?php echo $this->formLabel('message', 'Bericht: ');?></h3>
													    <?php echo $this->formTextarea('message', $message, array('class'=>'textinput')); ?>
													</div>
											</fieldset>

											<fieldset>
													<div class="field">
													  <?php echo $captcha; ?>
													</div>

													<div class="field">
													  <?php echo $this->formSubmit('send', 'Verstuur'); ?>
													</div>
									    </fieldset>
										</form>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
<?php echo foot(); ?>
