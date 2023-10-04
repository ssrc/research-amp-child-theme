# Research AMP Child Theme

This is a sample child theme for Research AMP Theme, the official theme for [Research AMP](https://ramp.ssrc.org/). The Research AMP Theme is meant to be highly customizable using the powerful tools in the WordPress Site Editor. However, there are some cases where a Research AMP site might need to customize the theme beyond what is possible in the Site Editor. The purpose of this child theme is to demonstrate how some of these customizations can be achieved.

## CSS styles

Many modifications to the appearance and layout of your site can be achieved using CSS. For small amounts of CSS, you can use the Custom CSS at Dashboard > Appearance > Customize > Additional CSS, with no need for a child theme like this one.

For larger amounts of CSS, or for cases where your team would prefer to keep the custom CSS in a file rather than in the WordPress database (for example, in order to use version control tools), you can use a child theme like this one. Add your custom styles to the `style.css` file in this child theme.

More advanced users can modify the way that the child theme and parent theme's stylesheets are registered and enqueued in the `functions.php` file. See the `research_amp_child_theme_enqueue_styles` function for details.

## Block template and part overrides

Research AMP generates much of its markup using PHP template files. In cases where you cannot achieve your desired changes using the tools available in the Site Editor, most of Research AMP's template files can be overridden in your child theme. Some examples:

1. You want to change the language or markup of the 'Submit' button on the Profile and Citation archive filter forms. This markup is created by the template found at `wp-content/plugins/research-amp/templates/filters/submit.php`. To customize this template without modifying the Research AMP plugin, create a directory called `filters` in your child theme, and copy the `submit.php` file from the Research AMP plugin into this directory. Then, make your desired changes to the template file in your child theme. Research AMP will use your customized template file instead of the one in the plugin.

2. You want to change the markup used by the 'Item Byline' block. This markup is created by the template found at `wp-content/plugins/research-amp/templates/blocks/item-byline.php`. Similar to the first example, you may create a child-theme directory `blocks`, copy the `item-byline.php` file from the Research AMP plugin into that directory, and make your modifications in the new file.

For a complete list of templates available for override, see the `wp-content/plugins/research-amp/templates` directory, or search the `research-amp` codebase for `ramp_get_template_part()` calls.

## Miscellaneous PHP customizations

Parts of the Research AMP platform, as well as many other third-party plugins, can be customized through the use of PHP filters and actions. For example, you can modify the default parameters that Research AMP uses to make external Zotero requests using a filter callback:

```php
add_filter(
  'ramp_zotero_client_remote_defaults',
  function ( $defaults ) {
    $defaults['timeout'] = 30;
    return $defaults;
  }
);
```

Similarly, certain plugins recommended for Research AMP sites offer customization using a similar technique. For example, if you are using Relevanssi for enhanced search, and you want to disable Relevanssi on Profile and Citation archives (where it may interfere with certain aspects of the default Research AMP search experience for these archives), you can use a filter callback:

```php
add_action(
  'wp',
  function() {
    if ( is_post_type_archive( 'ramp_profile' ) || is_post_type_archive( 'ramp_citation' ) ) {
      remove_filter( 'posts_request', 'relevanssi_prevent_default_request' );
      remove_filter( 'posts_pre_query', 'relevanssi_query', 99 );
    }
  }
);
```

Customizations of this sort can be added to the `functions.php` file in this child theme.

## Site Editor configuration values and theme.json

Many of the options available in the Site Editor when editing your Research AMP site are defined in the `theme.json` file in `research-amp-theme`. This includes options like the font sizes and color palette available for selection in the Styles section of the Site Editor. You can override these values in your child theme by creating a `theme.json` file in the root of your child theme.

See (https://fullsiteediting.com/lessons/child-themes/)[https://fullsiteediting.com/lessons/child-themes/] for more information about child themes and `theme.json`.
