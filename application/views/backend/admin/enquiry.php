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
<hr>

 <div class="panel panel-gradient" >
            
                <div class="panel-heading">
                    <div class="panel-title">
					 <?php echo get_phrase('enquiry_information_page'); ?>
					</div>
					</div>
<div class="table-responsive">

<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo get_phrase('category');?></th>
            <th><?php echo get_phrase('mobile');?></th>
            <th><?php echo get_phrase('purpose');?></th>
            <th><?php echo get_phrase('name');?></th>
            <th><?php echo get_phrase('who_to_visit');?></th>
            <th><?php echo get_phrase('date_submitted');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
                                $enquiry	=	$this->db->get('enquiry' )->result_array();
                                foreach($enquiry as $row):?>
            <tr>
                <td><?php echo $row['enquiry_id']?></td>
                <td><?php echo $row['category']?></td>
                <td><?php echo $row['mobile']?></td>
                <td><?php echo $row['purpose']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['whom_to_meet']?></td>
                <td><span class="label label-primary"><?php echo $row['date']?></span></td>
                <td>
                    
                    <a href="<?php echo base_url();?>index.php?admin/enquiry/delete/<?php echo $row['enquiry_id']?>" 
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
