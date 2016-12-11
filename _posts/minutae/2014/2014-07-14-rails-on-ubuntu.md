---
title: Rails On Ubuntu
category: minutae
layout: post
---

Ubuntu provides a package manager system for installing system software. You’ll
use this to prepare your computer before installing Ruby. However, don’t use
`apt-get` to install Ruby. The package manager will install an outdated version
of Ruby. And it will install Ruby at the system level (for all users). It’s
better to use RVM to install Ruby within your user environment.

But if you have an older version of Ruby installed on your computer, there’s no
need to remove it. RVM will leave your "system Ruby" untouched and use your
shell to intercept any calls to Ruby. Any older Ruby versions will remain on
your system and the RVM version will take precedence.

### Installing RVM & Ruby

Use [RVM, the Ruby Version Manager][2], to install Ruby and manage your Rails
versions as you might need an easy way to switch between Ruby versions. Just as
important, you’ll have a dependency mess if you install gems into the system
environment. RVM is popular, well-supported, and full-featured.

Here’s the simplest way:

```bash
$ \curl -L https://get.rvm.io | bash -s stable --ruby
```

The "—ruby" flag will install the newest version of Ruby. RVM includes an
"autolibs" option to identify and install system software needed for your
operating system. If you already have RVM installed, update it to the latest
version and install Ruby:

```bash
$ rvm get stable --autolibs=enable
$ rvm install ruby
$ rvm --default use ruby-2.1.2
```

To list available Ruby versions, run:

```bash
$ rvm list known
```

For example to change to Ruby version 2.0.0-p481, run:

```bash
$ rvm install ruby-2.0.0-p481
```

### Gems & RubyGems

[RubyGems][3] is the gem manager in Ruby. Use `gem update --system` to upgrade
the Ruby gem manager if necessary.

By default, when you install gems, documentation files will be installed.
Developers seldom use gem documentation files (they’ll browse the web instead).
Installing gem documentation files takes time, so many developers like to toggle
the default so no documentation is installed. Here’s how to speed up gem
installation by disabling the documentation step:

```bash
$ echo "gem: --no-document" >> ~/.gemrc
```

This adds the line `gem: --no-document` to the hidden `.gemrc` file in your home
directory.

### Installing Rails

You can install Rails directly into the global gemset. However, many developers
prefer to keep the global gemset sparse and install Rails into project-specific
gemsets, so each project has the appropriate version of Rails.

If you install Rails at this point, you will install it into the global gemset.
Instead, make a gemset just for the current stable release:

```bash
$ rvm use ruby-2.0.0-p481@rails4.1 --create
```

Install most recent stable release:

```bash
$ gem install rails
$ rails -v
```


---
1. [RailsApps by Daniel Kehoe][1]
2. [RVM, Ruby Version Manager][2]
3. [RubyGems.org][3]

[1]: https://railsapps.github.io/installrubyonrails-ubuntu.html
[2]: https://rvm.io
[3]: http://rubygems.org
