<?php

register_shutdown_function('onShutdown');

function onShutdown() {
    $error = error_get_last();

    if( $error !== NULL) {
        $errno   = $error["type"];
        $errfile = $error["file"];
        $errline = $error["line"];
        $errstr  = $error["message"];

        echo format_error( $errno, $errstr, $errfile, $errline);
    }
}

function format_error($errno, $errstr, $errfile, $errline) {
    $trace = print_r( debug_backtrace( false ), true );

    $content = <<<EOD

    <table>
        <thead><th>Item</th><th>Description</th></thead>
        <tbody>
            <tr>
                <th>Error</th>
                <td><pre>$errstr</pre></td>
            </tr>
            <tr>
                <th>Errno</th>
                <td><pre>$errno</pre></td>
            </tr>
            <tr>
                <th>File</th>
                <td>$errfile</td>
            </tr>
            <tr>
                <th>Line</th>
                <td>$errline</td>
            </tr>
            <tr>
                <th>Trace</th>
                <td><pre>$trace</pre></td>
            </tr>
        </tbody>
    </table>
EOD;
    return $content;
}

/**
 * @param string $url
 * @return bool|string
 */
function curl(string $url) {
    $curlObject = curl_init($url);
    curl_setopt($curlObject, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curlObject, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curlObject, CURLOPT_RETURNTRANSFER, true);
    $data = @curl_exec($curlObject);
    @curl_close($curlObject);
    return $data;
}

/**
 * @param array $array
 * @param $key
 * @param $value
 * @return mixed|null
 */
function search(array $array, $key, $value) {
    foreach ($array as $index => $item) {
        if ($item[$key] == $value) {
            return $index;
        }
    }
    return null;
}

/**
 * @param $type
 * @param $parents
 * @param $child
 * @return mixed|string
 */
function getParent($type, &$parents, $child) {
    global $pdo;
    $find = search($parents, 'name', $child);
    if ($find === null) {
        $stmt = $pdo->prepare('INSERT INTO `' . $type . '` (name) VALUES (?)');
        $stmt->execute([$child]);
        $child_id = $pdo->lastInsertId();
        $parents[] = ['id' => $child_id, 'name' => $child];
        return $child_id;
    } else {
        return $parents[$find]['id'];
    }
}