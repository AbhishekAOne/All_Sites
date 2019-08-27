<?php /* Smarty version 2.6.20, created on 2017-08-02 10:01:23
         compiled from profile-playlists-ul.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'smarty_fewchars', 'profile-playlists-ul.tpl', 8, false),)), $this); ?>
<ul class="pm-ul-browse-playlists thumbnails">
	<?php $_from = $this->_tpl_vars['playlists']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['playlists_foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['playlists_foreach']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['playlist_data']):
        $this->_foreach['playlists_foreach']['iteration']++;
?>
		<li>
		    <div class="pm-pl-thumb">
		    	<img src="<?php echo $this->_tpl_vars['playlist_data']['thumb_url']; ?>
">
		    	<div class="pm-pl-count"><span class="pm-pl-items"><?php echo $this->_tpl_vars['playlist_data']['items_count']; ?>
</span> <?php if ($this->_tpl_vars['playlist_data']['items_count'] == 1): ?><?php echo $this->_tpl_vars['lang']['_video']; ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['videos']; ?>
<?php endif; ?></div> <a href="<?php echo $this->_tpl_vars['playlist_data']['playlist_watch_all_href']; ?>
" class="pm-pl-thumb-overlay" rel="nofollow">&#9658; <?php echo $this->_tpl_vars['lang']['play_all']; ?>
</a>
		    </div>
		    <h3><?php if ($this->_tpl_vars['playlist_data']['visibility'] == @PLAYLIST_PRIVATE): ?><i class="icon-lock opac7"></i> <?php endif; ?><a href="<?php echo $this->_tpl_vars['playlist_data']['playlist_href']; ?>
" class="pm-title-link" title="<?php echo $this->_tpl_vars['playlist_data']['title']; ?>
"><?php echo smarty_fewchars(array('s' => $this->_tpl_vars['playlist_data']['title'],'length' => 80), $this);?>
</a></h3>
		    <span class="pm-video-attr-since"><small><?php echo $this->_tpl_vars['lang']['added']; ?>
 <time datetime="<?php echo $this->_tpl_vars['playlist_data']['html5_datetime']; ?>
" title="<?php echo $this->_tpl_vars['playlist_data']['full_datetime']; ?>
"><?php echo $this->_tpl_vars['playlist_data']['time_since']; ?>
 <?php echo $this->_tpl_vars['lang']['ago']; ?>
</time></small></span>
		</li>
	<?php endforeach; endif; unset($_from); ?>
</ul>