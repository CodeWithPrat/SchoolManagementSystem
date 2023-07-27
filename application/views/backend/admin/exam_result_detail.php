<hr>
<div class="row">
    <div class="col-md-12">
	<hr>
        <!------CONTROL TABS START------>
		 <div class="panel panel-success" >
            
                <div class="panel-heading">
                    <div class="panel-title">
                         <?php echo $detail_list[0]['class'] ?> | <?php echo $detail_list[0]['student'] ?> | <?php echo $detail_list[0]['subject'] ?> | <?php echo $detail_list[0]['date'] ?> <?php echo get_phrase('exam_reult'); ?>
               
                    </div>
                </div>
        <!------CONTROL TABS END------>

        <div class="tab-content">
            <div class="tab-pane box active" id="list">
                <div class="row form-group">
                    <div class="col-md-6"></div>
                </div>
            </div>

            <?php
            $marks = 0;
            foreach ($detail_list as $row) {
                ?>
                <div class="row form-group border-top" style="padding-top: 10px;">
                    <label class="col-sm-2 col-md-2 col-lg-2 text-right"><?php echo get_phrase('question'); ?>:</label>
                    <div class="col-sm-10 col-md-10 col-lg-10"><?php echo $row['question']; ?></div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-2 col-md-2 col-lg-2 text-right"><?php echo get_phrase('correct_answer'); ?>:</label>
                    <div class="col-sm-10 col-md-10 col-lg-10"><?php echo $row['correct_content']; ?></div>
                </div>                
                <div class="row form-group">
                    <label class="col-sm-2 col-md-2 col-lg-2 text-right"><?php echo get_phrase('your_answer'); ?>:</label>
                    <div class="col-sm-10 col-md-10 col-lg-10"><?php echo $row['answer_content']; ?></div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-2 col-md-2 col-lg-2 text-right"><?php echo get_phrase('result'); ?>:</label>
                    <div class="col-sm-10 col-md-10 col-lg-10"><?php echo ($row['marks'] == 1 ? '<i class="btn btn-success fa fa-check"></i>' : '<i class="btn btn-danger fa fa-times"></i>'); ?></div>
                </div>
                <input type="hidden" class="marks" value="<?php echo $row['marks']; ?>"/>
                <?php
                if ($row['marks'] == 1)
                    $marks ++;
            }
            ?>
            <div class="row form-group border-top" style="padding-top: 10px;">
                <label class="col-sm-4 col-md-4 col-lg-4 text-right"><h2><?php echo get_phrase('marks'); ?>:</h2></label>
                <div class="col-sm-8 col-md-8 col-lg-8"><h2><?php echo $marks; ?> / <?php echo $detail_list[0]['question_count'] ?></h2></div>
            </div>

        </div>
    </div>
</div>
</div>