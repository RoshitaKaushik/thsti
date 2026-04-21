<?php
$json_online = json_encode($getOnlineApplicationCount); 

$json_camp = json_encode($campaigns_total_Amount);
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
    .widget-content-left {
        background: #fff;
        padding: 18px 0px 18px 14px;
        font-size: 17px;
        font-weight: 700;
    }
    .widget-content-wrapper{
        margin-bottom:10px;
    }
    
    .widget-heading{
        display:inline;
        color: #797171;
    }
    .widget-numbers{
        float: right;
        display: inline;
        margin-right: 22px;
    }
</style>
<div class="content-page">
    <div class="content">
    	<div class="container">
    	    <div class="row">
				<div class="col-md-12">
					<div class="panel panel-color panel-info" style="background: transparent !important;">
						<div class="panel-heading">
							<h3 class="panel-title">Dashboard</h3>
						</div>
						<div class="panel-body">
						    
                            <div class="col-md-12">
                            		<div class="card mb-1 widget-content">
                            			<div class="widget-content-outer">
                            				<div class="widget-content-wrapper">
                            					<div class="widget-content-left">
                            						<div class="widget-heading">CONTACT DATABASE</div>
                            						<div class="widget-numbers text-success"><?= $total_contact ?></div>
                            					</div>
                            					<div class="widget-content-right">
                            						
                            					</div>
                            				</div>
                            			</div>
                            		</div>
                            		
                            	
                            		<div class="main-card mb-3 card">
                            			<div class="card-body">
                            				<!--h5 class="card-title">CONTACT DATABASE</h5-->
                            				<!--canvas id="chart-area"></canvas-->
                            				<div class="row">
                            				    <div class="col-md-6">
                            				        <div id="piechart1" style="width: 100%; height: 300px;"></div>
                            				    </div>
                            				    
                            				    <div class="col-md-6">
                            				        <div id="piechart2" style="width: 100%; height: 300px;"></div>
                            				    </div>
                            				    
                            				</div>
                            				
                            			</div>
                            		</div>
                            </div>	
                            
                            <div class="col-md-12" style="margin-top:20px;">
                                <div class="card mb-1 widget-content">
                                	<div class="widget-content-outer">
                                		<div class="widget-content-wrapper">
                                			<div class="widget-content-left">
                                				<div class="widget-heading">Finance </div>
                                				<!--div class="widget-subheading">Last year Finance</div-->
                                				<div class="widget-numbers text-warning"><?= $total_finance_amount['total_amount'] ?></div>
                                			</div>
                                			<div class="widget-content-right">
                                				
                                			</div>
                                		</div>
                                	</div>
                                </div>
                                
                                <div class="main-card mb-3 card">
                                	<div class="card-body">
                                		<!--h5 class="card-title">Finance </h5-->
                                		<!--canvas id="doughnut-chart"></canvas-->
                                		<div class="row">
                                		    <div class="col-md-6">
                                		        <div id="finanaceChartResult1" style="width: 100%; height: 300px;"></div>
                                		    </div>
                                		    <div class="col-md-6">
                                		        <div id="finanaceChartResult2" style="width: 100%; height: 300px;"></div>
                                		    </div>
                                		</div>
                                		
                                	</div>
                                </div>
        						
        					</div>	
                                <div class="col-md-12" style="margin-top:20px;">
                                    <div class="card mb-1 widget-content">
                                    	<div class="widget-content-outer">
                                    		<div class="widget-content-wrapper">
                                    			<div class="widget-content-left">
                                    				<div class="widget-heading">Finance</div>
                                    				<!--div class="widget-subheading">Last year Faculty</div-->
                                    				<div class="widget-numbers text-primary">
                                    				    <?= $total_finance_amount['total_amount'] ?>
                                    				</div>
                                    			</div>
                                    			<div class="widget-content-right">
                                    			</div>
                                    		</div>
                                    	</div>
                                    </div>
                                    <div class="main-card mb-3 card" >
                                        
                                    	<div class="card-body">
                                    		<!--h5 class="card-title">Faculty </h5-->
                                    		<!--canvas id="polar-chart"></canvas-->
                                    	    <div class="row">
                                    	        <div class="col-md-12">
                                    	            <div id="barchart_values" style="width: 100%; height: 400px;"> </div>
                                    	        </div>
                                    	    </div>
                                    		
                                    		
                                    	</div>
                                    	
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-12" style="margin-top:20px;">
                                    <div class="card mb-1 widget-content">
                                        <div class="widget-content-outer">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                	<div class="widget-heading">Online Application </div>
                                                	<!--div class="widget-subheading">Last year Timesheet </div-->
                                                </div>
                                                <div class="widget-content-right">
                                                	<div class="widget-numbers text-info"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <!--h5 class="card-title">Timesheet </h5-->
                                            <!--canvas id="canvas"></canvas-->
                                            <div id="chart_onlineForm"></div>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                
						</div>
					</div>
				</div>	
			</div>
    	</div>
    </div>
