<?php
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<script type="text/javascript">
	function validateTickets() {	
			var selectedSeats = "";
			var isSelected = false;
			$('table.colorTable').find('td.selected').each(function (i, el) {
				selectedSeats +=$(this).html().trim()+",";
				isSelected=true;
			});
			if( isSelected===false ) {
				$(".content-status").html("Ticket Selection is not Done!!");
				$(".content-status").css("color","red");
				$(".content-status").css("text-align","center");
				return false;
			} else {
				$("#ticketselection").val(selectedSeats);
				return true;
			}
	}
	
	$(document).ready(function(){		
		$('td').click(function() {			
			if(!$(this).hasClass('seatDisabled')) {
				if($(this).hasClass('selected')) {
					$(this).css('background-color','white');
					$(this).removeClass('selected');
				}
				else {
					$(this).css('background-color','lightgreen');
					$(this).addClass('selected');
				}
			}
		});		
	});
</script>

<div class="movie"> 
	<?php
		echo "<form action='/ticket-booking/order.php' onsubmit='return validateTickets()' method='post'>";
		echo "<span class='title'>Theatre: </span><span class='titleValue'>".$_POST['theatrename']."</span>";
		echo "<br>";
		echo "<span class='title'>Movie: </span><span class='titleValue'>".$_POST['moviename']."</span><span class='rating'>&nbsp;&nbsp;&nbsp;<img src='includes/likes.png'/ title='Users Rating'>".$_POST['movierating']."%</span>";
		echo "<br>";
		echo "<span class='title'>Show Start Time: </span><span class='titleValue'>".$_POST['moviestarttime']."</span>";				
		echo "<span class='movieOrder'><input type='submit' value='Next'></span>";
		echo "<input type=hidden name='showid' value=\"".$_POST['showid']."\">";
		echo "<input type=hidden name='theatreid' value=\"".$_POST['theatreid']."\">";
		echo "<input type=hidden name='movieid' value=\"".$_POST['movieid']."\">";
		echo "<input type=hidden name='screenid' value=\"".$_POST['screenid']."\">";	
		echo "<input type=hidden name='theatrename' value=\"".$_POST['theatrename']."\">";
		echo "<input type=hidden name='moviename' value=\"".$_POST['moviename']."\">";				
		echo "<input type=hidden name='movierating' value=\"".$_POST['movierating']."\">";	
		echo "<input type=hidden name='moviestarttime' value=\"".$_POST['moviestarttime']."\">";	
		echo "<input type=hidden name='ticketselection' id='ticketselection' value=''>";	
		echo "</form>";
	?>
</div>
<center>	
	<table class="colorTable" style="width:75%;border: 1px solid black;margin-top:10px;">
		<tbody>
			<tr style="border: 1px solid black;height:30px;text-align:center">				
				<td colspan="11" style="border: 1px solid black;font-weight:bold">Select Seats</td>				
			</tr>
			<tr style="border: 1px solid black;height:30px;text-align:center">
				<td colspan="4" style="width:50px;border: 1px solid black;background-color:lightgray">Seat Booked</td>
				<td colspan="3" style="width:50px;border: 1px solid black;">Seat Available</td>
				<td colspan="4" style="width:50px;border: 1px solid black;background-color:lightgreen">Seat Selected</td>				
			</tr>
			<?php
				$seatcountQuery = oci_parse($conn, 'SELECT seatcount from screens where screenid='.$_POST['screenid']);
				oci_execute($seatcountQuery);
				$nrows = oci_fetch_all($seatcountQuery, $seatCount);					
				
				$bookedSeatsQuery = oci_parse($conn, "select seatno from tickets where showid=".$_POST['showid']." order by seatno");				
				oci_execute($bookedSeatsQuery);
				$bTicketsNoOfRows = oci_fetch_all($bookedSeatsQuery, $bookedUserSeats,null, null, OCI_FETCHSTATEMENT_BY_ROW);	
				$bookedTickets =array_fill(0, $bTicketsNoOfRows, 0);				
				
				for($j=0;$j<count($bookedUserSeats);$j++) {
					$bookedTickets[$j] = $bookedUserSeats[$j]['SEATNO'];
				}
				
				$seatCount = $seatCount['SEATCOUNT'][0];
				if($nrows == 1) {
					$noOfRows = intval($seatCount / 10);
					
					if(intval($seatCount)%10 != 0) {						
						$noOfRows +=1;
					}
					
					$seatVar = 1;
					for($var = 0; $var<$noOfRows; $var++) {
						echo "<tr style=\"border: 1px solid black;height:30px;text-align:center\">";
						$count = 10;
						
						if($var == ($noOfRows-1)) {
							$count = $seatCount-(($noOfRows-1)*10);
						}
						
						for($i =0; $i<$count; $i++) {
							
							$tdVal = "<td ";
							if (in_array($seatVar, $bookedTickets)) {								
								$tdVal = $tdVal."class='seatDisabled' ";
							}
							$tdVal = $tdVal."style=\"width:50px;border: 1px solid black;cursor:pointer\" class ='seatno".$seatVar."'>".$seatVar."</td>";
							echo $tdVal;
							if($i==4) {
								echo "<td>Walking Area</td>";
							}
							$seatVar++;
							
						}
						echo "</tr>";			 
					}
				}
			?>	
			<tr>
				<td colspan="10"><center><h1>Screen facing towards this side <img src="includes/down.png" title='Screen Direction'/></h1></center></td>
			</tr>		
		</tbody>
	</table>
</center>
<?php
	include('footer.php');
	oci_close($conn);
?>