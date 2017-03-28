{extends file="main.tpl"}
{block name="class"}album{/block}
{block name="content"}
    <span class="view badge">
        View:&nbsp;
        <a href="javascript:location.reload()" class="active" id="link_list" title="List"><i class="fa fa-list"></i></a>&nbsp;
        <a href="javascript:initSlider()" id="link_slider" title="Slider"><i class="fa fa-arrows-h"></i></a>&nbsp;
    </span>

    <span class="badge">
        <a href="{$base_dir}album/{$album->getId()}/delete" title="Delete this album">
            <i class="fa fa-trash"></i>
        </a>
    </span>

    <div class="album-list">
        {foreach from=$images  item=$image}
            {assign var="thumbs" value=$image->getThumbs()}
            {assign var="exif" value=$image->getDetails()}
            <div class="image">
                <img src="{$base_dir}uploads/{$album->getId()}/{$thumbs[1]->getPath()|basename}" alt="" />
                <a href="{$base_dir}uploads/{$album->getId()}/{$image->getPath()|basename}" class="fullsize-link"  target="_blank"><i class="fa fa-plus"></i></a>
                {if $exif|is_array}
                    {if 'Model'|array_key_exists:$exif}
                        <span class="exif badge">
                            <i class="fa fa-camera"></i>
                            {$exif['Model']}
                        </span>
                    {/if}
                    {if 'Software'|array_key_exists:$exif}
                        <span class="exif badge">
                            <i class="fa fa-picture-o"></i>
                            {$exif['Software']}
                        </span>
                    {/if}
                {/if}
            </div>
        {foreachelse}
            <p>
                No images found in this album.
            </p>
        {/foreach}
    </div>
{/block}

{block name="footer" append="true"}
    <script type="text/javascript" src="{$base_dir}static/js/slick.min.js"></script>
    <script>
        function initSlider() {
            $("#link_list").removeClass('active');
            $("#link_slider").addClass('active');
            $(document).ready(function () {
                $('.album-list').slick({
                    dots: true
                })
            });
        }
    </script>
{/block}