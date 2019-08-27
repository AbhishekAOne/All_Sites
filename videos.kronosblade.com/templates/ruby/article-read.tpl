{include file="header.tpl" p="article" tpl_name="article-read"}
<div id="wrapper">
{if $show_addthis_widget == '1'}
{include file='widget-socialite.tpl'}
{/if}
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3" id="left">
          <div class="widget">
          <h4>{$lang._categories}</h4>
            <ul class="pm-browse-ul-subcats">
                {$article_categories}
            </ul>
          </div>
        </div><!-- .span3 -->
        <div class="span9" id="right">
		<div id="primary" class="primary-content">
        {if is_array($article)}
        <article class="post">
        <header class="entry-header">
        <h1 class="entry-title">{$article.title}</h1>
        </header><!-- .entry-header -->

        <div class="pm-article-info">
            <strong>{$lang.articles_published}</strong>: <time class="entry-date" datetime="{$article.html5_datetime}" title="{$article.full_datetime}" pubdate>{$article.date}</time> {$lang.articles_by} <a href="{$article.author_profile_href}">{$article.name}</a> 
            <strong>{$lang.articles_filedunder}</strong>: 
            {foreach from=$article.pretty_cats key=cat_name item=cat_href}
                <a href="{$cat_href}" title="{$cat_name}">{$cat_name}</a> 
            {/foreach} 
           - <strong>{$article.views_formatted}</strong> {$lang.views}
        </div>

        {if $logged_in && $is_admin == 'yes'}
        <a href="{$smarty.const._URL}/{$smarty.const._ADMIN_FOLDER}/article_manager.php?do=edit&id={$article.id}" rel="tooltip" class="btn btn-mini pull-right" title="{$lang.edit} ({$lang._admin_only})" target="_blank">{$lang.edit}</a>
        {/if}

        <div class="entry-post">
        {if $article.restricted == '1' && ! $logged_in}
        	<div class="restricted-video border-radius4">
			    <h2>{$lang.article_restricted_sorry}</h2>
				<p>{$lang.article_restricted_register}</p>
				<div class="restricted-login">
				{include file='user-auth-login-form.tpl'}
			    </div>
			</div>
        {else}
        	{$article.content}
		{/if}
        </div>
        </article>
        {else}
        <article class="post">
        <h1>{$article}</h1>
        </article>
        {/if}

        {if $ad_4 != ''}
        <div class="pm-ad-zone" align="center">{$ad_4}</div>
        {/if}

		<div class="clearfix"></div>
        {if !empty($article.tags) }
        <div class="pm-article-info"><strong>{$lang.tags}</strong>: 
            {foreach name=tag_links from=$article.tags key=k item=t}
             {if $smarty.foreach.tag_links.last}
              <a href="{$t.link}" title="{$t.tag}">{$t.tag}</a> 
             {else}
              <a href="{$t.link}" title="{$t.tag}">{$t.tag}</a>, 
             {/if}
            {/foreach}
        </div>
        <hr />
        {/if}

        {if is_array($related_articles) && count($related_articles) > 0}
		{if count($related_articles) > 1}
              <div class="btn-group btn-group-sort opac6 pm-slide-control">
              <button class="btn btn-mini" id="pm-slide-art-prev" class="prev"><img src="{$smarty.const._URL}/templates/{$template_dir}/img/arr-l.png" alt="{$lang.prev}"></button>
              <button class="btn btn-mini" id="pm-slide-art-next" class="next"><img src="{$smarty.const._URL}/templates/{$template_dir}/img/arr-r.png" alt="{$lang.next}"></button>
              </div>
		{/if}
			<h2>{$lang.articles_related}</h2>
            <ul class="pm-ul-home-articles" id="pm-ul-home-articles">
            {foreach from=$related_articles item=related key=id}
                <li>
                    <article>
                    {if $related.meta._post_thumb_show != ''}
					<div class="pm-article-thumb">
                    <a href="{$related.link}"><img src="{$smarty.const._ARTICLE_ATTACH_DIR}/{$related.meta._post_thumb_show}" align="left" width="55" height="55" border="0" alt="{$related.title}"></a>
					</div>
                    {/if}

                    <h6 dir="ltr" class="ellipsis"><a href="{$related.link}" class="pm-title-link">{smarty_fewchars s=$related.title length=110}</a></h6>
                    <p class="pm-article-preview">
                    {if $related.meta._post_thumb_show == ''}
                        <div class="minDesc">{smarty_fewchars s=$related.excerpt length=125}</div>
                    {else}
                        <div class="minDesc">{smarty_fewchars s=$related.excerpt length=125}</div>
                    {/if}
                    </p>
                    </article>
                </li>
			{/foreach}
            </ul>
		<div class="clearfix"></div>
		{/if}

	    	{include file="comments.tpl" tpl_name="article-read" allow_comments=$article.allow_comments}


		</div><!-- #primary -->
        </div><!-- #content -->
      </div><!-- .row-fluid -->
    </div><!-- .container-fluid -->


{include file="footer.tpl" tpl_name="article-read"}