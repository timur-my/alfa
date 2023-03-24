<?php //php 7.2.24

/* Вывести дерево без рекурсии в следующем виде
1
1.2
1.2.5
1.2.6
1.2.6.8
1.3
1.3.7
1.4
*/

$tree = [
	[ 'id' => '8', 'parent_id' => '6', ],
	[ 'id' => '2', 'parent_id' => '1', ],
	[ 'id' => '3', 'parent_id' => '1', ],
	[ 'id' => '4', 'parent_id' => '1', ],
	[ 'id' => '5', 'parent_id' => '2', ],
	[ 'id' => '1', 'parent_id' => '0', ],
	[ 'id' => '6', 'parent_id' => '2', ],
	[ 'id' => '7', 'parent_id' => '3', ],
];

$parents = [];
foreach ($tree as $node) {
	$parents[$node['parent_id']][] = $node['id'];
}

$back = false;
$firstId = array_shift($parents[0]);
$stack = [$firstId];
while (!empty($stack)) {
    $id = $stack[count($stack) - 1];

    if ($back === false) {
    	echo implode('.',$stack).PHP_EOL;
    }

    if (isset($parents[$id]) && count($parents[$id]) > 0) {
    	$nextId = array_shift($parents[$id]);
    	array_push($stack, $nextId);
    	$back = false;
    } else {
    	array_pop($stack);
    	$back = true;
    }
}

?>
