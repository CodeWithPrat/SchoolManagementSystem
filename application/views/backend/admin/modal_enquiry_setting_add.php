<?php $class_info = $this->db->get('class')->result_array(); ?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_enquiry_setting'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <?php echo form_open(base_url().'index.php?admin/enquiry_setting/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                   
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('category'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="category" class="form-control" id="field-1" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('purpose'); ?></label>

                        <div class="col-sm-9">
                            <input type="text" name="purpose" class="form-control" id="field-1" >
                        </div>
                    </div>
                    
					 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('whom'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="whom" class="form-control" id="field-1" >
                        </div>
                    </div>

                    <div class="col-sm-3 control-label col-sm-offset-2">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>

            </div>

        </div>

    </div>
</div>