export default {
    title: 'Laravel Crud Generator',
    description: 'Laravel CRUD generator: Generate CRUD for any db table with the make:crud command.',
    base: 'https://san-kumar.github.io/laravel-crud/',
    appearance: 'dark',
    themeConfig: {
        nav: [
            {text: '⚡️ Github', link: '/guide'},
            {text: 'Getting started', link: '/guide'},
            {
                text: 'Artisan commands',
                items: [
                    {text: 'artisan crud:generate', link: '/item-1'},
                    {text: 'artisan crud:remove', link: '/item-2'},
                    {text: 'artisan crud:template', link: '/item-3'}
                ]
            }
        ],
        sidebar: [
            {
                text: 'Guide',
                items: [
                    {text: 'Introduction', link: '/introduction'},
                    {text: 'Getting Started', link: '/getting-started'},
                ]
            },
            {
                text: 'Guide',
                collapsible: true,
                items: [
                    {text: 'Introduction', link: '/introduction'},
                    {text: 'Getting Started', link: '/getting-started'},
                ]
            },
        ],
        editLink: {
            pattern: 'https://github.com/vuejs/vitepress/edit/main/docs/:path'
        },
        search: {
            maxSuggestions: 10
        },
        footer: {
            message: 'Released under the MIT License.',
            copyright: 'Copyright © 2019-present Evan You'
        }
    }
};