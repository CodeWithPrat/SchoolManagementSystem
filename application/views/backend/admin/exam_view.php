<hr>
<div class="row">
    <div class="col-md-12">
        <!------CONTROL TABS START------>
<div class="panel panel-gradient" >
            
                <div class="panel-heading">
                    <div class="panel-title">
                        <?php echo get_phrase('exam_settings');?>
                    </div>
                </div>
                <div class="panel-body">
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('question_list'); ?>
                </a></li>
            <li>
                <a href="#edit" data-toggle="tab"><i class="entypo-cog"></i>
                    <?php echo get_phrase('exam_setting'); ?>
                </a></li>
        </ul>
        <div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo get_phrase('question'); ?></div></th>
                            <?php
                            for ($i = ord('A'); $i <= ord($max_label); $i++) {
                                ?>
                                <th><div><?php echo chr($i) ?></div></th>
                                <?php
                            }
                            ?>
                            <th><div><?php echo get_phrase('coreect_answer'); ?></div></th>
                            <th><div><?php echo get_phrase('options'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($exam_data as $row):
                            ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['question']; ?></td>
                                <?php
                                for ($i = ord('A'); $i <= ord($max_label); $i++) {
                                    ?>
                                    <td><div><?php echo $row[chr($i)] ?></div></td>
                                    <?php
                                }
                                ?>
                                <td><?php echo $row['correct_answers']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-primary pull-right" role="menu">

                                            <!-- EDITING LINK -->
                                            <li>
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/exam_edit/<?php echo $row['question_id']; ?>');">
                                                    <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit'); ?>
                                                </a>
                                            </li>
                                            <li class="divider"></li>

                                            <!-- DELETION LINK -->
                                            <li>
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/exam_view/<?php echo $row['class_id'] . '/' . $row['subject_id'] . '/' . $row['duration'] . '/' . $row['date'] . '/' . ($row['session'] == '' ? '%null' : $row['session']) ?>/delete/<?php echo $row['question_id']; ?>');">
                                                    <i class="entypo-trash"></i>
                                                    <?php echo get_phrase('delete'); ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->

            <div class="tab-pane box" id="edit" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open(base_url() . 'index.php?admin/exam_view', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                    <input type="hidden" name="mode1" value="save_exam"/>

                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                            <div class="col-sm-5">
                                <select name="class_id" type="text" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" onchange="return get_class_subject(this.value)">
                                    <?php
                                    foreach ($classes as $row):
                                        ?>
                                        <option value="<?php echo $row['class_id'] ?>" <?php echo ($row['class_id'] == $class_id ? 'selected' : '') ?>><?php echo $row['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('subject'); ?></label>
                            <div class="col-sm-5">
                                <select name="subject_id" id="subject_selector_holder" class="form-control" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>">
                                    <?php
                                    foreach ($subjects as $row):
                                        ?>
                                        <option value="<?php echo $row['subject_id'] ?>" <?php echo ($row['subject_id'] == $subject_id ? 'selected' : '') ?>><?php echo $row['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" name="date" class="form-control datepicker" value="<?php echo $date ?>" placeholder="Admin will select date"  data-start-view="2" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('session'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" name="session" value="<?php echo $session ?>" class="form-control" placeholder="Type session"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('question_count'); ?></label>
                            <div class="col-sm-4">
                                <input type="number" name="question_count" value="<?php echo $question_count ?>" class="form-control" placeholder="Question Count"  data-start-view="2" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('exam_duration'); ?></label>
                            <div class="col-sm-4">
                                <input type="number" name="duration" value="<?php echo $duration ?>" class="form-control" placeholder="Maximum Time for exam"  data-start-view="2" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                            <div class="col-sm-3" style="text-align: left; line-height: 30px;"><span style="color:#FF0000">Minutes</span></div>

                        </div>
                    </div>
                    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-5">
            <button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-book"></i>&nbsp;<?php echo get_phrase('save_now'); ?></button>
        </div>
    </div>
                    </form>  
                </div>
            </div>

        </div>
    </div>
</div>
</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

    jQuery(document).ready(function ($)
    {
        var datatable = $("#table_export").dataTable();
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

    function get_class_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_subject/' + class_id,
            success: function (response)
            {
                $('#subject_selector_holder').html(response);
            }
        });

    }

</script>