[![Build Status](https://travis-ci.org/itsmrwave/itsmrwave.github.io.svg?branch=master)](https://travis-ci.org/itsmrwave/itsmrwave.github.io)

[Personal site][1], initially on [Stacey][2] [for a while][4] but now ported to [Jekyll][5].

To install dependencies run:

```bash
$ bundle install
```

To run Jekyll in a way that matches the GitHub Pages build server, run Jekyll
with Bundler. Run:

```bash
$ bundle exec jekyll serve --watch --safe --trace --incremental
```

To run tests i.e. check if we can successfully build via jekyll build and run
HTML::Proofer do this:

```bash
$ bundle exec rake test
```

[1]: http://kingori.co
[2]: http://staceyapp.com/
[3]: http://feeds.feedburner.com/kingorico
[4]: https://github.com/itsmrwave/kingori.co/tree/on-stacey
[5]: http://jekyllrb.com/
