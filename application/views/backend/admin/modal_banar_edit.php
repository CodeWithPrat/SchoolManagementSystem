<?php 
$edit_data		=	$this->db->get_where('banar' , array('banar_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_bannar');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/banar/do_update/'.$row['banar_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
                                <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                                
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo $this->crud_model->get_image_url('banar' , $row['banar_id']);?>" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="userfile" accept="image/*">
                                            </span>
                                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                         <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('banner_text_1');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="b_namea" value="<?php echo $row ['b_namea'] ;?>" >
						</div>
					</div>
				
				
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('banner_text_2');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="b_nameb" value="<?php echo $row ['b_nameb'] ;?>" >
						</div> 
					</div>
                            
                            
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>&nbsp;<?php echo get_phrase('edit_banar');?></button>
                            </div>
                        </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>