</div>



<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Present Faculity - (<?= $total_active_faculity ?>)',    <?= $total_active_faculity ?> ],
          ['Past Faculity - (<?= $total_past_faculity ?>)',      <?= $total_past_faculity ?>],
          ['Present Student - (<?= $total_current_faculity ?>)',  <?= $total_current_faculity ?>],
          ['Formal Student - (<?= $total_formal_faculity ?>)', <?= $total_formal_faculity ?>],
          ['Vista - (<?= $total_groups_wise_count['Vista'] ?>)', <?= $total_groups_wise_count['Vista'] ?>],
          ['Grantmaker Affiliate - (<?= $total_groups_wise_count['Foundation'] ?>)', <?= $total_groups_wise_count['Foundation'] ?>],
          ['Media - (<?= $total_groups_wise_count['Media'] ?>)', <?= $total_groups_wise_count['Media'] ?>],
          ['Appalachian Program - (<?= $total_groups_wise_count['Appalachian'] ?>)', <?= $total_groups_wise_count['Appalachian'] ?>],
          ['Past & Present Board Member - (<?= $total_groups_wise_count['BoardMember'] ?>)', <?= $total_groups_wise_count['BoardMember'] ?>],
         
        ]);
        
        var data2 = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Past & Present Student Family - (<?= $total_groups_wise_count['StudentFamily'] ?>)', <?= $total_groups_wise_count['StudentFamily'] ?>],
            ['Receives Printed Annual Report - (<?= $total_groups_wise_count['AnnualReport'] ?>)', <?= $total_groups_wise_count['AnnualReport'] ?>],
            ['Daniel / VIP - (<?= $total_groups_wise_count['DanielVIP'] ?>)', <?= $total_groups_wise_count['DanielVIP'] ?>],
            ['Friend of Daniel/ Not VIP - (<?= $total_groups_wise_count['FriendofDaniel'] ?>)', <?= $total_groups_wise_count['FriendofDaniel'] ?>],
            ['Need Daniel Permission to Contact - (<?= $total_groups_wise_count['DanielPermissionNeeded'] ?>)', <?= $total_groups_wise_count['DanielPermissionNeeded'] ?>],
            ['Send Graduation Invitation - (<?= $total_groups_wise_count['GraduationInvite'] ?>)', <?= $total_groups_wise_count['GraduationInvite'] ?>],
            ['Received Quarter Century Report - (<?= $total_groups_wise_count['QuarterCenturyReport'] ?>)', <?= $total_groups_wise_count['QuarterCenturyReport'] ?>],
            ['Do Not Email - (<?= $total_groups_wise_count['Unsubscribed'] ?>)', <?= $total_groups_wise_count['Unsubscribed'] ?>],
            ['Deceased - (<?= $total_groups_wise_count['Deceased'] ?>)', <?= $total_groups_wise_count['Deceased'] ?>]
           
        ]);
        
         
        var options = {
            // title: 'My Daily Activities' 
            sliceVisibilityThreshold:0,
            chartArea:{
                left:0,
                right:10,
                top:20,
                bottom:20,
                width:"100%",
                height:"100%"
            },
            //pieStartAngle: 100,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
        chart.draw(data, options);
        
        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data2, options);
      }
</script>

<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(financeChart);
  function financeChart() {
    var data = financialData();

    var options = {
      title: '',
      pieHole: 0.4,
      sliceVisibilityThreshold:0,
      chartArea:{
          left:0,
          top:20,
          bottom:20,
          width:"100%",
          height:"100%"
      },
    };
    var chart = new google.visualization.PieChart(document.getElementById('finanaceChartResult1'));
    chart.draw(data, options);
    
  }
  
  
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(financeChart2);
  function financeChart2() {
    var data = financialData2();

    var options = {
      title: '',
      pieHole: 0.4,
      sliceVisibilityThreshold:0,
      chartArea:{
          left:20,
          top:20,
          bottom:20,
          width:"100%",
          height:"100%"
      },
    };
    var chart = new google.visualization.PieChart(document.getElementById('finanaceChartResult2'));
    chart.draw(data, options);
    
  }
  
 
