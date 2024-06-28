<?
$title = 'Обратный звонок';
if($args['form-title']) $title = $args['form-title']; ?>
<h2><?=$title;?></h2>
<?if($args['name']) echo '<p><b>Имя: </b>' . $args['name'] . '</p>'; ?>
<?if($args['lastname']) echo '<p><b>Фамилия: </b>' . $args['lastname'] . '</p>'; ?>
<?if($args['middlename']) echo '<p><b>Отчество: </b>' . $args['middlename'] . '</p>'; ?>
<?if($args['tel']) echo '<p><b>Телефон: </b>' . $args['tel'] . '</p>'; ?>
<?if($args['email']) echo '<p><b>Email: </b>' . $args['email'] . '</p>'; ?>
<?if($args['company']) echo '<p><b>Организация: </b>' . $args['company'] . '</p>'; ?>
<?if($args['message']) echo '<p><b>Сообщение: </b>' . $args['message'] . '</p>'; ?>