<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

function breadthFirstSearch(int $origin,int $destination): ?SplDoublyLinkedList {
    
    global $graph;
    $visited = [];
    $path = [];
    foreach ($graph as $vertex => $adj) {
        $visited[$vertex] = false;
    }
    $q = new SplQueue();
    $q->enqueue($origin);
    $visited[$origin] = true;
    $path[$origin] = new SplDoublyLinkedList();
    $path[$origin]->setIteratorMode(
        SplDoublyLinkedList::IT_MODE_FIFO|SplDoublyLinkedList::IT_MODE_KEEP
    );
    $path[$origin]->push($origin);
    $found = false;
    while (!$q->isEmpty() && $q->bottom() != $destination) {
        $t = $q->dequeue();
        if (!empty($graph[$t])) {
            // для каждого соседнего узла
            foreach ($graph[$t] as $vertex) {
                if (!$visited[$vertex]) {
                    $q->enqueue($vertex);
                    $visited[$vertex] = true;
                    $path[$vertex] = clone $path[$t];
                    $path[$vertex]->push($vertex);
                }
            }
        }
    }
    if (isset($path[$destination])) {
        return $path[$destination];
    } else {
        return null;
    }
}


fscanf(STDIN, "%d %d %d",
    $N, // the total number of nodes in the level, including the gateways
    $L, // the number of links
    $E // the number of exit gateways
);
$graph = [];
for ($i = 0; $i < $L; $i++) {
    fscanf(STDIN, "%d %d",
        $N1, // N1 and N2 defines a link between these nodes
        $N2
    );
    $graph[$N1][] = $N2;
    $graph[$N2][] = $N1;
}
$exits = [];
for ($i = 0; $i < $E; $i++) {
    fscanf(STDIN, "%d",
        $EI // the index of a gateway node
    );
    $exits[] = $EI;
}
// game loop
while (TRUE)
{
    fscanf(STDIN, "%d",
        $SI // The index of the node on which the Skynet agent is positioned this turn
    );
    $path = null;
    foreach($exits as $exit) {
        if($t = breadthFirstSearch($SI,$exit)) {
            if(!$path || (count($t) < count($path))) {
                $path = $t;
            }
        }
    }
    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug (equivalent to var_dump): error_log(var_export($var, true));
    $B1 = $path->shift();
    $B2 = $path->shift();
    unset($graph[$B1][$B2]);
    unset($graph[$B2][$B1]);
    // Example: 0 1 are the indices of the nodes you wish to sever the link between
    echo($B1.' '.$B2."\n");
    
 
}
?>
