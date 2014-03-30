<form role="form" action="<?php echo site_url('/'); ?>" id="searchform" method="get">
    <label for="s" class="sr-only">検索</label>
    <div class="input-group">
        <input type="text" class="form-control" id="s" name="s" placeholder="検索する" value="" />
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary"><i class="icon-search"></i>検索する</button>
        </span>
    </div> <!-- .input-group -->
</form>
