<?php echo $this->Html->css('mystyle'); ?>
<?php $this->set("title", 'Steward Comparison Report | DOSA PLAZA'); ?>
<div class="row" style="margin-top:15px;">
	<div class="col-md-12 main-div">
		<div class="portlet box blue-hoki">
			<div class="portlet-title">
				<table width="100%" style=" margin-top: 5px; margin-bottom: 5px; ">
					<tr>
						<td width="20%">
							<div class="caption"style="padding:13px; color: red;">
								Steward Comparison Report
							</div>
						</td>
						<td valign="button">
							<div align="center">
								<form method="GET">
									<table>
										<tr>
											<td>
												<input type="date" class="form-control" name="from_date" value="<?php echo $from_date; ?>" required />
											</td>
											<td>
												<input type="date" class="form-control" name="to_date" value="<?php echo $to_date; ?>" required />
											</td>
											<td>
												<button type="submit" class="btn" style="background-color: #FA6775;color: #FFF;" >GO</button>
											</td>
										</tr>
									</table>
								</form>
							</div>
						</td>
						<td width="20%"></td>
					</tr>
				</table>
				
				<div class="row">	
					<div class="col-md-12 horizontal"></div>
				</div>
			</div>
			<div class="portlet-body">
				<?php if($from_date && $to_date){ ?>

				<div class="table-scrollable">
					<div class="row">
						<div class="col-md-6">
							<script src="https://code.highcharts.com/highcharts.js"></script>
							<script src="https://code.highcharts.com/modules/data.js"></script>
							<script src="https://code.highcharts.com/modules/exporting.js"></script>
							<script src="https://code.highcharts.com/modules/export-data.js"></script>

							<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

							
							<table id="datatable" style="display: none;">
							  <thead>
							    <tr>
							      <th></th>
							      <?php foreach ($Employees as $Employee) { ?>
							      	<th><?= h($Employee->name) ?></th>
							      <?php } ?>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <td>/-</td>
							      <?php foreach ($Employees as $Employee) { ?>
							      	<td><?php echo $Employee->Emp_Sales; ?></td>
							      <?php } ?>
							    </tr>
							  </tbody>
							</table>

							<style type="text/css">
								.highcharts-button-symbol{
									display: none;
								}
								.highcharts-credits{
									display: none;
								}
							</style>
							<script type="text/javascript">
								Highcharts.chart('container', {
								  data: {
								    table: 'datatable'
								  },
								  chart: {
								    type: 'column'
								  },
								  title: {
								    text: 'Steward Comparison - Column Chart'
								  },
								  yAxis: {
								    allowDecimals: false,
								    title: {
								      text: 'Sales'
								    }
								  },
								  tooltip: {
								    formatter: function () {
								      return '<b>' + this.series.name + '</b><br/>' +
								        this.point.y + ' ' + this.point.name.toLowerCase();
								    }
								  }
								});
							</script>
						</div>
						<div class="col-md-6">
							<div id="container2" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

							<?php 
							$data = [];
							foreach ($Employees as $Employee) { 
								$data[] = [name => $Employee->name, y => round($Employee->Emp_Sales)];
							}
							$json_data = json_encode($data);
							?>
							
							<script type="text/javascript">
							// Radialize the colors
							Highcharts.setOptions({
							    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
							        return {
							            radialGradient: {
							                cx: 0.5,
							                cy: 0.3,
							                r: 0.7
							            },
							            stops: [
							                [0, color],
							                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
							            ]
							        };
							    })
							});

							// Build the chart
							Highcharts.chart('container2', {
							    chart: {
							        plotBackgroundColor: null,
							        plotBorderWidth: null,
							        plotShadow: false,
							        type: 'pie'
							    },
							    title: {
							        text: 'Steward Comparison - Pie Chart'
							    },
							    tooltip: {
							        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
							    },
							    plotOptions: {
							        pie: {
							            allowPointSelect: true,
							            cursor: 'pointer',
							            dataLabels: {
							                enabled: true,
							                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							                style: {
							                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							                },
							                connectorColor: 'silver'
							            }
							        }
							    },
							    series: [{
							        name: 'Share',
							        data: <?php echo $json_data; ?>
							    }]
							});
							</script>
						</div>
					</div>

					

				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>