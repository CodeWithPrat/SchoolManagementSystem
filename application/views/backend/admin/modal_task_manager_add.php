<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_task_manager'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <?php echo form_open(base_url().'index.php?admin/task_manager/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                   
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('task_name'); ?></label>

                        <div class="col-sm-5">
                            <input type="text" name="name" class="form-control" id="field-1" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                        <div class="col-sm-9">
                            <textarea type="text" name="description" class="form-control"></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('task_priority'); ?></label>

                        <div class="col-sm-9">
						<select name="priority" class="form-control">
						<option value="High">High</option>
						<option value="Normal">Normal</option>
						<option value="Medium">Medium</option>
						<option value="Low">Low</option>
						</select>
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('task_date'); ?></label>

                        <div class="col-sm-7">
                            <div class="date-and-time">
                                <input type="text" name="date" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                            </div>
                        </div>
                    </div>
					
					
					<div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('task_for'); ?></label>

                        <div class="col-sm-9">
						<select class="form-control select2" name="user" required>

            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
            <optgroup label="<?php echo get_phrase('student'); ?>">
                <?php
                $students = $this->db->get('student')->result_array();
                foreach ($students as $row):
                    ?>

                    <option value="student-<?php echo $row['name']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('parent'); ?>">
                <?php
                $parents = $this->db->get('parent')->result_array();
                foreach ($parents as $row):
                    ?>

                    <option value="parent-<?php echo $row['name']; ?>">
                        - <?php echo $row['name']; ?></option>
						
						
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('librarian'); ?>">
                <?php
                $librarians = $this->db->get('librarian')->result_array();
                foreach ($librarians as $row):
                    ?>

                    <option value="parent-<?php echo $row['name']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			
			 <optgroup label="<?php echo get_phrase('accountant'); ?>">
                <?php
                $accountants = $this->db->get('accountant')->result_array();
                foreach ($accountants as $row):
                    ?>

                    <option value="parent-<?php echo $row['name']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			 <optgroup label="<?php echo get_phrase('hostel'); ?>">
                <?php
                $hostels = $this->db->get('hostel')->result_array();
                foreach ($hostels as $row):
                    ?>

                    <option value="parent-<?php echo $row['name']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
        </select>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('task_status'); ?></label>

                        <div class="col-sm-9">
						<select name="status" class="form-control">
						<option value="Open">Open</option>
						<option value="On Hold">On Hold</option>
						<option value="Resolved">Resolved</option>
						<option value="Closed">Closed</option>
						</select>
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