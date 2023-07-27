
<div class="row">
	<div class="col-md-12">       
           		<!----CREATION FORM STARTS---->
 <div class="panel panel-gradient" >
                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('supply_front_end_information');?>
                    </div>
                </div>
				
   <?php echo form_open(base_url() . 'index.php?admin/front_end/do_update' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
							                <div class="panel-body">
											
			<blockquote class="blockquote-default">
			<p>
			<strong>General Information</strong>
			</p>
			<p>
			<small style="color: #FF0000">
			Thanks for showing interest in our software, please note that these are just general settings for school front end. You can contact the 							            author if you want to customise or implement front end to this software. Thanks
			</small>
		    </p>
		    </blockquote>

							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('about_us');?></label>
                                <div class="col-sm-5">
                <textarea  class="form-control" value = "" name="about_us"/><?php echo $this->db->get_where('front_end' , array('type' =>'about_us'))->row()->description;?></textarea>
								</div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('vision');?></label>
                                <div class="col-sm-5">
                <textarea  class="form-control" value = "" name="vission"/><?php echo $this->db->get_where('front_end' , array('type' =>'vission'))->row()->description;?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('mission');?></label>
                                <div class="col-sm-5">
                <textarea  class="form-control" value = "" name="mission"/><?php echo $this->db->get_where('front_end' , array('type' =>'mission'))->row()->description;?></textarea>

                                </div>
                            </div>
							
				<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('goal');?></label>
                                <div class="col-sm-5">
                <textarea  class="form-control" value = "" name="goal"/><?php echo $this->db->get_where('front_end' , array('type' =>'goal'))->row()->description;?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('services');?></label>
                                <div class="col-sm-5">
                <textarea  class="form-control" value = "" name="services"/><?php echo $this->db->get_where('front_end' , array('type' =>'services'))->row()->description;?></textarea>
                                </div>
                            </div>

                        		<div class="form-group">
                              	<div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;<?php echo get_phrase('save_settings');?></button>
                              	</div>
								</div>
								</div>
                    </form>  
					        
                </div>                
			            <?php echo form_close();?>

			<!----CREATION FORM ENDS-->
			
			
	</div>
	</div>