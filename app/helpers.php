<?php

/**
 * Helper fucntion to style active menu items
 * @param [type] $path   [description]
 * @param string $active [description]
 */
function set_active($path, $active = 'active', $complex = 0)
{
  if ($complex == 0) {
      return Request::is($path)? $active : '';
  } else {
    $complexpath = Request::segment(1) . '/' . Request::segment(2);
    return $path == $complexpath? $active : '';

  }

}
/**
 *  them directory selector
 */
// if (! function_exists('theme')) {
//     function theme($path)
//     {
//         $config = app('config')->get('cms.theme');
//         return url($config['folder'].'/'.$config['active'].'/assets/'.$path);
//     }
// }
