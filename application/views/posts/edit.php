<h2><?=$title?></h2>

<?php echo validation_errors()?>

<!--form_open is a built in CI function that sets the form action, post method and charset-->
<?php echo form_open('posts/update')?>
	<input type="hidden" name="id" value="<?php echo $post['id']?>">
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" class="form-control" id="title" name="title" placeholder="Your Title Here" value="<?php echo $post['title']?>">
    </div>
    <div class="form-group">
		<label for="post-body">Body</label>
		<textarea class="form-control" id="post-body" name="post-body" placeholder="Your Content Here"><?php echo $post['body']?></textarea>
	</div>
	<div class="form-group">
    <label for="categories"></label>
    <select name="category_id" class="form-control" id="categories">
    <?php foreach($categories as $category):?>
      <option value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
    <?php endforeach?>
    </select>
  </div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>
