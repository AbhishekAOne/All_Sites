{include file='header.tpl' p="index"} 
<div id="wrapper">
    <div class="container-fluid">
      <div class="row-fluid">
      <div class="span3" id="left">
		<div class="widget">
		<h4>{$lang._categories}</h4>
		<ul class="pm-browse-ul-subcats">
			{dropdown_menu_video_categories max_levels=0}
        </ul>
        </div>
        
        {if ($show_tags == 1) && (count($tags) > 0)}
		<div class="widget">
		<h4>{$lang.tags}</h4>
            {foreach from=$tags item=tag key=k}
                {$tag.href}
            {/foreach}
        </div>
        {/if}
        
        {if $show_stats == 1}
        <div class="widget">
        <h4>{$lang.site_stats}</h4>
        <ul class="pm-stats-data">
        	<li><a href="{$smarty.const._URL}/memberlist.{$smarty.const._FEXT}?do=online">{$lang.online_users}</a> <span class="pm-stats-count">{$stats.online_users}</span></li>
            <li><a href="{$smarty.const._URL}/memberlist.{$smarty.const._FEXT}">{$lang.total_users}</a> <span class="pm-stats-count">{$stats.users}</span></li>
            <li>{$lang.total_videos} <span class="pm-stats-count">{$stats.videos}</span></li>
        	<li>{$lang.videos_added_lw} <span class="pm-stats-count">{$stats.videos_last_week}</span></li>
        </ul>
		</div>
        {/if}
      </div><!-- .span3 -->

        <div class="span9" id="right">
		<div id="primary">
        <div id="pm-video-left">
        <div id="pm-featured" class="border-radius3">
        <h2>{$lang.featured}: <a href="{$featured_videos.0.video_href}">{smarty_fewchars s=$featured_videos.0.video_title length=55}</a></h2>
        {if $display_preroll_ad == true}
        	<div id="preroll_placeholder">
        		<div class="preroll_countdown">
	        		{$lang.preroll_ads_timeleft} <span class="preroll_timeleft">{$preroll_ad_data.timeleft_start}</span>
				</div>
        		{$preroll_ad_data.code}
				
				{if $preroll_ad_data.skip}
				<div class="preroll_skip_countdown">
					{$lang.preroll_ads_skip_msg} <span class="preroll_skip_timeleft">{$preroll_ad_data.skip_delay_seconds}</span>
				</div>
				<br />
				<a href="#" class="btn btn-blue hide" id="preroll_skip_btn">{$lang.preroll_ads_skip}</a>
				{/if}
				{if $preroll_ad_data.disable_stats == 0}
					<img src="{$smarty.const._URL}/ajax.php?p=stats&do=show&aid={$preroll_ad_data.id}&at={$smarty.const._AD_TYPE_PREROLL}" width="1" height="1" border="0" />
				{/if}
        	</div>
        {else}
			{include file="player.tpl" page="index" video_data=$featured_videos.0}
		{/if}
        </div>
        
        </div>
        
        
        <div id="pm-video-right">
        <div class="widget">
            <div class="btn-group btn-group-sort opac6 pm-slide-control">
            <button class="btn btn-mini btn-blue" id="pm-slide-top-prev" class="prev"><img src="{$smarty.const._URL}/templates/{$template_dir}/img/arr-l.png" width="10" height="11" alt="{$lang.prev}"></button>
            <button class="btn btn-mini btn-blue" id="pm-slide-top-next" class="next"><img src="{$smarty.const._URL}/templates/{$template_dir}/img/arr-r.png" width="10" height="11" alt="{$lang.next}"></button>
            </div>
            <h4>{$lang.top_m_videos}</h4>
            <ul class="pm-ul-top-videos" id="pm-ul-top-videos">
			{foreach from=$top_videos key=k item=video_data}
			  <li>
				<div class="pm-li-top-videos">
				<span class="pm-video-thumb pm-thumb-80 pm-thumb-top border-radius2">
				<span class="pm-video-li-thumb-info">
				{if $video_data.yt_length != 0}<span class="pm-label-duration border-radius3 opac7">{$video_data.duration}</span>{/if}
                {if $logged_in}
                <span class="watch-later hide">
                    <button class="btn btn-mini watch-later-add-btn-{$video_data.id}" onclick="watch_later_add({$video_data.id}); return false;" rel="tooltip" title="{$lang.add_to} {$lang.watch_later}"><i class="icon-time"></i></button>
                    <button class="btn btn-mini btn-remove hide watch-later-remove-btn-{$video_data.id}" onclick="watch_later_remove({$video_data.id}); return false;" rel="tooltip" title="{$lang.playlist_remove_item}"><i class="icon-ok"></i></button>
                </span>
                {/if}
				</span>
				<a href="{$video_data.video_href}" class="pm-thumb-fix pm-thumb-80"><span class="pm-thumb-fix-clip"><img src="{$video_data.thumb_img_url}" alt="{$video_data.attr_alt}" width="106"><span class="vertical-align"></span></span></a>
				</span>
				<h3 dir="ltr"><a href="{$video_data.video_href}" class="pm-title-link">{$video_data.video_title}</a></h3>
				<span class="pm-video-attr-numbers"><small>{$video_data.views_compact} {$lang.views}</small></span>
				</div>
			  </li>
			{/foreach}
            </ul>
            <div class="clearfix"></div>
        </div>
        {if $ad_5 != ''}
		<div class="widget">
        	<div class="pm-ad-zone" align="center">{$ad_5}</div>
        </div>
        {/if}
        </div>
        <div class="clearfix"></div>
        
        
        <div id="pm-wn">
        <h2>{$lang.vbwrn}</h2>
            {if $total_playingnow > 0}
            <div class="btn-group btn-group-sort opac5 pm-slide-control">
            <button class="btn btn-blue btn-mini" id="pm-slide-prev" class="prev"><img src="{$smarty.const._URL}/templates/{$template_dir}/img/arr-l.png" width="10" height="11" alt="{$lang.prev}"></button>
            <button class="btn btn-blue btn-mini" id="pm-slide-next" class="next"><img src="{$smarty.const._URL}/templates/{$template_dir}/img/arr-r.png" width="10" height="11" alt="{$lang.next}"></button>
            </div>
            <div id="pm-slide">
            <!-- Carousel items -->
            <ul class="pm-ul-wn-videos clearfix" id="pm-ul-wn-videos">
			{foreach from=$playingnow key=k item=video_data}
			  <li>
				<div class="pm-li-wn-videos">
				<span class="pm-video-thumb pm-thumb-138 pm-thumb-top border-radius2">
                <span class="pm-video-li-thumb-info">
                    {if $logged_in}
                    <span class="watch-later hide">
                        <button class="btn btn-mini watch-later-add-btn-{$video_data.id}" onclick="watch_later_add({$video_data.id}); return false;" rel="tooltip" title="{$lang.add_to} {$lang.watch_later}"><i class="icon-time"></i></button>
                        <button class="btn btn-mini btn-remove hide watch-later-remove-btn-{$video_data.id}" onclick="watch_later_remove({$video_data.id}); return false;" rel="tooltip" title="{$lang.playlist_remove_item}"><i class="icon-ok"></i></button>
                    </span>
                    {/if}
                </span>
				<a href="{$video_data.video_href}" class="pm-thumb-fix pm-thumb-138"><span class="pm-thumb-fix-clip"><img src="{$video_data.thumb_img_url}" alt="{$video_data.attr_alt}" width="138"><span class="vertical-align"></span></span></a>
				</span>
				<h3 dir="ltr"><a href="{$video_data.video_href}" class="pm-title-link">{$video_data.video_title}</a></h3>
				</div>
			  </li>
			{/foreach}
            </ul>
	        </div>
            {else}
            <div align="left">{$lang.no_vids_playing}</div>
            {/if}
        </div><!-- #pm-wn -->
        <div id="pm-new">
        <div class="clearfix"></div>
        <div class="element-videos">
        <div class="btn-group btn-group-sort opac5">
        <button class="btn btn-small btn-blue" id="list"><i class="icon-th"></i> </button>
        <button class="btn btn-small btn-blue" id="grid"><i class="icon-th-list"></i> </button>
        </div>
        <h2>{$lang.new_videos}</h2>    
        <ul class="pm-ul-browse-videos thumbnails" id="pm-grid">
		{foreach from=$new_videos key=k item=video_data}
		  <li>
			<div class="pm-li-video">
			    <span class="pm-video-thumb pm-thumb-138 pm-thumb border-radius2">
			    <span class="pm-video-li-thumb-info">
			    {if $video_data.yt_length != 0}<span class="pm-label-duration border-radius3 opac7">{$video_data.duration}</span>{/if}
			    {if $video_data.mark_new}<span class="label label-new">{$lang._new}</span>{/if}
    			{if $video_data.mark_popular}<span class="label label-pop">{$lang._popular}</span>{/if}
                {if $logged_in}
                <span class="watch-later hide">
                    <button class="btn btn-mini watch-later-add-btn-{$video_data.id}" onclick="watch_later_add({$video_data.id}); return false;" rel="tooltip" title="{$lang.add_to} {$lang.watch_later}"><i class="icon-time"></i></button>
                    <button class="btn btn-mini btn-remove hide watch-later-remove-btn-{$video_data.id}" onclick="watch_later_remove({$video_data.id}); return false;" rel="tooltip" title="{$lang.playlist_remove_item}"><i class="icon-ok"></i></button>
                </span>
                {/if}
				</span>
                <a href="{$video_data.video_href}" class="pm-thumb-fix pm-thumb-138"><span class="pm-thumb-fix-clip"><img src="{$video_data.thumb_img_url}" alt="{$video_data.attr_alt}" width="138"><span class="vertical-align"></span></span></a>
			    </span>
			    
			    <h3 dir="ltr"><a href="{$video_data.video_href}" class="pm-title-link" title="{$video_data.attr_alt}">{$video_data.video_title}</a></h3>
			    <div class="pm-video-attr">
			        <span class="pm-video-attr-author">{$lang.articles_by} <a href="{$video_data.author_profile_href}">{$video_data.author_name}</a></span>
			        <span class="pm-video-attr-since"><small>{$lang.added} <time datetime="{$video_data.html5_datetime}" title="{$video_data.full_datetime}">{$video_data.time_since_added} {$lang.ago}</time></small></span>
			        <span class="pm-video-attr-numbers"><small>{$video_data.views_compact} {$lang.views} / {$video_data.likes_compact} {$lang._likes}</small></span>
				</div>
			    <p class="pm-video-attr-desc">{$video_data.excerpt}</p>
				{if $video_data.featured}
			    <span class="pm-video-li-info">
			        <span class="label label-featured">{$lang._feat}</span>
			    </span>
				{/if}
			</div>
		  </li>
		{foreachelse}
			{$lang.top_videos_msg2}
		{/foreach}
        </ul>
        </div><!-- .element-videos -->
        </div><!-- #pm-new -->

		{if count($featured_categories_data) > 0}
		<div id="pm-new">
        <div class="clearfix"></div>
			<div class="element-videos">
				{foreach from=$featured_categories_data key=category_id item=video_data_array}
					{if $categories.$category_id.published_videos > 0}
					<div class="pm-section-head">
						<h2 class="upper-blue"><a href="{$categories.$category_id.url}">{$categories.$category_id.name}</a></h2>
						<div class="btn-group btn-group-sort pm-slide-control">
							<button class="btn btn-mini btn-blue" id="pm-slide-prev_{$category_id}">&#x276e;</button>
							<button class="btn btn-mini btn-blue" id="pm-slide-next_{$category_id}">&#x276f;</button>
						</div>
					</div>
					<div id="">
					<!-- Carousel items -->
					<ul class="pm-ul-carousel-videos list-inline" data-slider-id="{$category_id}" data-slides="5" id="pm-carousel_{$category_id}">
					{foreach from=$video_data_array key=k item=video_data}
					  <li>
						<div class="pm-li-video">
							<span class="pm-video-thumb pm-thumb-138 pm-thumb border-radius2">
							<span class="pm-video-li-thumb-info">
							{if $video_data.yt_length != 0}<span class="pm-label-duration border-radius3 opac7">{$video_data.duration}</span>{/if}
							{if $video_data.mark_new}<span class="label label-new">{$lang._new}</span>{/if}
							{if $video_data.mark_popular}<span class="label label-pop">{$lang._popular}</span>{/if}
							{if $logged_in}
							<span class="watch-later hide">
								<button class="btn btn-mini watch-later-add-btn-{$video_data.id}" onclick="watch_later_add({$video_data.id}); return false;" rel="tooltip" title="{$lang.add_to} {$lang.watch_later}"><i class="icon-time"></i></button>
								<button class="btn btn-mini btn-remove hide watch-later-remove-btn-{$video_data.id}" onclick="watch_later_remove({$video_data.id}); return false;" rel="tooltip" title="{$lang.playlist_remove_item}"><i class="icon-ok"></i></button>
							</span>
							{/if}
							</span>
							<a href="{$video_data.video_href}" class="pm-thumb-fix pm-thumb-138"><span class="pm-thumb-fix-clip"><img src="{$video_data.thumb_img_url}" alt="{$video_data.attr_alt}" width="138"><span class="vertical-align"></span></span></a>
							</span>
							<h3><a href="{$video_data.video_href}" class="pm-title-link" title="{$video_data.attr_alt}">{$video_data.video_title}</a></h3>
							<div class="pm-video-attr">
								<span class="pm-video-attr-author">{$lang.articles_by} <a href="{$video_data.author_profile_href}">{$video_data.author_name}</a></span>
								<span class="pm-video-attr-since"><small>{$lang.added} <time datetime="{$video_data.html5_datetime}" title="{$video_data.full_datetime}">{$video_data.time_since_added} {$lang.ago}</time></small></span>
								<span class="pm-video-attr-numbers"><small>{$video_data.views_compact} {$lang.views} / {$video_data.likes_compact} {$lang._likes}</small></span>
							</div>
							<p class="pm-video-attr-desc">{$video_data.excerpt}</p>
							{if $video_data.featured}
							<span class="pm-video-li-info">
								<span class="label label-featured">{$lang._feat}</span>
							</span>
							{/if}
						</div>
					  </li>
					{/foreach}
					</ul>
					</div><!-- #pm-slider -->
					<div class="clear-fix"></div>
					{/if}
				{/foreach}
			</div>
		</div>
		{/if}


		<div id="pm-articles">
        {if $smarty.const._MOD_ARTICLE == 1}
        <div class="widget">
              <div class="btn-group btn-group-sort opac6 pm-slide-control">
              <button class="btn btn-mini" id="pm-slide-art-prev" class="prev"><img src="{$smarty.const._URL}/templates/{$template_dir}/img/arr-l.png" width="10" height="11" align="absmiddle" alt="{$lang.prev} /"></button>
              <button class="btn btn-mini" id="pm-slide-art-next" class="next"><img src="{$smarty.const._URL}/templates/{$template_dir}/img/arr-r.png" width="10" height="11" alt="{$lang.next}"></button>
              </div>
			<h2>{$lang.articles_latest}</h2>
            <ul class="pm-ul-home-articles" id="pm-ul-home-articles">
            {foreach from=$articles item=article key=id}
            <li {if $article.featured == '1'}class="sticky-article"{/if}>
            <article>
            {if $article.meta._post_thumb_show != ''}
            <div class="pm-article-thumb">
            	<a href="{$article.link}" class="pm-title-link" title="{$article.title}"><img src="{$smarty.const._ARTICLE_ATTACH_DIR}/{$article.meta._post_thumb_show}" align="left" width="55" height="55" border="0" alt="{$article.title}"></a>
            </div>
            {/if}
            <h6 dir="ltr" class="ellipsis"><a href="{$article.link}" class="pm-title-link" title="{$article.title}">{smarty_fewchars s=$article.title length=100}</a></h6>
            <p class="pm-article-preview">
                {if $article.meta._post_thumb_show == ''}
                	<div class="minDesc">{smarty_fewchars s=$article.excerpt length=230}</div>
                {else}
                	<div class="minDesc">{smarty_fewchars s=$article.excerpt length=200}</div>
                {/if}
            </p>
            </article>
            </li>
            {/foreach}
            </ul>
        </div><!-- .widget -->
        {/if}        
        </div>
        <div class="clearfix"></div>
		</div><!-- #primary -->
        </div><!-- #content -->


        </div><!-- #sidebar -->
      </div><!-- .row-fluid -->
    </div><!-- .container-fluid -->
{include file='footer.tpl' p="index"} 