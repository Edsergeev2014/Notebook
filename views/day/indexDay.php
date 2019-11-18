<?php
?>
<h1>Расписание на сегодня</h1>
<!-- Проверка на выходной день -->
<h2>Сегодня: <?=$day->titleDay;?> <?php if($day->isWeekend):?> - выходной день<?php else:?>рабочий день<?php endif;?></h1>
<h3>Дата: <?=$day->date?></h3>
<h3>Время: <?=$day->time?></h3>
<h4><?=$day->activity?></h2>






