<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<hr />
 <div class="panel panel-gradient" >
            
                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('exam_settings');?>
                    </div>
                </div>
                <div class="panel-body">
    <?php echo form_open(base_url() . 'index.php?admm/examxreateinfo/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
    <div class="padded">
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo get_phrase('exam_class'); ?></label>
            <div class="col-sm-5">
                <select name="class_id" id="class_id" type="text" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" onchange="return get_class_subject()">
                    <?php
                    foreach ($classes as $row):
                        ?>
                        <option value="<?php echo $row['class_id'] ?>"><?php echo $row['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo get_phrase('exam_subject'); ?></label>
            <div class="col-sm-5">
                <select name="subject_id" id="subject_id" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                    <?php
                    foreach ($subjects as $row):
                        ?>
                        <option value="<?php echo $row['subject_id'] ?>"><?php echo $row['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo get_phrase('exam_date'); ?></label>
            <div class="col-sm-5">
                <input type="text" name="date" class="form-control datepicker" placeholder="Admin will select date"  data-start-view="2" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo get_phrase('session'); ?></label>
            <div class="col-sm-5">
     <input value="<?php echo $this->db->get_where('settings' , array('type' =>'session'))->row()->description;?>" name="session" class="form-control" readonly="true">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo get_phrase('question_count'); ?></label>
            <div class="col-sm-4">
                <input type="number" name="question_count" class="form-control" placeholder="Question Count"  data-start-view="2" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
            </div>

        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo get_phrase('exam_duration'); ?></label>
            <div class="col-sm-4">
                <input type="number" name="duration" class="form-control" placeholder="Maximum Time for exam"  data-start-view="2" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
            </div>
            <div class="col-sm-3" style="text-align: left; line-height: 30px;"> <span style="color:#FF0000">Minutes</span></div>

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-5">
            <button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>&nbsp;<?php echo get_phrase('continue'); ?></button>
        </div>
    </div>
</form>                
</div> 
</div> 

<script type="text/javascript">

    $(function () {
        get_class_subject();
    });
    function get_class_subject() {
        var class_id = $('#class_id :selected').val();
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_subject/' + class_id,
            async: false,
            success: function (response)
            {
                $('#subject_id').html(response);
            }
        });
    }

</script>