<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include('header.html');?>
<body > 
	<form name='form_add' id='form_add' method='POST' action='index.php'>
		<div id="logo" style="width:300px">
			<a href="index.php">
				<img src="//www.ingenyous.com/templates/zen_avanti/images/logo/ingenyous_logo_tr.png" alt="Ingenyous" />
			</a>
			<div id="tagline">
				<span style="margin-left:0px;margin-top:0px;"></span>
			</div>
		</div>						
		<?php
			$searchBoxValue = empty($_REQUEST['movieSearch']) ? 'Enter Movie Title' : $_REQUEST['movieSearch'];
		?>
		<div style='position:relative;width:100%;background-color:#e0e0e0;'>
			<div style='position:relative;top:4%;left:5%;width:90%;color:#000;font-style:italic;padding-top:5px;'>Item search:&nbsp;&nbsp;
			<br><input type='text' id='movieSearch' name='movieSearch' size='60' style='margin-top:3px;font-style:italic;color:#b0b0b0' onfocus='this.value=""' value='<?php echo $searchBoxValue; ?>'><br><br>
			<input type='submit' id='submitButton' name='submitButton' value='Search' size='25'  style='position:relative;width:10%'>
			</div>
		
			<?php
			/*print '<pre>';
			print_r($_REQUEST);
			print '</pre>';*/
			include_once('db.php');
			
			$whereMovieClause = '';
			if( $_REQUEST['movieSearch'] != '' )
			{
				$whereMovieClause = ' and MovieTitle like "%'.$_REQUEST['movieSearch'].'%" ';
			}
			
			//to display first five movies on the home page
			$queryHomePage = "select * from movieDetails  where GroupId <> '' ".$whereMovieClause." group by GroupId order by GroupId limit 5";
			//echo $queryHomePage;
			$queryObj = mysql_query($queryHomePage); 
			$rowCnt=0;
			while($row = mysql_fetch_assoc($queryObj))
			{			
				if($rowCnt == 0)
				{
				
				?>
					<br/>
					<div style='position:relative;top:4%;left:5%;width:60%;color:#000'>
						<table width='100%' cellspacing=0 cellpadding=3 >
							<tr><td  width='35%'><b>Store:</b></td><td><?php echo $row['Store']; ?></td></tr>										
						</table>
					</div>
				<?php 
				} 
				$rowCnt++;?>	
				<br/>
				<div style='position:relative;top:4%;left:5%;width:60%;color:#000'>
					<table width='100%' cellspacing=0 cellpadding=3 style='border-top:1px solid #000;border-left:1px solid #000;'>
						<tr><td class='tdBorder' width='35%'><a style='text-decoration:none' href='movie_description.php?GroupId=<?php echo $row['GroupId']; ?>'><?php echo $row['MovieTitle']; ?></a></td><td class='tdBorder tdColor'><img src='images/frantic.gif'></td></tr>
						<tr><td class='tdBorder' width='35%'>Price:</td><td class='tdBorder'><?php echo $row['Price']; ?></td></tr>					
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
	</form>
</body>
</html>