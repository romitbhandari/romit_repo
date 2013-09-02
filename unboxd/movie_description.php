<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	include('header.html');
	include('db.php');?>
	<body>
	<div style='position:relative;width:100%;background-color:#e0e0e0;height:100%'>
		
		<?php
		
		$groupId = empty($_REQUEST['GroupId']) ? '' : $_REQUEST['GroupId'];
		
		//to display first five movies on the home page
		$queryDetailsPage = "select * from movieDetails  where GroupId ='".$groupId."' order by ProductId;";
		//echo $queryDetailsPage;
		$queryObj = mysql_query($queryDetailsPage); 
		$rowCnt=0;
		while($row = mysql_fetch_assoc($queryObj))
		{			
			if($rowCnt == 0)
			{			
			?>
				<div style='position:relative;top:4%;left:5%;width:60%;color:#000'>
					<table width='100%' cellspacing=0 cellpadding=3 >
						<tr><td  width='35%'><b>Movie:</b></td><td><?php echo $row['MovieTitle']; ?></td></tr>										
						<tr><td  width='35%'><b>Category:</b></td><td><?php echo $row['Category'].'('.$row['SubCategory'].')'; ?></td></tr>																				
					</table>
				</div>
			<?php 
			} 
			$rowCnt++;?>	
			<br/>
			<div style='position:relative;top:4%;left:5%;width:60%;color:#000'>
				<table width='100%' cellspacing=0 cellpadding=3 style='border-top:1px solid #000;border-left:1px solid #000;'>
					<tr><td class='tdBorder' width='100%' align='left' colspan='2'>Version <?php echo $rowCnt;?></td></tr>
					<tr><td class='tdBorder' width='35%'>Price:</td><td class='tdBorder'><?php echo $row['Price']; ?></td></tr>					
					<tr><td class='tdBorder' width='35%'>Shipping Duration(in hrs):</td><td class='tdBorder'><?php echo $row['ShippingDuration']; ?></td></tr>					
				</table>
			</div>
			<br/>
		<?php 
		}
		// if no results exist
		if($rowCnt == 0)
		{?>
			<br/>
				<div style='position:relative;top:4%;left:5%;height:100%;width:60%;color:#000'>
					<table width='100%' cellspacing=0 cellpadding=3 >
						<tr><td>No results found.</td></tr>										
					</table>
				</div>
		<?php
		}
		?>	
		<br/>		
	</div>
	</body>
</html>