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

$mapping = [];

foreach ($tree as &$n) {
    $mapping[(int)$n['parent_id']][] = &$n;
}

foreach ($tree as &$n) {
    $n['visited'] = false;
    if (isset($mapping[$n['id']])) {
        $n['children'] = $mapping[$n['id']];
    }
}

$str = [];
$stack = [$mapping[0][0]];
while (!empty($stack)) {
    $node = &$stack[count($stack) - 1];

    if ($node['visited'] === true) {
        array_pop($stack);
        array_pop($str);
        continue;
    }
    $node['visited'] = true;
 
    $str[] = $node['id'];
    echo implode('.',$str).PHP_EOL;
    
    if (isset($node['children'])) {
        for ($i = count($node['children']) - 1; $i >= 0; $i--) {
            array_push($stack, $node['children'][$i]);
        }
    }
}

?>
