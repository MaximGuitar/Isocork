<?php
  function tpl($tpl, $args = [], $echo = true){
    $loader = new \Twig\Loader\FilesystemLoader(ABS_TPL_PATH.'/twig-templates/');
    $cache = isset($_GET['clear_cache']) ? false : ABS_TPL_PATH.'/twig-templates/cache/';
    $twig = new \Twig\Environment($loader, [
      'cache' => $cache,
    ]);

    $tpl = $tpl.'.html';
    if ($echo)
      echo $twig->render($tpl, $args);
    else
      return $twig->render($tpl, $args);
  }

  function render_partial($template_path, $render_data) {
    extract(['args' => $render_data]);
    require $template_path;
  }
?>