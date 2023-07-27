<?php 
$edit_data		=	$this->db->get_where('help_link' , array('helplink_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_help_link');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/help_link/do_update/'.$row['helplink_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="title" value="<?php echo $row['title'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('links');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="link" value="<?php echo $row['link'];?>"/>
                        </div>
                    </div>
                   
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-primary"><i class="fa fa-save">&nbsp;<?php echo get_phrase('edit_helpful_links');?></i></button>
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


