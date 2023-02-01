import{_ as e,c as s,o as a,a as n}from"./app.ca73af7b.js";const C=JSON.parse('{"title":"Installation","description":"","frontmatter":{},"headers":[{"level":2,"title":"Install with Composer","slug":"install-with-composer","link":"#install-with-composer","children":[]},{"level":2,"title":"Generate files","slug":"generate-files","link":"#generate-files","children":[]},{"level":2,"title":"Including the generated routes","slug":"including-the-generated-routes","link":"#including-the-generated-routes","children":[]},{"level":2,"title":"Location of the generated files","slug":"location-of-the-generated-files","link":"#location-of-the-generated-files","children":[]}],"relativePath":"guide/install.md"}'),l={name:"guide/install.md"},t=n(`<h1 id="installation" tabindex="-1">Installation <a class="header-anchor" href="#installation" aria-hidden="true">#</a></h1><h2 id="install-with-composer" tabindex="-1">Install with Composer <a class="header-anchor" href="#install-with-composer" aria-hidden="true">#</a></h2><p>Via <a href="http://getcomposer.org" target="_blank" rel="noreferrer">composer</a>:</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki material-palenight"><code><span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">composer</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">require</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">san-kumar/laravel-crud</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">--dev</span></span>
<span class="line"></span></code></pre></div><h2 id="generate-files" tabindex="-1">Generate files <a class="header-anchor" href="#generate-files" aria-hidden="true">#</a></h2><div class="warning custom-block"><p class="custom-block-title">Important!</p><p>Make sure to create the db tables and run migrations before starting the crud generator.</p></div><p>After installing the package you should see a new <code>crud:generate</code> command in your Artisan commands list.</p><p>To generate the Controller, Model, Policy, routes, etc use the following command:</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki material-palenight"><code><span class="line"><span style="color:#676E95;font-style:italic;"># Create CRUD for authors table</span></span>
<span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">php</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">artisan</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">crud:generate</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">authors</span></span>
<span class="line"></span>
<span class="line"><span style="color:#676E95;font-style:italic;"># Create CRUD for the authors &amp;gt; posts table</span></span>
<span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">php</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">artisan</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">crud:generate</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">authors.posts</span></span>
<span class="line"></span>
<span class="line"><span style="color:#676E95;font-style:italic;"># Create CRUD for the authors &amp;gt; posts &amp;gt; comments table  </span></span>
<span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">php</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">artisan</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">crud:generate</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">authors.posts.comments</span></span>
<span class="line"></span></code></pre></div><h2 id="including-the-generated-routes" tabindex="-1">Including the generated routes <a class="header-anchor" href="#including-the-generated-routes" aria-hidden="true">#</a></h2><p>By default, the generated routes are placed in the <code>./routes/crud/</code> directory. To include the generated routes just open your <code>routes/web.php</code> file and add the following line at the end of the file:</p><div class="language-php"><button title="Copy Code" class="copy"></button><span class="lang">php</span><pre class="shiki material-palenight"><code><span class="line"><span style="color:#676E95;font-style:italic;">/* inside routes/web.php */</span></span>
<span class="line"></span>
<span class="line"><span style="color:#89DDFF;">\\</span><span style="color:#A6ACCD;">San</span><span style="color:#89DDFF;">\\</span><span style="color:#A6ACCD;">Crud</span><span style="color:#89DDFF;">\\</span><span style="color:#FFCB6B;">Crud</span><span style="color:#89DDFF;">::</span><span style="color:#82AAFF;">routes</span><span style="color:#89DDFF;">();</span><span style="color:#A6ACCD;"> </span></span>
<span class="line"></span></code></pre></div><p>This will <code>glob</code> all the generated route files and include them in the <code>routes/web.php</code> file for you.</p><p>Alternatively, you can copy-paste the generated routes from the <code>./routes/crud/</code> directory to your <code>routes/web.php</code> file. This way you make any changes to the generated route code as per your needs.</p><h2 id="location-of-the-generated-files" tabindex="-1">Location of the generated files <a class="header-anchor" href="#location-of-the-generated-files" aria-hidden="true">#</a></h2><p>The <code>crud:generate</code> command will generate the following files and place them in the appropriate directories:</p><ul><li>Resource Controller <ul><li><code>app/Http/Controllers/[Name].php</code></li></ul></li><li>Model <ul><li><code>app/Model/[Name].php</code></li></ul></li><li>Policy <ul><li><code>app/Policies/[Name]Policy.php</code></li></ul></li><li>Routes <ul><li><code>routes/crud/[name].php</code></li></ul></li><li>Views <ul><li><code>resources/views/[name]/(index|edit|create|show).blade.php</code></li></ul></li></ul><p>By default, the generated code will not overwrite any existing files. If you want to overwrite the existing files, you can use the <code>--force</code> option.</p>`,18),o=[t];function r(p,i,c,d,h,u){return a(),s("div",null,o)}const g=e(l,[["render",r]]);export{C as __pageData,g as default};