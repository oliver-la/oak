{extends file="main.tpl"}
{block name="content"}
    {foreach from=$albums  item=$album}
        <a href="{$base_dir}album/{$album['id']}">
            <img src="{$base_dir}uploads/{$album['id']}/{$album['thumb']}" alt="" />
        </a>
        {foreachelse}
        <p>
            No albums found in this gallery.
        </p>
    {/foreach}
{/block}