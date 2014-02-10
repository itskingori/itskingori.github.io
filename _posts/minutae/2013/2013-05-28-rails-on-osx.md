---
title: "Rails On OS X (Mountain Lion)"
category: minutae
---

Start by [installing homebrew][11] :-)

###Installing Ruby###

OS X comes with [Ruby][4] installed but it's an older version, and you don't
want to be messing with core files so it's better to use [rbenv][2] and
[ruby- build][3] to manage and install your Ruby development environments.

Install both using [Homebrew][6]. Once done, add a line to your
`~/.bash_profile` and reload your terminal profile.

<pre class="brush: bash">
$ brew install rbenv ruby-build
$ echo 'eval "$(rbenv init -)"' >> ~/.bash_profile
$ source ~/.bash_profile
</pre>

They allow you to install different versions of Ruby and specify which
version to use on a per project basis. This is very useful to keep a
consistent development environment if you need to work in a particular Ruby
version.

Install the latest stable of Ruby ([check the Ruby website][5]). To see a
list of all available versions to install use `rbenv install --list`.

<pre class="brush: bash">
$ rbenv install 2.0.0-p247
$ rbenv rehash
</pre>

To set this version as the one to use globally so that you can make use of
it in your terminal, do this:

<pre class="brush: bash">
$ rbenv global 2.0.0-p247
</pre>

_Ps: You need to run the `rbenv rehash` after you install a new version of
Ruby._

_Ps 2: Check out more commands in the `rbenv` [readme on Github][7]. It's
worth bookmarking that page for reference later, or there is always `rbenv
--help`. The most common are:_


###Installing Bundler###

[Bundler][9] is a [Ruby gem][8] manages an application's dependencies, kind
of like a shopping list of other libraries the application needs to work. If
you're just starting out with Ruby on Rails you will see just how important
and helpful this gem is.

You can use the `rbenv shell` command to ensure we have the correct version
of Ruby loaded in our terminal window, it sets a shell-specific Ruby version
by setting the `BENV_VERSION` environment variable in your shell. This
version overrides application-specific versions and the global version. If
you're paranoid you can always check your Ruby version with `ruby
--version`.

<pre class="brush: bash">
$ rbenv shell 2.0.0-p247
$ gem install bundler
$ rbenv rehash
</pre>

To configure Bundler to install gems in a location relative to your projects
instead of globally, in this case the vendor folder of a Rails project, do
this:

<pre class="brush: bash">
$ mkdir ~/.bundle
$ touch ~/.bundle/config
$ echo 'BUNDLE_PATH: vendor/bundle' >> ~/.bundle/config
</pre>

####Skip rdoc generation####

If you use Google for finding your Gem documentation you might consider
saving a bit of time when installing gems by skipping the documentation.

<pre class="brush: bash">
$ echo 'gem: --no-rdoc --no-ri' >> ~/.gemrc
</pre>

_Ps: Notice `rbenv rehash` has been used again when installing bundler, you
need to do this whenever you install a new gem that provides binaries. So if
you've installed a gem and the terminal tells you it can't find it run
`rbenv rehash`._

_Ps 2: As you'll see from `rbenv install --list` there are loads of Ruby
versions available including JRuby just remember you will need to re-install
your gems for each version as they are not shared._


###Installing Rails###

Check out the [Rails website][10] for the whole story on Rails.

<pre class="brush: bash">
$ gem install rails
$ rbenv rehash
</pre>

Rails has a number of dependencies to install so don't be surprised if you
see loads of other gems being installed at the same time.


###Installing MySQL###

Most people prefer MySQL as their DB of choice.

<pre class="brush: bash">
$ gem install mysql2
</pre>

To connect:

<pre class="brush: bash">
$ mysql -u root
</pre>

A few things that you should know:

<pre class="brush: bash">
# To have launchd start mysql at login:
$ ln -sfv /usr/local/opt/mysql/*.plist ~/Library/LaunchAgents

# Then to load mysql now:
$ launchctl load ~/Library/LaunchAgents/homebrew.mxcl.mysql.plist

# Or, if you don't want/need launchctl, you can just run:
# mysql.server {start|stop|restart|reload|force-reload|status}
$ mysql.server start
</pre>

If you are using MAMP and don't need MySQL, check out the config file
details [in this other post][12].

_Ps: For those using Rails & MAMP (using sockets, which seems to be the
easier option) ... I'm not quite sure if it works out of the box. I was
tinkering with an actual MySQL install using homebrew by the time I found
this solution. If it doesn't, try install MySQL using homebrew first. There
have been a few articles on the web discussing the fact that the MySQL
bundled with MAMP doesn't have everything reuired for a full MySQL
installation (which might be necessary for the mysql2 gem install)._


###Your First Rails Project###

<pre class="brush: bash">
$ rails new helloworld
$ cd helloworld
</pre>

Set the local Ruby version for this project to make sure this stays
constant, even if we change the global version later on. This command will
write automatically to `.ruby-version` in your project directory. This file
will automatically change the Ruby version within this folder and warn you
if you don't have it installed.

Then run Bundler to install all the project gems into vendor/bundle, they
are kept with the project locally and won't interfere with anything else
outside.

<pre class="brush: bash">
$ rbenv local 2.0.0-p247
$ bundle install
</pre>

If your gems ever stop working you can just delete the vendor/bundle
directory and run the command again to re-install them. It's also worth
updating your .gitignore file so you don't commit all of those gems!

Now to test if the application is working:

<pre class="brush: bash">
$ rails server
</pre>

<div markdown="1" class="post-footnotes">
1. [Official Ruby website][5]
2. This post is borrowed heavily from [Ruby on Rails development with Mac OS X Mountain Lion][1]. He deserves the credit. This is merely my own personal reference of the procedure.
3. [`rbenv` Command Reference][7]
4. [Bundler Ruby Gem][9]
5. [Rails Ruby Gem][8]
6. [Installing Homebrew][11]
</div>

[1]: http://createdbypete.com/articles/ruby-on-rails-development-with-mac-os-x-mountain-lion/
[2]: https://github.com/sstephenson/rbenv
[3]: https://github.com/sstephenson/ruby-build
[4]: http://www.ruby-lang.org/en/
[5]: http://www.ruby-lang.org/en/downloads/
[6]: http://brew.sh/
[7]: https://github.com/sstephenson/rbenv#command-reference
[8]: http://docs.rubygems.org/read/chapter/1
[9]: http://bundler.io/
[10]: http://rubyonrails.org/
[11]: https://github.com/mxcl/homebrew/wiki/Installation
[12]: /minutae/2013/08/rails-with-mysql/
