---
title: "Image Attachments as files in Apple Mail"
link: http://micahgilman.com/play/disable-mac-mailapp-inline-image-attachments/
category: minutae
layout: post
---

> Mail.app by default displays images inline, and most email clients won't
> recognize them as attachments. If you right click (or ctrl click with a one
> button mouse) on the image you can select to view the image as icon, which
> makes it behave like a normal attachment. To make this the default behavior
> you'll need to use the Terminal to set the preference. Terminal is in
> `Applications Utilities`. Open Terminal and type:

```console
$ defaults write com.apple.mail DisableInlineAttachmentViewing -bool yes
```

If you decide this isn't what you're looking for, to restore inline attachment
viewing type:

```console
$ defaults write com.apple.mail DisableInlineAttachmentViewing -bool false
```

Restart Mail and you're back to normal.
