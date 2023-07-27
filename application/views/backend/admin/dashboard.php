<style>
#chartdiv {
	width		: 100%;
	height		: 250px;
	font-size	: 11px;
}							
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/pie.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<style>
#chartdiv2 {
	width		: 100%;
	height		: 250px;
	font-size	: 11px;
}					
.style2 {font-size: 24px}
</style>



<div class="row">
<div class="col-md-12">
		<div class="row">
            <div class="col-md-3">
            
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('student');?>" 
                    		data-postfix="" data-duration="1500" data-delay="0">0</div>
                 
                    <h3><?php echo get_phrase('student');?></h3>
                   <p>Total students</p>
                </div>
                
            </div>
            <div class="col-md-3">
            
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('teacher');?>" 
                    		data-postfix="" data-duration="800" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('teacher');?></h3>
                   <p>Total teachers</p>
                </div>
                
            </div>
            <div class="col-md-3">
            
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('parent');?>" 
                    		data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('parent');?></h3>
                   <p>Total parents</p>
                </div>
                
            </div>
			
			<div class="col-md-3">
            
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-book"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('librarian');?>" 
                    		data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('librarian');?></h3>
                   <p>Total librarian</p>
                </div>
                
            </div>
			
			<div class="col-md-3">
            
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('accountant');?>" 
                    		data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('Accountants');?></h3>
                   <p>Total Accountants</p>
                </div>
                
            </div>
			
			<div class="col-md-3">
            
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-gear"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('enquiry');?>" 
                    		data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('all_enquries');?></h3>
                   <p>Total Enquiries</p>
                </div>
                
            </div>
			
			<div class="col-md-3">
            
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="fa fa-envelope"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('message');?>" 
                    		data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('all_messages');?></h3>
                   <p>All Messages</p>
                </div>
                
            </div>
			
			
            <div class="col-md-3">
            
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <?php 
							$check	=	array(	'date' => date('Y-m-d') , 'status' => '1' );
							$query = $this->db->get_where('attendance' , $check);
							$present_today		=	$query->num_rows();
						?>
                    <div class="num" data-start="0" data-end="<?php echo $present_today;?>" 
                    		data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('attendance');?></h3>
                   <p>Total present student today</p>
                </div>
                
            </div>
    	</div>
    </div>
	

	<div class="col-md-7">
    	<div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-gradient " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('event_schedule');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
        </div>
    </div>
	
	
	<div class="col-md-5">
    	<div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-gradient " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('Charts');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
							
						 <div id="chartdiv2"></div>	              
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
        </div>
    </div>
	
	<div class="col-md-5">
    	<div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-gradient " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('Charts');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
			                   
							   
			                     <div id="chartdiv"></div>

							   
							   								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
        </div>
    </div>
	
	
	
    </div>
	



    <script>
  $(document).ready(function() {
	  
	  var calendar = $('#notice_calendar');
				
				$('#notice_calendar').fullCalendar({
					header: {
						left: 'title',
						right: 'today prev,next'
					},
					
					//defaultView: 'basicWeek',
					
					editable: false,
					firstDay: 1,
					height: 530,
					droppable: false,
					
					events: [
						<?php 
						$notices	=	$this->db->get('noticeboard')->result_array();
						foreach($notices as $row):
						?>
						{
							title: "<?php echo $row['notice_title'];?>",
							start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
							end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>) 
						},
						<?php 
						endforeach
						?>
						
					]
				});
	});
  </script>

  <script>
var chart;
var legend;
var selected;

var types = [{
  type: "<?php echo get_phrase('section');?>",
  percent: <?php echo $this->db->count_all('section');?>,
  color: "#ff9e01",
  subs: [{
    type: "<?php echo get_phrase('class');?>",
    percent: <?php echo $this->db->count_all('class');?>,
  }, {
    type: "<?php echo get_phrase('subject');?>",
    percent: <?php echo $this->db->count_all('subject');?>,
  }, {
    type: "<?php echo get_phrase('study_material');?>",
    percent: <?php echo $this->db->count_all('document');?>,
  }]
}, {
  type: "<?php echo get_phrase('transportations');?>",
  percent: <?php echo $this->db->count_all('transport');?>,
  color: "#b0de09",
  subs: [{
    type: "<?php echo get_phrase('assignments');?>",
    percent: <?php echo $this->db->count_all('assignment');?>
  }, {
    type: "<?php echo get_phrase('syllabus');?>",
    percent: <?php echo $this->db->count_all('document');?>
  }, {
    type: "<?php echo get_phrase('task_manager');?>",
    percent: <?php echo $this->db->count_all('task_manager');?>
  }]
  
  }, {
  type: "<?php echo get_phrase('expenses');?>",
  percent: <?php echo $this->db->count_all('expense_category');?>,
  color: "#FF0000",
  subs: [{
    type: "<?php echo get_phrase('all_news');?>",
    percent: <?php echo $this->db->count_all('news');?>
  }, {
    type: "<?php echo get_phrase('exam_question');?>",
    percent: <?php echo $this->db->count_all('question');?>
  }, {
    type: "<?php echo get_phrase('thoughts');?>",
    percent: <?php echo $this->db->count_all('todays_thought');?>
  }]
}];