</script>

<script>
   
    /*google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = financialData();

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "",
        
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }*/
  
  function financialData(){
      
        const content = [];
        content.push(["Element", "Density", { role: "style" } ]);
        let json_online = <?= $json_camp ?>;
        console.log("JSON LENGTH",json_online.length)
        let first_half = Math.round((json_online.length)/2);
        for(let i = 0; i < first_half; i++) {
            obj = json_online[i];
            var cc = [];
            cc.push(obj.CampaignName);
            let amount = ((obj.Amount != null) && (obj.Amount != ''))?obj.Amount : 0.00; 
            cc.push(parseFloat(amount));
            cc.push("#"+Math.floor(Math.random() * 899999 + 100000));
            content.push(cc);
        }
        
        return google.visualization.arrayToDataTable( content );
  }
  
  function financialData2(){
      
        const content = [];
        content.push(["Element", "Density", { role: "style" } ]);
        let json_online = <?= $json_camp ?>;
        console.log("JSON LENGTH",json_online.length)
        let first_half = Math.round((json_online.length)/2);
        for(let i = first_half; i < json_online.length; i++) {
            obj = json_online[i];
            var cc = [];
            cc.push(obj.CampaignName);
            let amount = ((obj.Amount != null) && (obj.Amount != ''))?obj.Amount : 0.00; 
            cc.push(parseFloat(amount));
            cc.push("#"+Math.floor(Math.random() * 899999 + 100000));
            content.push(cc);
        }
        
        return google.visualization.arrayToDataTable( content );
  }
  
</script>


<script type="text/javascript">
      //google.charts.load('current', {'packages':['bar']});
      //google.charts.setOnLoadCallback(drawChart);
      
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
     
    function drawChart() {
      // Define the chart to be drawn.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Campanion');
      data.addColumn('number', 'Amount');
      const content = [];
      
        let json_online = <?= $json_camp ?>;
        for(let i = 0; i < json_online.length; i++) {
            obj = json_online[i];
            var cc = [];
            let amount = ((obj.Amount != null) && (obj.Amount != ''))?obj.Amount : 0.00;
            cc.push(obj.CampaignName);
            cc.push(parseFloat(amount));
            content.push(cc);
        }
        data.addRows(content);
      // Instantiate and draw the chart.
      var chart = new google.visualization.ColumnChart(document.getElementById('barchart_values'));
      chart.draw(data, null);
    }
      /*function drawChart() {
        
        
        
        const content = [];
        content.push(["Campanion", "Amount"]);
        let json_online = <?= $json_camp ?>;
        for(let i = 0; i < json_online.length; i++) {
            obj = json_online[i];
            var cc = [];
           
            let amount = ((obj.Amount != null) && (obj.Amount != ''))?obj.Amount : 0.00; 
            
            cc.push(obj.CampaignName);
            cc.push(parseFloat(amount));
            content.push(cc);
        }
        
        var data = google.visualization.arrayToDataTable(content);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_values'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }*/
</script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);
      function drawVisualization() {  
        let json_online = <?= $json_online ?>;
        //var content = "";
        const content = [];
        content.push(['Year', 'Approved', 'Submitted', 'Pending']);

        for(let i = 0; i < json_online.length; i++) {
            obj = json_online[i];
            var cc = [];
            cc.push(obj.Year);
            cc.push(parseInt(obj.approved));
            cc.push(parseInt(obj.submitted));
            cc.push(parseInt(obj.NotSubmitted));
            content.push(cc);
        }
        var data = google.visualization.arrayToDataTable(content);
       /* var data = google.visualization.arrayToDataTable([
             ['Year', 'Approved', 'Rejected', 'No Action'],
             ['2004',   165,        938,         522],
             ['2005',   135,       1120,         599],
             ['2006',   157,       1167,         587],
             ['2007',   139,       1110,         615],
             ['2008',   136,       691,          629],
         ]);
        */
        var options = {
            title : '',
            vAxis: {title: 'Applicant'},
            hAxis: {title: 'Year'},
            seriesType: 'bars',
            series: {3: {type: 'line'}}
        };
        var chart = new google.visualization.ComboChart(document.getElementById('chart_onlineForm'));
        chart.draw(data, options);
      }
</script>