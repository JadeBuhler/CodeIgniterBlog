<h2><?=$title?></h2>

<?php echo validation_errors()?>

<!--form_open is a built in CI function that sets the form action, post method and charset-->
<?php echo form_open_multipart('posts/create')?>
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Your Title Here">
  </div>
  <div class="form-group">
    <label for="post-body">Body</label>
    <textarea class="form-control" id="post-body" name="post-body" placeholder="Your Content Here"></textarea>
  </div>
  <div class="form-group">
    <label for="categories"></label>
    <select name="category_id" class="form-control" id="categories">
    <?php foreach($categories as $category):?>
      <option value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
    <?php endforeach?>
    </select>
  </div>
  <div class="form-group">
    <label for="post-image">Upload Image</label>
    <!--In order for image uploading to work in CodeIgniter the name attribute must be "userfile"-->
    <input type="file" name="userfile" id="post-image" size="20">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
