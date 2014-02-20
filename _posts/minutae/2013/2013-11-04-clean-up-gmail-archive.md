---
title: "How To Filter Out What's Been Archived From All Mail (In GMail)"
category: minutae
layout: post
---

In the Gmail search box, type ...

```
-label:inbox -label:sent -label:drafts -label:trash -label:notes
```

This should give you all your archived messages (excluding the emails in the
inbox, sent, drafts, trash and notes).

You also probably want to consider changing the IMAP action after an email is
deleted from archiving the email (default) to sending the deleted email to
'Trash'.

I prefer the latter, since it places the deleted email in the most sensible
place - 'Trash'. And deleting the email from 'Trash' now permanently deletes it
and archiving does the obvious - archive. Keeping your 'All Mail' much cleaner.

_Ps: If you have other custom labels you'll need to add them in there as well._
