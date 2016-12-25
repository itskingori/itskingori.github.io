---
title: To globally ignore or not to?
category: minutae
layout: post
---

I found myself [contributing to an open source project][oauth2-server-php]
recently ... [here][commit1] & [here][commit2]. First thing that I thought
awkward was that the project's `.gitignore` file paid no attention to OS-
generated or editor-generated files. So I happily contributed those exclusions
to the project's `.gitignore` so we ended up with [this][commit3] ...

```text
# Editor Files #
*.komodoproject

# OS generated files #
.DS_Store
.DS_Store?
._*
.Spotlight-V100
.Trashes
Icon?
ehthumbs.db
Thumbs.db
```

Which isn't elegant. At all.

> I have a slight problem with this, though. The .DS_Store isn’t related to your
> project, it is related to the system you’re coding on. _Your .gitignore file
> will be a lot more elegant if it only lists files that are related to the
> projects_.

### Solution ###

Git has a global configuration that applies rules to all of your projects.

On linux for example:

```bash
$ git config --global core.excludesfile ~/.global_ignore
```

On Windows (if using GitHub. for Windows) the `.gitconfig` file lives in the
user's home directory. In my case, for example ( & on Windows Vista/8), the
location of the `.gitconfig` file is `C:\Users\YOU\.gitconfig`. To set up a
global gitconfig, I use a directory `C:\Users\YOU\config\` containing a file
called `global_ignore`, and in `.gitconfig` I would add;

```ini
[user]
    name = King'ori Maina
    email = j@kingori.co

[core]
    excludesfile = C:/Users/itsmrwave/configs/global_ignore
```

And finally in the `global_ignore` file we have something like;

```text
## Editor Files ##
*.sublime-project
*.sublime-workspace

## Backup ##
*.bak

## Logs and databases ##
*.log
*.sql
*.sqlite

## Packages ##
# it's better to unpack these files and commit the raw source
# git has its own built in compression methods
*.7z
*.dmg
*.gz
*.iso
*.jar
*.rar
*.tar
*.zip

# OS generated files #
$RECYCLE.BIN/
.DS_Store
.DS_Store?
._*
.Spotlight-V100
.Trashes
Desktop.ini
Icon?
ehthumbs.db
Thumbs.db
```

Of course this is [my pref][my-global-ignore], feel free to use whatever
suits you.

---

1. [A collection of useful .gitignore
   Templates](https://github.com/github/gitignore)
2. [Ignoring files](https://help.github.com/articles/ignoring-files)
3. [Setting up a global .gitignore for Github for
   Windows](http://www.lemoda.net/git/github-gitignore-windows/index.html)
4. [Global gitignores](http://augustl.com/blog/2009/global_gitignores/)

[commit1]: https://github.com/itsmrwave/oauth2-server-php/commit/640498926f2ebe8499c14184b89d613acf60ae59  "Update README with more info on grant types"
[commit2]: https://github.com/itsmrwave/oauth2-server-php/commit/31fc8c2a2f9dcf1d3a0a58736c7b6d7cd88bb74a  "Place the realm & scope values in ..."
[commit3]: https://github.com/itsmrwave/oauth2-server-php/commit/f26798ce7007c19671e7fed5bfe42d5c63240639  "Ignore editor, OS and test files"
[oauth2-server-php]: https://github.com/bshaffer/oauth2-server-php  "bshaffer/oauth2-server-php"
[my-global-ignore]: https://github.com/itsmrwave/configs/blob/master/gitignore/global_ignore  "itsmrwave/configs/gitignore/global_ignore"
