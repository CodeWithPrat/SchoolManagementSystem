<hr>
<blockquote class="blockquote-default">
			<p>
			<strong>General Information</strong>
			</p>
			<p>
			<small style="color: #FF0000">
			Thanks for showing interest in our software, please note that these are just general settings for school front end. You can contact the 							            author if you want to customise or implement front end to this software. Thanks
			</small>
		    </p>
		    </blockquote>
 <div class="panel panel-gradient" >
            
                <div class="panel-heading">
                    <div class="panel-title">
					 <?php echo get_phrase('parent_information_page'); ?>
					</div>
					</div>
<br>
           &nbsp;&nbsp;&nbsp;&nbsp;
<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_enquiry_setting_add');" 
    class="btn btn-primary">
        <?php echo get_phrase('enquiry_category_settings'); ?>
</button>
<div style="clear:both;"></div>
<br>
<div class="table-responsive">
			
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo get_phrase('category');?></th>
            <th><?php echo get_phrase('purpose');?></th>
            <th><?php echo get_phrase('who_to_visit');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
                                $enquiry_category	=	$this->db->get('enquiry_category' )->result_array();
                                foreach($enquiry_category as $row):?>
            <tr>
                <td><?php echo $row['enquirycat_id']?></td>
                <td><?php echo $row['category']?></td>
                <td><?php echo $row['purpose']; ?></td>
                <td><?php echo $row['whom']?></td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_enquiry_setting_edit/<?php echo $row['enquirycat_id']?>');" 
                        class="btn btn-info btn-sm btn-icon icon-left">
                            <i class="entypo-pencil"></i>
                            Edit
                    </a>
                    <a href="<?php echo base_url();?>index.php?admin/enquiry_setting/delete/<?php echo $row['enquirycat_id']?>" 
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
</div>



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
