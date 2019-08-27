<?php /* Smarty version 2.6.30, created on 2017-08-02 13:26:52
         compiled from user-subscribe-button.tpl */ ?>
<?php if (! $this->_tpl_vars['profile_data']['am_following']): ?>
	<button id="btn_follow_<?php echo $this->_tpl_vars['profile_user_id']; ?>
" class="btn btn-small btn-follow border-radius4" data-user-id="<?php echo $this->_tpl_vars['profile_user_id']; ?>
"><?php echo $this->_tpl_vars['lang']['subscribe']; ?>
</button>
<?php else: ?>
	<button id="btn_unfollow_<?php echo $this->_tpl_vars['profile_user_id']; ?>
" class="btn btn-unfollow btn-small border-radius4" data-user-id="<?php echo $this->_tpl_vars['profile_user_id']; ?>
"><i class="icon-ok icon-white"></i> <?php echo $this->_tpl_vars['lang']['subscribed']; ?>
</button>
<?php endif; ?>