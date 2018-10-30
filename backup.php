<!--
Zeljko Bareta - IM Associate, Belgrade, Serbia
work e-mail:	BARETA@unhcr.org
private e-mail:	zbareta@gmail.com
mobile:			+38163 366 158
skype: 			zeljko.bareta
-->
<?php ob_start(); ?>
<html lang="en">
	<head>
		<?php include("functions.php");?>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>AGDM - Data Management Portal</title>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
		<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function() {
			    
			    $('#data').DataTable( {
			        dom: 'Bfrtip',
			        lengthMenu: [
			            [ 10, 50, 100, -1 ],
			            [ '10 rows', '50 rows', '100 rows', 'Show all' ]
			        ],
			        buttons: [
			            'pageLength', 'copy', 'excel'
			        ]
			    } );
		    // Setup - add a text input to each footer cell
		    $('#data tfoot th').each( function () {
		        var title = $(this).text();
		        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
		    } );
		 
		    // DataTable
		    var table = $('#data').DataTable();
		 
		    // Apply the search
		    table.columns().every( function () {
		        var that = this;
		 
		        $( 'input', this.footer() ).on( 'keyup change', function () {
		            if ( that.search() !== this.value ) {
		                that
		                    .search( this.value )
		                    .draw();
		            }
		        } );
		    } );
		} );

		</script>
		<style>
			tfoot {
			    display: table-header-group;
}
			tfoot input {
		      width: 100%;
		      padding: 3px;
		      box-sizing: border-box;
		    }
			#loader {
			  position: absolute;
			  left: 50%;
			  top: 50%;
			  z-index: 1;
			  width: 150px;
			  height: 150px;
			  margin: -75px 0 0 -75px;
			  border: 16px solid #0072bc;
			  border-radius: 50%;
			  border-top: 16px solid #000000;
			  width: 120px;
			  height: 120px;
			  -webkit-animation: spin 2s linear infinite;
			  animation: spin 2s linear infinite;
			}
			@-webkit-keyframes spin {
			  0% { -webkit-transform: rotate(0deg); }
			  100% { -webkit-transform: rotate(360deg); }
			}

			@keyframes spin {
			  0% { transform: rotate(0deg); }
			  100% { transform: rotate(360deg); }
			}

			/* Add animation to "page content" */
			.animate-bottom {
			  position: relative;
			  -webkit-animation-name: animatebottom;
			  -webkit-animation-duration: 1s;
			  animation-name: animatebottom;
			  animation-duration: 1s
			}
			@-webkit-keyframes animatebottom {
			  from { bottom:-100px; opacity:0 } 
			  to { bottom:0px; opacity:1 }
			}
			@keyframes animatebottom { 
			  from{ bottom:-100px; opacity:0 } 
			  to{ bottom:0; opacity:1 }
			}
			#myDiv {
			  display: none;
			  text-align: center;
			}
		</style>
		<?php
		
		if (!isset($_POST['username'])){?>
		<div align="center">
			<img src="AGDM_vertical.png" alt="AGDM Logo" style="max-width: 100%; height: auto; align">
			<br><br>
			<form action="" method="post">
				Username:<br>
				<input style="width: 200px"  type="text" name="username"><br><br>
				Password:<br>
				<input style="width: 200px" type="password" name="password"><br><br>
				<input type="submit" value="login">
			</form>
		<p style="font-style: italic;">Please use the KoBo username and password associated with the AGDM data colleciton form.</br>
		If you do not have the required credentials, please contact your UNHCR IM focal point.</br>
		In order to edit records through "KoBo Link", you need to be logged in to KoBo Toolbox sepparately.</p>
		</div>
		<div align="center" style="color: red">
		<?php if (isset($_POST["username"])){echo $error;}?>
		</div>
		<?php
		}else{
		$username = test_input($_POST['username']);
		$password = test_input($_POST['password']);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curl, CURLOPT_URL, "https://kobocat.unhcr.org/agdm_serbia/forms/aepCjduG4RTxrtvUh9AL8C/api");
		curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$resp = curl_exec($curl);
		$forms = json_decode($resp,true);
		if($errno = curl_errno($curl)) {
			$error_message = curl_strerror($errno);
			echo "Error: Could not connect to KoBo database. Please try again later.";
		}
		curl_close($curl);?>
	</head>
	<body style="font-family:arial; font-size: 13; width:80%; margin:20 auto;" onload="myFunction()">

		<div id="loader"></div>
		<div style="display:none;" id="myDiv" class="animate-bottom"></div>
		<script>
			var myVar;
			function myFunction() {
			    myVar = setTimeout(showPage, 1000);
			}
			function showPage() {
			  document.getElementById("loader").style.display = "none";
			  document.getElementById("myDiv").style.display = "block";
			}
		</script>
		<img src="AGDM_horizontal.png" alt="BPM Logo" style="max-width: 100%; height: auto;">
		</br></br>
		<p>In order to update/delete records by clicking on the record ID, you need to be logged in into <a href="https://kobo.unhcr.org/" target="_blank">KoBo Toolbox</a> sepparately. Use the same credentials as for this app.<br>
		To enter create new records, open a <a href="https://enketo.unhcr.org/x/#CZ5cxVtL" target="_blank">blank form</a><br><br></p>
		<form method="GET" action="index.php">
			<input type="hidden" name="action" value="Logged_out" ?>
			<input type="submit" value='Log Out'></form>
		<div>
		<div>	
			<form method="POST" action="dashboard.php">
			<input type="hidden" name="url" value="https://kobocat.unhcr.org/agdm_serbia/forms/aepCjduG4RTxrtvUh9AL8C/api">
			<input type="hidden" name="username" value=<?php echo $_POST['username'] ?>>
			<input type="hidden" name="password" value=<?php echo $_POST['password'] ?>>
			<input type="submit" value='View Dashboard'></form>
		<div>
			<table id="data" class="display" cellspacing="0" width="2800px" style="font-family:arial; font-size: 13">
				<thead>
					<tr>
						<th>ID/Link</th>
						<th>Location</th>
						<th>Date of Visit</th>
						<th>Interpreters</th>
						<th>Language(s)</th>
						<th>Facilitator(s)</th>
						<th>Age Group</th>
						<th>Gender</th>
						<th>Nationality</th>
						<th>Group - Additional Info</th>
						<th>Protection Risk - Cause</th>
						<th>Capacity - Community</th>
						<th>Proposed Solutions</th>
						<th>Risk Comment</th>
						<th>Feedback Provided</th>
						<th>Urgent Response Needed</th>
						<th>General Comment</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID/Link</th>
						<th>Location</th>
						<th>Date of Visit</th>
						<th>Interpreters</th>
						<th>Language(s)</th>
						<th>Facilitator(s)</th>
						<th>Age Group</th>
						<th>Gender</th>
						<th>Nationality</th>
						<th>Group - Additional Info</th>
						<th>Protection Risk - Cause</th>
						<th>Capacity - Community</th>
						<th>Proposed Solutions</th>
						<th>Risk Comment</th>
						<th>Feedback Provided</th>
						<th>Urgent Response Needed</th>
						<th>General Comment</th>
					</tr>
				</tfoot>
				<tbody>
				<?php
					if (!is_array($forms)){
						ob_end_clean();
						header('Location: index.php');
						ob_end_flush();
						;
					}
					foreach($forms as $item){?>
					<tr style="font-size: 11">
						<td><a href=<?php echo substr("https://kobocat.unhcr.org/agdm_serbia/forms/aepCjduG4RTxrtvUh9AL8C/api", 0, -4) . "/instance#/"?><?php echo $item['_id']?>><?php echo $item['_id'];?></a></td>
						<td><?php if(isset($item['Location'])){echo strtoupper($item['Location']);}else echo "No Data";?></td>
						<td><?php if(isset($item['date_of_visit'])){echo strtoupper($item['date_of_visit']);}else echo "No Data";?></td>
						<td><?php if(isset($item['Translators_Interpreters'])){echo $item['Translators_Interpreters'];}else echo "No Data";?></td>
						<td><?php if(isset($item['Language_s_used'])){echo strtoupper(str_replace(" ", ", ", $item['Language_s_used']));}else echo "No Data";?></td>

						<!--Interpreters group-->
						<td ><?php if (isset($item['group_na33l66'])){foreach($item['group_na33l66'] as $it)
							{
								echo $it['group_na33l66/Name'] . " from " . strtoupper($it['group_na33l66/Organization']) . ";<br>";}}else echo "No Data";?>
						</td>
						<!--PoC group-->
						<td><?php if (isset($item['group_composition'])){foreach($item['group_composition'] as $it)
							{
								echo str_replace("60 to above", "60+", str_replace("_", " to ", $it['group_composition/age_group'])) . ";<br>";}}else echo "No Data";?>
						</td>
				
						<td><?php if (isset($item['group_composition'])){foreach($item['group_composition'] as $it)
							{
								echo strtoupper($it['group_composition/Gender']) . ";<br>";}}else echo "No Data";?>
						</td>
						<td style="width: 200px"><?php if (isset($item['group_composition'])){foreach($item['group_composition'] as $it)
							{
								echo strtoupper($it['group_composition/nationality']) . " - " . $it['group_composition/number_persons'] . ";<br>";}}else echo "No Data";?>
						</td>
						<td style="width: 300px"><?php if (isset($item['group_composition'])){foreach($item['group_composition'] as $it)
							{
								if(isset($it['group_composition/Additional_Information'])) echo $it['group_composition/Additional_Information'] . ";<br>";}}else echo "No Data";?>
						</td>
						<td style="width: 300px"><?php if (isset($item['protection_risk'])){foreach($item['protection_risk'] as $it)
							{
								echo clean_risks($it['protection_risk/risk']) . " (" .str_replace(" ", ", ", $it['protection_risk/Protection_Risk_Cause']) . ")" . ";<br>";}}else echo "No Data";?>
						</td>

						<td><?php if (isset($item['protection_risk'])){foreach($item['protection_risk'] as $it)
							{
								echo strtoupper($it['protection_risk/Protection_Risk_Capacity_Wit']) . ";<br>";}}else echo "No Data";?>
						</td>


						<td style="width: 300px"><?php if (isset($item['protection_risk'])){foreach($item['protection_risk'] as $it)
							{
								if(isset($it['protection_risk/Solutions_proposed_by_Community'])) echo $it['protection_risk/Solutions_proposed_by_Community'] . ";<br>";}}else echo "No Data";?>
						</td>
						<td style="width: 300px"><?php if (isset($item['protection_risk'])){foreach($item['protection_risk'] as $it)
							{
								if(isset($it['protection_risk/risk_comment'])) echo $it['protection_risk/risk_comment'] . ";<br>";}}else echo "No Data";?>
						</td>

						<td><?php if (isset($item['protection_risk'])){foreach($item['protection_risk'] as $it)
							{
								echo strtoupper($it['protection_risk/feedback']) . ";<br>";}}else echo "No Data";?>
						</td>
						<td><?php if (isset($item['protection_risk'])){foreach($item['protection_risk'] as $it)
							{
								echo strtoupper($it['protection_risk/urgent_follow_up']) . ";<br>";}}else echo "No Data";?>
						</td>
						<td style="width: 300px"><?php if(isset($item['general_comment'])){echo $item['general_comment'];}else echo "No Data";?></td>

					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<?php } ?>
	</body>
</html>