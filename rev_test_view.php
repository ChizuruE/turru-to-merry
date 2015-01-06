<?php 
	session_start();
	include_once("controller/chkSession.php");
	include_once("controller/revs.php");
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>履歴</title>
	<style>
	/*ul{text-align:center;}*/
	ul,li{list-style:none;}
	ul.rev{margin-bottom:3px;}
	ul.rev li{display:inline;}
	</style>
</head>
<body>
	<h1>履歴詳細画面</h1>

		<?php  if(mysql_num_rows($result)<=15){ ?>
			<ul>
			<?php while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) { ?>
				<li style="background-color:#ccc; width:320px;">
					<ul class="rev">
						<li><?php echo ($row['entry_timestamp']); ?></li>
						<li><?php echo ($row['part_id']); ?></li>
						<li><?php echo ($row['hair_id']); ?></li>
						<li><input type="button" value="×"></li>
					</ul>
				</li>
			</ul>
			<?php } ?>	
		<?php }else{ ?>
			<ul>
			<?php while ($row = mysql_fetch_array($result_limited, MYSQL_ASSOC)) { ?>
				<li style="background-color:#ccc; width:320px;">
					<ul class="rev">

						<?php  
							//年月日取得
							$entry_timestamp = $row['entry_timestamp'];
							$rev = new DateTime($entry_timestamp);
							$entry_date = $rev->format('Y年m月d日');
						?>
						<li><?php echo ($entry_date); ?></li>
						

						<?php 
							//剃った部位の名前(part_idからpart_nameを取得)
							$sql_part = "SELECT * FROM parts where part_id='".$row['part_id']."'";
							$result_part = mysql_query($sql_part) or exit('part_idの抽出に失敗');

							if(mysql_num_rows($result_part)==1){
								$row_part = mysql_fetch_array($result_part, MYSQL_ASSOC); //このへんの指定がおかしい？
								$part_name = $row_part['part_name'];
							}
						 ?>
						<li><?php echo ($part_name); ?></li>
						
						<?php 
							//剃った毛の長さ(1mm=短め、2mm=普通、3mm=長め)
							$sql_hair = "SELECT * FROM hairs where hair_id='".$row['hair_id']."'";
							$result_hair = mysql_query($sql_hair) or exit('hair_lengthの抽出に失敗');

							if(mysql_num_rows($result_hair)==1){
								$row_hair = mysql_fetch_array($result_hair, MYSQL_ASSOC); //このへんの指定がおかしい？
								$part_length = $row_hair['hair_length'];
								// echo $part_length;
								switch($part_length){
									case 1:
										$part_length = "短め";
										break;
									case 2:
										$part_length = "普通";
										break;
									case 3:
										$part_length = "長め";
										break;
									default:
										$part_length = "？";
								}
							}
						 ?>
						<li><?php echo ($part_length); ?></li>

						<li>
							<form action="rev_test_view.php" method="POST">
								<input type="hidden" name="flag_del" value="<?php echo $entry_timestamp; ?>">
								<input type="submit" value="×" name="revs.php">
							</form>
						</li>
					</ul>
				</li>
				<?php } ?>
			</ul>
			<form action="rev_test_view.php" method="POST">
				<input type="hidden" name="flag" value="1">
				<input type="submit" value="もっと見る" name="revs.php">
			</form>
			<?php } ?>
		
		</ul>

		
		
		<br>
		<br>

		<button onClick="location.href='main_test_view.php'">メイン画面①へ→</button>
		
</body>
</html>