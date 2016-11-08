---
title: "Image Magick, Imagick, Homebrew & MAMP-Pro"
link: https://github.com/jdlx/install_Imagick_on_MAMP/wiki/Imagick-for-MAMP-Pro---installation-guide
category: minutae
layout: post
---

Install [XCode][xcode] + the Command-Line Tools. (CL tools are not bundled with
[Xcode 4.3][xcode43] by default anymore and should contain build tools such as
`gcc` (confirm with whatever version you are using). XCode app (found on the
AppStore) is easy to install but the CL Tools can only be installed within XCode
as an optional install on  the Components tab of the Downloads preferences
panel.

Install [Homebrew][homebrew] which will be used to install libs/components as
well as manage the dependencies for us.

``` bash
$ ruby -e "$(curl -fsSL https://raw.github.com/mxcl/homebrew/go)"
```

Install [ImageMagick][imagemagick].

``` bash
$ brew install imagemagick
```

Installing a PHP53 compatible version of [Imagick][imagick] ... first let
Homebrew search the formula for you

``` bash
$ brew search php53-imagick
```

... OR ...

``` bash
$ brew search imagick
```

The above searches should return something like 'josegonzalez/php/php53-imagick'
... use this for the next step:

``` bash
$ brew install josegonzalez/php/php53-imagick
```

If you get "No formula & taping" errors ...

``` bash
Error: No available formula for XYZ
Please tap it and then try again: brew tap XYZ
```

... do as you've been told, and run the 'brew tap' ... command exactly as the
error told you. After that, repeat the step which caused that error.

Now edit MAMP config & add the extension to MAMP Pro's php.ini. In MAMP Pro go
to the menubar, and choose `File > Edit Templates > PHP > PHP x.x.x php.ini`. A
simple editor window will popup where you can edit the ini file. A search for
the term 'extension=', will lead you to a block with various lines of
'extension=...'. Now simply ad the following one and save the file:

``` bash
extension="/usr/local/Cellar/php53-imagick/3.1.0RC2/imagick.so"
```

Copy libfreetype to MAMP lib (freetype version in path may vary)

``` bash
cp /usr/local/Cellar/freetype/2.4.11/lib/libfreetype.6.dylib /Applications/MAMP/Library/lib/
```

Fix library version incompatibilities by open the file
`/Applications/MAMP/Library/bin/envvars` in the editor, and comment out the
following lines:

``` bash
cDYLD_LIBRARY_PATH="/Applications/MAMP/Library/lib:$DYLD_LIBRARY_PATH"
export DYLD_LIBRARY_PATH
```

Restart MAMP and check the phpinfo tab: a search for the term `imagick` should
bring you to a section reading like so:

``` bash
imagick module version                    3.1.0RC2
imagick classes                           Imagick, ImagickDraw, ImagickPixel, ImagickPixelIterator
ImageMagick version                       ImageMagick 6.7.7-6 2012-09-18 Q16 http://www.imagemagick.org
ImageMagick copyright                     Copyright (C) 1999-2012 ImageMagick Studio LLC
ImageMagick release date                  2012-09-18
ImageMagick number of supported formats:  191
```

_Ps: Original post - see footnote #4, has extra's on enabling tiff support_

#### Update <sup>7th/05/2013</sup> :

After installing Imagemagick using Homebrew on Lion, everything is fine except
that it doesn't work at all when being called from php.

``` php
exec ('/usr/local/bin/convert') // works, but
exec ('which convert') // doesn't
```

Turns out, for php to work convert should be in /usr/bin/ so this solved it:

``` bash
ln -s /usr/local/bin/convert /usr/bin/convert
```

#### Update <sup>25th/12/2013</sup> :

This article was originally linked to [this][1] ... which is now broken. I've
also update Homebrew links which seem to have moved. Thanks to
[@CreativityKills][2] for the heads up.

---

1. This was done on MacOSX 10.8.3 (other versions may vary)
2. Tested with MAMP Pro 2.1.2 (other versions may vary)
3. [Image Magick][imagemagick] & [Imagick][imagick] are two very different things. The former is the core library and the latter is a PHP Wrapper that uses the API of the former, so you do need to install the former before the latter
4. [Xcode 4.3 and Homebrew: Where did my command line tools go?](http://holgr.com/blog/2012/02/xcode-4-3-and-homebrew-where-did-my-command-line-tools-go/)
5. [Resolved: MAMP Php can't exec ('convert') after Homebrew ImageMagick install][link1]
6. [Installing PHP PEAR and PECL extensions on MAMP for Mac OS X 10.7 (Lion)][link2]

[xcode]: https://developer.apple.com/xcode/
[xcode43]: http://developer.apple.com/library/ios/#documentation/DeveloperTools/Conceptual/WhatsNewXcode/Articles/xcode_4_3.html
[homebrew]: http://brew.sh/
[imagemagick]: http://www.imagemagick.org/script/index.php
[imagick]: http://pecl.php.net/package/imagick
[link1]: http://stackoverflow.com/questions/7163497/resolved-mamp-php-cant-exec-convert-after-homebrew-imagemagick-install
[link2]: http://www.lullabot.com/blog/articles/installing-php-pear-and-pecl-extensions-mamp-mac-os-x-107-lion
[1]: https://github.com/jdlx/install_Imagick_on_MAMP/wiki/Imagick-for-MAMP-Pro---installation-guide
[2]: https://twitter.com/CreativityKills
