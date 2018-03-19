# Tennis-game

Project set up for pair programing tests

## Installation

```
composer install
```

## Run

```
php game.php
```

## Test

```
vendor/bin/phpunit tests/TennisTest.php
```

## Exercise steps :

1. Start party : 0 - 0
2. Player 1 scores : 15 - 0
3. Player 1 scores and win game : 30 - 0, 40 - 0, 1 - 0 / 0 - 0
4. Player 2 scores : 15 - 15, 15 - 30, 15 - 40, 30 - 40, 40 - 40
5. Players 1 and 2 equalities : A - 40, 40 - 40, 40 - A
6. Player 2 win game after equality: 0 - 1 / 0 - 0
7. Players 1 and 2 win games up to 4 - 4
8. Player 1 win 6 - 4
9. Player 1 and 2 equality : 5 - 5
10. Player 2 win 7 - 5
11. Player 1 and 2 equality : 6 - 6
12. Player 1 and 2 play tie break until player 2 wins : 7 - 6