function generateChartData() {
  var chartData = [];
  for (var i = 0; i < types.length; i++) {
    if (i == selected) {
      for (var x = 0; x < types[i].subs.length; x++) {
        chartData.push({
          type: types[i].subs[x].type,
          percent: types[i].subs[x].percent,
          color: types[i].color,
          pulled: true
        });
      }
    } else {
      chartData.push({
        type: types[i].type,
        percent: types[i].percent,
        color: types[i].color,
        id: i
      });
    }
  }
  return chartData;
}

AmCharts.makeChart("chartdiv", {
  "type": "pie",
"theme": "light",

  "dataProvider": generateChartData(),
  "labelText": "[[title]]: [[value]]",
  "balloonText": "[[title]]: [[value]]",
  "titleField": "type",
  "valueField": "percent",
  "outlineColor": "#FFFFFF",
  "outlineAlpha": 0.8,
  "outlineThickness": 2,
  "colorField": "color",
  "pulledField": "pulled",
  "titles": [{
    "text": "Click a slice to see the details"
	
  }],
  "listeners": [{
    "event": "clickSlice",
    "method": function(event) {
      var chart = event.chart;
      if (event.dataItem.dataContext.id != undefined) {
        selected = event.dataItem.dataContext.id;
      } else {
        selected = undefined;
      }
      chart.dataProvider = generateChartData();
      chart.validateData();
    }
  }],
  "export": {
    "enabled": true
  }
});
</script>


<script src="<?php echo base_url() ?>js/amcharts.js"></script>
<script src="<?php echo base_url() ?>js/serial.js"></script>

<script src="<?php echo base_url() ?>js/canvasjs.min.js"></script>
<script>

 $(function () {
//        $('#sel_location_modal').slideDown('slow');
<?php if ($this->session->userdata('isFirst')) { ?>
            showSelectLocationModal();
<?php } ?>

        var chart = AmCharts.makeChart("chartdiv2", {
            "titles": [{
                    "text": "Statics Chart",
                    "size": 15,
                    "color": '#FF0000'
                }],
            "type": "serial",
            "theme": "light",
            "marginTop": 50,
            "marginRight": 40,
            "dataProvider": [{
                    "index": " <?php echo get_phrase('payment');?>",
                    "value": <?php echo $this->db->count_all('payment');?>
                }, {
                    "index": " <?php echo get_phrase('all_invoice');?>",
                    "value": <?php echo $this->db->count_all('invoice');?>
                }, {
                    "index": " <?php echo get_phrase('help_desk');?>",
                    "value": <?php echo $this->db->count_all('help_desk');?>
                }, {
                    "index": " <?php echo get_phrase('results');?>",
                    "value": <?php echo $this->db->count_all('exam_result');?>
                }, {
                    "index": " <?php echo get_phrase('enquiry');?>",
                    "value": <?php echo $this->db->count_all('enquiry');?>
                }, {
                    "index": " <?php echo get_phrase('media');?>",
                    "value": <?php echo $this->db->count_all('media');?>
                }],
            "valueAxes": [{
                    "axisAlpha": 0.5,
                    "position": "left"
                }],
            "graphs": [{
                    "id": "g1",
                    "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
                    "bullet": "round",
                    "bulletSize": 8,
                    "lineColor": "#4e7d2a",
                    "lineThickness": 2,
                    "negativeLineColor": "#4e7d2a",
                    "type": "smoothedLine",
                    "valueField": "value",
                    "balloonColor": "#f7941d",
                    "balloon": {
                        "adjustBorderColor": true,
                        "color": "#fff",
                        "cornerRadius": 5,
                        "fillColor": "#FF0000"
                    }
                }],
//            "chartScrollbar": {
//                "graph": "g1",
//                "gridAlpha": 0,
//                "color": "#888888",
//                "scrollbarHeight": 55,
//                "backgroundAlpha": 0,
//                "selectedBackgroundAlpha": 0.1,
//                "selectedBackgroundColor": "#888888",
//                "graphFillAlpha": 0,
//                "autoGridCount": true,
//                "selectedGraphFillAlpha": 0,
//                "graphLineAlpha": 0.2,
//                "graphLineColor": "#c2c2c2",
//                "selectedGraphLineColor": "#888888",
//                "selectedGraphLineAlpha": 1
//
//            },
            "chartCursor": {
//                "categoryBalloonDateFormat": "YYYY",
                "cursorAlpha": 0,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "valueLineAlpha": 0.5,
                "fullWidth": true,
                "color":"#fff",
                "cursorColor": "#4e7d2a",
                "zoomable": false
            },
//            "dataDateFormat": "YYYY",
            "categoryField": "index",
            "categoryAxis": {
//                "minPeriod": "YYYY",
                "parseDates": false,
                "minorGridAlpha": 0.1,
                "minorGridEnabled": true,
                "autoWrap":true,
            },
            "export": {
                "enabled": true
            }
        });
//
//        chart.addListener("rendered", zoomChart);
//        if (chart.zoomChart) {
//            chart.zoomChart();
//        }
//
//        function zoomChart() {
//            chart.zoomToIndexes(Math.round(chart.dataProvider.length * 0.4), Math.round(chart.dataProvider.length * 0.55));
//        }


    });
</script>
