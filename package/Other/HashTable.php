<?php
/**
 * HashTable
 *
 * @author   Wxxiong  <wxxiong6@gmail.com>
 * @date     2019/5/9
 * @license  MIT
 * -------------------------------------------------------------
 * HashTable
 */


define('TABLE_SIZE', 100);

class KeyValue
{
    public $key;
    public $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}

class HashTable
{
    public $size = 0;
    public $data = [];
}

function create_table($size = TABLE_SIZE)
{
    $table = new HashTable();
    for ($i = 0; $i < $size; ++$i) {
        $table->data[$i] = null;
    }
    $table->size = 100;

    return $table;
}

function destroy_table(&$table)
{
    unset($table);
}

function hash_key($key, $size = TABLE_SIZE)
{
    $len = strlen($key);
    $hash = 0;
    for ($i = 0; $i < $len; ++$i) {
        $hash = $hash * 31 + ord($key[$i]);
    }

    return abs($hash % $size);
}

function print_debug($table)
{
    for ($i = 0; $i < $table->size; ++$i) {
        if (null === $table->data[$i]) {
            echo $i, "\n";
        } else {
            echo $i, ' key=', $table->data[$i]->key, ', value=', $table->data[$i]->value , "\n";
        }
    }
}

function exists(&$table, $key)
{
    $index = hash_key($key);
    if (null === $table->data[$index]) {
        return false;
    }

    if (0 === strcmp($key, $table->data[$index]->key)) {
        return true;
    }

    return false;
}

function add(&$table, $key, KeyValue $object)
{
    $index = hash_key($key);
    $table->data[$index] = $object;
}

function get(&$table, $key)
{
    $index = hash_key($key);
    if (0 === strcmp($key, $table->data[$index]->key)) {
        return $table->data[$index]->value;
    }
}

function delete(&$table, $key)
{
    $index = hash_key($key);
    if (null === $table->data[$index]) {
        return;
    }
    if (0 === strcmp($key, $table->data[$index]->key)) {
        return $table->data[$index] = null;
    }
}

$hash_table = create_table();
print_debug($hash_table);

add($hash_table, 'Wang', new KeyValue('Wang', '50'));
add($hash_table, 'Li', new KeyValue('Li', '20'));
add($hash_table, 'Chow', new KeyValue('Chow', '23'));
print_debug($hash_table);

//get
echo "----------get-------------- \n";
var_dump(get($hash_table, 'Wang'));

//delete
echo "----------delete-------------- \n";
delete($hash_table, 'Wang');
var_dump(delete($hash_table, 'Wang'));

//exists
echo "----------exists-------------- \n";
var_dump(exists($hash_table, 'Wang'));
var_dump(exists($hash_table, 'Li'));