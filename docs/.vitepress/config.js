export default {
    title: 'Laravel Crud Generator',
    host: 'localhost',
    description: 'Laravel CRUD generator: Generate CRUD for any db table with the crud:generate command.',
    //base: 'https://san-kumar.github.io/laravel-crud/',
    base: '/laravel-crud/',
    appearance: 'dark',
    themeConfig: {
        nav: [
            {text: 'Getting started', link: '/guide'},
            {
                text: 'Artisan commands',
                items: [
                    {text: 'artisan crud:generate', link: '/guide/'},
                    {text: 'artisan crud:template', link: '/guide/customization'},
                    {text: 'artisan crud:remove', link: '/guide/remove'},
                ]
            }
        ],
        sidebar: [
            {
                text: 'Introduction',
                items: [
                    {text: 'Index', link: '/guide/'},
                    {text: 'Installation', link: '/guide/install'},
                    {text: 'Options', link: '/guide/options'},
                ]
            },
            {
                text: 'Details',
                items: [
                    {text: 'Nested parents', link: '/guide/nesting'},
                    {text: 'Authentication', link: '/guide/authentication'},
                    {text: 'Create / edit form', link: '/guide/crud'},
                    {text: 'Soft deletes', link: '/guide/soft-deletes'},
                    {text: 'Inbuilt search', link: '/guide/search'},
                    {text: 'Customization', link: '/guide/customization'},
                ]
            },
            {
                text: 'Appendix',
                items: [
                    {text: 'Gotchas', link: '/guide/gotchas'},
                    {text: 'CRUD removal', link: '/guide/remove'},
                    {text: 'Roadmap', link: '/guide/roadmap'},
                ]
            },
        ],
        editLink: {
            pattern: 'https://github.com/san-kumar/laravel-crud/docs/:path'
        },
        search: {
            maxSuggestions: 10
        },
        footer: {
            message: 'Released under the MIT License.',
            copyright: 'Copyright © 2022-present San Kumar'
        },
        socialLinks: [
            { icon: 'github', link: 'https://github.com/san-kumar/laravel-crud' }
        ],
    }
};