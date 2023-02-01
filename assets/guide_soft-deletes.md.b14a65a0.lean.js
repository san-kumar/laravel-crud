import{_ as o,c as s,o as a,b as e,d as t}from"./app.ca73af7b.js";const v=JSON.parse('{"title":"Soft deletes","description":"","frontmatter":{},"headers":[],"relativePath":"guide/soft-deletes.md"}'),d={name:"guide/soft-deletes.md"},l=e("h1",{id:"soft-deletes",tabindex:"-1"},[t("Soft deletes "),e("a",{class:"header-anchor",href:"#soft-deletes","aria-hidden":"true"},"#")],-1),n=e("p",null,"Laravel provides a simple way to implement soft deletes on your Eloquent models. Soft deletes allow you to keep a record of a model's deletion without actually deleting the model from your database. This allows you to restore the model at a later time if needed.",-1),r=e("p",null,"Laravel CRUD generator handles tables with soft deletes automatically and generates the appropriate code for you to restore or purge deleted records.",-1),i=e("blockquote",null,[e("p",null,[e("img",{src:"https://cdn.articlevideorobot.com/hosted/22-12-2022/selection-305-e2e0.webp",alt:"Handling soft deletes"}),e("br"),t(" (Handling soft deletes)")])],-1),c=e("p",null,[t("To show deleted records in the list view, just append "),e("code",null,"?trashed=1"),t(" to the URL (this link isn't added to the navigation menu by default, so you have to add it manually).")],-1),h=[l,n,r,i,c];function u(p,f,_,m,g,y){return a(),s("div",null,h)}const w=o(d,[["render",u]]);export{v as __pageData,w as default};