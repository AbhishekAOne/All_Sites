<?php /* Smarty version 2.6.20, created on 2017-08-02 10:16:20
         compiled from profile-playlist-view.tpl */ ?>
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
        <?php if ($this->_tpl_vars['my_playlist']): ?>
		<a href="<?php echo @_URL; ?>
/playlists.<?php echo @_FEXT; ?>
" class="btn btn-blue pull-right"><?php echo $this->_tpl_vars['lang']['view_all']; ?>
</a>
		<h1><?php echo $this->_tpl_vars['lang']['manage_playlists']; ?>
</h1>
		<hr />
		<?php else: ?>
		<br />
		<?php endif; ?>

		<div class="row-fluid">
			<div class="span12">
			<?php if (! is_array ( $this->_tpl_vars['playlist'] )): ?>
				<div class="alert alert-danger">
					<?php echo $this->_tpl_vars['lang']['playlist_not_found']; ?>

				</div>
			<?php elseif ($this->_tpl_vars['playlist']['visibility'] == @PLAYLIST_PRIVATE && ! $this->_tpl_vars['my_playlist']): ?>
				<div class="alert alert-info">
					<i class="icon-lock opac7"></i> <?php echo $this->_tpl_vars['lang']['playlist_private']; ?>

				</div>
			<?php else: ?>
				<div class="pm-playlist-edit">
					<div class="pm-pl-header row-fluid">
						<div class="span3">
							<div class="pm-pl-thumb">
							<img src="<?php echo $this->_tpl_vars['playlist']['thumb_url']; ?>
" height="126" border="0">
							<a href="<?php echo $this->_tpl_vars['playlist']['playlist_watch_all_href']; ?>
" class="pm-pl-thumb-overlay" rel="nofollow">&#9658; <?php echo $this->_tpl_vars['lang']['play_all']; ?>
</a>
							</div>
						</div>
						<div class="pm-pl-header-content span9">
							<div class="pm-pl-header-title">
								<?php if ($this->_tpl_vars['playlist']['visibility'] == @PLAYLIST_PRIVATE): ?>
									<a href="#playlist-settings" <?php if ($this->_tpl_vars['my_playlist']): ?>data-toggle="modal" data-backdrop="true" data-keyboard="true"<?php endif; ?> rel="tooltip" title="<?php echo $this->_tpl_vars['lang']['playlist_private_desc']; ?>
" class="pm-pl-status-icon"><i class="icon-lock opac7"></i></a>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['playlist']['visibility'] == @PLAYLIST_PUBLIC): ?>
									<a href="#playlist-settings" <?php if ($this->_tpl_vars['my_playlist']): ?>data-toggle="modal" data-backdrop="true" data-keyboard="true"<?php endif; ?> rel="tooltip" title="<?php echo $this->_tpl_vars['lang']['playlist_public_desc']; ?>
" class="pm-pl-status-icon"><i class="icon-globe opac7"></i></a>
								<?php endif; ?>
								<h3><?php echo $this->_tpl_vars['playlist']['title']; ?>
</h3> 
							</div>

							<ul class="pm-pl-header-details unstyled">
								<li><?php echo $this->_tpl_vars['lang']['_by']; ?>
 <a href="<?php echo $this->_tpl_vars['playlist']['user_profile_href']; ?>
"><?php echo $this->_tpl_vars['playlist']['user_name']; ?>
</a></li>
								<li><?php if ($this->_tpl_vars['playlist']['items_count'] == 1): ?>1 <?php echo $this->_tpl_vars['lang']['_video']; ?>
<?php else: ?><?php echo $this->_tpl_vars['playlist']['items_count']; ?>
 <?php echo $this->_tpl_vars['lang']['videos']; ?>
<?php endif; ?></li>
							</ul>
							
							<div class="pm-pl-actions">
								<?php if ($this->_tpl_vars['playlist']['items_count'] > 0): ?>
								<a href="<?php echo $this->_tpl_vars['playlist']['playlist_watch_all_href']; ?>
" class="btn btn-small border-radius0 btn-video" rel="nofollow"><i class="icon-play"></i> <?php echo $this->_tpl_vars['lang']['play_all']; ?>
</a>
								<?php endif; ?> 
								<?php if ($this->_tpl_vars['share_link'] != '' && $this->_tpl_vars['playlist']['visibility'] == @PLAYLIST_PUBLIC): ?>
								<a href="#playlist-share" class="btn btn-small border-radius0 btn-video" data-toggle="modal" data-backdrop="true" data-keyboard="true"><i class="icon-share-alt"></i> <?php echo $this->_tpl_vars['lang']['_share']; ?>
