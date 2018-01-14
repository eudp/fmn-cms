<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2><?php echo $title; ?></h2>

	<?php foreach ($news as $news_item): ?>

	        <h3><?php echo $news_item['title']; ?></h3>
	        <div class="main">
	                <?php echo $news_item['description']; ?>
	        </div>
	        <p><a href="">View article</a></p>

	<?php endforeach; ?>
</body>
</html>