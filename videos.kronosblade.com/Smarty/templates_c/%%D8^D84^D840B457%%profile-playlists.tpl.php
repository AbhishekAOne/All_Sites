<?php /* Smarty version 2.6.20, created on 2017-08-02 10:01:23
         compiled from profile-playlists.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array('no_index' => '1','p' => 'playlists')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="wrapper">
    <div class="container-fluid">


      <div class="row-fluid">
        <div class="span12 extra-space">
		<div id="primary">
		
	        <?php if ($this->_tpl_vars['allow_playlists']): ?>
			<a href="#new-playlist" data-toggle="modal" data-backdrop="true" data-keyboard="true" class="btn btn-success pull-right"><?php echo $this->_tpl_vars['lang']['playlist_create_new']; ?>
</a>
			<?php endif; ?>
			
			<h1><?php echo $this->_tpl_vars['lang']['manage_playlists']; ?>
</h1>
			<hr />

	        <div class="row-fluid">
	        	<div class="span12">        	
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'profile-playlists-ul.tpl', 'smarty_include_vars' => array('playlists' => $this->_tpl_vars['playlists'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	            </div>
	        </div>

			<!-- #new-playlist modal -->
			<?php if ($this->_tpl_vars['allow_playlists']): ?>
			<form name="new-playlist" class="form-horizontal" method="post" action="">
			<div class="modal hide" id="new-playlist" role="dialog" aria-labelledby="new-playlist-form-label">
			    <div class="modal-header">
			         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			         <h3 id="new-playlist-form-label"><?php echo $this->_tpl_vars['lang']['playlist_create_new']; ?>
</h3>
			    </div>
			    <div class="modal-body">
			    	<div id="playlist-modal-ajax-response" class="hide"></div>
										

					<div class="control-group">
						<label class="control-label"><?php echo $this->_tpl_vars['lang']['playlist_name']; ?>
</label>
						<div class="controls">
						<input type="text" name="playlist_name" value="" />
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><?php echo $this->_tpl_vars['lang']['playlist_privacy']; ?>
</label>
						<div class="controls">
						<select name="visibility">
							<option value="<?php echo @PLAYLIST_PUBLIC; ?>
"><?php echo $this->_tpl_vars['lang']['public']; ?>
</option>
							<option value="<?php echo @PLAYLIST_PRIVATE; ?>
"><?php echo $this->_tpl_vars['lang']['private']; ?>
</option>
						</select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label"><?php echo $this->_tpl_vars['lang']['video_ordering']; ?>
</label>
						<div class="controls">
						<select name="sorting">
							<option value="default"><?php echo $this->_tpl_vars['lang']['_manual']; ?>
</option>
							<option value="popular"><?php echo $this->_tpl_vars['lang']['most_popular']; ?>
</option>
							<option value="date-added-desc"><?php echo $this->_tpl_vars['lang']['sort_added_new']; ?>
</option>
							<option value="date-added-asc"><?php echo $this->_tpl_vars['lang']['sort_added_old']; ?>
</option>
							<option value="date-published-desc"><?php echo $this->_tpl_vars['lang']['sort_published_new']; ?>
</option>
							<option value="date-published-asc"><?php echo $this->_tpl_vars['lang']['sort_published_old']; ?>
</option>
						</select>
						</div>
					</div>
			    </div>
				<div class="modal-footer">
					<img src="<?php echo @_URL; ?>
/templates/<?php echo $this->_tpl_vars['template_dir']; ?>
/img/ajax-loading.gif" width="16" height="16" alt="<?php echo $this->_tpl_vars['lang']['please_wait']; ?>
" align="absmiddle" border="0" class="hide" id="modal-loading-gif">
					<a href="#" class="btn btn-small btn-link" data-dismiss="modal" ><?php echo $this->_tpl_vars['lang']['submit_cancel']; ?>
</a>
					<a href="#" class="btn btn-success" id="create_playlist_submit_btn" onclick="playlist_create(this, 'playlists-modal'); return false;" disabled><?php echo $this->_tpl_vars['lang']['_create']; ?>
</a>
				</div>
			</div>
			</form>
			<?php endif; ?>
			
		</div><!-- #primary -->
    </div><!-- #content -->
  </div><!-- .row-fluid -->
</div><!-- .container-fluid -->     
        
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 