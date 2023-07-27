 <hr>
 <div class="panel panel-gradient" >
            
                <div class="panel-heading">
                    <div class="panel-title">
					 <?php echo get_phrase('parent_information_page'); ?>
					</div>
					</div>
<div class="table-responsive">
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('circular_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_circular');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
        
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
<table class="table table-bordered table-striped datatable" id="table-2">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('subject');?></div></th>
                    		<th><div><?php echo get_phrase('reference_no');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($circular as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['subject'];?></td>
							<td><?php echo $row['ref'];?></td>
							<td><?php echo $row['date'];?></td>
							<td>
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_circular/<?php echo $row['circular_id'];?>');" 
                        class="btn btn-info btn-sm btn-icon icon-left">
                            <i class="entypo-pencil"></i>
                            Edit
                    </a>
                    <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/circular/delete/<?php echo $row['circular_id'];?>');" 
                        class="btn btn-danger btn-sm btn-icon icon-left" onclick="return confirm('Are you sure to delete?');">
                            <i class="entypo-cancel"></i>
                            Delete
                    </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/circular/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('circular_title');?></label>
                                <div class="col-sm-5">
                                    <input name="subject" type="text" class="form-control"/>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('reference_no');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="ref"/>
                                </div>
                            </div>
							
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('content');?></label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" name="content"></textarea>
                                </div>
                            </div>
							
							
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('circular_date'); ?></label>

                        <div class="col-sm-7">
                            <div class="date-and-time">
                                <input type="text" name="date" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                            </div>
                        </div>
                    </div>
                            
                           <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-success btn-sm btn-icon icon-left"> <i class="entypo-plus"></i><?php echo get_phrase('add_circular');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
		</div>
	</div>
</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>