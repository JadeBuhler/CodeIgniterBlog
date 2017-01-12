<!--Index page for blog posts-->
<h2><?=$title?></h2>
<?php foreach($posts as $post):?>

	<h3><?php echo $post['title']?></h3>
	<div class="row">
		<div class="col-md-3">
			<img class="post-thumb" src="assets/images/posts/<?php echo $post['image']?>">
		</div>
		<div class="col-md-9">
			<small class="post-date">Posted on: <?php echo $post['timestamp']?> in
			<strong><?php echo $post['name']?></strong></small>

			<p><?php echo word_limiter($post['body'], 60)?></p>
			<p><a href="<?php echo site_url('/posts/'.$post['slug'])?>">Read More</a></p>
		</div>
	</div>


<?php endforeach?>
