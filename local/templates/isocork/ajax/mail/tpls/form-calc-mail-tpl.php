<?
$title = 'Обратный звонок';
if($args['form-title']) $title = $args['form-title']; ?>
<h2><?=$title;?></h2>
<?if($args['name']) echo '<p><b>Имя: </b>' . $args['name'] . '</p>'; ?>
<?if($args['tel']) echo '<p><b>Телефон: </b>' . $args['tel'] . '</p>'; ?>
<?if($args['email']) echo '<p><b>Email: </b>' . $args['email'] . '</p>'; ?>
<?if($args['type']) echo '<p><b>Физ.лицо/юр.лицо: </b>' . $args['type'] . '</p>'; ?>
<br/>
<h3>Данные из формы:</h3>
<?if($args['select-type']) echo '<p><b>Тип продукции: </b>' . $args['select-type'] . '</p>'; ?>
<?if($args['select-work']) echo '<p><b>Вид работ: </b>' . $args['select-work'] . '</p>'; ?>
<?if($args['select-architecture']) echo '<p><b>Тип: </b>' . $args['select-architecture'] . '</p>'; ?>
<?if($args['select-local']) echo '<p><b>Локация: </b>' . $args['select-local'] . '</p>'; ?>
<?if($args['select-seam'] && (!$args['select-architecture'] || $args['select-architecture'] != 'Картуш 310мл.')) echo '<p><b>Ширина шва: </b>' . $args['select-seam'] . '</p>'; ?>
<br/>
<b>Размеры строения:</b>
<?if($args['height']) echo '<p><b>Высота, м: </b>' . $args['height'] . '</p>'; ?>
<?if($args['lenght']) echo '<p><b>Длина, м: </b>' . $args['lenght'] . '</p>'; ?>
<?if($args['weight']) echo '<p><b>Ширина, м: </b>' . $args['weight'] . '</p>'; ?>
<?if($args['diameter']) echo '<p><b>Диаметр бруса, м: </b>' . $args['diameter'] . '</p>'; ?>
<?if($args['form-result']) echo '<h3>' . $args['form-result'] . '</h3>'; ?>