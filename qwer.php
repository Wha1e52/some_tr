<?php

require_once 'classes/Car.php';

$text = '<p>Параграф.</p><!-- Комментарий --> <a href="#fragment">Ещё текст</a>';
echo strip_tags($text, '<p><a>');
echo "\n";




