# USE INDEX and FORCE INDEX using Doctrine MySql

Doctrine SqlWalker extension to apply USE INDEX and FORCE INDEX hints using DQL on top of MySql.
Works with both createQuery and createQueryBuilder.
You can set different index hints per DQL table aliases.

## Getting Started

Example:
```
use Ggergo\SqlIndexHintBundle\SqlIndexWalker;
...
$query = ...;
$query->setHint(Query::HINT_CUSTOM_OUTPUT_WALKER, SqlIndexWalker::class);
$query->setHint(SqlIndexWalker::HINT_INDEX, [
    'your_dql_table_alias'           => 'FORCE INDEX FOR JOIN (your_composite_index) FORCE INDEX FOR ORDER BY (PRIMARY)',
    'your_another_dql_table_alias'   => 'FORCE INDEX (PRIMARY)',
    ...
]);
```

### Installing

Require with composer, ie.:

```
{
    "require": {
        "ggergo/sqlindexhintbundle": "*"
    }
}
```
