<?php 
$edit_data		=	$this->db->get_where('circular' , array('circular_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_circular');?>
            	</div>
            </div>
			<div class="panel-body">
			
                <?php echo form_open(base_url() . 'index.php?admin/circular/do_update/'.$row['circular_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="subject" value="<?php echo $row['subject'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('reference_no');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="ref" value="<?php echo $row['ref'];?>"/>
                        </div>
                    </div>
					
					<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('content');?></label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" name="content"><?php echo $row ['content'];?></textarea>
                                </div>
                            </div>
					
							
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>

                        <div class="col-sm-7">
                            <div class="date-and-time">
                                <input type="text" value="<?php echo $row['date'];?>" name="date" class="form-control datepicker" data-format="D, dd MM yyyy">
                            </div>
                        </div>
                    </div>
                            
					
                   
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-primary"><i class="fa fa-save">&nbsp;<?php echo get_phrase('edit_circular');?></i></button>
						</div>
					</div>
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>


