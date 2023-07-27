<?php 
$edit_data		=	$this->db->get_where('club' , array('club_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_club');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/club/do_update/'.$row['club_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('club_name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="club_name" value="<?php echo $row['club_name'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="desc" value="<?php echo $row['desc'];?>"/>
                        </div>
                    </div>
                   
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-primary"><i class="fa fa-save">&nbsp;<?php echo get_phrase('edit_club');?></i></button>
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


