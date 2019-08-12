<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/
fscanf(STDIN, "%d %d",
    $W, # width of the building.
    $H # height of the building.
);
fscanf(STDIN, "%d",
    $N # maximum number of turns before game over.
);
fscanf(STDIN, "%d %d",
    $currentPositionX,
    $currentPositionY
);
$upperBoundary = 0;
$lowerBoundary = $H - 1;
$leftBoundary = 0;
$rightBoundary = $W - 1;
# game loop
while (TRUE) {
    fscanf(STDIN, "%s",
        $bombDir # the direction of the bombs from batman's current location (U, UR, R, DR, D, DL, L or UL)
    );
    $bombDir = str_split($bombDir);
    foreach($bombDir as $dir) {
        switch($dir) {         
            case 'D':
                $upperBoundary = $currentPositionY;
                $currentPositionY = ceil(($currentPositionY + $lowerBoundary) / 2);
                break;
            case 'U':
                $lowerBoundary = $currentPositionY;
                $currentPositionY = floor(($currentPositionY + $upperBoundary) / 2);
                break;
            case 'L':
                $rightBoundary = $currentPositionX;
                $currentPositionX = floor(($currentPositionX + $leftBoundary) / 2);
                break;
            case 'R':
                $leftBoundary = $currentPositionX;
                $currentPositionX = ceil(($currentPositionX + $rightBoundary) / 2);
                break;
        }
    }
    # Write an action using echo(). DON'T FORGET THE TRAILING \n
    # To debug (equivalent to var_dump): error_log(var_export($var, true));
    # the location of the next window Batman should jump to.
    echo($currentPositionX.' '.$currentPositionY."\n");
}
?>
