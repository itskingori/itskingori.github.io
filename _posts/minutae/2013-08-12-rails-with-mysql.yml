title: "Set MySQL Instead Of SQLite3 As Default In New Rails App"

published: 2013-08-12T12:00:00+3:00

type: own-post

content: |-

    Normally we would do something like `rails new APP_PATH` but we have the
    option to preconfigure for selected database namely: mysql, oracle,
    postgresql, sqlite3, frontbase, ibm_db, sqlserver, jdbcmysql, jdbcsqlite3,
    jdbcpostgresql, jdbc

    <pre class="brush: plain">
    Usage:
        rails new APP_PATH [options]

    Options:
        -d, [--database=DATABASE]
    </pre>

    So we could use `$rails new projectname -d mysql` the specify the port in
    the database config file, `config/database.yml`.

    <pre class="brush: plain; highlight: [9,19,29]">
    development:
        adapter: mysql2
        encoding: utf8
        database: **YOURDBNAME_development**
        pool: 5
        username: **YOUR_USERNAME**
        password: **YOUR_PASSWORD**
        host: localhost
        port: 3306

    test:
        adapter: mysql2
        encoding: utf8
        database: **YOURDBNAME_test**
        pool: 5
        username: **YOUR_USERNAME**
        password: **YOUR_PASSWORD**
        host: localhost
        port: 3306

    production:
        adapter: mysql2
        encoding: utf8
        database: **YOURDBNAME_production**
        pool: 5
        username: **YOUR_USERNAME**
        password: **YOUR_PASSWORD**
        host: localhost
        port: 3306
    </pre>

    If you are using MAMP, you can use the sockets instead;

    <pre class="brush: plain; highlight: [9,19,29]">
    development:
        adapter: mysql2
        encoding: utf8
        database: **YOURDBNAME_development**
        pool: 5
        username: **YOUR_USERNAME**
        password: **YOUR_PASSWORD**
        host: localhost
        socket: /Applications/MAMP/tmp/mysql/mysql.sock

    test:
        adapter: mysql2
        encoding: utf8
        database: **YOURDBNAME_test**
        pool: 5
        username: **YOUR_USERNAME**
        password: **YOUR_PASSWORD**
        host: localhost
        socket: /Applications/MAMP/tmp/mysql/mysql.sock

    production:
        adapter: mysql2
        encoding: utf8
        database: **YOURDBNAME_production**
        pool: 5
        username: **YOUR_USERNAME**
        password: **YOUR_PASSWORD**
        host: localhost
        socket: /Applications/MAMP/tmp/mysql/mysql.sock
    </pre>

    Check out [this other post][3] that has details on installation of Rails on
    OS X (MySQL included).

    _Ps: Find out more options from `rails --help`_

    _Ps 2: For those using Rails & MAMP (using sockets, which seems to be the
    easier option) ... I'm not quite sure if it works out of the box. I was
    tinkering with an actual MySQL install using homebrew by the time I found
    this solution. If it doesn't, try install MySQL using homebrew first. There
    have been a few articles on the web discussing the fact that the MySQL
    bundled with MAMP doesn't have everything reuired for a full MySQL
    installation (which might be necessary for the mysql2 gem install)._

    <div markdown="1" class="post-footnotes">
    1. [Stack Overflow | Convert a Ruby on Rails app from sqlite to MySQL?][1] ... shows you step by step guide on how to migrate an existing SQLite DB to MySQL.
    2. [Stack Overflow | Using SQLite vs. MySQL with Ruby?][2] ... debate on which is the better way to go. Personally I prefer MySQL.
    </div>

    [1]: http://stackoverflow.com/questions/1670154/convert-a-ruby-on-rails-app-from-sqlite-to-mysql
    [2]: http://stackoverflow.com/questions/5781482/using-sqlite-vs-mysql-with-ruby
    [3]: /minutae/2013/07/rails-on-osx/
