<?php
// We will use the $post global for settings
global $post;

// Load all films
$mbff_films = \get_posts([
    'post_type'     => 'mbfilmfest_film',
    'numberposts'   => -1,
    'orderby'       => 'menu_order',
    'order'         => 'ASC'
]);

?><div id="mbfilmfest_view"></div>

<script>
function randcolor()
{
    return "" + ((1<<24)*Math.random() | 0).toString(16);
}

var mbfilmfest = {
    baseUrl: <?= json_encode(\plugin_dir_url($this->plugin->plugin_dir)) ?>,
    header: {
        image: "https://via.placeholder.com/1920x720.png/000000/FFFFFF?text=Header+Image"
    },
    contents: {
        films: [
<?php foreach ($mbff_films as $film):
    $oembed = get_field('video_oembed', $film->ID);
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
    ?>
            {
                id: <?= json_encode($film->ID) ?>,
                title: <?= json_encode($film->post_title) ?>,
                screening_time: <?= json_encode($film->screening_time) ?>,
                description: <?= json_encode($film->description) ?>,
                image: <?= json_encode(\get_the_post_thumbnail_url($film, 'full')) ?>,
                embed: <?= json_encode($oembed) ?>,
                tags: [<?php
                $tags = \get_the_tags($film);
                foreach ($tags as $tag):
                    echo json_encode($tag->name) . ",";
                endforeach;
                ?>]
            },
<?php endforeach; ?>
        ]
    },
    promos: [
        {
            id: 'promo-1',
            title: 'Australian Films on Netflix',
            image: 'https://via.placeholder.com/1920x960.png/' + randcolor() + '/' + randcolor() +  '?text=Australian+Films+on+Netflix',
            link: 'https://www.netflix.com/ph/browse/genre/100371',
            height: '100vh',
            background: '#000000'
        }
    ],
    links: [
        {
            id: 'partner-20',
            name: 'Sed ut perspiciatis',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev',
            tags: ['Sip']
        },
        {
            id: 'partner-21',
            name: 'unde omnis iste',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev',
            tags: ['Sip']
        },
        {
            id: 'partner-22',
            name: 'Sed ut perspiciatis',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev',
            tags: ['Sip']
        },
        {
            id: 'partner-23',
            name: 'natus error sit voluptatem',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev',
            tags: ['Sip']
        },
        {
            id: 'partner-24',
            name: 'accusantium doloremque laudantium',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev',
            tags: ['Sip']
        },
        {
            id: 'partner-25',
            name: 'eaque ipsa quae ab illo',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev',
            tags: ['Sip']
        },
        {
            id: 'partner-26',
            name: 'dolor sit amet, consectetur',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev',
            tags: ['Partner']
        },
        {
            id: 'partner-27',
            name: 'aliquam quaerat voluptatem',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev',
            tags: ['Partner']
        },
        {
            id: 'partner-28',
            name: 'dolor sit amet, consectetur',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev',
            tags: ['Partner']
        },
        {
            id: 'partner-29',
            name: 'aliquam quaerat voluptatem',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev',
            tags: ['Partner']
        },
        {
            id: 'partner-30',
            name: 'dolor sit amet, consectetur',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev',
            tags: ['Partner']
        },
        {
            id: 'partner-31',
            name: 'aliquam quaerat voluptatem',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev',
            tags: ['Partner']
        }
    ],
    settings: {
        primaryLinksTitle: <?= json_encode(\get_field('primary_links_title')); ?>,
        primaryLinksDescription: <?= json_encode(\get_field('primary_links_description')); ?>,
        primaryLinksFormat: <?= json_encode(\get_field('primary_links_format')); ?>,
        primaryLinksFilter: <?= json_encode(\get_field('primary_links_tag_filter')); ?>,
        primaryLinksBackground: <?= json_encode(\get_field('primary_links_background_color')); ?>,
        secondaryLinksTitle: <?= json_encode(\get_field('secondary_links_title')); ?>,
        secondaryLinksDescription: <?= json_encode(\get_field('secondary_links_description')); ?>,
        secondaryLinksFormat: <?= json_encode(\get_field('secondary_links_format')); ?>,
        secondaryLinksFilter: <?= json_encode(\get_field('secondary_links_tag_filter')); ?>,
        secondaryLinksBackground: <?= json_encode(\get_field('secondary_links_background_color')); ?>
    }
}
</script>
