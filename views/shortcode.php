<?php
// We will use the $post global for settings
global $post;

if (!function_exists('printBannersJSON')) {
    // Helper function to print Banner JSON
    function printBannersJSON($banners) {
        foreach ($banners as $banner) : ?>
        {
                id: <?= json_encode($banner->ID) ?>,
                title: <?= json_encode($banner->post_title) ?>,
                image: <?= json_encode(\get_the_post_thumbnail_url($banner, 'full')) ?>,
                link: <?= json_encode(\get_field('banner_link', $banner->ID)) ?>,
                width: <?= json_encode((int)\get_field('width', $banner->ID)) ?>,
                height: <?= json_encode((int)\get_field('height', $banner->ID)) ?>,
                background: <?= json_encode(\get_field('background_color', $banner->ID)) ?>,
                newWindow: <?= json_encode(\get_field('new_window', $banner->ID)) ?>

            },
        <?php
        endforeach;
    }
}

// Load all films
$mbff_films = \get_posts([
    'post_type'     => 'mbfilmfest_film',
    'numberposts'   => -1,
    'orderby'       => 'menu_order',
    'order'         => 'ASC'
]);

// Load all links
$mbff_links = \get_posts([
    'post_type'     => 'mbfilmfest_link',
    'numberposts'   => -1,
    'orderby'       => 'menu_order',
    'order'         => 'ASC'
]);

// Load all primary banners (based on primary_banners_tag_filter)
$mbff_primary_banners = \get_posts([
    'post_type'     => 'mbfilmfest_banner',
    'numberposts'   => -1,
    'orderby'       => 'menu_order',
    'order'         => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => \get_field('primary_banners_tag_filter')
        )
    )
]);

// Load all secondary banners (based on secondary_banners_tag_filter)
$mbff_secondary_banners = \get_posts([
    'post_type'     => 'mbfilmfest_banner',
    'numberposts'   => -1,
    'orderby'       => 'menu_order',
    'order'         => 'ASC',
    'tax_query' => array(
        array(
            'taxonomy' => 'post_tag',
            'field'    => 'term_id',
            'terms'    => \get_field('secondary_banners_tag_filter')
        )
    )
]);

?><div id="mbfilmfest_view"></div>

<script>
var mbfilmfest = {
    baseUrl: <?= json_encode(\plugin_dir_url($this->plugin->plugin_dir)) ?>,
    contents: {
        primaryBanners: [
    <?php printBannersJSON($mbff_primary_banners); ?>
    ],
        films: [
<?php foreach ($mbff_films as $film):
    if (\get_field('video_embed_code', $film->ID)) {
        $oembed = (\get_field('video_embed_code', $film->ID));
    } else {
        $oembed = \get_field('video_oembed', $film->ID);
        $matches = null;
        preg_match('/src="(.+?)"/', $oembed, $matches);
        $src = $matches[1];
        $params = array(
            'autoplay'  => 1,
            'hd'        => 1,
            'autohide'  => 1
        );
        $new_src = add_query_arg($params, $src);
        $oembed = str_replace($src, $new_src, $oembed);

        $attributes = 'frameborder="0"';
        $oembed = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $oembed);
    }
    ?>
            {
                id: <?= json_encode($film->ID) ?>,
                title: <?= json_encode($film->post_title) ?>,
                screening_time: <?= json_encode($film->screening_time) ?>,
                description: <?= json_encode($film->description) ?>,
                image: <?= json_encode(\get_the_post_thumbnail_url($film, 'large')) ?>,
                embed: <?= json_encode($oembed) ?>,
                startTime: <?= json_encode(\get_field('start_time', $film->ID)) ?>,
                endTime: <?= json_encode(\get_field('end_time', $film->ID)) ?>,
                tags: [<?php
                $tags = \get_the_tags($film);
                foreach ($tags as $i => $tag):
                    echo ($i > 0 ? "," : '') . json_encode($tag->name);
                endforeach;
                ?>]
            },
<?php endforeach; ?>
        ],
        secondaryBanners: [
    <?php printBannersJSON($mbff_secondary_banners); ?>
    ],
        links: [
<?php foreach ($mbff_links as $link): ?>
            {
                id: <?= json_encode($link->ID) ?>,
                name: <?= json_encode($link->post_title) ?>,
                image: <?= json_encode(\get_the_post_thumbnail_url($link, 'medium')) ?>,
                link: <?= json_encode($link->link_url) ?>,
                tags: [<?php
                $tags = \get_the_tags($link);
                foreach ($tags as $i => $tag):
                    echo ($i > 0 ? "," : '') . json_encode($tag->term_id);
                endforeach;
                ?>]
            },
<?php endforeach; ?>
        ]
    },
    settings: {
        primaryLinksTitle: <?= json_encode(\get_field('primary_links_title')); ?>,
        primaryLinksDescription: <?= json_encode(\get_field('primary_links_description')); ?>,
        primaryLinksFormat: <?= json_encode(\get_field('primary_links_format')); ?>,
        primaryLinksFilter: <?= json_encode(\get_field('primary_links_tag_filter') ? \get_field('primary_links_tag_filter')->term_id : null); ?>,
        primaryLinksBackground: <?= json_encode(\get_field('primary_links_background_color')); ?>,
        showPrimaryLinkNames: <?= json_encode(\get_field('show_primary_link_names')); ?>,
        secondaryLinksTitle: <?= json_encode(\get_field('secondary_links_title')); ?>,
        secondaryLinksDescription: <?= json_encode(\get_field('secondary_links_description')); ?>,
        secondaryLinksFormat: <?= json_encode(\get_field('secondary_links_format')); ?>,
        secondaryLinksFilter: <?= json_encode(\get_field('secondary_links_tag_filter') ? \get_field('secondary_links_tag_filter')->term_id : null); ?>,
        secondaryLinksBackground: <?= json_encode(\get_field('secondary_links_background_color')); ?>,
        showSecondaryLinkNames: <?= json_encode(\get_field('show_secondary_link_names')); ?>,
    }
}
</script>
