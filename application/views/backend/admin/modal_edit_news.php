<?php 
$edit_data		=	$this->db->get_where('news' , array('news_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_news');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/news/edit/do_update/'.$row['news_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('news_title');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="news_title" value="<?php echo $row['news_title'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="datepicker form-control" name="date" value="<?php echo $row['date'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('news_content');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="news_content" value="<?php echo $row['news_title'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                      <button type="submit" class="btn btn-info"><?php echo get_phrase('edit_news');?></button>
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





