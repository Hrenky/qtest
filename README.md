<h3>Setup process</h3>

<p>Project is using PHP 8.1</p>

<strong>OPTIONAL</strong>

<p>If there are issues with running <code>composer install</code> you will need to update
composer with <code>composer self-update</code></p>

<strong>STEPS</strong>

<ul>
<ol>1. <code>composer install</code> and <code>npm install</code> to install all the packages</ol>
<ol>2. copy .env.example to .env just to have an .env file</ol>
<ol>3. run <code>php artisan key:generate</code></ol>
<ol>4. run <code>npm run build</code> to create all css and js files</ol>
<ol>5. run <code>php artisan server</code> and go to the link it gives you</ol>
</ul>
