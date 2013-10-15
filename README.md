WXRContentBundle
================

Installation
------------

Nothing special.

Configuration
-------------

WXRContentBundle doesn't require any configuration.

### Default configuration

``` yaml
wxr_content:
    twig:
        extension:
            render:
                default_template: WXRContentBundle::contents.html.twig
```

Twig extension
--------------

WXRContentBundle comes with the `wxr_content_render` twig function.

Display contents where "example" is content's name, tag's name or tag's slug:

``` twig
{{ wxr_content_render("example") }}
```

Display content by content's name:

``` twig
{{ wxr_content_render({ name: content_name }) }}
```

Display contents by tag's name:

``` twig
{{ wxr_content_render({ "tag.name": tag_name }) }}
```

Display contents by tag's slug:

``` twig
{{ wxr_content_render({ "tag.slug": tag_slug }) }}
```

Display content or array of contents:

``` twig
{{ wxr_content_render(some_contents) }}
```

Contents will be rendered by the default template (see Configuration).
To override default template, pass it as second parameter:

``` twig
{{ wxr_content_render(some_contents, 'WXRContentBundle::raw.html.twig') }}
```
