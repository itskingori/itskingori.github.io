---
title: "Making Infrastructure Boring"
category: blog
layout: post
---

I'm rather conservative about the tools that I choose to use. I don't always go
for the new shiny toy buy rather the one that's been battle-tested and is
seemingly stable. I didn't quite have a name for this and so, I was quite happy
when I bumped into the idea of "[Choosing Boring Technology][1]" by [Dan
McKinley][2].

While he's talking mostly about software development, I think the same idea can
be applied to infrastructure work. So I just thought it would be worth
distilling his ideas into a few maxims that would be easier for me to remember.

##### Embrace Boredom

> The nice thing about boringness (so constrained) is that the capabilities of
> these things are well understood. But more importantly, their failure modes
> are well understood.

##### Optimize Globally

> The problem with "best tool for the job" thinking is that it takes a myopic
> view of the words "best" and "job." Your job is keeping the company in
> business, god damn it. And the "best" tool is the one that occupies the "least
> worst" position for as many of your problems as possible.

##### Choose New Technology, Sometimes

> New technology choices might be purely additive (for example: "we don’t have
> caching yet, so let’s add memcached"). But they might also overlap or replace
> things you are already using. If that’s the case, you should set clear
> expectations about migrating old functionality to the new system. The policy
> should typically be "we’re committed to migrating," with a proposed timeline.
> The intention of this step is to keep wreckage at manageable levels, and to
> avoid proliferating locally-optimal solutions.

##### Just Ship

> Mindful choice of technology gives engineering minds real freedom: the freedom
> to contemplate bigger questions. Technology for its own sake is snake oil.

---

1. I really encourage you to read [the whole blog post on "Choosing Boring
   Technology"][1]. He goes into detail into each maxim.
2. There's also [a talk about "Choosing Boring Technology"][3] based on [the
   blog post][1].

[1]: https://mcfunley.com/choose-boring-technology
[2]: https://twitter.com/mcfunley
[3]: http://boringtechnology.club
[3]: https://home.apache.org/~dch/blog/2016/10/20/infra-should-be-boring/
[4]: https://dzone.com/articles/boring-is-the-new-black
