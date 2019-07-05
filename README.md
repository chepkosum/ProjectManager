# codeigniter-reg-login
Project management System

Codeigniter version: 3.1.6

After you download unzip the code into your xampp or wampp and rename the folder to <strong>PMS</strong> and then do the below configurations first.

Open and edit <strong>/PMS/application/config/config.php</strong>
<pre class="toolbar-overlay:false lang:php decode:true">$config['base_url'] = 'http://localhost/codeigniter/index.php';</pre>
then,

update your database settings in <strong>/codeigniter/application/config/database.php</strong>
<pre class="toolbar-overlay:false lang:php decode:true">$db['default'] = array(
	'dsn'	=&gt; '',
	'hostname' =&gt; 'localhost',
	'username' =&gt; 'root',
	'password' =&gt; '',
	'database' =&gt; 'ari_project_management',
	'dbdriver' =&gt; 'mysqli',
	'dbprefix' =&gt; '',
	'pconnect' =&gt; FALSE,
	'db_debug' =&gt; (ENVIRONMENT !== 'production'),
	'cache_on' =&gt; FALSE,
	'cachedir' =&gt; '',
	'char_set' =&gt; 'utf8',
	'dbcollat' =&gt; 'utf8_general_ci',
	'swap_pre' =&gt; '',
	'encrypt' =&gt; FALSE,
	'compress' =&gt; FALSE,
	'stricton' =&gt; FALSE,
	'failover' =&gt; array(),
	'save_queries' =&gt; TRUE
);
</pre>
Now open phpmyadmin / mysql, and create a new database called 'ari_project_management' and execute the below queries:
<pre class="toolbar-overlay:false lang:mysql decode:true">--