</a>
								<?php endif; ?> 
								<?php if ($this->_tpl_vars['my_playlist'] && $this->_tpl_vars['playlist']['type'] != @PLAYLIST_TYPE_WATCH_LATER && $this->_tpl_vars['playlist']['type'] != @PLAYLIST_TYPE_HISTORY): ?>
								<a href="#playlist-settings" class="btn btn-small border-radius0 btn-video" data-toggle="modal" data-backdrop="true" data-keyboard="true"><i class="icon-cog"></i> <?php echo $this->_tpl_vars['lang']['playlist_settings']; ?>
</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="pm-pl-content">
						<ul class="pm-pl-list unstyled">
							<?php if ($this->_tpl_vars['playlist']['items_count'] == 0): ?>
							<li>
								<p><?php echo $this->_tpl_vars['lang']['playlist_empty']; ?>
</p>
							</li>
							<?php else: ?>
							<?php $_from = $this->_tpl_vars['playlist_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['playlist_items_foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['playlist_items_foreach']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['list_video']):
        $this->_foreach['playlist_items_foreach']['iteration']++;
?>
							<li class="playlist-item" id="playlist_item_<?php echo $this->_tpl_vars['list_video']['id']; ?>
">
								<div class="pm-pl-list-index"><?php echo $this->_tpl_vars['index']+1; ?>
</div>
								<div class="pm-pl-list-thumb"><a href="<?php echo $this->_tpl_vars['list_video']['playlist_video_href']; ?>
" rel="nofollow"><img src="<?php echo $this->_tpl_vars['list_video']['thumb_img_url']; ?>
" height="40" border="0"></a></div>
								<div class="pm-pl-list-title"><a href="<?php echo $this->_tpl_vars['list_video']['playlist_video_href']; ?>
" rel="nofollow"><?php echo $this->_tpl_vars['list_video']['video_title']; ?>
</a></div>
								<div class="pm-pl-list-author"><a href="<?php echo $this->_tpl_vars['list_video']['author_profile_href']; ?>
"><?php echo $this->_tpl_vars['list_video']['author_name']; ?>
</a></div>
								<?php if ($this->_tpl_vars['my_playlist']): ?>
								<div class="pm-pl-list-action">
									<a href="#" class="btn btn-link" onclick="playlist_delete_item(<?php echo $this->_tpl_vars['playlist']['list_id']; ?>
, <?php echo $this->_tpl_vars['list_video']['id']; ?>
, '#playlist_item_<?php echo $this->_tpl_vars['list_video']['id']; ?>
'); return false;" rel="tooltip" title="<?php echo $this->_tpl_vars['lang']['playlist_remove_item']; ?>
"><i class="icon-remove opac7"></i></a>
								</div>
								<?php endif; ?>
							</li>
							<?php endforeach; endif; unset($_from); ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>


		<!-- #playlist-share modal -->
		<?php if ($this->_tpl_vars['share_link'] != '' && $this->_tpl_vars['playlist']['visibility'] == @PLAYLIST_PUBLIC): ?>
		<div class="modal hide" id="playlist-share" role="dialog" aria-labelledby="playlist-share-form-label">
		    <div class="modal-header">
		         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		         <h3 id="playlist-share-form-label"><?php echo $this->_tpl_vars['lang']['_share']; ?>
</h3>
		    </div>
		    <div class="modal-body">
		        <p><?php echo $this->_tpl_vars['lang']['playlist_share_msg']; ?>
</p>
                <div class="row-fluid">
                    <div class="span3">
	                    <a href="https://www.facebook.com/sharer.php?u=<?php echo $this->_tpl_vars['share_link_urlencoded']; ?>
&t=<?php echo $this->_tpl_vars['share_title_urlencoded']; ?>
" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" rel="tooltip" title="Share on FaceBook"><i class="pm-vc-sprite facebook-icon"></i></a>
	                    <a href="https://twitter.com/home?status=Watching%20<?php echo $this->_tpl_vars['share_title_urlencoded']; ?>
%20on%20<?php echo $this->_tpl_vars['share_link_urlencoded']; ?>
" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" rel="tooltip" title="Share on Twitter"><i class="pm-vc-sprite twitter-icon"></i></a>
	                    <a href="https://plus.google.com/share?url=<?php echo $this->_tpl_vars['share_link_urlencoded']; ?>
" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" rel="tooltip" title="Share on Google+"><i class="pm-vc-sprite google-icon"></i></a>
                    </div>
                    <div class="span9">
                    	<div class="input-prepend">
                    		<span class="add-on">URL</span><input name="share_link" id="share_link" type="text" value="<?php echo $this->_tpl_vars['share_link']; ?>
