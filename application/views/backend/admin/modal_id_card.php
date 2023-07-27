<?php 
$edit_data		=	$this->db->get_where('hostel' , array('hostel_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<center>
    <a onClick="PrintElem('#invoice_print')" class="btn btn-primary btn-icon icon-left hidden-print pull-right">
        Print Invoice
        <i class="entypo-print"></i>
    </a>
</center>

    <br><br>

    <div id="invoice_print">
        <table width="100%" border="0">
            <tr>
                <td align="center">
                    <img src="<?php echo $this->crud_model->get_image_url('hostel' , $row['hostel_id']);?>" width="80" height="80" alt="...">
                </td>
            </tr>
        </table>
        <hr>
        <table width="100%" border="0">    
            <tr>
                <td align="center" valign="top">
                    Name:&nbsp;&nbsp;&nbsp;<?php echo $row['name'];?><br><br>
                    Sex:&nbsp;&nbsp;&nbsp;<?php echo $row['sex'];?><br><br>
                    Mobile Number:&nbsp;&nbsp;&nbsp;<?php echo $row['phone'];?><br><br>
                    Address:&nbsp;&nbsp;&nbsp;<?php echo $row['address'];?> <br><br>
					Occupation:&nbsp;&nbsp;&nbsp;<?php echo get_phrase('hostel');?>            
                </td>
            </tr>
        </table>
        <hr>
    </div>
<?php endforeach; ?>


<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>