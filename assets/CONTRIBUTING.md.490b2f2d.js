import{_ as s,c as a,o as n,a as l}from"./app.8647f078.js";const u=JSON.parse('{"title":"How to contribute","description":"","frontmatter":{},"headers":[{"level":2,"title":"Contributing","slug":"contributing","link":"#contributing","children":[{"level":3,"title":"Fork this repository","slug":"fork-this-repository","link":"#fork-this-repository","children":[]},{"level":3,"title":"Clone your fork","slug":"clone-your-fork","link":"#clone-your-fork","children":[]},{"level":3,"title":"Create a branch","slug":"create-a-branch","link":"#create-a-branch","children":[]},{"level":3,"title":"Add a remote","slug":"add-a-remote","link":"#add-a-remote","children":[]},{"level":3,"title":"Pull and rebase","slug":"pull-and-rebase","link":"#pull-and-rebase","children":[]},{"level":3,"title":"Working on branch","slug":"working-on-branch","link":"#working-on-branch","children":[]},{"level":3,"title":"Submitting pull request","slug":"submitting-pull-request","link":"#submitting-pull-request","children":[]}]}],"relativePath":"CONTRIBUTING.md"}'),o={name:"CONTRIBUTING.md"},e=l(`<h1 id="how-to-contribute" tabindex="-1">How to contribute <a class="header-anchor" href="#how-to-contribute" aria-hidden="true">#</a></h1><p>Thank you for considering to contribute to this repository! This file will walk you through all the steps to ensure both you and I have a good time submitting and reviewing your contribution. First off, some basic rules and reading material:</p><ul><li>Submit your work in a new branch and make the PR to the master branch.</li><li><a href="http://chris.beams.io/posts/git-commit/" target="_blank" rel="noreferrer">Write a short &amp; descriptive commit message</a>.</li><li>Rebase before committing the final change.</li><li>Stick to <a href="http://www.php-fig.org/psr/psr-2/" target="_blank" rel="noreferrer">PSR-2</a>.</li><li>Add tests if necessary and ensure all the tests are green on the final commit.</li><li>Make sure the CI tools used by the repository are all in order. If one fails, you should make it pass.</li></ul><h2 id="contributing" tabindex="-1">Contributing <a class="header-anchor" href="#contributing" aria-hidden="true">#</a></h2><p>Here are the steps to follow to contribute to this repository:</p><ul><li><a href="#fork-this-repository">Fork this repository on GitHub</a>.</li><li><a href="#clone-your-fork">Clone your fork to your local machine</a>.</li><li><a href="#create-a-branch">Create a feature branch</a>.</li><li><a href="#add-a-remote">Add an &#39;upstream&#39; remote</a>.</li><li><a href="#pull-and-rebase">Regularly pull &amp; rebase from the upstream remote</a>.</li><li><a href="#working-on-branch">Work on feature branch</a>.</li><li><a href="#submitting-pull-request">Submit a pull request to the master branch</a>.</li></ul><h3 id="fork-this-repository" tabindex="-1">Fork this repository <a class="header-anchor" href="#fork-this-repository" aria-hidden="true">#</a></h3><p>Fork the repository right here on GitHub. To learn more about forking a repository, visit <a href="https://help.github.com/articles/fork-a-repo/" target="_blank" rel="noreferrer">GitHub&#39;s help article</a>.</p><h3 id="clone-your-fork" tabindex="-1">Clone your fork <a class="header-anchor" href="#clone-your-fork" aria-hidden="true">#</a></h3><p>Clone your repository on your local machine to start work on your pull request.</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki material-palenight"><code><span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">git</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">clone</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">git@github.com:</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">USERNAM</span><span style="color:#A6ACCD;">E</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">REPOSITOR</span><span style="color:#A6ACCD;">Y</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">.git</span></span>
<span class="line"><span style="color:#676E95;font-style:italic;"># Or if you prefer HTTPS:</span></span>
<span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">git</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">clone</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">https://github.com/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">USERNAM</span><span style="color:#A6ACCD;">E</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">REPOSITOR</span><span style="color:#A6ACCD;">Y</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">.git</span></span>
<span class="line"></span>
<span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">cd</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">REPOSITOR</span><span style="color:#A6ACCD;">Y</span><span style="color:#89DDFF;">&gt;</span></span>
<span class="line"></span></code></pre></div><h3 id="create-a-branch" tabindex="-1">Create a branch <a class="header-anchor" href="#create-a-branch" aria-hidden="true">#</a></h3><p>Make your own feature branch in order not to clutter up master.</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki material-palenight"><code><span class="line"><span style="color:#676E95;font-style:italic;"># Think of a good name for your branch:</span></span>
<span class="line"><span style="color:#676E95;font-style:italic;">#   fix/typo-in-readme</span></span>
<span class="line"><span style="color:#676E95;font-style:italic;">#   feature/some-feature</span></span>
<span class="line"><span style="color:#676E95;font-style:italic;">#   bug/some-bug-you-are-fixing</span></span>
<span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">git</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">checkout</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">-b</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">BRANCH_NAM</span><span style="color:#A6ACCD;">E</span><span style="color:#89DDFF;">&gt;</span></span>
<span class="line"></span></code></pre></div><h3 id="add-a-remote" tabindex="-1">Add a remote <a class="header-anchor" href="#add-a-remote" aria-hidden="true">#</a></h3><p>Add an &#39;upstream&#39; remote to pull from and to stay up to date with the work being done in there.</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki material-palenight"><code><span class="line"><span style="color:#676E95;font-style:italic;"># List all current remotes</span></span>
<span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">git</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">remote</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">-v</span></span>
<span class="line"><span style="color:#FFCB6B;">origin</span><span style="color:#A6ACCD;">  </span><span style="color:#C3E88D;">git@github.com/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">USERNAM</span><span style="color:#A6ACCD;">E</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">REPOSITOR</span><span style="color:#A6ACCD;">Y</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">.git</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">(</span><span style="color:#FFCB6B;">fetch</span><span style="color:#89DDFF;">)</span></span>
<span class="line"><span style="color:#FFCB6B;">origin</span><span style="color:#A6ACCD;">  </span><span style="color:#C3E88D;">git@github.com/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">USERNAM</span><span style="color:#A6ACCD;">E</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">REPOSITOR</span><span style="color:#A6ACCD;">Y</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">.git</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">(</span><span style="color:#FFCB6B;">push</span><span style="color:#89DDFF;">)</span></span>
<span class="line"></span>
<span class="line"><span style="color:#676E95;font-style:italic;"># Add a new remote called &#39;upstream&#39;</span></span>
<span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">git</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">remote</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">add</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">upstream</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">git@github.com:san-kumar/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">REPOSITOR</span><span style="color:#A6ACCD;">Y</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">.git</span></span>
<span class="line"><span style="color:#676E95;font-style:italic;"># Or if you prefer HTTPS:</span></span>
<span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">git</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">remote</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">add</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">upstream</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">https://github.com/san-kumar/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">REPOSITOR</span><span style="color:#A6ACCD;">Y</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">.git</span></span>
<span class="line"></span>
<span class="line"><span style="color:#676E95;font-style:italic;"># The new remote should now be in the list</span></span>
<span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">git</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">remote</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">-v</span></span>
<span class="line"><span style="color:#FFCB6B;">origin</span><span style="color:#A6ACCD;">  </span><span style="color:#C3E88D;">git@github.com/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">USERNAM</span><span style="color:#A6ACCD;">E</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">REPOSITOR</span><span style="color:#A6ACCD;">Y</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">.git</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">(</span><span style="color:#FFCB6B;">fetch</span><span style="color:#89DDFF;">)</span></span>
<span class="line"><span style="color:#FFCB6B;">origin</span><span style="color:#A6ACCD;">  </span><span style="color:#C3E88D;">git@github.com/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">USERNAM</span><span style="color:#A6ACCD;">E</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">REPOSITOR</span><span style="color:#A6ACCD;">Y</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">.git</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">(</span><span style="color:#FFCB6B;">push</span><span style="color:#89DDFF;">)</span></span>
<span class="line"><span style="color:#FFCB6B;">upstream</span><span style="color:#A6ACCD;">  </span><span style="color:#C3E88D;">git@github.com/san-kumar/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">REPOSITOR</span><span style="color:#A6ACCD;">Y</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">.git</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">(</span><span style="color:#FFCB6B;">fetch</span><span style="color:#89DDFF;">)</span></span>
<span class="line"><span style="color:#FFCB6B;">upstream</span><span style="color:#A6ACCD;">  </span><span style="color:#C3E88D;">git@github.com/san-kumar/</span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">REPOSITOR</span><span style="color:#A6ACCD;">Y</span><span style="color:#89DDFF;">&gt;</span><span style="color:#C3E88D;">.git</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">(</span><span style="color:#FFCB6B;">push</span><span style="color:#89DDFF;">)</span></span>
<span class="line"></span></code></pre></div><h3 id="pull-and-rebase" tabindex="-1">Pull and rebase <a class="header-anchor" href="#pull-and-rebase" aria-hidden="true">#</a></h3><p>Pull from upstream to stay up to date with what others might be doing in this repository. Any merge conflicts that arise are your responsibility to resolve.</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki material-palenight"><code><span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">git</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">pull</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">--rebase</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">upstream</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">master</span></span>
<span class="line"></span></code></pre></div><h3 id="working-on-branch" tabindex="-1">Working on branch <a class="header-anchor" href="#working-on-branch" aria-hidden="true">#</a></h3><p>Do your magic and make your fix. I can&#39;t help you with this 😉. Once you&#39;re happy with the result and all tests pass, go ahead and push to your feature branch.</p><div class="language-bash"><button title="Copy Code" class="copy"></button><span class="lang">bash</span><pre class="shiki material-palenight"><code><span class="line"><span style="color:#FFCB6B;">$</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">git</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">push</span><span style="color:#A6ACCD;"> </span><span style="color:#C3E88D;">origin</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&lt;</span><span style="color:#C3E88D;">BRANCH_NAM</span><span style="color:#A6ACCD;">E</span><span style="color:#89DDFF;">&gt;</span></span>
<span class="line"></span></code></pre></div><h3 id="submitting-pull-request" tabindex="-1">Submitting pull request <a class="header-anchor" href="#submitting-pull-request" aria-hidden="true">#</a></h3><p>Now, let&#39;s head back over to this repository on GitHub and submit the pull request!</p>`,25),t=[e];function p(r,c,i,y,C,D){return n(),a("div",null,t)}const A=s(o,[["render",p]]);export{u as __pageData,A as default};
