<?
$title = 'Связаться с нами'; ?>
<h2><?=$title;?></h2>
<?if($args['tel']) echo '<p><b>Телефон: </b>' . $args['tel'] . '</p>'; ?>
<?if($args['form-title']) echo '<p><b>Точка продажи: </b>' . $args['form-title'] . '</p>'; ?> 
<?if($args['form-address']) echo '<p><b>Адрес организации: </b>' . $args['form-address'] . '</p>'; ?>