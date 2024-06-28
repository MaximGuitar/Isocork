<?
$title = 'Обратный звонок';
if($args['form-title']) $title = $args['form-title']; ?>
<h2><?=$title;?></h2>
<?if($args['tel']) echo '<p><b>Телефон: </b>' . $args['tel'] . '</p>'; ?>
<?if($args['email']) echo '<p><b>Email: </b>' . $args['email'] . '</p>'; ?>