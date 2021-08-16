<?php

namespace Ggergo\SqlIndexHintBundle\Tests;

use Ggergo\SqlIndexHintBundle\SqlIndexWalker;
use PHPUnit\Framework\TestCase;

class SqlIndexWalkerTest extends TestCase
{
    use AccessModifierTrait;

    /**
     * Since the parent Sql walker class does not have a nearly complete unit test, we are only testing the core functionality of the extension which happens to be a protected method. ¯\_(ツ)_/¯.
     *
     * @dataProvider provideDataForTestInsertIndex
     */
    public function testInsertIndex($sqlKey, $sqlTableAlias, $indexExp, $sqlQueryString, $correctSql)
    {
        $mockSiw = $this->createMock(SqlIndexWalker::class);
        $sql = $this->invokeMethod($mockSiw, 'insertIndex', [$sqlKey, $sqlTableAlias, $indexExp, $sqlQueryString]);

        $this->assertEquals($correctSql, $sql);
    }

    public function provideDataForTestInsertIndex()
    {
        return [
            ['FROM', 'a', 'FORCE INDEX (PRIMARY)', 'SELECT * FROM schema.table a;', 'SELECT * FROM schema.table a FORCE INDEX (PRIMARY) ;'],
            ['FROM', 'a', 'FORCE INDEX (PRIMARY)', 'SELECT * FROM table a;', 'SELECT * FROM table a FORCE INDEX (PRIMARY) ;'],
            ['FROM', 'a', 'FORCE INDEX (PRIMARY)', 'SELECT * FROM table AS a;', 'SELECT * FROM table AS a FORCE INDEX (PRIMARY) ;'],
            ['FROM', 'a', 'FORCE INDEX (PRIMARY)', 'select * from table as a;', 'select * from table as a FORCE INDEX (PRIMARY) ;'],

            ['JOIN', 'j', 'FORCE INDEX (PRIMARY)', 'SELECT * FROM table a JOIN table_to_join j;', 'SELECT * FROM table a JOIN table_to_join j FORCE INDEX (PRIMARY) ;'],
            ['JOIN', 'j', 'FORCE INDEX (PRIMARY)', 'SELECT * FROM table a JOIN table_to_join j ON a.id = j.aid;', 'SELECT * FROM table a JOIN table_to_join j  FORCE INDEX (PRIMARY) ON a.id = j.aid;'],

            ['JOIN', 'lj', 'FORCE INDEX (PRIMARY)', 'SELECT * FROM table a JOIN table_to_join j on a.id = j.aid LEFT JOIN table_to_join lj ON a.id = j.aid INNER JOIN table_to_join ij;', 'SELECT * FROM table a JOIN table_to_join j on a.id = j.aid LEFT JOIN table_to_join lj  FORCE INDEX (PRIMARY) ON a.id = j.aid INNER JOIN table_to_join ij;'],
        ];
    }
}