" class="span11" onClick="SelectAll('share_link');">
						</div>
                    </div>
                </div>
		    </div>
		</div>
		<?php endif; ?>

		<!-- #playlist-settings modal -->
		<?php if ($this->_tpl_vars['playlist']['type'] != @PLAYLIST_TYPE_WATCH_LATER && $this->_tpl_vars['playlist']['type'] != @PLAYLIST_TYPE_HISTORY): ?>
		<form name="playlist-settings" class="form-horizontal" method="post" action="">
		<div class="modal hide" id="playlist-settings" role="dialog" aria-labelledby="playlist-settings-form-label">
		    <div class="modal-header">
		         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		         <h3 id="playlist-settings-form-label"><?php echo $this->_tpl_vars['lang']['playlist_settings']; ?>
</h3>
		    </div>
		    <div class="modal-body">
		    	<div id="playlist-modal-ajax-response" class="hide"></div>
				
				<?php if ($this->_tpl_vars['playlist']['type'] == @PLAYLIST_TYPE_CUSTOM): ?>
				<div class="control-group">
					<label class="control-label"><?php echo $this->_tpl_vars['lang']['playlist_name']; ?>
</label>
					<div class="controls">
					<input type="text" name="playlist_name" value="<?php echo $this->_tpl_vars['playlist']['title']; ?>
" />
					</div>
				</div>
				<?php endif; ?> 
				
				<div class="control-group">
					<label class="control-label"><?php echo $this->_tpl_vars['lang']['playlist_privacy']; ?>
</label>
					<div class="controls">
					<select name="visibility">
						<option value="<?php echo @PLAYLIST_PUBLIC; ?>
" <?php if ($this->_tpl_vars['playlist']['visibility'] == @PLAYLIST_PUBLIC): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['public']; ?>
</option>
						<option value="<?php echo @PLAYLIST_PRIVATE; ?>
" <?php if ($this->_tpl_vars['playlist']['visibility'] == @PLAYLIST_PRIVATE): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['private']; ?>
</option>
					</select>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label"><?php echo $this->_tpl_vars['lang']['video_ordering']; ?>
</label>
					<div class="controls">
					<select name="sorting">
						<option value="default" <?php if ($this->_tpl_vars['playlist']['sorting'] == 'default'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['_manual']; ?>
</option>
						<option value="popular" <?php if ($this->_tpl_vars['playlist']['sorting'] == 'popular'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['most_popular']; ?>
</option>
						<option value="date-added-desc" <?php if ($this->_tpl_vars['playlist']['sorting'] == 'date-added-desc'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['sort_added_new']; ?>
</option>
						<option value="date-added-asc" <?php if ($this->_tpl_vars['playlist']['sorting'] == 'date-added-asc'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['sort_added_old']; ?>
</option>
						<option value="date-published-desc" <?php if ($this->_tpl_vars['playlist']['sorting'] == 'date-published-desc'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['sort_published_new']; ?>
</option>
						<option value="date-published-asc" <?php if ($this->_tpl_vars['playlist']['sorting'] == 'date-published-asc'): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['lang']['sort_published_old']; ?>
</option>
					</select>
					</div>
				</div>
		    </div>
			<div class="modal-footer">
				<?php if ($this->_tpl_vars['my_playlist']): ?>
				<a href="#" class="btn btn-danger <?php if ($this->_tpl_vars['playlist']['type'] != @PLAYLIST_TYPE_CUSTOM): ?>disabled<?php endif; ?> pull-left" <?php if ($this->_tpl_vars['playlist']['type'] == @PLAYLIST_TYPE_CUSTOM): ?> onclick="playlist_delete(<?php echo $this->_tpl_vars['playlist']['list_id']; ?>
, this);" <?php endif; ?>><?php echo $this->_tpl_vars['lang']['submit_delete']; ?>
</a>
				<?php endif; ?>
				<img src="<?php echo @_URL; ?>
/templates/<?php echo $this->_tpl_vars['template_dir']; ?>
/img/ajax-loading.gif" width="16" height="16" alt="<?php echo $this->_tpl_vars['lang']['please_wait']; ?>
" class="hide" id="modal-loading-gif">
				<a href="#" class="btn btn-small btn-link" data-dismiss="modal" ><?php echo $this->_tpl_vars['lang']['submit_cancel']; ?>
</a>
				<a href="#" class="btn btn-success" onclick="playlist_save_settings(<?php echo $this->_tpl_vars['playlist']['list_id']; ?>
, this); return false;"><?php echo $this->_tpl_vars['lang']['submit_save']; ?>
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