<!doctype html>
<html>
    <head>
        <title>M152</title>
        <base href="{$base_dir}">
        <link rel="stylesheet" href="{$base_dir}static/css/main.css" />
        <link rel="stylesheet" href="{$base_dir}static/css/dropzone.css" />
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    </head>
    <body>
        <header>
            <a href="{$base_dir}">
                <h1 class="title">オーク</h1>
            </a>
            <ul>
                <li>
                    <a href="{$base_dir}">Gallery</a>
                </li>
                <li>
                    <a href="{$base_dir}gallery/new">Upload</a>
                </li>
            </ul>
        </header>
        <section class="container {block name="class"}{/block}">
            {block name="content"}No content yet!{/block}
        </section>

        {block name="footer"}{/block}
    </body>
</html>