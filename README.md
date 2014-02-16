Currently Connected Users
==========

This is a small piece of PHP for use with the JW Player. It will show how many connected users are watching a steam at any particular time (by IP Address). The IPs are stored in a text file.

### [Demo](http://www.pluginsbyethan.com/github/connected.php)

Implementation:
==========

The file visitors.php simply needs to be loaded unerneath the closing script tag for your JW Player embed as a PHP include It is that simple. Like so:

<pre>
&lt;?php include 'visitors.php'; ?&gt;
</pre>

Example:
==========
<pre>
&lt;script type=&quot;text/javascript&quot; src=&quot;jwplayer.js&quot;&gt;&lt;/script&gt;
&lt;div id=&quot;player&quot;&gt;&lt;/div&gt;
&lt;script type=&quot;text/javascript&quot;&gt;
jwplayer('player').setup({
&nbsp;&nbsp;'width': '575',
&nbsp;&nbsp;'height': '400',
&nbsp;&nbsp;'file': 'video.mp4'
&nbsp;&nbsp;'image': &quot;video.jpg&quot;
});
&lt;/script&gt;
&lt;?php include 'visitors.php'; ?&gt;
</pre>

The source code is available for this script. There is just a .php file for PHP. Publishing the PHP can be simply done with any text editor. Enjoy~! :)