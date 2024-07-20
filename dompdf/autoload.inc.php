<?php

/**
 * Dompdf Autoloader
 *
 * PHP versions 5
 *
 * @category Dompdf
 * @package  Dompdf
 * @author   Benj Carson <benj.carson@gmail.com>
 * @author   Fabian Schmengler <fabian.schmengler@tigerdean.de>
 * @license  http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @link     http://www.dompdf.com/
 */

spl_autoload_register(function ($class) {
    // Define the base directory for the namespace prefix
    $baseDir = __DIR__ . '/src/';

    // Does the class use the namespace prefix?
    $len = strlen('Dompdf\\');
    if (strncmp('Dompdf\\', $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // Get the relative class name
    $relativeClass = substr($class, $len);

    // Replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
