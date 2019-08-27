<?php /* Smarty version 2.6.30, created on 2017-08-04 07:24:41
         compiled from channel.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'pm_number_format', 'channel.tpl', 84, false),array('function', 'smarty_fewchars', 'channel.tpl', 107, false),array('modifier', 'lower', 'channel.tpl', 84, false),array('modifier', 'sprintf', 'channel.tpl', 141, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array('p' => 'general','tpl_name' => 'channel')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="wrapper" class="profile-page">
	<div class="container-fluid">
	  <div class="row-fluid">
		<div class="span12">
		<div class="pm-profile">
				<div class="pm-profile-header">
						<div class="pm-profile-cover">
							<?php if ($this->_tpl_vars['profile_data']['id'] == $this->_tpl_vars['s_user_id']): ?>
							<div class="pm-profile-cover-preview" data-cropit-height="200">
								<div class="cropit-image-preview">
									<?php if ($this->_tpl_vars['profile_data']['channel_cover']['max'] != ''): ?>
									<img src="<?php echo $this->_tpl_vars['profile_data']['channel_cover']['max']; ?>
" >
									<?php else: ?>
									<img src="<?php echo @_URL; ?>
/templates/<?php echo $this->_tpl_vars['template_dir']; ?>
/img/bg-channel-cover.png" alt=""  border="0" class="img-responsive">
									<?php endif; ?>
									<span class="pm-profile-cover-edit"><a href="#" title="<?php echo $this->_tpl_vars['lang']['update_channel_cover']; ?>
" class="btn btn-link btn-edit" id="btn-edit-cover"><i class="icon icon-pencil"></i></a></span>

									<form action="#" class="cropit-form" id="cropit-cover-form">
										<input type="file" class="cropit-image-input" id="cropit-cover-input" />
										<input type="hidden" name="image-data" class="hidden-cover-data-img" />
										<input type="hidden" name="p" value="upload" />
										<input type="hidden" name="do" value="channel-cover" />
										<button class="btn btn-default btn-cancel"><?php echo $this->_tpl_vars['lang']['submit_cancel']; ?>
</button>
										<button type="submit" class="btn btn-success"><?php echo $this->_tpl_vars['lang']['submit_save']; ?>
</button>
									</form>
								</div>
							</div>
							<?php else: ?>
									<?php if ($this->_tpl_vars['profile_data']['channel_cover']['max'] != ''): ?>
									<img src="<?php echo $this->_tpl_vars['profile_data']['channel_cover']['max']; ?>
" >
									<?php else: ?>
									<img src="<?php echo @_URL; ?>
/templates/<?php echo $this->_tpl_vars['template_dir']; ?>
/img/bg-channel-cover.png" alt=""  border="0" class="img-responsive">
									<?php endif; ?>
							<?php endif; ?>

							<div class="pm-profile-avatar-pic">
								<?php if ($this->_tpl_vars['profile_data']['id'] == $this->_tpl_vars['s_user_id']): ?>
								<div class="cropit-image-preview">
									<img src="<?php echo $this->_tpl_vars['profile_data']['avatar_url']; ?>
" alt="<?php echo $this->_tpl_vars['profile_data']['username']; ?>
"  border="0" class="img-responsive">
									<span class="pm-profile-avatar-edit"><a href="#" title="<?php echo $this->_tpl_vars['lang']['update_avatar']; ?>
" class="btn btn-link btn-edit" id="btn-edit-avatar"><i class="icon icon-pencil"></i></a></span>
									<form action="#" class="cropit-form" id="cropit-avatar-form">
										<input type="file" class="cropit-image-input" id="cropit-avatar-input" />
										<input type="hidden" name="image-data" class="hidden-avatar-data-img" />
										<input type="hidden" name="p" value="upload" />
										<input type="hidden" name="do" value="user-avatar" />
										<button class="btn btn-default btn-cancel-avatar"><?php echo $this->_tpl_vars['lang']['submit_cancel']; ?>
</button>
										<button type="submit" class="btn btn-mini btn-success"><?php echo $this->_tpl_vars['lang']['submit_save']; ?>
</button>
									</form>
								</div>
								<?php else: ?>
									<img src="<?php echo $this->_tpl_vars['avatar']; ?>
" alt="<?php echo $this->_tpl_vars['profile_data']['username']; ?>
" border="0" class="img-responsive">
								<?php endif; ?>
							</div>
							
							<div class="pm-profile-user-info">
								<h1><?php echo $this->_tpl_vars['profile_data']['username']; ?>


								<?php if ($this->_tpl_vars['profile_data']['channel_verified'] && @_MOD_SOCIAL): ?><span class="label"><?php echo $this->_tpl_vars['lang']['verified']; ?>
</span><?php endif; ?>
								<!--<?php if ($this->_tpl_vars['profile_data']['channel_featured'] == 1): ?><span class="label"><?php echo $this->_tpl_vars['lang']['featured']; ?>
</span><?php endif; ?>--> 

								<?php if ($this->_tpl_vars['user_is_banned']): ?> <span class="label label-banned"><?php echo $this->_tpl_vars['lang']['user_account_banned_label']; ?>
</span><?php endif; ?>
								<?php if (@_MOD_SOCIAL && $this->_tpl_vars['logged_in'] == 1 && $this->_tpl_vars['s_user_id'] != $this->_tpl_vars['profile_data']['id']): ?>
									<?php if ($this->_tpl_vars['profile_data']['is_following_me']): ?>
										<span class="label label-social-follows"><?php echo $this->_tpl_vars['lang']['subscriber']; ?>
</span>
									<?php endif; ?>
								<?php endif; ?>
								</h1>

								<div class="pm-profile-buttons">
									<?php if (@_MOD_SOCIAL && $this->_tpl_vars['logged_in'] == 1 && $this->_tpl_vars['s_user_id'] != $this->_tpl_vars['profile_data']['id']): ?>
										<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'user-subscribe-button.tpl', 'smarty_include_vars' => array('profile_user_id' => $this->_tpl_vars['profile_data']['id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									<?php endif; ?>
								</div>
							</div>
					</div>
				</div>

				<div class="pm-profile-body">
					<div class="row-fluid">
						<div class="span9">
							<ul class="pm-profile-stats list-inline">
								<li><?php echo smarty_pm_number_format(array('number' => $this->_tpl_vars['total_submissions']), $this);?>
 <span><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['videos'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</span></li>
								<?php if (@_MOD_SOCIAL): ?>
								<li><?php echo smarty_pm_number_format(array('number' => $this->_tpl_vars['profile_data']['followers_count']), $this);?>
 <span><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['subscribers'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</span></li>
								<?php endif; ?>
								<li><?php echo smarty_pm_number_format(array('number' => $this->_tpl_vars['total_playlists']), $this);?>
 <span><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['_playlists'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</span></li>
							</ul>
						</div>
						<div class="span3">
							<?php if (count ( $this->_tpl_vars['profile_data']['social_links'] ) > 0): ?>
							<ul class="pm-profile-links list-inline pull-right">
								<?php if ($this->_tpl_vars['profile_data']['social_links']['website'] != ''): ?><li><a href="<?php echo $this->_tpl_vars['profile_data']['social_links']['website']; ?>
" target="_blank" rel="nofollow"><i class="fa fa-globe"></i></a></li><?php endif; ?>
								<?php if ($this->_tpl_vars['profile_data']['social_links']['facebook'] != ''): ?><li><a href="<?php echo $this->_tpl_vars['profile_data']['social_links']['facebook']; ?>
" target="_blank" rel="nofollow"><i class="fa fa-facebook-square"></i></a></li><?php endif; ?>
								<?php if ($this->_tpl_vars['profile_data']['social_links']['twitter'] != ''): ?><li><a href="<?php echo $this->_tpl_vars['profile_data']['social_links']['twitter']; ?>
" target="_blank" rel="nofollow"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
								<?php if ($this->_tpl_vars['profile_data']['social_links']['instagram'] != ''): ?><li><a href="<?php echo $this->_tpl_vars['profile_data']['social_links']['instagram']; ?>
" target="_blank" rel="nofollow"><i class="fa fa-instagram"></i></a></li><?php endif; ?>
								<?php if ($this->_tpl_vars['profile_data']['social_links']['google_plus'] != ''): ?><li><a href="<?php echo $this->_tpl_vars['profile_data']['social_links']['google_plus']; ?>
" target="_blank" rel="nofollow"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
								<?php if (isset ( $this->_tpl_vars['mm_profile_webfields_inject'] )): ?><?php echo $this->_tpl_vars['mm_profile_webfields_inject']; ?>
<?php endif; ?>
							</ul>
							<?php endif; ?>
						</div>
					</div>
					<div class="clearfix"></div>
					<?php if ($this->_tpl_vars['profile_data']['about']): ?>
						<div class="pm-profile-desc">
						<span class="ellipsis-line"><?php echo smarty_fewchars(array('s' => $this->_tpl_vars['profile_data']['about'],'length' => 280), $this);?>
</span>
						<?php if (isset ( $this->_tpl_vars['mm_profile_info_inject'] )): ?><?php echo $this->_tpl_vars['mm_profile_info_inject']; ?>
<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
		</div>

		<div class="row-fluid" id="sticky">
			<div class="span12">
				<ul class="nav nav-tabs">
					<li <?php if ($_GET['view'] == 'videos' || $_GET['view'] == ''): ?>class="active"<?php endif; ?>><a href="#pm-pro-own" data-toggle="tab"><?php echo $this->_tpl_vars['lang']['videos']; ?>
</span></a></li>
					<?php if (@_MOD_SOCIAL): ?>
					<?php if ($this->_tpl_vars['s_user_id'] == $this->_tpl_vars['profile_data']['id']): ?>
						<li><a href="#pm-pro-activity-stream" data-toggle="tab"><?php echo $this->_tpl_vars['lang']['activity_newsfeed']; ?>
</a></li>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['s_user_id'] == $this->_tpl_vars['profile_data']['id'] || $this->_tpl_vars['profile_data']['am_following']): ?>
						<li><a href="#pm-pro-user-activity" data-toggle="tab"><?php echo $this->_tpl_vars['lang']['my_activity']; ?>
</a></li>
					<?php endif; ?>
					<?php endif; ?>
					<li <?php if ($_GET['view'] == 'playlists'): ?>class="active"<?php endif; ?>><a href="#pm-pro-playlists" id="pm-pro-playlists-btn" class="pm-pro-playlists-btn" data-profile-id="<?php echo $this->_tpl_vars['profile_data']['id']; ?>
" data-toggle="tab"><?php echo $this->_tpl_vars['lang']['_playlists']; ?>
</a></li>
					<?php if (@_MOD_SOCIAL && $this->_tpl_vars['s_user_id'] == $this->_tpl_vars['profile_data']['id']): ?>
						<li><a href="#pm-pro-followers" data-toggle="tab"><?php echo $this->_tpl_vars['lang']['subscribers']; ?>
</a></li>
						<li><a href="#pm-pro-following" data-toggle="tab"><?php echo $this->_tpl_vars['lang']['subscribed_to']; ?>
</a></li>
					<?php endif; ?>

					<li><a href="#pm-pro-about" data-toggle="tab"><?php echo $this->_tpl_vars['lang']['_about']; ?>
</a></li>
				</ul>
			</div>
		</div>

		<div class="row-fluid">
		<div class="span12">
		<div class="tab-content">
			<div class="tab-pane <?php if ($_GET['view'] == 'videos' || $_GET['view'] == ''): ?>active<?php else: ?>fade<?php endif; ?>" id="pm-pro-own">
			<h4><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['videos_from_s'])) ? $this->_run_mod_handler('sprintf', true, $_tmp, $this->_tpl_vars['profile_data']['username']) : sprintf($_tmp, $this->_tpl_vars['profile_data']['username'])); ?>
</h4>

            <ul class="pm-ul-browse-videos thumbnails">
            <?php $_from = $this->_tpl_vars['submitted_video_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['video_data']):
?>
              <li>
                <div class="pm-li-video<?php if ($this->_tpl_vars['video_data']['pending_approval']): ?> pending<?php endif; ?>">
                    <span class="pm-video-thumb pm-thumb-234 pm-thumb border-radius2">

					<?php if ($this->_tpl_vars['profile_data']['id'] == $this->_tpl_vars['s_user_id'] && $this->_tpl_vars['allow_user_edit_video']): ?>
						<?php if ($this->_tpl_vars['video_data']['pending_approval']): ?>
						<a href="<?php echo @_URL; ?>
/edit-video.php?vid=<?php echo $this->_tpl_vars['video_data']['id']; ?>
&type=pending" class="btn btn-mini btn-edit-video" rel="tooltip" title="<?php echo $this->_tpl_vars['lang']['edit']; ?>
"><i class="fa fa-pencil"></i></a>
						<?php else: ?>
						<a href="<?php echo @_URL; ?>
/edit-video.php?vid=<?php echo $this->_tpl_vars['video_data']['uniq_id']; ?>
" class="btn btn-mini btn-edit-video" rel="tooltip" title="<?php echo $this->_tpl_vars['lang']['edit']; ?>
"><i class="fa fa-pencil"></i></a>
						<?php endif; ?>
					<?php endif; ?>

                    <span class="pm-video-li-thumb-info">
	                    <?php if ($this->_tpl_vars['video_data']['yt_length'] != 0): ?><span class="pm-label-duration border-radius3 opac7"><?php echo $this->_tpl_vars['video_data']['duration']; ?>
</span><?php endif; ?>
						<?php if ($this->_tpl_vars['logged_in']): ?>
						<span class="watch-later hide">
							<button class="btn btn-mini watch-later-add-btn-<?php echo $this->_tpl_vars['video_data']['id']; ?>
" onclick="watch_later_add(<?php echo $this->_tpl_vars['video_data']['id']; ?>
); return false;" rel="tooltip" title="<?php echo $this->_tpl_vars['lang']['add_to']; ?>
 <?php echo $this->_tpl_vars['lang']['watch_later']; ?>
"><i class="icon-time"></i></button>
							<button class="btn btn-mini btn-remove hide watch-later-remove-btn-<?php echo $this->_tpl_vars['video_data']['id']; ?>
" onclick="watch_later_remove(<?php echo $this->_tpl_vars['video_data']['id']; ?>
); return false;" rel="tooltip" title="<?php echo $this->_tpl_vars['lang']['playlist_remove_item']; ?>
"><i class="icon-ok"></i></button>
						</span>
						<?php endif; ?>
                    </span>
                    <a href="<?php echo $this->_tpl_vars['video_data']['video_href']; ?>
" class="pm-thumb-fix pm-thumb-234"><span class="pm-thumb-fix-clip"><img src="<?php echo $this->_tpl_vars['video_data']['thumb_img_url']; ?>
" alt="<?php echo $this->_tpl_vars['video_data']['video_title']; ?>
" width="234"><span class="vertical-align"></span></span></a>
                    <?php if ($this->_tpl_vars['video_data']['pending_approval']): ?><div class="pending-approval"><?php echo $this->_tpl_vars['lang']['pending_approval']; ?>
</div><?php endif; ?>
                    </span>
                    
                    <h3><a href="<?php echo $this->_tpl_vars['video_data']['video_href']; ?>
" class="pm-title-link" title="<?php echo $this->_tpl_vars['video_data']['video_title']; ?>
"><?php echo $this->_tpl_vars['video_data']['video_title']; ?>
</a></h3>
                    <div class="pm-video-attr">
                        <span class="pm-video-attr-author"><?php echo $this->_tpl_vars['lang']['articles_by']; ?>
 <a href="<?php echo $this->_tpl_vars['video_data']['author_profile_href']; ?>
"><?php echo $this->_tpl_vars['video_data']['author_username']; ?>
</a></span>
                        <span class="pm-video-attr-since"><small><?php echo $this->_tpl_vars['lang']['added']; ?>
 <time datetime="<?php echo $this->_tpl_vars['video_data']['html5_datetime']; ?>
" title="<?php echo $this->_tpl_vars['video_data']['full_datetime']; ?>
"><?php echo $this->_tpl_vars['video_data']['time_since_added']; ?>
 <?php echo $this->_tpl_vars['lang']['ago']; ?>
</time></small></span>
                        <span class="pm-video-attr-numbers"><small><?php echo $this->_tpl_vars['video_data']['views_compact']; ?>
 <?php echo $this->_tpl_vars['lang']['views']; ?>
 / <?php echo $this->_tpl_vars['video_data']['likes_compact']; ?>
 <?php echo $this->_tpl_vars['lang']['_likes']; ?>
</small></span>
                    </div>
                    <p class="pm-video-attr-desc"><?php echo $this->_tpl_vars['video_data']['excerpt']; ?>
</p>
                    <?php if ($this->_tpl_vars['video_data']['featured']): ?>
                    <span class="pm-video-li-info">
                        <span class="label label-featured"><?php echo $this->_tpl_vars['lang']['_feat']; ?>
</span>
                    </span>
                    <?php endif; ?>
                </div>
              </li>
            <?php endforeach; else: ?>
                <?php echo $this->_tpl_vars['lang']['top_videos_msg2']; ?>

            <?php endif; unset($_from); ?>
            </ul>
			
			<?php if (count ( $this->_tpl_vars['submitted_video_list'] ) >= 10): ?>
			<a href="<?php echo @_URL; ?>
/search.php?keywords=<?php echo $this->_tpl_vars['username']; ?>
&btn=Search&t=user" class="btn btn-small" title="<?php echo $this->_tpl_vars['lang']['profile_watch_all']; ?>
"><?php echo $this->_tpl_vars['lang']['profile_watch_all']; ?>
</a>
			<?php endif; ?>
			</div>

			<div class="tab-pane fade" id="pm-pro-about">
			<h4><?php echo $this->_tpl_vars['lang']['_about']; ?>
</h4>
			<?php if ($this->_tpl_vars['about']): ?>
				<p><?php echo $this->_tpl_vars['about']; ?>
</p>
			<?php else: ?>
				<p><?php echo $this->_tpl_vars['lang']['profile_msg_about_empty']; ?>
</p>
			<?php endif; ?>
			<?php if (isset ( $this->_tpl_vars['mm_profile_info_inject'] )): ?><?php echo $this->_tpl_vars['mm_profile_info_inject']; ?>
<?php endif; ?>

			<div class="clearfix"></div>

			<?php if (count ( $this->_tpl_vars['profile_data']['social_links'] ) > 0): ?>
			<h4><?php echo $this->_tpl_vars['lang']['_social']; ?>
</h4>
			<ul class="pm-pro-social-links list-unstyled">
			<?php if ($this->_tpl_vars['profile_data']['social_links']['website'] != ''): ?> 
				<li><i class="fa fa-globe"></i> <a href="<?php echo $this->_tpl_vars['profile_data']['social_links']['website']; ?>
" target="_blank" rel="nofollow"><?php echo $this->_tpl_vars['profile_data']['social_links']['website']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['profile_data']['social_links']['facebook'] != ''): ?>
				<li><i class="fa fa-facebook-square"></i> <a href="<?php echo $this->_tpl_vars['profile_data']['social_links']['facebook']; ?>
" target="_blank" rel="nofollow"><?php echo $this->_tpl_vars['profile_data']['social_links']['facebook']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['profile_data']['social_links']['twitter'] != ''): ?>
				<li><i class="fa fa-twitter"></i> <a href="<?php echo $this->_tpl_vars['profile_data']['social_links']['twitter']; ?>
" target="_blank" rel="nofollow"><?php echo $this->_tpl_vars['profile_data']['social_links']['twitter']; ?>
</a></li>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['profile_data']['social_links']['instagram'] != ''): ?>
				<li><i class="fa fa-instagram"></i> <a href="<?php echo $this->_tpl_vars['profile_data']['social_links']['instagram']; ?>
" target="_blank" rel="nofollow"><?php echo $this->_tpl_vars['profile_data']['social_links']['instagram']; ?>
</a></li> 
			<?php endif; ?>
			<?php if ($this->_tpl_vars['profile_data']['social_links']['google_plus'] != ''): ?>
				<li><i class="fa fa-google-plus"></i> <a href="<?php echo $this->_tpl_vars['profile_data']['social_links']['google_plus']; ?>
" target="_blank" rel="nofollow"><?php echo $this->_tpl_vars['profile_data']['social_links']['google_plus']; ?>
</a></li> 
			<?php endif; ?>
			<?php if (isset ( $this->_tpl_vars['mm_profile_webfields_inject'] )): ?><?php echo $this->_tpl_vars['mm_profile_webfields_inject']; ?>
<?php endif; ?>
			</ul>
			<?php endif; ?>
			</div>

			<div class="tab-pane <?php if ($_GET['view'] == 'playlists'): ?>fade in active<?php else: ?>fade<?php endif; ?>" id="pm-pro-playlists">
				<?php if ($this->_tpl_vars['profile_data']['id'] == $this->_tpl_vars['s_user_id']): ?>
				<h4><?php echo $this->_tpl_vars['lang']['my_playlists']; ?>
</h4>
				<?php else: ?>
				<h4><?php echo $this->_tpl_vars['lang']['_playlists']; ?>
</h4>
				<?php endif; ?>
				<div id="profile-playlists-container">
					<img src="<?php echo @_URL; ?>
/templates/<?php echo $this->_tpl_vars['template_dir']; ?>
/img/ajax-loading.gif" alt="<?php echo $this->_tpl_vars['lang']['please_wait']; ?>
" align="absmiddle" border="0" width="16" height="16" /> <?php echo $this->_tpl_vars['lang']['please_wait']; ?>

				</div>
			</div>

			<?php if (@_MOD_SOCIAL): ?>
			<div class="tab-pane fade" id="pm-pro-followers">
			<h4><?php echo $this->_tpl_vars['lang']['subscribers']; ?>
</h4>
				<div id="pm-pro-followers-content"></div>
			</div>
			
			<div class="tab-pane fade" id="pm-pro-following">
			<?php if (is_array ( $this->_tpl_vars['who_to_follow_list'] )): ?>
				<h4><?php echo $this->_tpl_vars['lang']['suggested_channels']; ?>
</h4>
				<a href="#" id="hide_who_to_follow" class="pm-pro-suggest-hide">&times; <?php echo $this->_tpl_vars['lang']['hide']; ?>
</a>
				<ul class="row-fluid pm-channels-list list-unstyled">
				<?php $_from = $this->_tpl_vars['who_to_follow_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['user_data']):
?>
				<li class="span4">
					<div class="pm-channel">
						<div class="pm-channel-header">
							<div class="pm-channel-cover">
								<?php if ($this->_tpl_vars['user_data']['channel_cover']['max']): ?>
									<img src="<?php echo $this->_tpl_vars['user_data']['channel_cover']['450']; ?>
" alt="<?php echo $this->_tpl_vars['user_data']['username']; ?>
"  border="0" class="img-responsive">
								<?php endif; ?>
							</div>
							<div class="pm-channel-profile-pic">
								<a href="<?php echo $this->_tpl_vars['user_data']['profile_url']; ?>
"><img src="<?php echo $this->_tpl_vars['user_data']['avatar_url']; ?>
" alt="<?php echo $this->_tpl_vars['user_data']['username']; ?>
"  border="0" class="img-responsive"></a>
							</div>
						</div>
						<div class="pm-channel-body">
							<h3><a href="<?php echo $this->_tpl_vars['user_data']['profile_url']; ?>
" class="ellipsis-line <?php if ($this->_tpl_vars['user_data']['user_is_banned']): ?>pm-user-banned<?php endif; ?>"><?php echo $this->_tpl_vars['user_data']['name']; ?>
</a> <?php if ($this->_tpl_vars['user_data']['is_following_me']): ?><span class="label label-success label-follow-status pm-follows"><?php echo $this->_tpl_vars['lang']['subscriber']; ?>
</span><?php endif; ?></h3>
							<div class="pm-channel-stats"> <?php echo $this->_tpl_vars['user_data']['videos_count_formatted']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['videos'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
 / <?php echo $this->_tpl_vars['user_data']['followers_count_formatted']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['subscribers'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)); ?>
</div>
							<div class="pm-channel-desc"><?php echo $this->_tpl_vars['user_data']['about']; ?>
</div>
							<div class="pm-channel-buttons">
								<?php if (@_MOD_SOCIAL && $this->_tpl_vars['logged_in'] == '1' && $this->_tpl_vars['user_data']['id'] != $this->_tpl_vars['s_user_id']): ?>
									<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user-subscribe-button.tpl", 'smarty_include_vars' => array('profile_data' => $this->_tpl_vars['user_data'],'profile_user_id' => $this->_tpl_vars['user_data']['id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</li>

				<?php endforeach; endif; unset($_from); ?>
				</ul>
			<?php endif; ?>

			<h4><?php echo $this->_tpl_vars['lang']['subscribed_to']; ?>
</h4>
				<div id="pm-pro-following-content"></div>
			</div>

			<?php if ($this->_tpl_vars['s_user_id'] == $this->_tpl_vars['profile_data']['id'] || $this->_tpl_vars['profile_data']['am_following']): ?>
			<div class="tab-pane fade" id="pm-pro-user-activity"> 
			<h4><?php echo $this->_tpl_vars['lang']['my_activity']; ?>
</h4>
				<div id="pm-pro-user-activity-content"></div>
			</div>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['s_user_id'] == $this->_tpl_vars['profile_data']['id']): ?>
			<div class="tab-pane fade" id="pm-pro-activity-stream">	
			<h4><?php echo $this->_tpl_vars['lang']['activity_newsfeed']; ?>
</h4>
                <form name="user-update-status" method="post" action="" onsubmit="update_status();return false;" >
                    <textarea class="span12" name="post-status" ></textarea>
                    <br />
                    <button type="submit" name="btn-update-status" class="btn btn-blue" /><?php echo $this->_tpl_vars['lang']['status_update']; ?>
</button>
                </form>
				<div id="pm-pro-activity-stream-content">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'activity-stream.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
			</div>
			<?php endif; ?>
			<?php endif; ?>
			
		  </div><!-- /tab-content -->
		</div>
		</div>
		<input type="hidden" name="profile_user_id" value="<?php echo $this->_tpl_vars['profile_data']['id']; ?>
" />
		</div><!-- #content -->
	  </div><!-- .row -->
	</div><!-- .container -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array('tpl_name' => 'channel')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>