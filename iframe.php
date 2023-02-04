<script type="text/javascript">
setTimeout("window.location.reload()",5000);//Обновление раз в 5 секунд
</script>
<body>
<?php
if(isset($_POST['message'])){
  $sql = "insert into `messages` (`message`) values ('".$_POST['message']."')";
  mysql_query($sql);
}
$sql = "select `message` from `messages` where 1 order by id desc";
$res = mysql_query($sql);
while($row = mysql_fetch_object($res)){
 printf("<div>%s</div>",$row->message);
}
?>
</body>
