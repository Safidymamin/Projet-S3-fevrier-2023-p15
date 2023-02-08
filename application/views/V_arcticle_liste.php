<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Liste Article</title>
</head>
<body>
	<?php foreach($datas : $data) : ?>
		<p><?php echo $data->titre; ?></p>
	<?php endforeach ?>

</body>
</html>