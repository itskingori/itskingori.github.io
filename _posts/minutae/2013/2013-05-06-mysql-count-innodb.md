---
title: "Fast counting of rows on InnoDB"
category: minutae
layout: post
---

See, MyISAM always stores the number of rows on the table header. So, whenever
we ask "how many rows are there?", it can just grab the count and return it. Not
InnoDB. This makes InnoDB very slow in count queries without a where clause.

> So if you have query like SELECT COUNT(*) FROM USER It will be much faster for
> MyISAM (MEMORY and some others) tables because they would simply read number
> of rows in the table from stored value. Innodb will however need to perform
> full table scan or full index scan because it does not have such counter, it
> also can’t be solved by simple singe counter for Innodb tables as different
> transactions may see different number of rows in the table.

> If you have query like SELECT COUNT(*) FROM IMAGE WHERE USER_ID=5 this query
> will be executed same way both for MyISAM and Innodb tables by performing
> index rage scan. This can be faster or slower both for MyISAM and Innodb
> depending on various conditions.

> The trick is to hint it at a specific index. So, if you’re getting poor
> response times from InnoDB count, it means you’ve got lots of rows that have
> to be counted one at a time. And since you’ve got a lot of rows, you have at
> least one index. Just pick an index that will never contain a NULL value, and
> tell MySQL to ‘use index (index_name)’.

```sql
mysql> SELECT count(*) FROM messages USE INDEX (index_messages_on_remote_created_at);
```

```text
+----------+
| count(*) |
+----------+
|  1276831 |
+----------+

1 row in set (3.19 sec)
```

---

1. [Fast MySQL InnoDB count. Really fast][link1]
2. [MySQL Performance Blog: COUNT(*) for Innodb Tables][link2]
3. [MySQL 5.1 Reference Manual: Counting Rows][link3]
4. COUNT doesn't count NULL values, so if you are counting values _by a field_ that has NULL values, those rows won't be counted by COUNT.

[link1]: http://www.cloudspace.com/blog/2009/08/06/fast-mysql-innodb-count-really-fast/
[link2]: http://www.mysqlperformanceblog.com/2006/12/01/count-for-innodb-tables/
[link3]: http://dev.mysql.com/doc/refman/5.1/en/counting-rows.html
