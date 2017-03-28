{extends file="main.tpl"}
{block name="content"}
    <form action="{$base_dir}gallery" method="post" class="dropzone" id="galleryZone">
        <input type="hidden" name="id" value="{$id}" />
        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>
    </form>

    <a href="{$base_dir}album/{$id}">Create album</a>
{/block}

{block name="footer" append="true"}
    <script src="{$base_dir}static/js/dropzone.js"></script>
{/block}