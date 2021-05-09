<div id="mbfilmfest_view"></div>

<script>
function randcolor()
{
    return "" + ((1<<24)*Math.random() | 0).toString(16);
}

var mbfilmfest = {
    header: {
        image: "https://via.placeholder.com/1920x720.png/000000/FFFFFF?text=Header+Image"
    },
    contents: {
        films: [
            {
                id: 1,
                title: 'Lorem ipsum',
                description: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit',
                image: 'https://via.placeholder.com/1920x1080.png/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
                embed: '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                tags: ['Feature Films', 'Short Films']
            },
            {
                id: 2,
                title: 'Aenean commodo',
                description: 'Aenean commodo ligula eget dolor. Aenean massa',
                image: 'https://via.placeholder.com/1920x1080.png/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
                embed: '<iframe src="https://player.vimeo.com/video/152985022" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>',
                tags: ['Feature Films', 'Short Films']
            },
            {
                id: 3,
                title: 'Cum sociis natoque',
                description: 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus',
                image: 'https://via.placeholder.com/1920x1080.png/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
                embed: '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                tags: ['Feature Films']
            },
            {
                id: 4,
                title: 'Donec quam felis',
                description: 'Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.',
                image: 'https://via.placeholder.com/1920x1080.png/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
                embed: '<iframe src="https://player.vimeo.com/video/152985022" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>',
                tags: ['Feature Films']
            },
            {
                id: 5,
                title: 'Nulla consequat',
                description: 'Nulla consequat massa quis enim..',
                image: 'https://via.placeholder.com/1920x1080.png/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
                embed: '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                tags: ['Feature Films', 'Short Films']
            },
            {
                id: 6,
                title: 'Donec pede justo',
                description: 'Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.',
                image: 'https://via.placeholder.com/1920x1080.png/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
                embed: '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                tags: ['Short Films']
            },
            {
                id: 7,
                title: 'In enim justo',
                description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.',
                image: 'https://via.placeholder.com/1920x1080.png/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
                embed: '<iframe src="https://player.vimeo.com/video/152985022" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>',
                tags: ['Short Films']
            },
            {
                id: 8,
                title: 'Nullam dictum felis',
                description: 'Nullam dictum felis eu pede mollis pretium. Integer tincidunt.',
                image: 'https://via.placeholder.com/1920x1080.png/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
                embed: '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                tags: ['Short Films']
            },
            {
                id: 9,
                title: 'Cras dapibus',
                description: 'Cras dapibus. Vivamus elementum semper nisi.',
                image: 'https://via.placeholder.com/1920x1080.png/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
                embed: '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                tags: ['Short Films']
            },
            {
                id: 10,
                title: 'Aenean vulputate',
                description: 'Aenean vulputate eleifend tellus.',
                image: 'https://via.placeholder.com/1920x1080.png/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
                embed: '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                tags: ['Short Films']
            },
            {
                id: 11,
                title: 'Aenean leo ligula',
                description: 'Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,',
                image: 'https://via.placeholder.com/1920x1080.png/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
                embed: '<iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                tags: ['Short Films']
            }
        ]
    },
    promos: [
        {
            id: 'promo-1',
            title: 'Australian Films on Netflix',
            image: 'https://via.placeholder.com/1920x960.png/' + randcolor() + '/' + randcolor() +  '?text=Australian+Films+on+Netflix',
            link: 'https://www.netflix.com/ph/browse/genre/100371',
            height: '100vh'
        },
        {
            id: 'promo-2',
            title: 'SIP',
            image: 'https://via.placeholder.com/1920x720.png/' + randcolor() + '/' + randcolor() +  '?text=SIP+Promo'
        },
    ],
    partners: [
        {
            id: 'partner-20',
            name: 'Sed ut perspiciatis',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev'
        },
        {
            id: 'partner-21',
            name: 'unde omnis iste',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev'
        },
        {
            id: 'partner-22',
            name: 'Sed ut perspiciatis',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev'
        },
        {
            id: 'partner-23',
            name: 'natus error sit voluptatem',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev'
        },
        {
            id: 'partner-24',
            name: 'accusantium doloremque laudantium',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev'
        },
        {
            id: 'partner-25',
            name: 'eaque ipsa quae ab illo',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev'
        },
        {
            id: 'partner-26',
            name: 'dolor sit amet, consectetur',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev'
        },
        {
            id: 'partner-27',
            name: 'aliquam quaerat voluptatem',
            image: 'https://via.placeholder.com/600/' + randcolor() + '/' + randcolor() + '?text=Placeholder',
            link: 'https://inggo.dev'
        }
    ]
}
</script>