# USE INDEX and FORCE INDEX using Doctrine MySQL

Doctrine SqlWalker extension to apply `USE INDEX` and `FORCE INDEX` hints using DQL on top of MySQL.
Works with both `createQuery()` and `createQueryBuilder()`.
You can set different index hints per DQL table aliases.

## Getting Started

Example:
```php
use Ggergo\SqlIndexHintBundle\SqlIndexWalker;
use Doctrine\ORM\Query;
// ...
$query = '...';
$query->setHint(Query::HINT_CUSTOM_OUTPUT_WALKER, SqlIndexWalker::class);
$query->setHint(SqlIndexWalker::HINT_INDEX, [
    'your_dql_table_alias'           => 'FORCE INDEX FOR JOIN (your_composite_index) FORCE INDEX FOR ORDER BY (PRIMARY)',
    'your_another_dql_table_alias'   => 'FORCE INDEX (PRIMARY)',
    // ...
]);
```

### Installing

Require with Composer, i.e.:

```bash
composer require ggergo/sqlindexhintbundle
```
